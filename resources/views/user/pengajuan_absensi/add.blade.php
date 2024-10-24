@extends('templates.app')
@section('container')
    <div id="app-wrap" style="padding-top: 0">
        <div class="bill-content">
            <div class="tf-container"></div>
            <form
                    method="post"
                    id="formSubmit"
                    class="tf-form p-2"
                    action=""
                    enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="inputUserId" name="user_id" value="{{ auth()->user()->id }}">
                <input type="hidden" id="inputShiftId" name="" value="0">
                <input type="hidden" id="isClockInChecked" name="" value="0">
                <input type="hidden" id="isClockOutChecked" name="" value="0">

                <div class="group-input">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" id="inputDate" name="tanggal" value="">
                    <div class="invalid-feedback">
                    </div>
                </div>

                <section id="mappingShiftExistSection" class="d-none">
                    {{--Shift--}}
                    <div class="group-input">
                        <label for="shift">Shift</label>
                        <input type="text" id="inputShift" name="shift" value="" disabled>
                        <div class="invalid-feedback">
                        </div>
                    </div>

                    {{--Clock in check--}}
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="clockInCheckInput">
                        <label class="form-check-label" for="clockInCheckInput">Clock in</label>
                    </div>

                    {{--Clock in--}}
                    <div class="group-input">
                        <label for="jam_masuk_pengajuan">Jam Masuk</label>
                        <input
                                type="text"
                                class="form-control clockpicker"
                                id="clockInInput"
                                name="jam_masuk_pengajuan"
                                autofocus
                                value="">
                        <div class="invalid-feedback">
                        </div>
                    </div>

                    {{--Clock out check--}}
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="clockOutCheckInput">
                        <label class="form-check-label" for="clockOutCheckInput">Clock out</label>
                    </div>

                    {{--Clock out--}}
                    <div class="group-input">
                        <label for="jam_pulang_pengajuan">Jam Pulang</label>
                        <input
                                type="text"
                                class="form-control clockpicker"
                                id="clockOutInput"
                                name="jam_pulang_pengajuan"
                                autofocus
                                value="">
                        <div class="invalid-feedback">
                        </div>
                    </div>

                    {{--Deskripsi--}}
                    <div class="group-input">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" id="inputReason" class=""></textarea>
                        <div class="invalid-feedback">
                        </div>
                    </div>

                    {{--File--}}
                    <div class="group-input">
                        <input type="file" class="form-control" id="inputFile" name="file_pengajuan">
                        <div class="invalid-feedback">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                </section>
                <section id="mappingShiftExistNotSection" class="d-none justify-content-center">
                    <p>Tidak ada shift</p>
                </section>
            </form>
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
    <script src="/js/pages/pengajuan_absensi/add.js"></script>
@endpush
