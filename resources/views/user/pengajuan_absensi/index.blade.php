@extends('templates.app')
@section('container')
    <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
                <div class="tf-spacing-16"></div>

                <div class="bill-content">
                    <form action="{{ url('/pengajuan-absensi') }}">
                        <div class="row">
                            <div class="col-10">
                                <div class="input-field">
                                    <span class="icon-search"></span>
                                    <input required class="search-field value_input" placeholder="Search" name="search" type="text" value="{{ request('search') }}">
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
    <div id="app-wrap">
        <div class="bill-content">
            <div class="tf-container">
                <a href="{{ url('/pengajuan-absensi/add') }}" class="btn btn-sm btn-primary ms-4" style="border-radius: 10px">+ Tambah</a>
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
