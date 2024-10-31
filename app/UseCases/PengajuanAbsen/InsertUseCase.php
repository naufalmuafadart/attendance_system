<?php

namespace App\UseCases\PengajuanAbsen;

use App\Entities\PengajuanAbsen\RegisterPengajuanAbsenEntity;
use App\Repositories\MappingShiftRepository;
use App\Repositories\AttendanceRequestRepository;
use App\Repositories\NotificationRepository;
use App\Repositories\StorageRepository;
use App\Repositories\UserRepository;

class InsertUseCase {
    public function __construct(
        AttendanceRequestRepository $pengajuanAbsenRepository,
        StorageRepository           $storageRepository,
        MappingShiftRepository      $mappingShiftRepository,
        NotificationRepository $notificationRepository,
        UserRepository $userRepository) {
        $this->pengajuanAbsenRepository = $pengajuanAbsenRepository;
        $this->storageRepository = $storageRepository;
        $this->mappingShiftRepository = $mappingShiftRepository;
        $this->notificationRepository = $notificationRepository;
        $this->userRepository = $userRepository;
    }

    public function execute($user_id, $date, $clock_in, $clock_out, $reason, $file) {
        $mapping_shift_id = $this->mappingShiftRepository->get_id_by_user_id_and_date($user_id, $date);
        $file = $this->storageRepository->upload($file, 'uploads/pengajuan_absensi');
        $entity = new RegisterPengajuanAbsenEntity(
            $user_id,
            $mapping_shift_id,
            $clock_in,
            $clock_out,
            $reason,
            $file
        );
        $this->pengajuanAbsenRepository->insert($entity);
        $user = $this->userRepository->getById($user_id);
        $admin_id = (int) env('ADMIN_ID', 1);
        $this->notificationRepository->publish(
            [$admin_id],
            $user_id,
            $user->name,
            $user->name.' mengajukan pengajuan absensi untuk tanggal '.$date,
            '/admin/attendance_request'
        );
    }
}
