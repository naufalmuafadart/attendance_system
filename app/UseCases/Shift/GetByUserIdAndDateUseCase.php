<?php

namespace App\UseCases\Shift;

use App\Repositories\MappingShiftRepository;
use App\Repositories\ShiftRepository;

class GetByUserIdAndDateUseCase {
    public function __construct(MappingShiftRepository $mappingShiftRepository, ShiftRepository $shiftRepository) {
        $this->mappingShiftRepository = $mappingShiftRepository;
        $this->shiftRepository = $shiftRepository;
    }

    public function execute($userId, $date) {
        $shiftId = $this->mappingShiftRepository->get_shift_id_by_user_id_and_date($userId, $date);
        return $this->shiftRepository->get_by_id($shiftId);
    }
}
