<?php

namespace App\Entities\TwoWeekShiftPattern;

class RegisterTwoWeekShiftPatternEntity
{
    public $name;
    public $start_date;
    public $monday_shift_id;
    public $tuesday_shift_id;
    public $wednesday_shift_id;
    public $thursday_shift_id;
    public $friday_shift_id;
    public $saturday_shift_id;
    public $sunday_shift_id;

    public $second_monday_shift_id;
    public $second_tuesday_shift_id;
    public $second_wednesday_shift_id;
    public $second_thursday_shift_id;
    public $second_friday_shift_id;
    public $second_saturday_shift_id;
    public $second_sunday_shift_id;
    public function __construct(
        string $name,
        string $start_date,
        int $monday_shift_id,
        int $tuesday_shift_id,
        int $wednesday_shift_id,
        int $thursday_shift_id,
        int $friday_shift_id,
        int $saturday_shift_id,
        int $sunday_shift_id,
        int $second_monday_shift_id,
        int $second_tuesday_shift_id,
        int $second_wednesday_shift_id,
        int $second_thursday_shift_id,
        int $second_friday_shift_id,
        int $second_saturday_shift_id,
        int $second_sunday_shift_id)
    {
        $this->name = $name;
        $this->start_date = $start_date;
        $this->monday_shift_id = $monday_shift_id;
        $this->tuesday_shift_id = $tuesday_shift_id;
        $this->wednesday_shift_id = $wednesday_shift_id;
        $this->thursday_shift_id = $thursday_shift_id;
        $this->friday_shift_id = $friday_shift_id;
        $this->saturday_shift_id = $saturday_shift_id;
        $this->sunday_shift_id = $sunday_shift_id;
        $this->second_monday_shift_id = $second_monday_shift_id;
        $this->second_tuesday_shift_id = $second_tuesday_shift_id;
        $this->second_wednesday_shift_id = $second_wednesday_shift_id;
        $this->second_thursday_shift_id = $second_thursday_shift_id;
        $this->second_friday_shift_id = $second_friday_shift_id;
        $this->second_saturday_shift_id = $second_saturday_shift_id;
        $this->second_sunday_shift_id = $second_sunday_shift_id;
    }
}
