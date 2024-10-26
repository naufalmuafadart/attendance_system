<?php

namespace App\Repositories;

use App\Entities\ShiftPattern\RegisterShiftPatternEntity;

interface ShiftPatternRepository
{
    public function insert(RegisterShiftPatternEntity $shiftPattern);
    public function get();
    public function get_by_id(int $id);
}
