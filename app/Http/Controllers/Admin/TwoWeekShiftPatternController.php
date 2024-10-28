<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TwoWeekShiftPatternController extends Controller
{
    public function index() {
        $data = [
            'title' => 'Two-Weeks Shift Pattern',
        ];
        return view('admin.two_week_shift_pattern.index', $data);
    }

    public function add() {
        $data = [
            'title' => 'Tambah Two-Weeks Shift Pattern',
        ];
        return view('admin.two_week_shift_pattern.add', $data);
    }

    public function edit($id) {
        $data = [
            'id' => $id,
            'title' => 'Edit Shift Pattern',
        ];
        return view('admin.two_week_shift_pattern.edit', $data);
    }
}
