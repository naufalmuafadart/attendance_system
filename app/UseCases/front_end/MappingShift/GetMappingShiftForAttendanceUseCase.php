<?php

namespace App\UseCases\front_end\MappingShift;

use App\Repositories\MappingShiftRepository;

class GetMappingShiftForAttendanceUseCase {
    /**
     * @var MappingShiftRepository
     */
    private $mappingShiftRepository;

    public function __construct(MappingShiftRepository $mappingShiftRepository) {
        $this->mappingShiftRepository = $mappingShiftRepository;
    }

    public function execute($user_id) {
        try {
            return $this->mappingShiftRepository->get_by_user_id_and_date($user_id, date('Y-m-d'));
        } catch (\Throwable $th) {
            return null;
        }
    }
}
