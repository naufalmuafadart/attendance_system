<?php

namespace App\Entities\AttendanceRequest;

use Carbon\Carbon;

class RegisteredAttendanceRequestEntity
{
    public $id;
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

    public function __construct($id, $user_id, $mapping_shift_id, $clock_in, $clock_out, $reason, $file, $status, $approved_by, $reject_reason, $created_at, $updated_at) {
        $this->id = $id;
        $this->user_id = $user_id;
        $this->mapping_shift_id = $mapping_shift_id;

        if ($clock_in != null) {
            $this->clock_in = Carbon::createFromFormat('H:i:s', $clock_in);
        } else {
            $this->clock_in = null;
        }

        if ($clock_out != null) {
            $this->clock_out = Carbon::createFromFormat('H:i:s', $clock_out);
        } else {
            $this->clock_out = null;
        }

        $this->reason = $reason;
        $this->file = $file;
        $this->status = $status;
        $this->approved_by = $approved_by;
        $this->reject_reason = $reject_reason;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }
}
