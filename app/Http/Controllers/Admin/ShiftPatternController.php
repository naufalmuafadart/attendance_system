<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShiftPatternController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Shift Pattern',
        ];
        return view('admin.shift_pattern.index', $data);
    }

    public function add() {
        $data = [
            'title' => 'Tambah Shift Pattern',
        ];
        return view('admin.shift_pattern.add', $data);
    }
}
