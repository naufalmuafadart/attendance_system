<?php

namespace App\Entities\AttendanceRequest;

class AttendanceRequestEntity
{
    public $user_id;
    public $mapping_shift_id;
    public $clock_in;
    public $clock_out;
    public $reason;
    public $file;
    public $status;
    public $approved_by;
    public $reject_reason;
    public $created_at;
    public $updated_at;

    public $date;

    public function __construct($user_id, $mapping_shift_id, $clock_in, $clock_out, $reason, $file, $status, $approved_by, $reject_reason, $created_at, $updated_at) {
        $this->user_id = $user_id;
        $this->mapping_shift_id = $mapping_shift_id;
        $this->clock_in = $clock_in;
        $this->clock_out = $clock_out;
        $this->reason = $reason;
        $this->file = $file;
        $this->status = $status;
        $this->approved_by = $approved_by;
        $this->reject_reason = $reject_reason;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }
}
