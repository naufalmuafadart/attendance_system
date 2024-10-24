<?php

namespace App\Infrastructures;

use App\Exceptions\NotFoundException;
use App\Models\MappingShift;
use App\Repositories\MappingShiftRepository;

class EloquentMappingShiftRepository implements MappingShiftRepository {
    public function get_shift_id_by_user_id_and_date($user_id, $date) {
        try {
            $ms = MappingShift::where('user_id', $user_id)->where('tanggal', $date)->firstOrFail();
            return $ms->shift_id;
        } catch(\Exception $e) {
            throw new NotFoundException('Mapping Shift not found');
        }
    }
}
