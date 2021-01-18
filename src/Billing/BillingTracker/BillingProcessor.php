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

    public function __construct($post)
    {
        $this->post = $post;
    }

    /**
     * This is the entry-point of claim-processing called in billing_process.php
     */
    public function execute()
    {
        // Use the user's input parameters to build the appropriate processing task
        $processing_task = $this->buildProcessingTaskFromPost($this->post);

        // Based on UI form input, get the claims we actually need to bill
        $claims = $this->prepareClaims();

        // What task are we running, as directed by the user. Process the claims using
        // the task
        $this->processClaims($processing_task, $claims);

        return $processing_task->getLogger();
    }

    protected function prepareClaims()
    {
        $claims = [];
        // Build the claims we actually want to process from the post
        // The form pots all claims whether they were selected or not, and we
        // just want the claims that were selected by the user, which have 'bill'
        // index set on their array.
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
        // Tell the last claim in the array that they are last in case it's needed for building the
        // batch output, as in the case of GeneratorX12Direct
        $billingClaim->setIsLast(true);

        return $claims;
    }

    protected function processClaims(ProcessingTaskInterface $processingTask, array $claims)
    {
        // Call setup on our processing task. If the task is a file-generator,
        // this calls setup on the generator (to set up batch file, etc)
        $processingTask->setup($this->post);

        // Go through each claim and process it while organizing them into batches
        foreach ($claims as $claim) {

            // Call the execute method on the task we created below based on user input
            // If the task is generating a file, one of the Generator* file's execute methods is called
            $processingTask->execute($claim);
        }

        $processingTask->complete([
            'claims' => $claims,
            'post' => $this->post
        ]);
    }

    protected function buildProcessingTaskFromPost($post)
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
        // processing task object to process the claims and produce output (if any).
        // Determine which processing task the user wants us to run based on the input
        // on the billing manager form. In the case of the Generator tasks that create
        // an output file, if the user selects validate only, we don't do
        // any writing or create a batch to send, we just perform validation
        // Normal operation will submit generate the files and submit
        $processing_task = null;
        if (isset($post['bn_reopen'])) {
            $processing_task = new TaskReopen();
        } else if (isset($post['bn_external'])) {
            $processing_task = new TaskMarkAsClear();
        } else if ($GLOBALS['gen_x12_based_on_ins_co'] && isset($post['bn_x12'])) {
            $processing_task = new GeneratorX12Direct($this->extractAction());
        } else if ($GLOBALS['gen_x12_based_on_ins_co'] && isset($post['bn_x12_encounter'])) {
            $processing_task = new GeneratorX12Direct($this->extractAction(), true);
        } else if (isset($post['bn_x12'])) {
            $processing_task = new GeneratorX12($this->extractAction());
        } else if (isset($post['bn_x12_encounter'])) {
            $processing_task = new GeneratorX12($this->extractAction(), true);
        } else if (isset($post['bn_process_hcfa'])) {
            $processing_task = new GeneratorHCFAPDF($this->extractAction());
        } else if (isset($post['bn_process_hcfa_form'])) {
            $processing_task = new ProcessHCFAForm($this->extractAction());
        } else if (isset($post['bn_process_ub04'])) {
            $processing_task = new GeneratorUB04X12($this->extractAction());
        } else if (isset($post['bn_process_ub04_form'])) {
            $processing_task = new ProcessUB04Form($this->extractAction());
        } else if (isset($post['bn_external'])) {
            $processing_task = new GeneratorExternal($this->extractAction());
        }

        $logger = new BillingLogger();
        $processing_task->setLogger($logger);

        return $processing_task;
    }

    protected function extractAction()
    {
        $action = null;
        if (isset($this->post['btn-clear'])) {
            $action = self::VALIDATE_AND_CLEAR;
        } else if (isset($this->post['btn-validate'])) {
            $action = self::VALIDATE_ONLY;
        } else if (isset($this->post['btn-continue'])) {
            $action = self::NORMAL;
        }

        return $action;
    }
}
