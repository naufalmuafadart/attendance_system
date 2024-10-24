<?php

namespace App\Repositories;

interface MappingShiftRepository {
    public function get_shift_id_by_user_id_and_date($user_id, $date);
}
