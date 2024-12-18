<?php

namespace App\Infrastructures;

use App\Entities\MappingShift\RegisterMappingShiftEntity;
use App\Exceptions\CustomException;
use App\Exceptions\NotFoundException;
use App\Models\MappingShift;
use App\Repositories\MappingShiftRepository;
use DateInterval;
use DatePeriod;
use Illuminate\Database\Eloquent\ModelNotFoundException;

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
                    if ($model->shift_id == 1) {
                        $model->status_absen = 'Libur';
                    }
                    $model->lock_location = $entity->is_lock_location ? 1 : 0;
                    $model->save();
                }
            }
        } catch(\Exception $e) {
            throw new CustomException($e->getMessage());
        }
    }

    public function get_by_user_id_and_date($user_id, $date) {
        try {
            return MappingShift::where('user_id', $user_id)->where('tanggal', $date)->firstOrFail();
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException('Mapping Shift not found');
        }
    }

    public function get_id_by_user_id_and_date($user_id, $date) {
        try {
            $ms = MappingShift::where('user_id', $user_id)->where('tanggal', $date)->firstOrFail();
            return $ms->id;
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException('Mapping Shift not found');
        }
    }

    /**
     * @throws NotFoundException
     */
    public function update_clock_in($id, $clock_in, $shift_clock_in) {
       try {
           $ms = MappingShift::findOrFail($id);
           $ms->jam_absen = $clock_in->format('H:i:s');
           $ms->save();
       } catch (ModelNotFoundException $e) {
           throw new NotFoundException('Mapping Shift not found');
       }
    }

    public function update_clock_out($id, $clock_out, $shift_clock_out) {
        try {
            $ms = MappingShift::findOrFail($id);
            $ms->jam_pulang = $clock_out->format('H:i:s');
            $ms->save();
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException('Mapping Shift not found');
        }
    }

    public function get_date_by_id($id)
    {
        try {
            return MappingShift::findOrFail($id)->tanggal;
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException('Mapping Shift not found');
        }
    }

    public function get_shift_id_by_id($id) {
        try {
            return MappingShift::findOrFail($id)->shift_id;
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException('Mapping Shift not found');
        }
    }

    /**
     * @throws NotFoundException
     */
    public function update_late_offset_second($id, $late_offset_second)
    {
        try {
            $ms = MappingShift::findOrFail($id);
            $ms->telat = $late_offset_second;
            $ms->save();
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException('Mapping Shift not found');
        }
    }

    /**
     * @throws NotFoundException
     */
    public function update_early_offset_second($id, $early_offset_second) {
        try {
            $ms = MappingShift::findOrFail($id);
            $ms->pulang_cepat = $early_offset_second;
            $ms->save();
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException('Mapping Shift not found');
        }
    }

    public function update_status($id, $status) {
        try {
            $ms = MappingShift::findOrFail($id);
            $ms->status_absen = $status;
            $ms->save();
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException('Mapping Shift not found');
        }
    }
}
