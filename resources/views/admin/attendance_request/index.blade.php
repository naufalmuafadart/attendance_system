@extends('templates.dashboard')

@push('pre-script')
    <script src="/js/pages/admin/attendance_request/index.js" type="module"></script>
@endpush

@push('style')
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
                        <tr
                                v-for="(request, index) in requests"
                                is="vue:row-user"
                                @download-file="downloadFile"
                                @open-modal="openModal"
                                :index="index"
                                :user_name="request['user_name']"
                                :date="request['date']"
                                :shift_name="request['shift_name']"
                                :clock_in="request['clock_in']"
                                :clock_out="request['clock_out']"
                                :reason="request['reason']"
                                :status="request['status']"
                                :file="request['file']"></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Structure -->
    <detail-modal
            v-if="selected_request_index>-1"
            @close-modal="closeModal"
            @on-reject="onReject"
            @on-approve="onApprove"
            @download-file="downloadFile"
            :user_name="requests[selected_request_index]['user_name']"
            :date="requests[selected_request_index]['date']"
            :shift_name="requests[selected_request_index]['shift_name']"
            :clock_in="requests[selected_request_index]['clock_in']"
            :clock_out="requests[selected_request_index]['clock_out']"
            :reason="requests[selected_request_index]['reason']"
            :status="requests[selected_request_index]['status']"
            :file="requests[selected_request_index]['file']"
            :is_shown="isModalVisible"
            :index="selected_request_index"></detail-modal>
@endsection
