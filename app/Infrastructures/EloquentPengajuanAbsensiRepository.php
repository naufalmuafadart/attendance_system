<?php

namespace App\Infrastructures;

use App\Entities\PengajuanAbsen\RegisterPengajuanAbsenEntity;
use App\Models\PengajuanAbsen;
use App\Repositories\PengajuanAbsensiRepository;

class EloquentPengajuanAbsensiRepository implements PengajuanAbsensiRepository
{

    public function insert(RegisterPengajuanAbsenEntity $pengajuanAbsenEntity) {
        $model = new PengajuanAbsen;
        $model->user_id = $pengajuanAbsenEntity->user_id;
        $model->mapping_shift_id = $pengajuanAbsenEntity->mapping_shift_id;
        $model->clock_in = $pengajuanAbsenEntity->clock_in;
        $model->clock_out = $pengajuanAbsenEntity->clock_out;
        $model->reason = $pengajuanAbsenEntity->reason;
        $model->file = $pengajuanAbsenEntity->file;
        $model->status = $pengajuanAbsenEntity->status;
        $model->save();
    }
}
