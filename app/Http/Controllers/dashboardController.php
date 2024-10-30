<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\MappingShift;
use App\UseCases\front_end\user\Dashboard\GetDashboardUserDataUseCase;
use Illuminate\Http\Request;
use App\Models\Cuti;
use App\Models\Lembur;
use App\Models\ResetCuti;
use App\Models\Announcement;
use App\Models\Blog;
use App\Models\Acara;

class dashboardController extends Controller
{
    /**
     * @var GetDashboardUserDataUseCase
     */
    private $getDashboardUserDataUseCase;

    public function __construct(GetDashboardUserDataUseCase $getDashboardUserDataUseCase) {
        $this->getDashboardUserDataUseCase = $getDashboardUserDataUseCase;
    }

    public function index() {
        date_default_timezone_set('Asia/Jakarta');
        $tgl_skrg = date("Y-m-d");

        if(auth()->user()->is_admin == "admin"){
            return view('dashboard.index', [
                'title' => 'Dashboard',
                'jumlah_user' => User::count(),
                'jumlah_masuk' => MappingShift::where('tanggal', $tgl_skrg)->where('status_absen', 'Masuk')->count(),
                'jumlah_libur' => MappingShift::where('tanggal', $tgl_skrg)->where('status_absen', 'Libur')->count(),
                'jumlah_cuti' => MappingShift::where('tanggal', $tgl_skrg)->where('status_absen', 'Cuti')->count(),
                'jumlah_izin_masuk' => MappingShift::where('tanggal', $tgl_skrg)->where('status_absen', 'Izin Masuk')->count(),
                'jumlah_izin_telat' => MappingShift::where('tanggal', $tgl_skrg)->where('status_absen', 'Izin Telat')->count(),
                'jumlah_izin_pulang_cepat' => MappingShift::where('tanggal', $tgl_skrg)->where('status_absen', 'Izin Pulang Cepat')->count(),
                'jumlah_karyawan_lembur' => Lembur::where('tanggal', $tgl_skrg)->count(),
            ]);
        } else {
            $user_login = auth()->user()->id;
            $tanggal = "";
            $tglskrg = date('Y-m-d');
            $tglkmrn = date('Y-m-d', strtotime('-1 days'));
            $mapping_shift = MappingShift::where('user_id', $user_login)->where('tanggal', $tglkmrn)->get();
            if($mapping_shift->count() > 0) {
                foreach($mapping_shift as $mp) {
                    $jam_absen = $mp->jam_absen;
                    $jam_pulang = $mp->jam_pulang;
                }
            } else {
                $jam_absen = "-";
                $jam_pulang = "-";
            }
            if($jam_absen != null && $jam_pulang == null) {
                $tanggal = $tglkmrn;
            } else {
                $tanggal = $tglskrg;
            }

            $blog = Blog::where('is_published', true)
                ->orderBy('created_at', 'desc')
                ->get();

            $acara = Acara::orderBy('start_time', 'desc')
                ->take(10)
                ->get();

            $data = $this->getDashboardUserDataUseCase->execute();

            return view('user.index', [
                'title' => 'Dashboard',
                'shift_karyawan' => MappingShift::where('user_id', $user_login)->where('tanggal', $tanggal)->first(),
                'news' => $blog,
                'acara' => $acara,
                'data' => $data,
            ]);
        }
    }

    public function menu() {
        return view('dashboard.menu', [
            'title' => 'All Menu',
        ]);
    }
}
