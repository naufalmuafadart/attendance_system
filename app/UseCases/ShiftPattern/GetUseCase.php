<?php

namespace App\UseCases\ShiftPattern;

use App\Repositories\ShiftPatternRepository;

class GetUseCase
{
    /**
     * @var ShiftPatternRepository
     */
    private $shiftPatternRepository;

    public function __construct(ShiftPatternRepository $shiftPatternRepository) {
        $this->shiftPatternRepository = $shiftPatternRepository;
    }

    public function execute() {
        return $this->shiftPatternRepository->get();
    }
}
