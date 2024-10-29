<?php

namespace App\UseCases\AttendanceRequest;

use App\Repositories\AttendanceRequestRepository;
use App\Repositories\MappingShiftRepository;

class ApproveUseCase
{
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

    public function execute($id) {
        $attendance_request = $this->attendanceRequestRepository->get_by_id($id);
        $mapping_shift_id = $attendance_request->mapping_shift_id;
        $clock_in = $attendance_request->clock_in;
        $clock_out = $attendance_request->clock_out;
        if ($clock_in != null) {
            $this->mappingShiftRepository->update_clock_in($mapping_shift_id, $clock_in);
        }
        if ($clock_out != null) {
            $this->mappingShiftRepository->update_clock_out($mapping_shift_id, $clock_out);
        }
        $this->attendanceRequestRepository->approve($attendance_request->id);
    }
}
