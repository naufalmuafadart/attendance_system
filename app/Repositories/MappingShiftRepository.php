<?php

namespace App\Repositories;

use App\Entities\MappingShift\RegisterMappingShiftEntity;

interface MappingShiftRepository {
    public function get_shift_id_by_user_id_and_date($user_id, $date);
    public function insert(RegisterMappingShiftEntity $entity);
    public function get_by_user_id_and_date($user_id, $date);
}
