<?php

namespace App\UseCases\ShiftPattern;

use App\Repositories\ShiftPatternRepository;
use App\Repositories\UserRepository;

class AssignUserUseCase
{
    /**
     * @var ShiftPatternRepository
     */
    private $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->userRepository = $userRepository;
    }

    public function execute($arr_id, $shift_pattern_id) {
        $this->userRepository->resetShiftPatternIdByShiftPatternId($shift_pattern_id);
        for ($i = 0; $i < count($arr_id); $i++) {
            $this->userRepository->updateShiftPatternId($arr_id[$i], $shift_pattern_id);
        }
    }
}
