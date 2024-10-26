<?php

namespace App\UseCases\ShiftPattern;

use App\Entities\ShiftPattern\RegisterShiftPatternEntity;
use App\Models\ShiftPattern;
use App\Repositories\ShiftPatternRepository;

class InsertUseCase
{
    /**
     * @var ShiftPatternRepository
     */
    private $shiftPatternRepository;

    public function __construct(ShiftPatternRepository $shiftPatternRepository) {
        $this->shiftPatternRepository = $shiftPatternRepository;
    }

    public function execute(string $name,
                            int $monday_shift_id,
                            int $tuesday_shift_id,
                            int $wednesday_shift_id,
                            int $thursday_shift_id,
                            int $friday_shift_id,
                            int $saturday_shift_id,
                            int $sunday_shift_id) {
        $entity = new RegisterShiftPatternEntity(
            $name,
            $monday_shift_id,
            $tuesday_shift_id,
            $wednesday_shift_id,
            $thursday_shift_id,
            $friday_shift_id,
            $saturday_shift_id,
            $sunday_shift_id
        );
        return $this->shiftPatternRepository->insert($entity);
    }
}
