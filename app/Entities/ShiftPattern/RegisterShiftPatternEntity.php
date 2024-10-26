<?php

namespace App\Entities\ShiftPattern;

class RegisterShiftPatternEntity
{
    public $name;
    public $monday_shift_id;
    public $tuesday_shift_id;
    public $wednesday_shift_id;
    public $thursday_shift_id;
    public $friday_shift_id;
    public $saturday_shift_id;
    public $sunday_shift_id;
    public function __construct(
        string $name,
        int $monday_shift_id,
        int $tuesday_shift_id,
        int $wednesday_shift_id,
        int $thursday_shift_id,
        int $friday_shift_id,
        int $saturday_shift_id,
        int $sunday_shift_id) {
        $this->name = $name;
        $this->monday_shift_id = $monday_shift_id;
        $this->tuesday_shift_id = $tuesday_shift_id;
        $this->wednesday_shift_id = $wednesday_shift_id;
        $this->thursday_shift_id = $thursday_shift_id;
        $this->friday_shift_id = $friday_shift_id;
        $this->saturday_shift_id = $saturday_shift_id;
        $this->sunday_shift_id = $sunday_shift_id;
    }
}
