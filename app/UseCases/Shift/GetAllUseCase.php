<?php

namespace App\UseCases\Shift;

use App\Repositories\ShiftRepository;

class GetAllUseCase {
    /**
     * @var ShiftRepository
     */
    private $shiftRepository;

    public function __construct(ShiftRepository $shiftRepository) {
        $this->shiftRepository = $shiftRepository;
    }

    public function execute() {
        return $this->shiftRepository->get();
    }
}
