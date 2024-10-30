<?php

namespace App\Infrastructures;

use App\Entities\AttendanceRequest\AttendanceRequestEntity;
use App\Entities\PengajuanAbsen\RegisterPengajuanAbsenEntity;
use App\Exceptions\NotFoundException;
use App\Models\AttendanceRequest;
use App\Repositories\AttendanceRequestRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class EloquentAttendanceRequestRepository implements AttendanceRequestRepository
{
    public function insert(RegisterPengajuanAbsenEntity $pengajuanAbsenEntity) {
        $model = new AttendanceRequest;
        $model->user_id = $pengajuanAbsenEntity->user_id;
        $model->mapping_shift_id = $pengajuanAbsenEntity->mapping_shift_id;
        $model->clock_in = $pengajuanAbsenEntity->clock_in;
        $model->clock_out = $pengajuanAbsenEntity->clock_out;
        $model->reason = $pengajuanAbsenEntity->reason;
        $model->file = $pengajuanAbsenEntity->file;
        $model->status = $pengajuanAbsenEntity->status;
        $model->save();
    }

    public function get()
    {
        return AttendanceRequest::all();
    }

    public function getWithUsernameAndShiftName() {
        return DB::select('
            SELECT
                attendance_requests.id as id,
                users.name as user_name,
                shifts.nama_shift as shift_name,
                mapping_shifts.id as mapping_shift_id,
                mapping_shifts.tanggal as date,
                attendance_requests.clock_in,
                attendance_requests.clock_out,
                attendance_requests.reason,
                attendance_requests.file,
                attendance_requests.status,
                attendance_requests.approved_by,
                attendance_requests.reject_reason
            FROM
                attendance_requests
            JOIN users ON attendance_requests.user_id = users.id
            JOIN mapping_shifts ON attendance_requests.mapping_shift_id = mapping_shifts.id
            JOIN shifts ON mapping_shifts.shift_id = shifts.id
            ORDER BY attendance_requests.id DESC;
        ');
    }

    /**
     * @throws NotFoundException
     */
    public function approve($id)
    {
        try {
            $request = AttendanceRequest::findOrFail($id);
            $request->approved_by = 1;
            $request->status = 'approved';
            $request->save();
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException('Attendance request not found');
        }
    }

    /**
     * @throws NotFoundException
     */
    public function reject($id, $reason)
    {
        try {
            $request = AttendanceRequest::findOrFail($id);
            $request->approved_by = 1;
            $request->status = 'rejected';
            $request->reject_reason = $reason;
            $request->save();
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException('Attendance request not found');
        }
    }

    /**
     * @throws NotFoundException
     */
    public function get_by_id($id)
    {
        try {
            return AttendanceRequest::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            throw new NotFoundException('Attendance request not found');
        }
    }

    public function get_by_user_id($user_id) {
        $requests = AttendanceRequest::where('user_id', $user_id)->get();
        $data = [];
        for ($i = 0; $i < count($requests); $i++) {
            $data[] = new AttendanceRequestEntity(
                $requests[$i]->user_id,
                $requests[$i]->mapping_shift_id,
                $requests[$i]->clock_in,
                $requests[$i]->clock_out,
                $requests[$i]->reason,
                $requests[$i]->file,
                $requests[$i]->status,
                $requests[$i]->approved_by,
                $requests[$i]->reject_reason,
                $requests[$i]->created_at,
                $requests[$i]->updated_at
            );
        }
        return $data;
    }
}
