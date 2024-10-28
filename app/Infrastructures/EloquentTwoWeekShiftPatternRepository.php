<?php

namespace App\Infrastructures;

use App\Entities\TwoWeekShiftPattern\RegisterTwoWeekShiftPatternEntity;
use App\Exceptions\NotFoundException;
use App\Models\TwoWeekShiftPattern;
use App\Repositories\TwoWeekShiftPatternRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EloquentTwoWeekShiftPatternRepository implements TwoWeekShiftPatternRepository
{
    public function get() {
        return TwoWeekShiftPattern::all();
    }

    public function get_by_id(int $id) {
        try {
            return TwoWeekShiftPattern::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException('Two week shift pattern not found');
        }
    }

    public function insert(RegisterTwoWeekShiftPatternEntity $entity)
    {
        $model = new TwoWeekShiftPattern;
        $model->name = $entity->name;
        $model->start_date = $entity->start_date;
        $model->monday_shift_id = $entity->monday_shift_id;
        $model->tuesday_shift_id = $entity->tuesday_shift_id;
        $model->wednesday_shift_id = $entity->wednesday_shift_id;
        $model->thursday_shift_id = $entity->thursday_shift_id;
        $model->friday_shift_id = $entity->friday_shift_id;
        $model->saturday_shift_id = $entity->saturday_shift_id;
        $model->sunday_shift_id = $entity->sunday_shift_id;
        $model->second_monday_shift_id = $entity->second_monday_shift_id;
        $model->second_tuesday_shift_id = $entity->second_tuesday_shift_id;
        $model->second_wednesday_shift_id = $entity->second_wednesday_shift_id;
        $model->second_thursday_shift_id = $entity->second_thursday_shift_id;
        $model->second_friday_shift_id = $entity->second_friday_shift_id;
        $model->second_saturday_shift_id = $entity->second_saturday_shift_id;
        $model->second_sunday_shift_id = $entity->second_sunday_shift_id;
        $model->save();
    }

    public function get_all_id() {
        return TwoWeekShiftPattern::pluck('id')->toArray();
    }
}
