<?php


namespace OpenEMR\Billing\BillingTracker;


use OpenEMR\Billing\BillingUtilities;
use OpenEMR\Billing\Hcfa1500;

class GeneratorHCFA_PDF extends AbstractGenerator implements GeneratorInterface
{
    protected $pdf;
    protected $batch;
    protected $createNewPage;

    public function setup($context)
    {
        $this->pdf = new \Cezpdf('LETTER');
        $this->pdf->ezSetMargins(trim($context['top_margin']) + 0, 0, trim($context['left_margin']) + 0, 0);
        $this->pdf->selectFont('Courier');

        // The instantiation of the PDF object "comes with" a canvas to write to,
        // so the first claim, we don't need to create one. On subsequent claims, we do.
        $this->createNewPage = false;

        // Instantiate mainly for the filename creation, we're not tracking text segments
        // since we're generating a PDF
        $this->batch = new BillingClaimBatch();

        $filename = $this->batch->getBatFilename() . '.pdf';
        $this->batch->setBatFilename($filename);
    }

    public function execute(BillingClaim $claim)
    {
        $log = '';
        $hcfa = new Hcfa1500();
        $lines = $hcfa->genHcfa1500($claim->getPid(), $claim->getEncounter(), $log);
        $this->appendToLog($log);
        $alines = explode("\014", $lines); // form feeds may separate pages
        foreach ($alines as $tmplines) {
            // The first claim we don't create a new page.
            if ($this->createNewPage) {
                $this->pdf->ezNewPage();
            } else {
                $this->createNewPage = true;
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
            if (!BillingUtilities::updateClaim(false, $claim->getPid(), $claim->getEncounter(), -1, -1, 2, 2, $filename)) {
                $this->printToScreen(xl("Internal error: claim ") . $claim->getId() . xl(" not found!") . "\n");
            }
        }
    }

    public function complete($context = null)
    {
        if ($this->getAction() === BillingProcessor::VALIDATE_AND_CLEAR ||
            $this->getAction() === BillingProcessor::VALIDATE_ONLY) {
            // If we are just validating, the output should be a PDF presented
            // to the user, but we don't save to the edi/ directory.
            $fname = tempnam($GLOBALS['temporary_files_dir'], 'PDF');
            file_put_contents($fname, $this->pdf->ezOutput());
            // Send the content for view.
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header('Content-type: application/pdf');
            header('Content-Disposition: inline; filename="' . $this->batch->getBatFilename() . '"');
            header('Content-Transfer-Encoding: binary');
            header('Content-Length: ' . filesize($fname));
            ob_end_clean();
            @readfile($fname);
            unlink($fname);
            exit();
        } else if ($this->getAction() === BillingProcessor::NORMAL) {
            // If a writable edi directory exists (and it should), write the pdf to it.
            $fh = @fopen($GLOBALS['OE_SITE_DIR'] . "/documents/edi/{$this->batch->getBatFilename()}", 'a');
            if ($fh) {
                fwrite($fh, $this->pdf->ezOutput());
                fclose($fh);
            }
            // Send the PDF download.
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Content-Type: application/force-download");
            header("Content-Disposition: attachment; filename={$this->batch->getBatFilename()}");
            header("Content-Description: File Transfer");
            // header("Content-Length: " . strlen($bat_content));
            echo $this->pdf->ezOutput();

            exit();
        }
    }
}
