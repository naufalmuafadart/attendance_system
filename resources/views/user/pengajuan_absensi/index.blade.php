@extends('templates.app')

@push('pre-script')
    <script type="text/javascript">
        const user_id = Number('{{ auth()->user()->id }}');
    </script>
    <script src="/js/pages/user/pengajuan_absensi/index.js" type="module"></script>
@endpush

@section('container')
    <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
                <div class="tf-spacing-16"></div>

                <div class="bill-content">
                    <form action="{{ url('/pengajuan-absensi') }}">
                        <div class="d-flex justify-content-between">
                            <div class="col-6">
                                <div class="input-field">
                                    <input class="" placeholder="Search" name="search" type="date" v-model="firstDateModel">
                                </div>
                            </div>
                            <div>-</div>
                            <div class="col-6">
                                <input class="" placeholder="Search" name="search" type="date" v-model="lastDateModel">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tf-spacing-16"></div>
            </div>
        </div>
    </div>
    <div id="app-wrap" style="padding-top: 5px;">
        <div class="bill-content">
            <div class="tf-container">
                <a href="{{ url('/pengajuan-absensi/add') }}" class="btn btn-sm btn-primary ms-4 mb-3" style="border-radius: 10px">+ Tambah</a>
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Clock in</th>
                        <th>Clock out</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(request, index) in filteredRequests">
                        <td>@{{ index + 1 }}</td>
                        <td>@{{ request['date'] }}</td>
                        <td>@{{ request['clock_in'] == null ? '-' : request['clock_in'] }}</td>
                        <td>@{{ request['clock_out'] == null ? '-' : request['clock_out'] }}</td>
                        <td v-if="request['status']==='pending'">Pending</td>
                        <td v-if="request['status']==='approved'">Diterima</td>
                        <td v-if="request['status']==='rejected'">Ditolak</td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
@endsection
