<?php

namespace App\UseCases\AttendanceRequest;

use App\Repositories\AttendanceRequestRepository;

class RejectUseCase {
    /**
     * @var AttendanceRequestRepository
     */
    private $repository;

    public function __construct(AttendanceRequestRepository $repository) {
        $this->repository = $repository;
    }

    public function execute($id, $reason) {
        $this->repository->reject($id, $reason);
    }
}
