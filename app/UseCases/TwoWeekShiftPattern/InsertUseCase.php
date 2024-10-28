<?php

namespace App\UseCases\TwoWeekShiftPattern;

use App\Entities\TwoWeekShiftPattern\RegisterTwoWeekShiftPatternEntity;
use App\Models\TwoWeekShiftPattern;
use App\Repositories\TwoWeekShiftPatternRepository;

class InsertUseCase
{
    /**
     * @var TwoWeekShiftPatternRepository
     */
    private $repository;

    public function __construct(TwoWeekShiftPatternRepository $repository) {
        $this->repository = $repository;
    }

    public function execute(
        string $name,
        string $start_date,
        int $monday_shift_id,
        int $tuesday_shift_id,
        int $wednesday_shift_id,
        int $thursday_shift_id,
        int $friday_shift_id,
        int $saturday_shift_id,
        int $sunday_shift_id,
        int $second_monday_shift_id,
        int $second_tuesday_shift_id,
        int $second_wednesday_shift_id,
        int $second_thursday_shift_id,
        int $second_friday_shift_id,
        int $second_saturday_shift_id,
        int $second_sunday_shift_id
    ) {
        $entity = new RegisterTwoWeekShiftPatternEntity(
            $name,
            $start_date,
            $monday_shift_id,
            $tuesday_shift_id,
            $wednesday_shift_id,
            $thursday_shift_id,
            $friday_shift_id,
            $saturday_shift_id,
            $sunday_shift_id,
            $second_monday_shift_id,
            $second_tuesday_shift_id,
            $second_wednesday_shift_id,
            $second_thursday_shift_id,
            $second_friday_shift_id,
            $second_saturday_shift_id,
            $second_sunday_shift_id);
        $this->repository->insert($entity);
    }
}
