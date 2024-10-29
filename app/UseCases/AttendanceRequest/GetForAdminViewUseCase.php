<?php

namespace App\UseCases\AttendanceRequest;

use App\Repositories\AttendanceRequestRepository;

class GetForAdminViewUseCase
{
    /**
     * @var AttendanceRequestRepository
     */
    private $attendanceRequestRepository;

    public function __construct(AttendanceRequestRepository $attendanceRequestRepository) {
        $this->attendanceRequestRepository = $attendanceRequestRepository;
    }

    public function execute() {
        return $this->attendanceRequestRepository->getWithUsernameAndShiftName();
    }
}
