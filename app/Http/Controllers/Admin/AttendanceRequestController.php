<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AttendanceRequestController extends Controller
{
    public function index() {
        return view('admin.attendance_request.index', ['title' => 'Pengajuan Absensi']);
    }
}
