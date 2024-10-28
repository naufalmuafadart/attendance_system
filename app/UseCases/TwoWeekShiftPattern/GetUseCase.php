<?php

namespace App\UseCases\TwoWeekShiftPattern;

use App\Repositories\TwoWeekShiftPatternRepository;

class GetUseCase
{
    /**
     * @var TwoWeekShiftPatternRepository
     */
    private $repository;

    public function __construct(TwoWeekShiftPatternRepository $repository) {
        $this->repository = $repository;
    }

    public function execute() {
        return $this->repository->get();
    }
}
