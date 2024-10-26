<?php

namespace App\Repositories;

interface ShiftRepository {
    function get();
    function get_by_id($id);
}
