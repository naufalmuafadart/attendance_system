@extends('templates.app')

@push('pre-script')
    <script type="text/javascript">
        const user_id = Number('{{ auth()->user()->id }}');
    </script>
    <script src="/js/pages/user/pengajuan_absensi/add.js" type="module"></script>
@endpush

@section('container')
    <div id="app-wrap" style="padding-top: 0">
        <div class="bill-content">
            <div class="tf-container"></div>
            <form
                    method="post"
                    id="formSubmit"
                    class="tf-form p-2"
                    action=""
                    @submit.prevent="onSubmit"
                    enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="inputUserId" name="user_id" value="{{ auth()->user()->id }}">
                <input type="hidden" id="inputShiftId" name="" value="0">
                <input type="hidden" id="isClockInChecked" name="" value="0">
                <input type="hidden" id="isClockOutChecked" name="" value="0">

                <div class="group-input">
                    <label for="tanggal">Tanggal</label>
                    <input type="date" id="inputDate" name="tanggal" v-model="dateModel">
                    <div class="invalid-feedback">
                    </div>
                </div>

                <section id="mappingShiftExistSection" v-if="is_has_fetch_date && !is_no_shift">
                    {{--Shift--}}
                    <div class="group-input">
                        <label for="shift">Shift</label>
                        <input type="text" id="inputShift" name="shift" v-model="shiftModel" disabled>
                        <div class="invalid-feedback">
                        </div>
                    </div>

                    {{--Clock in check--}}
                    <div class="form-check">
                        <input
                                type="checkbox"
                                class="form-check-input"
                                v-model="clockInCheckModel">
                        <label class="form-check-label" for="clockInCheckInput">Clock in</label>
                    </div>

                    {{--Clock in--}}
                    <div class="group-input">
                        <label for="jam_masuk_pengajuan">Jam Masuk</label>
                        <input
                                type="time"
                                class="form-control clockpicker"
                                id="clockInInput"
                                name="jam_masuk_pengajuan"
                                autofocus
                                v-model="clockInModel">
                        <div class="invalid-feedback">
                        </div>
                    </div>

                    {{--Clock out check--}}
                    <div class="form-check">
                        <input
                                type="checkbox"
                                class="form-check-input"
                                v-model="clockOutCheckModel">
                        <label class="form-check-label" for="clockOutCheckInput">Clock out</label>
                    </div>

                    {{--Clock out--}}
                    <div class="group-input">
                        <label for="jam_pulang_pengajuan">Jam Pulang</label>
                        <input
                                type="time"
                                class="form-control clockpicker"
                                id="clockOutInput"
                                name="jam_pulang_pengajuan"
                                autofocus
                                v-model="clockOutModel">
                        <div class="invalid-feedback">
                        </div>
                    </div>

                    {{--Deskripsi--}}
                    <div class="group-input">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea name="deskripsi" id="inputReason" v-model="descriptionModel"></textarea>
                        <div class="invalid-feedback">
                        </div>
                    </div>

                    {{--File--}}
                    <div class="group-input">
                        <label for="">File bukti</label>
                        <input
                                type="file"
                                class="form-control"
                                id="inputFile"
                                @change="onFileChange"
                                name="file_pengajuan">
                        <div class="invalid-feedback">
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary float-right" :disabled="is_btn_submit_disabled">Submit</button>
                </section>
                <section v-if="is_has_fetch_date && is_no_shift" class="d-flex justify-content-center">
                    <p>Tidak ada shift</p>
                </section>
            </form>
        </div>
    </div>
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
@endpush
