<?php

namespace App\UseCases\AttendanceRequest;

use App\Repositories\AttendanceRequestRepository;

class GetUseCase {
    /**
     * @var AttendanceRequestRepository
     */
    private $repository;

    public function __construct(AttendanceRequestRepository $repository) {
        $this->repository = $repository;
    }

    public function execute() {
        return $this->repository->get();
    }
}
