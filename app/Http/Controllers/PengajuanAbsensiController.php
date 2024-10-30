<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use App\Models\MappingShift;
use App\Models\User;

class PengajuanAbsensiController extends Controller
{
    public function index() {
        $title = 'Pengajuan Absensi';
        $search = request()->input('search');
        $jabatan = Jabatan::find(auth()->user()->jabatan_id);
        $user_id = User::where('jabatan_id', auth()->user()->jabatan_id)->pluck('id');
        $mapping_shift = MappingShift::where('status_pengajuan', '!=', null)
            ->when($jabatan->manager == auth()->user()->id, function ($query) use ($user_id) {
                $query->where(function ($q) use ($user_id) {
                    $q->whereIn('user_id', $user_id)
                        ->orWhere('user_id', auth()->user()->id);
                });
            })
            ->when($jabatan->manager !== auth()->user()->id, function ($query) {
                $query->where('user_id', auth()->user()->id);
            })
            ->when($search, function ($query) use ($search) {
                $query->whereHas('User', function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%'.$search.'%');
                });
            })
            ->orderBy('tanggal', 'DESC')
            ->paginate(10)
            ->withQueryString();

        return view('user.pengajuan_absensi.index', compact(
            'mapping_shift',
            'title',
            'user_id'
        ));
    }

    public function add() {
        $title = 'Buat pengajuan absensi';
        return view('user.pengajuan_absensi.add', compact('title'));
    }
}
