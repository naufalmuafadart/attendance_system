<?php

namespace App\Repositories;

use App\Entities\PengajuanAbsen\RegisterPengajuanAbsenEntity;

interface PengajuanAbsensiRepository
{
    public function insert(RegisterPengajuanAbsenEntity $pengajuanAbsenEntity);
}
