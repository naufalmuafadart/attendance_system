<?php

namespace App\UseCases\AttendanceRequest;

use App\Repositories\AttendanceRequestRepository;
use App\Repositories\DateTimeRepository;
use App\Repositories\MappingShiftRepository;
use App\Repositories\ShiftRepository;

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

    /**
     * @var ShiftRepository
     */
    private $shiftRepository;

    /**
     * @var DateTimeRepository
     */
    private $dateTimeRepository;

    public function __construct(
        AttendanceRequestRepository $attendanceRequestRepository,
        MappingShiftRepository $mappingShiftRepository,
        ShiftRepository $shiftRepository, DateTimeRepository $dateTimeRepository) {
        $this->attendanceRequestRepository = $attendanceRequestRepository;
        $this->mappingShiftRepository = $mappingShiftRepository;
        $this->shiftRepository = $shiftRepository;
        $this->dateTimeRepository = $dateTimeRepository;
    }

    public function execute($id) {
        $attendance_request = $this->attendanceRequestRepository->get_by_id($id);
        $mapping_shift_id = $attendance_request->mapping_shift_id;
        $shift_id = $this->mappingShiftRepository->get_shift_id_by_id($mapping_shift_id);
        $shift = $this->shiftRepository->get_entity_by_id($shift_id);

        $shift_clock_in = $shift->clock_in;
        $shift_clock_out = $shift->clock_out;

        $clock_in = $attendance_request->clock_in;
        $clock_out = $attendance_request->clock_out;

        $late_second = 0;
        if ($clock_in != null) {
            if ($this->dateTimeRepository->greater_than($clock_in, $shift_clock_in)) {
                $late_second = $this->dateTimeRepository->get_difference_in_seconds($clock_in, $shift_clock_in);
                $this->mappingShiftRepository->update_late_offset_second($mapping_shift_id, $late_second);
            } else {
                $this->mappingShiftRepository->update_late_offset_second($mapping_shift_id, 0);
            }
            $this->mappingShiftRepository->update_clock_in($mapping_shift_id, $clock_in, $late_second);
        }
        if ($clock_out != null) {
             if ($this->dateTimeRepository->less_than($clock_out, $shift_clock_out)) {
                 $late_second = $this->dateTimeRepository->get_difference_in_seconds($clock_out, $shift_clock_out);
                 $this->mappingShiftRepository->update_early_offset_second($mapping_shift_id, $late_second);
             } else {
                 $this->mappingShiftRepository->update_early_offset_second($mapping_shift_id, 0);
             }
            $this->mappingShiftRepository->update_clock_out($mapping_shift_id, $clock_out, $shift_clock_out);
        }

        if ($clock_in != null || $clock_out != null) {
            $this->mappingShiftRepository->update_status($mapping_shift_id, 'Masuk');
        }
        $this->attendanceRequestRepository->approve($attendance_request->id);
    }
}
