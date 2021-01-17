<?php

function process_form($ar)
{
    global $bill_info, $bat_filename, $pdf, $template;
    global $ub04id, $validatePass;

    // Set up crypto object
    $cryptoGen = new CryptoGen();

    if (
        isset($ar['bn_x12']) || isset($ar['bn_x12_encounter']) || isset($ar['bn_process_hcfa']) || isset($ar['bn_hcfa_txt_file']) || isset($ar['bn_process_hcfa_form'])
        || isset($ar['bn_process_ub04_form']) || isset($ar['bn_process_ub04']) || isset($ar['bn_ub04_x12'])
    ) {
        if ($GLOBALS['billing_log_option'] == 1) {
            if (file_exists($GLOBALS['OE_SITE_DIR'] . "/documents/edi/process_bills.log")) {
                $hlog = file_get_contents($GLOBALS['OE_SITE_DIR'] . "/documents/edi/process_bills.log");
            }
            if ($cryptoGen->cryptCheckStandard($hlog)) {
                $hlog = $cryptoGen->decryptStandard($hlog, null, 'database');
            }
        } else { // ($GLOBALS['billing_log_option'] == 2)
            $hlog = '';
        }
    }


    if (isset($ar['bn_external'])) {
        // Open external billing file for output.
        $be = new BillingExport();
    }

    if (empty($ar['claims'])) {
        $ar['claims'] = array();
    }
    $bat_content = "";
    $claim_count = 0;
    foreach ($ar['claims'] as $claimid => $claim_array) {
        $ta = explode("-", $claimid);
        $patient_id = $ta[0];
        $encounter = $ta[1];
        $payer_id = substr($claim_array['payer'], 1);
        $payer_type = substr(strtoupper($claim_array['payer']), 0, 1);
        if ($payer_type == 'P') {
            $payer_type = 1;
        } elseif ($payer_type == 'S') {
            $payer_type = 2;
        } elseif ($payer_type == 'T') {
            $payer_type = 3;
        } else {
            $payer_type = 0;
        }

        if (isset($claim_array['bill'])) {
            if (isset($ar['bn_external'])) {
                // Write external claim.
                $be->addClaim($patient_id, $encounter);
            } else {
                $sql = "SELECT x.processing_format from x12_partners as x where x.id =?";
                $result = sqlQuery($sql, [$claim_array['partner']]);
                $target = "x12";
                if (!empty($result['processing_format'])) {
                    $target = $result['processing_format'];
                }
            }

            $clear_claim = isset($ar['btn-clear']);
            $validate_claim = isset($ar['btn-validate']);
            $validatePass = $validate_claim || $clear_claim;
            $payer_id_held = -1;
            $tmp = 1;
            if (!$validate_claim) {
                if ($clear_claim) {
                    $tmp = BillingUtilities::updateClaim(true, $patient_id, $encounter, $payer_id, $payer_type, 2); // $sql .= " billed = 1, ";
                }
                if (isset($ar['bn_x12']) || isset($ar['bn_x12_encounter']) && !$clear_claim) {
                    $tmp = BillingUtilities::updateClaim(true, $patient_id, $encounter, $payer_id, $payer_type, 2, 1, '', $target, $claim_array['partner']);
                } elseif (isset($ar['bn_ub04_x12'])) {
                    $ub04id = get_ub04_array($patient_id, $encounter);
                    $ub_save = json_encode($ub04id);
                    $tmp = BillingUtilities::updateClaim(true, $patient_id, $encounter, $payer_id, $payer_type, 2, 1, '', $target, $claim_array['partner'] . '-837I', 0, $ub_save);
                } elseif (isset($ar['bn_process_ub04_form']) || isset($ar['bn_process_ub04'])) {
                    $ub04id = get_ub04_array($patient_id, $encounter);
                    $ub_save = json_encode($ub04id);
                    $tmp = BillingUtilities::updateClaim(true, $patient_id, $encounter, $payer_id, $payer_type, 2, 1, '', 'ub04', -1, 0, $ub_save);
                } elseif (isset($ar['bn_process_hcfa']) || isset($ar['bn_hcfa_txt_file']) || isset($ar['bn_process_hcfa_form']) && !$clear_claim) {
                    $tmp = BillingUtilities::updateClaim(true, $patient_id, $encounter, $payer_id, $payer_type, 2, 1, '', 'hcfa');
                } elseif (isset($ar['bn_mark'])) {
                    // $sql .= " billed = 1, ";
                    $tmp = BillingUtilities::updateClaim(true, $patient_id, $encounter, $payer_id, $payer_type, 2);
                } elseif (isset($ar['bn_reopen'])) {
                    $tmp = BillingUtilities::updateClaim(true, $patient_id, $encounter, $payer_id, $payer_type, 1, 0);
                } elseif (isset($ar['bn_external'])) {
                    // $sql .= " billed = 1, ";
                    $tmp = BillingUtilities::updateClaim(true, $patient_id, $encounter, $payer_id, $payer_type, 2);
                }
            } else {
                // so if we validate lets validate against currently set payer.
                // will reset to current payer once claim processed(below).
                $payer_id_held = sqlQueryNoLog("SELECT payer_id FROM billing WHERE " .
                    "pid= ? AND encounter = ? AND activity = 1", array($patient_id, $encounter))['payer_id'];
                sqlStatementNoLog("UPDATE billing SET payer_id = ? WHERE " .
                    "pid= ? AND encounter = ? AND activity = 1", array($payer_id, $patient_id, $encounter));
            }
            if (!$tmp) {
                die(xlt("Claim ") . text($claimid) . xlt(" update failed, not in database?"));
            } else {
                if ($validate_claim) {
                    $hlog .= xl("Validating Claim") . " " . $claimid . " " . xl("existing claim status is not altered.") . "\n";
                }
                if ($clear_claim) {
                    $hlog .= xl("Validating Claim") . " " . $claimid . " " . xl("and resetting claim status.") . "\n";
                }
                if (isset($ar['bn_mark'])) {
                    $bill_info[] = xl("Claim ") . $claimid . xl(" was marked as billed only.") . "\n";
                } elseif (isset($ar['bn_reopen'])) {
                    $bill_info[] = xl("Claim ") . $claimid . xl(" has been re-opened.") . "\n";
                } elseif (isset($ar['bn_x12']) || isset($ar['bn_x12_encounter'])) {
                    $log = '';
                    $segs = explode("~\n", X125010837P::genX12837P($patient_id, $encounter, $log, isset($ar['bn_x12_encounter'])));
                    $hlog .= $log;
                    append_claim($segs);
                    if ($validatePass) {
                        validate_payer_reset($payer_id_held, $patient_id, $encounter);
                        continue;
                    }
                    if (!BillingUtilities::updateClaim(false, $patient_id, $encounter, -1, -1, 2, 2, $bat_filename)) {
                        $bill_info[] = xl("Internal error: claim ") . $claimid . xl(" not found!") . "\n";
                    }
                } elseif (isset($ar['bn_ub04_x12'])) {
                    $log = '';
                    $segs = explode("~\n", X125010837I::generateX12837I($patient_id, $encounter, $log, $ub04id));
                    $hlog .= $log;
                    append_claim($segs);
                    if ($validatePass) {
                        validate_payer_reset($payer_id_held, $patient_id, $encounter);
                        continue;
                    }
                    if (!BillingUtilities::updateClaim(false, $patient_id, $encounter, -1, -1, 2, 2, $bat_filename, 'X12-837I', -1, 0, json_encode($ub04id))) {
                        $bill_info[] = xl("Internal error: claim ") . $claimid . xl(" not found!") . "\n";
                    }
                } elseif (isset($ar['bn_process_hcfa'])) {
                    $log = '';
                    $hcfa = new Hcfa1500();
                    $lines = $hcfa->genHcfa1500($patient_id, $encounter, $log);
                    $hlog .= $log;
                    $alines = explode("\014", $lines); // form feeds may separate pages
                    foreach ($alines as $tmplines) {
                        if ($claim_count++) {
                            $pdf->ezNewPage();
                        }
                        $pdf->ezSetY($pdf->ez['pageHeight'] - $pdf->ez['topMargin']);
                        $pdf->ezText($tmplines, 12, array(
                            'justification' => 'left',
                            'leading' => 12
                        ));
                    }
                    if ($validatePass) {
                        validate_payer_reset($payer_id_held, $patient_id, $encounter);
                        continue;
                    }
                    if (!BillingUtilities::updateClaim(false, $patient_id, $encounter, -1, -1, 2, 2, $bat_filename)) {
                        $bill_info[] = xl("Internal error: claim ") . $claimid . xl(" not found!") . "\n";
                    }
                } elseif (isset($ar['bn_process_hcfa_form'])) {
                    $log = '';
                    $hcfa = new Hcfa1500();
                    $lines = $hcfa->genHcfa1500($patient_id, $encounter, $log);
                    $hcfa_image = $GLOBALS['images_static_absolute'] . "/cms1500.png";
                    $hlog .= $log;
                    $alines = explode("\014", $lines); // form feeds may separate pages
                    foreach ($alines as $tmplines) {
                        if ($claim_count++) {
                            $pdf->ezNewPage();
                        }
                        $pdf->ezSetY($pdf->ez['pageHeight'] - $pdf->ez['topMargin']);
                        $pdf->addPngFromFile("$hcfa_image", 0, 0, 612, 792);
                        $pdf->ezText($tmplines, 12, array(
                            'justification' => 'left',
                            'leading' => 12
                        ));
                    }
                    if ($validatePass) {
                        validate_payer_reset($payer_id_held, $patient_id, $encounter);
                        continue;
                    }
                    if (!BillingUtilities::updateClaim(false, $patient_id, $encounter, -1, -1, 2, 2, $bat_filename)) {
                        $bill_info[] = xl("Internal error: claim ") . $claimid . xl(" not found!") . "\n";
                    }
                } elseif (isset($ar['bn_process_ub04_form']) || isset($ar['bn_process_ub04'])) {
                    $claim_count++;
                    $log = "";
                    $template[] = buildTemplate($patient_id, $encounter, "", "", $log);
                    $hlog .= $log;
                    if ($validatePass) {
                        validate_payer_reset($payer_id_held, $patient_id, $encounter);
                        continue;
                    }
                    if (!BillingUtilities::updateClaim(false, $patient_id, $encounter, -1, -1, 2, 2, $bat_filename, 'ub04', -1, 0, json_encode($ub04id))) {
                        $bill_info[] = xl("Internal error: claim ") . $claimid . xl(" not found!") . "\n";
                    }
                } elseif (isset($ar['bn_hcfa_txt_file'])) {
                    $log = '';
                    $hcfa = new Hcfa1500();
                    $lines = $hcfa->genHcfa1500($patient_id, $encounter, $log);
                    $hlog .= $log;
                    $bat_content .= $lines;
                    if ($validatePass) {
                        validate_payer_reset($payer_id_held, $patient_id, $encounter);
                        continue;
                    }
                    if (!BillingUtilities::updateClaim(false, $patient_id, $encounter, -1, -1, 2, 2, $bat_filename)) {
                        $bill_info[] = xl("Internal error: claim ") . $claimid . xl(" not found!") . "\n";
                    }
                } else {
                    $bill_info[] = xl("Claim ") . $claimid . xl(" was queued successfully.") . "\n";
                }
            }
        } // end if this claim has billing
    } // end foreach

    if (!empty($hlog)) {
        if ($GLOBALS['drive_encryption']) {
            $hlog = $cryptoGen->encryptStandard($hlog, null, 'database');
        }
        file_put_contents($GLOBALS['OE_SITE_DIR'] . "/documents/edi/process_bills.log", $hlog);
    }

    if (isset($ar['bn_process_ub04_form']) || isset($ar['bn_process_ub04'])) {
        if (isset($ar['bn_process_ub04'])) {
            $action = "noform";
        } elseif (isset($ar['bn_process_ub04_form'])) {
            $action = "form";
        }
        ub04Dispose('download', $template, $bat_filename, $action);
        exit();
    }

    if ($validatePass) {
        if (isset($ar['bn_hcfa_txt_file'])) {
            $format_bat = $bat_content;
            $wrap = "<!DOCTYPE html><html><head></head><body><div><pre>" . text($format_bat) . "</pre></div></body></html>";
            echo $wrap;
            exit();
        } elseif (isset($ar['bn_x12']) || isset($ar['bn_x12_encounter']) || isset($ar['bn_ub04_x12'])) {
            global $bat_content;
            append_claim_close();
            $format_bat = str_replace('~', PHP_EOL, $bat_content);
            $wrap = "<!DOCTYPE html><html><head></head><body><div style='overflow: hidden;'><pre>" . text($format_bat) . "</pre></div></body></html>";
            echo $wrap;
            exit();
        } else {
            $fname = tempnam($GLOBALS['temporary_files_dir'], 'PDF');
            file_put_contents($fname, $pdf->ezOutput());
            // Send the content for view.
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header('Content-type: application/pdf');
            header('Content-Disposition: inline; filename="' . $bat_filename . '"');
            header('Content-Transfer-Encoding: binary');
            header('Content-Length: ' . filesize($fname));
            ob_end_clean();
            @readfile($fname);
            unlink($fname);
            exit();
        }
        die(xlt("Unknown Selection"));
    } else {
        if (isset($ar['bn_x12']) || isset($ar['bn_x12_encounter']) || isset($ar['bn_ub04_x12'])) {
            append_claim_close();
            send_batch();
            exit();
        }
        if (isset($ar['bn_process_hcfa'])) {
            // If a writable edi directory exists (and it should), write the pdf to it.
            $fh = @fopen($GLOBALS['OE_SITE_DIR'] . "/documents/edi/$bat_filename", 'a');
            if ($fh) {
                fwrite($fh, $pdf->ezOutput());
                fclose($fh);
            }
            // Send the PDF download.
            $pdf->ezStream(array(
                'Content-Disposition' => $bat_filename
            ));
            exit();
        }
        if (isset($ar['bn_process_hcfa_form'])) {
            // If a writable edi directory exists (and it should), write the pdf to it.
            $fh = @fopen($GLOBALS['OE_SITE_DIR'] . "/documents/edi/$bat_filename", 'a');
            if ($fh) {
                fwrite($fh, $pdf->ezOutput());
                fclose($fh);
            }
            // Send the PDF download.
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Content-Type: application/force-download");
            header("Content-Disposition: attachment; filename=$bat_filename");
            header("Content-Description: File Transfer");
            // header("Content-Length: " . strlen($bat_content));
            echo $pdf->ezOutput();

            exit();
        }
        if (isset($ar['bn_hcfa_txt_file'])) {
            $fh = @fopen($GLOBALS['OE_SITE_DIR'] . "/documents/edi/$bat_filename", 'a');
            if ($fh) {
                fwrite($fh, $bat_content);
                fclose($fh);
            }
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Content-Type: application/force-download");
            header("Content-Disposition: attachment; filename=$bat_filename");
            header("Content-Description: File Transfer");
            header("Content-Length: " . strlen($bat_content));
            echo $bat_content;
            exit();
        }
        if (isset($ar['bn_external'])) {
            // Close external billing file.
            $be->close();
        }
    }
}
