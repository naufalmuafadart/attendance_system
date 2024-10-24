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
                <ul class="mt-3 mb-5">
                    <form method="post" class="tf-form p-2" action="{{ url('my-absen/pengajuan-proses/1') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="group-input">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="@error('tanggal') is-invalid @enderror" id="tanggal" name="tanggal" value="">
                            <div class="invalid-feedback">
                            </div>
                        </div>

                        <div class="group-input">
                            <label for="shift">Shift</label>
                            <input type="text" class="@error('shift') is-invalid @enderror" id="shift" name="shift" value="" disabled>
                            <div class="invalid-feedback">
                            </div>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">Clock in</label>
                        </div>

                        <div class="group-input">
                            <label for="jam_masuk_pengajuan">Jam Masuk</label>
                            <input type="text" class="form-control clockpicker @error('jam_masuk_pengajuan') is-invalid @enderror" id="jam_masuk_pengajuan" name="jam_masuk_pengajuan" autofocus value="">
                            <div class="invalid-feedback">
                            </div>
                        </div>

                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="exampleCheck2">
                            <label class="form-check-label" for="exampleCheck2">Clock out</label>
                        </div>

                        <div class="group-input">
                            <label for="jam_pulang_pengajuan">Jam Pulang</label>
                            <input type="text" class="form-control clockpicker @error('jam_pulang_pengajuan') is-invalid @enderror" id="jam_pulang_pengajuan" name="jam_pulang_pengajuan" autofocus value="">
                            <div class="invalid-feedback">
                            </div>
                        </div>

                        <div class="group-input">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea name="deskripsi" id="deskripsi" class="@error('deskripsi') is-invalid @enderror"></textarea>
                            <div class="invalid-feedback">
                            </div>
                        </div>

                        <div class="group-input">
                            <input type="file" class="form-control @error('file_pengajuan') is-invalid @enderror" id="file_pengajuan" name="file_pengajuan">
                            <div class="invalid-feedback">
                            </div>
                        </div>

                        <input type="hidden" name="status_pengajuan" value="Menunggu">

                        <button type="submit" class="btn btn-primary float-right">Submit</button>
                    </form>
                </ul>
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

@push('script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script>
        $(document).ready(function(){
            $('.clockpicker').clockpicker({
                donetext: 'Done'
            });

            $('select').select2();

            $('body').on('keyup', '.clockpicker', function (event) {
                var val = $(this).val();
                val = val.replace(/[^0-9:]/g, '');
                val = val.replace(/:+/g, ':');
                $(this).val(val);
            });
        });
    </script>
    <script src=""></script>
@endpush
