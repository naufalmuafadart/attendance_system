<?php

namespace App\UseCases\MappingShift;

use App\Entities\MappingShift\RegisterMappingShiftEntity;
use App\Repositories\MappingShiftRepository;
use App\Repositories\ShiftPatternRepository;
use App\Repositories\UserRepository;

class InsertTodayUseCase {
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var MappingShiftRepository
     */
    private $mappingShiftRepository;
    /**
     * @var ShiftPatternRepository
     */
    private $shiftPatternRepository;

    public function __construct(
        ShiftPatternRepository $shiftPatternRepository,
        UserRepository $userRepository,
        MappingShiftRepository $mappingShiftRepository) {
        $this->shiftPatternRepository = $shiftPatternRepository;
        $this->userRepository = $userRepository;
        $this->mappingShiftRepository = $mappingShiftRepository;
    }

    public function execute() {
        $shift_pattern_arr_id = $this->shiftPatternRepository->get_all_id();
        $today = date('l');
        for ($sp_index = 0; $sp_index < count($shift_pattern_arr_id); $sp_index++) {
            $shift_pattern = $this->shiftPatternRepository->get_by_id($shift_pattern_arr_id[$sp_index]);
            $shift_id = 0;
            if ($today == 'Monday') {
                $shift_id = $shift_pattern->monday_shift_id;
            } else if ($today == 'Tuesday') {
                $shift_id = $shift_pattern->tuesday_shift_id;
            } else if ($today == 'Wednesday') {
                $shift_id = $shift_pattern->wednesday_shift_id;
            } else if ($today == 'Thursday') {
                $shift_id = $shift_pattern->thursday_shift_id;
            } else if ($today == 'Friday') {
                $shift_id = $shift_pattern->friday_shift_id;
            } else if ($today == 'Saturday') {
                $shift_id = $shift_pattern->saturday_shift_id;
            } else if ($today == 'Sunday') {
                $shift_id = $shift_pattern->sunday_shift_id;
            }

            $selected_ids = $this->userRepository->getArrIdByShiftPatternId($shift_pattern->id);
            $registerMappingShiftEntity = new RegisterMappingShiftEntity(
                $shift_id,
                $selected_ids,
                date("Y-m-d"),
                date("Y-m-d"),
                True,
            );
            $this->mappingShiftRepository->insert($registerMappingShiftEntity);
        }
    }
}
