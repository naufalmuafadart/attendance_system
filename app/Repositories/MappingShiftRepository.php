<?php

namespace App\Repositories;

use App\Entities\MappingShift\RegisterMappingShiftEntity;

interface MappingShiftRepository {
    public function get_shift_id_by_user_id_and_date($user_id, $date);
    public function insert(RegisterMappingShiftEntity $entity);
    public function get_by_user_id_and_date($user_id, $date);
    public function get_id_by_user_id_and_date($user_id, $date);
    public function update_clock_in($id, $clock_in);
    public function update_clock_out($id, $clock_out);
    public function get_date_by_id($id);
}
