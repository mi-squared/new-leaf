<?php


namespace OpenEMR\Billing\BillingTracker;


use OpenEMR\Billing\Hcfa1500;

class GeneratorHCFA_PDF extends AbstractGenerator implements GeneratorInterface
{
    protected $pdf;
    protected $batch;

    public function setup($context)
    {
        $this->pdf = new Cezpdf('LETTER');
        $this->pdf->ezSetMargins(trim($context['top_margin']) + 0, 0, trim($context['left_margin']) + 0, 0);
        $this->pdf->selectFont('Courier');

        // Instantiate mainly for the filename creation, we're not tracking text segments
        // since we're generating a PDF
        $this->batch = new BillingClaimBatch();
    }

    public function execute(BillingClaim $claim)
    {
        $log = '';
        $hcfa = new Hcfa1500();
        $lines = $hcfa->genHcfa1500($claim->getPid(), $claim->getEncounter(), $log);
        $this->appendToLog($log);
        $alines = explode("\014", $lines); // form feeds may separate pages
        foreach ($alines as $tmplines) {
            if ($claim_count++) {
                $this->pdf->ezNewPage();
            }
            $this->pdf->ezSetY($this->pdf->ez['pageHeight'] - $this->pdf->ez['topMargin']);
            $this->pdf->ezText($tmplines, 12, array(
                'justification' => 'left',
                'leading' => 12
            ));
        }
        if ($this->getAction() === BillingProcessor::VALIDATE_ONLY) {
            //validate_payer_reset($payer_id_held, $patient_id, $encounter);
            return;
        } else {
            $filename = $this->batch->getBatFilename() . '.pdf';
            if (!BillingUtilities::updateClaim(false, $claim->getPid(), $claim->getEncounter(), -1, -1, 2, 2, $filename)) {
                $this->printToScreen(xl("Internal error: claim ") . $claim->getId() . xl(" not found!") . "\n");
            }
        }
    }

    public function complete($context = null)
    {
        // TODO: Implement complete() method.
    }
}
