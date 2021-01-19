<?php

/**
 * This class represents the task that compiles claims into
 * a HCFA form batch. This prints the claim data only, with no
 * form fields that are present on the HCFA 1500 paper form.
 *
 * The other HCFA generator will print the data over an image of
 * the paper form fields.
 *
 * @package   OpenEMR
 * @link      http://www.open-emr.org
 * @author    Ken Chapple <ken@mi-squared.com>
 * @copyright Copyright (c) 2021 Ken Chapple <ken@mi-squared.com>
 * @license   https://github.com/openemr/openemr/blob/master/LICENSE GNU General Public License 3
 */

namespace OpenEMR\Billing\BillingTracker;

use OpenEMR\Billing\BillingTracker\Traits\WritesToBillingLog;
use OpenEMR\Billing\BillingUtilities;
use OpenEMR\Billing\Hcfa1500;

class GeneratorHCFA_PDF extends AbstractGenerator implements GeneratorInterface, LoggerInterface
{
    use WritesToBillingLog;

    /**
     * Instance of the Cezpdf object for writing
     * @Cezpdf
     */
    protected $pdf;

    /**
     * Our billing claim batch for tracking the filename and other
     * generic claim batch things
     *
     * @BillingClaimBatch
     */
    protected $batch;

    /**
     * When we run the execute function on each claim, we don't want
     * to create a new page the first time. The instantiation of the PDF
     * object "comes with" a canvas to write to, so the first claim, we
     * don't need to create one. On subsequent claims, we do so we initialize
     * this to false, and then set to true after the first claim.
     *
     * @bool
     */
    protected $createNewPage;

    public function setup(array $context)
    {
        $this->pdf = new \Cezpdf('LETTER');
        $this->pdf->ezSetMargins(trim($context['top_margin']) + 0, 0, trim($context['left_margin']) + 0, 0);
        $this->pdf->selectFont('Courier');

        // This is to tell our execute method not to create a new page the first claim
        $this->createNewPage = false;

        // Instantiate mainly for the filename creation, we're not tracking text segments
        // since we're generating a PDF, which is managed in this object
        $this->batch = new BillingClaimBatch('.pdf');
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

    /**
     * Generate the download output
     *
     * @param array $context
     */
    public function complete(array $context)
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
