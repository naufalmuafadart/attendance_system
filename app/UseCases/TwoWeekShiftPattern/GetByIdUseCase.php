<?php

namespace App\UseCases\TwoWeekShiftPattern;

use App\Repositories\TwoWeekShiftPatternRepository;

class GetByIdUseCase
{
    /**
     * @var TwoWeekShiftPatternRepository
     */
    private $repository;

    public function __construct(TwoWeekShiftPatternRepository $repository) {
        $this->repository = $repository;
    }

    public function execute(int $id) {
        return $this->repository->get_by_id($id);
    }
}
