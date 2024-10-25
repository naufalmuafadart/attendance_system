<?php

namespace App\Entities\MappingShift;

class RegisterMappingShiftEntity
{
    public $shift_id;
    public $selected_ids;
    public $start_date;
    public $end_date;
    public $is_lock_location;

    /**
     * @throws \DateMalformedStringException
     */
    public function __construct($shift_id, $selected_ids, $start_date, $end_date, $is_lock_location) {
        $this->shift_id = $shift_id;
        $this->selected_ids = $selected_ids;
        $this->start_date = new \DateTime($start_date);
        $this->end_date = new \DateTime($end_date);
        $this->is_lock_location = $is_lock_location;
    }
}
