<?php


namespace OpenEMR\Billing\BillingTracker;


class BillingClaimBatch
{
    protected $bat_type = ''; // will be edi or hcfa
    protected $bat_sendid = '';
    protected $bat_recvid = '';
    protected $bat_content = '';
    protected $bat_gscount = 0;
    protected $bat_stcount = 0;
    protected $bat_time;
    protected $bat_hhmm;
    protected $bat_yymmdd;
    protected $bat_yyyymmdd;
    // Seconds since 1/1/1970 00:00:00 GMT will be our interchange control number
    // but since limited to 9 char must be without leading 1
    protected $bat_icn;
    protected $bat_filename;
    protected $bat_filedir;

    public function __construct()
    {
        $this->bat_type = ''; // will be edi or hcfa
        $this->bat_sendid = '';
        $this->bat_recvid = '';
        $this->bat_content = '';
        $this->bat_gscount = 0;
        $this->bat_stcount = 0;
        $this->bat_time = time();
        $this->bat_hhmm = date('Hi', $this->bat_time);
        $this->bat_yymmdd = date('ymd', $this->bat_time);
        $this->bat_yyyymmdd = date('Ymd', $this->bat_time);
        // Seconds since 1/1/1970 00:00:00 GMT will be our interchange control number
        // but since limited to 9 char must be without leading 1
        $this->bat_icn = substr((string)$this->bat_time, 1, 9);
        $this->bat_filename = date("Y-m-d-Hi", $this->bat_time) . "-batch";
        $this->bat_filedir = $GLOBALS['OE_SITE_DIR'] . DIRECTORY_SEPARATOR . "documents" . DIRECTORY_SEPARATOR . "edi";
    }


    /**
     * @return string
     */
    public function getBatContent(): string
    {
        return $this->bat_content;
    }

    /**
     * @return string
     */
    public function getBatFiledir(): string
    {
        return $this->bat_filedir;
    }

    /**
     * @param string $bat_filedir
     */
    public function setBatFiledir(string $bat_filedir): void
    {
        $this->bat_filedir = $bat_filedir;
    }

    /**
     * @return string
     */
    public function getBatFilename(): string
    {
        return $this->bat_filename;
    }

    /**
     * @param string $bat_filename
     */
    public function setBatFilename(string $bat_filename): void
    {
        $this->bat_filename = $bat_filename;
    }

    /**
     * Write the batch file to disk, and if enabled, queue the file
     * to be written to remote SFTP server.
     *
     * In the case of the "normal" generate x12 (not per-insco) we
     * only generate one batch file, so we need to send it to all
     * of the x-12 partners that were found during billing process.
     * This will usually only ever have one element, but just in case
     * There are more than one x-12 partner configured and input through
     * billing manger, we handle the array case.
     *
     * @param array|null|int $x12_partner_id
     */
    public function write_batch_file($x12_partner_id = null)
    {
        $error = false;
        // If a writable edi directory exists, log the batch to it.
        // I guarantee you'll be glad we did this. :-)
        if ($this->bat_filedir !== false) {
            $fh = fopen($this->bat_filedir . DIRECTORY_SEPARATOR . $this->bat_filename, 'a');
            if ($fh) {
                fwrite($fh, $this->bat_content);
                fclose($fh);
            } else {
                $error = true;
            }
        }

        // If we are automatically uploading claims to X12 partners, do that here right after we
        // write the 'official' batch file
        if (false === $error &&
            $GLOBALS['auto_sftp_claims_to_x12_partner']) {
            if ($x12_partner_id !== null) {
                $now = date('Y-m-d h:i:s');
                // If this is an array, queue the batchfile to send to all x-12 partners
                if (is_array($x12_partner_id)) {
                    foreach( $x12_partner_id as $id) {
                        X12RemoteTracker::create([
                            'x12_partner_id' => $id,
                            'x12_filename' => $this->bat_filename,
                            'status' => X12RemoteTracker::STATUS_WAITING,
                            'messages' => '',
                            'created_at' => $now,
                            'updated_at' => $now
                        ]);
                    }
                } else {
                    X12RemoteTracker::create([
                        'x12_partner_id' => $x12_partner_id,
                        'x12_filename' => $this->bat_filename,
                        'status' => X12RemoteTracker::STATUS_WAITING,
                        'messages' => '',
                        'created_at' => $now,
                        'updated_at' => $now
                    ]);
                }
            }
        }

        return $error;
    }

    public function append_claim(&$segs)
    {
        foreach ($segs as $seg) {
            if (!$seg) {
                continue;
            }
            $elems = explode('*', $seg);
            if ($elems[0] == 'ISA') {
                if (!$this->bat_content) {
                    $bat_sendid = trim($elems[6]);
                    $bat_recvid = trim($elems[8]);
                    $bat_sender = (!empty($GS02)) ? $GS02 : $bat_sendid;
                    $this->bat_content = substr($seg, 0, 70) . "$this->bat_yymmdd*$this->bat_hhmm*" . $elems[11] . "*" . $elems[12] . "*$this->bat_icn*" . $elems[14] . "*" . $elems[15] . "*:~";
                }
                continue;
            } elseif (!$this->bat_content) {
                die("Error:<br />\nInput must begin with 'ISA'; " . "found '" . text($elems[0]) . "' instead");
            }
            if ($elems[0] == 'GS') {
                if ($this->bat_gscount == 0) {
                    ++$this->bat_gscount;
                    $this->bat_content .= "GS*HC*" . $elems[2] . "*" . $elems[3] . "*$this->bat_yyyymmdd*$this->bat_hhmm*1*X*" . $elems[8] . "~";
                }
                continue;
            }
            if ($elems[0] == 'ST') {
                ++$this->bat_stcount;
                $bat_st_02 = sprintf("%04d", $this->bat_stcount);
                $this->bat_content .= "ST*837*" . $bat_st_02;
                if (!empty($elems[3])) {
                    $this->bat_content .= "*" . $elems[3];
                }

                $this->bat_content .= "~";
                continue;
            }

            if ($elems[0] == 'BHT') {
                // needle is set in OpenEMR\Billing\X125010837P
                $this->bat_content .= substr_replace($seg, '*' . $this->bat_icn . $bat_st_02 . '*', strpos($seg, '*0123*'), 6);
                $this->bat_content .= "~";
                continue;
            }

            if ($elems[0] == 'SE') {
                $this->bat_content .= sprintf("SE*%d*%04d~", $elems[1], $this->bat_stcount);
                continue;
            }

            if ($elems[0] == 'GE' || $elems[0] == 'IEA') {
                continue;
            }

            $this->bat_content .= $seg . '~';
        }
    }

    public function append_claim_close()
    {
        if ($this->bat_gscount) {
            $this->bat_content .= "GE*$this->bat_stcount*1~";
        }

        $this->bat_content .= "IEA*$this->bat_gscount*$this->bat_icn~";
    }
}
