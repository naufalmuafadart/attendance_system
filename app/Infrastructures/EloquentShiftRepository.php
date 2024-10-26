<?php

namespace App\Infrastructures;

use App\Exceptions\NotFoundException;
use App\Models\Shift;
use App\Repositories\ShiftRepository;

class EloquentShiftRepository implements ShiftRepository
{
    function get() {
        return Shift::get();
    }

    function get_by_id($id) {
        try {
            return Shift::findOrFail($id);
        } catch (\Throwable $th) {
            throw new NotFoundException("Shift not found");
        }
    }
}
