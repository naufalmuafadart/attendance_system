<?php

namespace App\Entities\PengajuanAbsen;

class RegisterPengajuanAbsenEntity
{
    public $user_id;
    public $mapping_shift_id;
    public $clock_in;
    public $clock_out;
    public $reason;
    public $file;
    public $status;
    public $approved_by;
    public function __construct($user_id, $mapping_shift_id, $clock_in, $clock_out, $reason, $file) {
        $this->user_id = $user_id;
        $this->mapping_shift_id = $mapping_shift_id;
        $this->clock_in = $clock_in;
        $this->clock_out = $clock_out;
        $this->reason = $reason;
        $this->file = $file;
        $this->status = 'pending';
        $this->approved_by = null;
    }
}
