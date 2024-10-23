@extends('templates.app')
@section('container')
    <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
                <div class="tf-spacing-16"></div>
                <div class="bill-content">
                    <form action="">
                        <div class="row">
                            <div class="col-10">
                                <div class="input-field">
                                    <span class="icon-search"></span>
                                    <input required class="search-field value_input" placeholder="Search" name="search" type="text" value="" id="inputSearch">
                                    <span class="icon-clear"></span>
                                </div>
                            </div>
                            <div class="col-2">
                                <button type="submit" class="btn"><i class="fa fa-search"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="tf-spacing-16"></div>
            </div>
        </div>
    </div>
    <div id="app-wrap" style="padding-top: 0">
        <div class="bill-content">
            <div class="tf-container">
                <h3 class="fw_6 d-flex justify-content-between mt-3">{{ $title }}</h3>
                <ul class="mt-3 mb-5" id="userContainer">
                </ul>
            </div>
        </div>
    </div>
    <template id="userTemplate">
        <li class="list-card-invoice tf-topbar d-flex justify-content-between align-items-center">
            <div class="user-info">
                <img src="{{ url('/assets/img/foto_default.jpg') }}" alt="image" class="profilePhoto">
            </div>
            <div class="content-right">
                <h4><a href="" class="userAnchor"><span class="name"></span> <span class="primary_color">View</span></a></h4>
                <p>
                    <span class="position"></span> <br> <a href="https://wa.me/081212341234" class="phone">081212341234</a>
                </p>
            </div>
        </li>
    </template>
@endsection

@push('script')
    <script src="/js/pages/karyawan/indexUser.js"></script>
@endpush
