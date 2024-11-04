<?php

namespace App\Entities\Shift;

use Carbon\Carbon;

class RegisteredShift
{
    public $id;
    public $name;
    public $clock_in;
    public $clock_out;
    public $created_at;
    public $updated_at;

    public function __construct($id, $name, $clock_in, $clock_out, $created_at, $updated_at) {
        $this->id = $id;
        $this->name = $name;
        $this->clock_in = Carbon::createFromFormat('H:i', $clock_in);
        $this->clock_out = Carbon::createFromFormat('H:i', $clock_out);
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }
}
