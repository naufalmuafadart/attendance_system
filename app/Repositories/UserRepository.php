<?php

namespace App\Repositories;

interface UserRepository
{
    public function getAllUserAndTheirPosition();
    public function updateShiftPatternId($id, $shiftPatternId);
    public function updateTwoWeekShiftPatternId($id, $twoWeekShiftPatternId);
    public function resetShiftPatternIdByShiftPatternId($shiftPatternId);
    public function resetTwoWeekShiftPatternIdByShiftPatternId($twoWeekShiftPatternId);
    public function getByShiftPatternId($shiftPatternId);
    public function getArrIdByShiftPatternId($shiftPatternId);
    public function getArrIdByTwoWeekShiftPatternId($twoWeekShiftPatternId);
    public function getByTwoWeekShiftPatternId($twoWeekShiftPatternId);
}
