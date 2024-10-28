<?php

namespace App\Infrastructures;

use App\Exceptions\CustomException;
use App\Exceptions\NotFoundException;
use App\Models\ShiftPattern;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class EloquentUserRepository implements UserRepository {
    public function getAllUserAndTheirPosition() {
        try {
            return DB::table("users")
                ->join("jabatans", "users.jabatan_id", "=", "jabatans.id")
                ->select("users.*", "jabatans.nama_jabatan")
                ->where('users.is_admin', 'user')
                ->orderBy('users.name')
                ->get();
        } catch (\Exception $e) {
            throw new CustomException($e->getMessage());
        }
    }

    /**
     * @throws NotFoundException
     * @throws CustomException
     */
    public function updateShiftPatternId($id, $shiftPatternId)
    {
        try {
            $user = User::findOrFail($id);
            $user->shift_pattern_id = $shiftPatternId;
            $user->save();
        } catch (\Exception $e) {
            if ($e instanceof ModelNotFoundException) {
                throw new NotFoundException('shift pattern not found');
            }
            throw new CustomException($e->getMessage());
        }
    }

    public function updateTwoWeekShiftPatternId($id, $twoWeekShiftPatternId) {
        try {
            $user = User::findOrFail($id);
            $user->two_week_shift_pattern_id = $twoWeekShiftPatternId;
            $user->save();
        } catch (\Exception $e) {
            if ($e instanceof ModelNotFoundException) {
                throw new NotFoundException('shift pattern not found');
            }
            throw new CustomException($e->getMessage());
        }
    }

    public function resetShiftPatternIdByShiftPatternId($shiftPatternId) {
        User::where('shift_pattern_id', $shiftPatternId)->update(['shift_pattern_id' => null]);
    }

    public function resetTwoWeekShiftPatternIdByShiftPatternId($twoWeekShiftPatternId) {
        User::where('two_week_shift_pattern_id', $twoWeekShiftPatternId)->update(['two_week_shift_pattern_id' => null]);
    }

    public function getByShiftPatternId($shiftPatternId) {
        return User::where('shift_pattern_id', $shiftPatternId)->get();
    }

    public function getArrIdByShiftPatternId($shiftPatternId) {
        return User::where('shift_pattern_id', $shiftPatternId)->pluck('id')->toArray();
    }

    public function getArrIdByTwoWeekShiftPatternId($twoWeekShiftPatternId) {
        return User::where('two_week_shift_pattern_id', $twoWeekShiftPatternId)->pluck('id')->toArray();
    }

    public function getByTwoWeekShiftPatternId($shiftPatternId) {
        return User::where('two_week_shift_pattern_id', $shiftPatternId)->get();
    }
}
