<?php

namespace App\Infrastructures;

use App\Entities\ShiftPattern\RegisterShiftPatternEntity;
use App\Models\ShiftPattern;
use App\Repositories\ShiftPatternRepository;

class EloquentShiftPatternRepository implements ShiftPatternRepository {

    public function insert(RegisterShiftPatternEntity $shiftPattern) {
        $model = new ShiftPattern;
        $model->name = $shiftPattern->name;
        $model->monday_shift_id = $shiftPattern->monday_shift_id;
        $model->tuesday_shift_id = $shiftPattern->tuesday_shift_id;
        $model->wednesday_shift_id = $shiftPattern->wednesday_shift_id;
        $model->thursday_shift_id = $shiftPattern->thursday_shift_id;
        $model->friday_shift_id = $shiftPattern->friday_shift_id;
        $model->saturday_shift_id = $shiftPattern->saturday_shift_id;
        $model->sunday_shift_id = $shiftPattern->sunday_shift_id;
        $model->save();
    }

    public function get()
    {
        return ShiftPattern::all();
    }
}
