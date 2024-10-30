<?php

namespace App\UseCases\AttendanceRequest;

use App\Repositories\AttendanceRequestRepository;
use App\Repositories\MappingShiftRepository;

class GetForUserViewUseCase {
    /**
     * @var AttendanceRequestRepository
     */
    private $attendanceRequestRepository;

    /**
     * @var MappingShiftRepository
     */
    private $mappingShiftRepository;

    public function __construct(AttendanceRequestRepository $attendanceRequestRepository, MappingShiftRepository $mappingShiftRepository) {
        $this->attendanceRequestRepository = $attendanceRequestRepository;
        $this->mappingShiftRepository = $mappingShiftRepository;
    }

    public function execute($user_id) {
        $requests = $this->attendanceRequestRepository->get_by_user_id($user_id);
        for ($i = 0; $i < count($requests); $i++) {
            $requests[$i]->date = $this->mappingShiftRepository->get_date_by_id($requests[$i]->mapping_shift_id);
        }
//        $requests->mapping_shift_id = '$requests->toArray()';
        return $requests;
    }
}
