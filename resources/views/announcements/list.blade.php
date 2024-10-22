@extends('templates.app')

@section('container')
    <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box" id="announcementContainer">
                <p id="textAnnouncementNotFound" class="d-none">No announcements available for you.</p>
            </div>
        </div>
    </div>
    <template id="announcementTemplate">
        <div class="food-box">
            <a href="">
                <div class="content">
                    <h4></h4>
                    <!-- You can add more fields from the announcement like date, created_by, etc. -->
                    <span></span>
                </div>
            </a>
        </div>
        <hr>
    </template>
@endsection

@push('script')
    <script src="/js/pages/announcements/list.js"></script>
@endpush
