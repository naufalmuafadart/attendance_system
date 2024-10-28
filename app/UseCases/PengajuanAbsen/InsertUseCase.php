<?php

namespace App\UseCases\PengajuanAbsen;

use App\Entities\PengajuanAbsen\RegisterPengajuanAbsenEntity;
use App\Repositories\MappingShiftRepository;
use App\Repositories\PengajuanAbsensiRepository;
use App\Repositories\StorageRepository;

class InsertUseCase {
    public function __construct(
        PengajuanAbsensiRepository $pengajuanAbsenRepository,
        StorageRepository $storageRepository,
        MappingShiftRepository $mappingShiftRepository) {
        $this->pengajuanAbsenRepository = $pengajuanAbsenRepository;
        $this->storageRepository = $storageRepository;
        $this->mappingShiftRepository = $mappingShiftRepository;
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
    }
}
