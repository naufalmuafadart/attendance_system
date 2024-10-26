<?php

namespace App\UseCases\ShiftPattern;

use App\Repositories\ShiftPatternRepository;

class GetByIdUseCase {
    /**
     * @var ShiftPatternRepository
     */
    private $repository;

    public function __construct(ShiftPatternRepository $repository) {
        $this->repository = $repository;
    }

    public function execute(int $id) {
        return $this->repository->get_by_id($id);
    }
}
