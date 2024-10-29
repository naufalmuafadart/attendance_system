@extends('templates.dashboard')

@push('pre-script')
    <script src="/js/pages/admin/attendance_request/index.js" type="module"></script>
@endpush

@push('style')
    <style>
        .custom-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background */
            z-index: 999;
        }

        /* Modal content */
        .custom-modal-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 80%; /* Large width */
            max-width: 1000px;
            height: 80%; /* Large height */
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            overflow-y: auto; /* Allows scrolling for overflow */
            border-radius: 8px;
        }

        /* Close button */
        .custom-modal-close-button {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 24px;
            cursor: pointer;
        }
    </style>
@endpush

@section('isi')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h3>Pengajuan Absen</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kayawan</th>
                            <th>Tanggal</th>
                            <th>Shift</th>
                            <th>Clock In</th>
                            <th>Clock Out</th>
                            <th>Alasan</th>
                            <th>File</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(request, index) in requests">
                            <td>@{{ index + 1 }}</td>
                            <td>@{{ request['user_name'] }}</td>
                            <td>@{{ request['date'] }}</td>
                            <td>@{{ request['shift_name'] }}</td>
                            <td>@{{ request['clock_in'] == null ? '-' : request['clock_in'] }}</td>
                            <td>@{{ request['clock_out'] == null ? '-' : request['clock_out'] }}</td>
                            <td>@{{ request['reason'] }}</td>
                            <td>
                                <button class="btn btn-primary" @click="downloadFile(index)">
                                    <i data-feather="download" style="height: 1rem"></i>
                                </button>
                            </td>
                            <td v-if="request['status']==='pending'"><span class="badge badge-pill badge-warning">Pending</span></td>
                            <td v-if="request['status']==='approved'"><span class="badge badge-pill badge-success">Diterima</span></td>
                            <td v-if="request['status']==='rejected'"><span class="badge badge-pill badge-danger">Ditolak</span></td>
                            <td>
                                <button class="btn btn-info" @click="openModal(index)">
                                    <i data-feather="external-link" style="height: 1em"></i>
                                </button>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Structure -->
    <div id="largeModal" class="custom-modal-overlay" :style="{ 'display': modalDisplay }">
        <div class="custom-modal-content" v-if="selected_request_index > -1">
            <span class="custom-modal-close-button" @click="closeModal()">&times;</span>
            <h2>Detail pengajuan absen</h2>
            <table class="table table-bordered table-striped mb-2">
                <tbody>
                <tr>
                    <td>Nama Karyawan</td>
                    <td style="text-align: right;">@{{ requests[selected_request_index]['user_name'] }}</td>
                </tr>
                <tr>
                    <td>Tanggal</td>
                    <td style="text-align: right;">@{{ requests[selected_request_index]['date'] }}</td>
                </tr>
                <tr>
                    <td>Shift</td>
                    <td style="text-align: right;">@{{ requests[selected_request_index]['shift_name'] }}</td>
                </tr>
                <tr>
                    <td>Clock In</td>
                    <td style="text-align: right;">@{{ requests[selected_request_index]['clock_in'] == null ? '-' : requests[selected_request_index]['clock_in'] }}</td>
                </tr>
                <tr>
                    <td>Clock out</td>
                    <td style="text-align: right;">@{{ requests[selected_request_index]['clock_out'] == null ? '-' : requests[selected_request_index]['clock_out'] }}</td>
                </tr>
                <tr>
                    <td>Alasan</td>
                    <td style="text-align: right;">@{{ requests[selected_request_index]['reason'] }}</td>
                </tr>
                <tr>
                    <td>File</td>
                    <td style="text-align: right;"><button @click="downloadFile(selected_request_index)">Download</button></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td style="text-align: right;">@{{ requests[selected_request_index]['status'] }}</td>
                </tr>
                <tr v-if="requests[selected_request_index]['status']==='rejected'">
                    <td>Alasan ditolak</td>
                    <td style="text-align: right;">@{{ requests[selected_request_index]['reject_reason'] }}</td>
                </tr>
                </tbody>
            </table>

            <div class="d-flex justify-content-center" v-if="requests[selected_request_index]['status'] === 'pending'">
                <button class="btn btn-info" @click="onApprove()"><i data-feather="check" style="height: 1rem"></i>Terima</button>
                <div style="width: 10px;"></div>
                <button class="btn btn-danger" @click="onBtnRejectClicked">
                    <i data-feather="x" style="height: 1rem"></i>
                    Tolak
                </button>
            </div>
            <form v-if="requests[selected_request_index]['status'] === 'pending' && btn_reject_has_clicked" @submit.prevent="onReject">
                <h3>Alasan Penolakan</h3>
                <div class="form-group">
                    <input type="text" class="form-control" v-model="reasonModel">
                </div>
                <button class="btn btn-info">Submit Penolakan</button>
            </form>
        </div>
    </div>
@endsection
