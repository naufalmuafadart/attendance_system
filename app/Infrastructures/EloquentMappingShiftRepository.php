<?php

namespace App\Infrastructures;

use App\Entities\MappingShift\RegisterMappingShiftEntity;
use App\Exceptions\CustomException;
use App\Exceptions\NotFoundException;
use App\Models\MappingShift;
use App\Repositories\MappingShiftRepository;
use DateInterval;
use DatePeriod;

class EloquentMappingShiftRepository implements MappingShiftRepository {
    public function get_shift_id_by_user_id_and_date($user_id, $date) {
        try {
            $ms = MappingShift::where('user_id', $user_id)->where('tanggal', $date)->firstOrFail();
            return $ms->shift_id;
        } catch(\Exception $e) {
            throw new NotFoundException('Mapping Shift not found');
        }
    }

    public function insert(RegisterMappingShiftEntity $entity) {
        try {
            $interval = new DateInterval('P1D');
            $end_date = $entity->end_date->add($interval);
            $datePeriod = new DatePeriod($entity->start_date, $interval, $end_date);

            for ($employee_index = 0; $employee_index < count($entity->selected_ids); $employee_index++) {
                $employee_id = $entity->selected_ids[$employee_index];
                foreach ($datePeriod as $date) {
                    $model = new MappingShift;
                    $model->user_id = $employee_id;
                    $model->shift_id = $entity->shift_id;
                    $model->tanggal = $date->format('Y-m-d');
                    $model->telat = 0;
                    $model->pulang_cepat = 0;
                    $model->status_absen = 'Tidak Masuk';
                    $model->lock_location = $entity->is_lock_location ? 1 : 0;
                    $model->save();
                }
            }
        } catch(\Exception $e) {
            throw new CustomException($e->getMessage());
        }
    }
}
