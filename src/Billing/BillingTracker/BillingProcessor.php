<?php


namespace OpenEMR\Billing\BillingTracker;


class BillingProcessor
{
    /**
     * Post from the billing manager form
     * @var
     */
    protected $post;

    /**
     * The following constants are the options for processing tasks, which are the actions
     * applied to the checked claims on the billing manager screen
     */
    const VALIDATE_ONLY = 'validate-only';
    const VALIDATE_AND_CLEAR = 'validate-and-clear';
    const NORMAL = 'normal';

    /**
     * This is where messages are logged
     *
     * @var array
     */
    protected $bill_info = [];

    protected $hlog = "";

    public function __construct($post)
    {
        $this->post = $post;
    }

    public function execute()
    {
        // Setup
        $processing_task = $this->buildProcessFromPost($this->post);

        // Based on form post, get the claims we actually need to bill
        $claims = $this->prepareClaims();

        // What task are we running, as directed by the user. Are we validating only,
        $this->processClaims($processing_task, $claims);
    }

    public function prepareClaims()
    {
        $claims = [];
        // Build the claims we actually want to process from the post
        // The form pots all claims wether they were selected or not
        foreach ($this->post['claims'] as $claimId => $partner_and_payor) {
            if (isset($partner_and_payor['bill'])) {
                // The format coming in from POST is like this:
                // [ encounter-pid => [ 'partner' => partnerId, 'payor' => 'p'.payorId ], ... ]
                // Since the format is cryptic, we use the BillingClaim constructor to parse that into meaningful
                // attributes.
                $billingClaim = new BillingClaim($claimId, $partner_and_payor);
                $claims[]= $billingClaim;
            }
        }

        // When we reach the end of the loop $billingClaim will still be the last claim object in the array
        // Tell the last claim in the array that they are last
        $billingClaim->setIsLast(true);

        return $claims;
    }

    public function processClaims(ProcessingTaskInterface $processingTask, array $claims)
    {
        // Call setup on our processing task. If the task is a file-generator,
        // this calls setup on the generator (to set up batch file, etc)
        $processingTask->setup($this->post);

        // Go through each claim and process it while organizing them into batches
        $processed_count = 0;
        foreach ($claims as $claim) {

            // Call the execute method on the task we created below based on user input
            // If the task is generating a file, one of the Generator* file's execute methods is called
            $processingTask->execute($claim);
            $processed_count++;
        }

        $processingTask->complete([
            'claims' => $claims,
            'post' => $this->post
        ]);
    }

    protected function buildProcessFromPost($post)
    {
//        if ($GLOBALS['ub04_support']) {
//            require_once("./ub04_dispose.php");
//            ub04_dispose();
//        }
//
//        $EXPORT_INC = "$webserver_root/custom/BillingExport.php";
//        if (file_exists($EXPORT_INC)) {
//            include_once($EXPORT_INC);
//            $BILLING_EXPORT = true;
//        }

        // Depending on which type of process we are running, create the appropriate
        // process object to process the claims and produce output
        $generator = null;
        if ($GLOBALS['gen_x12_based_on_ins_co'] && isset($post['bn_x12'])) {
            $generator = new GeneratorX12Direct();
        } else if ($GLOBALS['gen_x12_based_on_ins_co'] && isset($post['bn_x12_encounter'])) {
            $generator = new GeneratorX12Direct(true);
        } else if (isset($post['bn_x12'])) {
            $generator = new GeneratorX12();
        } else if (isset($post['bn_x12_encounter'])) {
            $generator = new GeneratorX12(true);
        } else if (isset($post['bn_process_hcfa'])) {
            $generator = new GeneratorHCFAPDF();
        } else if (isset($post['bn_process_hcfa_form'])) {
            $generator = new ProcessHCFAForm();
        } else if (isset($post['bn_process_ub04'])) {
            $generator = new GeneratorUB04X12();
        } else if (isset($post['bn_process_ub04_form'])) {
            $generator = new ProcessUB04Form();
        } else if (isset($post['bn_external'])) {
            $generator = new GeneratorExternal();
        }

        // Determine which processing task the user wants us to run based on the input
        // on the billing manager form. If they select validate only, we don't do
        // any writing or create a batch to send, we just perform validation
        // Normal operation will submit generate the files and submit
        $processing_task = null;
        if (isset($post['btn-clear'])) {
            $generator->setAction(self::VALIDATE_AND_CLEAR);
            $processing_task = new TaskGenerateFile($generator);
        } else if (isset($post['btn-validate'])) {
            $generator->setAction(self::VALIDATE_ONLY);
            $processing_task = new TaskGenerateFile($generator);
        } else if (isset($post['btn-continue'])) {
            $generator->setAction(self::NORMAL);
            $processing_task = new TaskGenerateFile($generator);
        } else if (isset($post['bn_reopen'])) {
            $processing_task = new TaskReopen();
        } else if (isset($post['bn_external'])) {
            $processing_task = new TaskMarkAsClear();
        }

        $logger = new BillingLogger();
        $processing_task->setLogger($logger);

        return $processing_task;
    }
}
