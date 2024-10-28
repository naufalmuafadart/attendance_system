<?php

namespace App\UseCases\MappingShift;

use App\Entities\MappingShift\RegisterMappingShiftEntity;
use App\Repositories\MappingShiftRepository;
use App\Repositories\ShiftPatternRepository;
use App\Repositories\TwoWeekShiftPatternRepository;
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

    /**
     * @var TwoWeekShiftPatternRepository
     */
    private $twoWeekShiftPatternRepository;

    public function __construct(
        ShiftPatternRepository $shiftPatternRepository,
        UserRepository $userRepository,
        MappingShiftRepository $mappingShiftRepository,
        TwoWeekShiftPatternRepository $twoWeekShiftPatternRepository) {
        $this->shiftPatternRepository = $shiftPatternRepository;
        $this->userRepository = $userRepository;
        $this->mappingShiftRepository = $mappingShiftRepository;
        $this->twoWeekShiftPatternRepository = $twoWeekShiftPatternRepository;
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

        $shift_pattern_arr_id = $this->twoWeekShiftPatternRepository->get_all_id();
        $todayDateTime = new \DateTime(date('Y-m-d'));
        for ($sp_index = 0; $sp_index < count($shift_pattern_arr_id); $sp_index++) {
            $shift_pattern = $this->twoWeekShiftPatternRepository->get_by_id($shift_pattern_arr_id[$sp_index]);
            $start_date = new \DateTime($shift_pattern->start_date);
            $day_difference = $todayDateTime->diff($start_date)->days;
            $shift_id = 0;
            if ($today == 'Monday') {
                $shift_id = $day_difference % 14 < 7 ? $shift_pattern->monday_shift_id : $shift_pattern->second_monday_shift_id;
            } else if ($today == 'Tuesday') {
                $shift_id = $day_difference % 14 < 7 ? $shift_pattern->tuesday_shift_id : $shift_pattern->second_tuesday_shift_id;
            } else if ($today == 'Wednesday') {
                $shift_id = $day_difference % 14 < 7 ? $shift_pattern->wednesday_shift_id : $shift_pattern->second_wednesday_shift_id;
            } else if ($today == 'Thursday') {
                $shift_id = $day_difference % 14 < 7 ? $shift_pattern->thursday_shift_id : $shift_pattern->second_thursday_shift_id;
            } else if ($today == 'Friday') {
                $shift_id = $day_difference % 14 < 7 ? $shift_pattern->friday_shift_id : $shift_pattern->second_friday_shift_id;
            } else if ($today == 'Saturday') {
                $shift_id = $day_difference % 14 < 7 ? $shift_pattern->saturday_shift_id : $shift_pattern->second_saturday_shift_id;
            } else if ($today == 'Sunday') {
                $shift_id = $day_difference % 14 < 7 ? $shift_pattern->sunday_shift_id : $shift_pattern->second_sunday_shift_id;
            }

            $selected_ids = $this->userRepository->getArrIdByTwoWeekShiftPatternId($shift_pattern->id);
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
