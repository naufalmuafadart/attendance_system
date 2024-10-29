<?php

namespace App\Repositories;

use App\Entities\PengajuanAbsen\RegisterPengajuanAbsenEntity;

interface AttendanceRequestRepository
{
    public function insert(RegisterPengajuanAbsenEntity $pengajuanAbsenEntity);
    public function get();
    public function getWithUsernameAndShiftName();
    public function approve($id);
    public function reject($id, $reason);
    public function get_by_id($id);
}
