<?php

namespace App\Repositories;

use App\Entities\Shift\RegisteredShift;

interface ShiftRepository {
    function get();
    function get_by_id($id);
    function get_entity_by_id($id): RegisteredShift;
}
