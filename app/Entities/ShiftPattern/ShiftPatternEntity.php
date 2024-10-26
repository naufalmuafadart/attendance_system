<?php

namespace App\Entities\ShiftPattern;

class ShiftPatternEntity
{
    public $name;
    public $monday_shift_id;
    public $tuesday_shift_id;
    public $wednesday_shift_id;
    public $thursday_shift_id;
    public $friday_shift_id;
    public $saturday_shift_id;
    public $sunday_shift_id;
    public $created_at;
    public $updated_at;
    public function __construct(
        $name,
        $monday_shift_id,
        $tuesday_shift_id,
        $wednesday_shift_id,
        $thursday_shift_id,
        $friday_shift_id,
        $saturday_shift_id,
        $sunday_shift_id,
        $created_at,
        $updated_at) {
        $this->name = $name;
        $this->monday_shift_id = $monday_shift_id;
        $this->tuesday_shift_id = $tuesday_shift_id;
        $this->wednesday_shift_id = $wednesday_shift_id;
        $this->thursday_shift_id = $thursday_shift_id;
        $this->friday_shift_id = $friday_shift_id;
        $this->saturday_shift_id = $saturday_shift_id;
        $this->sunday_shift_id = $sunday_shift_id;
        $this->created_at = $created_at;
        $this->updated_at = $updated_at;
    }
}
