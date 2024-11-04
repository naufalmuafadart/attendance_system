<?php

namespace App\Infrastructures;

use App\Entities\Shift\RegisteredShift;
use App\Exceptions\NotFoundException;
use App\Models\Shift;
use App\Repositories\ShiftRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EloquentShiftRepository implements ShiftRepository
{
    function get() {
        return Shift::get();
    }

    /**
     * @throws NotFoundException
     */
    function get_by_id($id) {
        try {
            return Shift::findOrFail($id);
        } catch (\Throwable $th) {
            throw new NotFoundException("Shift not found");
        }
    }

    /**
     * @throws NotFoundException
     */
    function get_entity_by_id($id): RegisteredShift
    {
        try {
            $shift = Shift::findOrFail($id);
            return new RegisteredShift(
                $shift->id,
                $shift->nama_shift,
                $shift->jam_masuk,
                $shift->jam_keluar,
                $shift->created_at,
                $shift->updated_at,
            );
        } catch (ModelNotFoundException $th) {
            throw new NotFoundException("Shift not found");
        }
    }
}
