<?php

namespace App\Repositories;

use App\Entities\TwoWeekShiftPattern\RegisterTwoWeekShiftPatternEntity;

interface TwoWeekShiftPatternRepository
{
    public function get();
    public function get_by_id(int $id);
    public function insert(RegisterTwoWeekShiftPatternEntity $entity);
    public function get_all_id();
}
