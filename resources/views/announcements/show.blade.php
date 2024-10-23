@extends('templates.app')
@section('container')
    <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
                <div class="voucher-info">
                    <h2 class="fw_6" id="announcementTitle"></h2>
                </div>
                <div class="mt-2 mb-5">
                    <p class="mt-2 fw_4" id="announcementDate"></p>
                </div>
                <div class="voucher-desc mb-5">
                    <h4 class="fw_6">Informasi</h4>
                    <span id="announcementContent"></span>
                </div>
                <div class="voucher-desc">
                    <h4 class="fw_6">Download</h4>
                    <a href="#" id="downloadAnchor" class="d-none"><button class="btn btn-primary">Download</button></a>
                </div>
            </div>
        </div>
    </div>
    <br>
    <br>
@endsection

@push('script')
    <script src="/js/pages/announcements/show.js" type="text/javascript"></script>
@endpush
