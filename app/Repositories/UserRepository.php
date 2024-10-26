<?php

namespace App\Repositories;

interface UserRepository
{
    public function getAllUserAndTheirPosition();
    public function updateShiftPatternId($id, $shiftPatternId);
    public function resetShiftPatternIdByShiftPatternId($shiftPatternId);
    public function getByShiftPatternId($shiftPatternId);
    public function getArrIdByShiftPatternId($shiftPatternId);
}
