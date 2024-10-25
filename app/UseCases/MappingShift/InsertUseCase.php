<?php

namespace App\UseCases\MappingShift;

use App\Entities\MappingShift\RegisterMappingShiftEntity;
use App\Repositories\MappingShiftRepository;

class InsertUseCase
{
    public function __construct(MappingShiftRepository $repository) {
        $this->repository = $repository;
    }

    public function execute($shift_id, $selected_ids, $start_date, $end_date, $is_lock_location)
    {
        $entity = new RegisterMappingShiftEntity(
            $shift_id,
            $selected_ids,
            $start_date,
            $end_date,
            $is_lock_location
        );
        $this->repository->insert($entity);
    }
}
