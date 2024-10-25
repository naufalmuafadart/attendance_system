@extends('templates.dashboard')

@push('pre-script')
    <script>
        const shift_id = '{{ $shift->id }}';
    </script>
    <script src="/js/pages/shift/edit.js" type="module"></script>
@endpush

@section('isi')
    <div class="row">
        <div class="col-md-12 m project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 p-0 d-flex mt-2">
                        <h4>{{ $title }}</h4>
                    </div>
                    <div class="col-md-6 p-0">
                        <a href="{{ url('/shift') }}" class="btn btn-danger btn-sm ms-2">Back</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <form method="post" class="p-4" action="{{ url('/shift/'.$shift->id) }}">
                    @method('put')
                    @csrf
                        <div class="form-group">
                            <label for="nama_shift" class="float-left">Nama Shift</label>
                            <input type="text" class="form-control @error('nama_shift') is-invalid @enderror" id="nama_shift" name="nama_shift" autofocus value="{{ old('nama_shift', $shift->nama_shift) }}">
                            @error('nama_shift')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jam_masuk" class="float-left">Jam Masuk</label>
                            <input type="text" class="form-control clockpicker @error('jam_masuk') is-invalid @enderror" id="jam_masuk" name="jam_masuk" autofocus value="{{ old('jam_masuk', $shift->jam_masuk) }}">
                            @error('jam_masuk')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="jam_keluar" class="float-left">Jam Keluar</label>
                            <input type="text" class="form-control clockpicker @error('jam_keluar') is-invalid @enderror" id="jam_keluar" name="jam_keluar" autofocus value="{{ old('jam_keluar', $shift->jam_keluar) }}">
                            @error('jam_keluar')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    <button type="submit" class="btn btn-primary float-right">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 m project-list">
            <div class="card">
                <div class="row">
                    <div class="col-md-6 p-0 d-flex mt-2">
                        <h4>Assign karyawan</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card p-4">
                <form
                    @submit.prevent="onSubmitMappingShift">
                    <input type="hidden" value="{{ $shift->id }}" name="shift_id" />
                    <div class="form-group">
                        <label for="" class="float-left">Pilih karyawan</label>
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Nama</th>
                                <th scope="col">Jabatan</th>
                                <th scope="col">
                                    <input
                                            type="checkbox"
                                            @change="toggleSelectAll($event)"
                                            :checked="areAllSelected"
                                    />
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(employee, index) in employees" :key="employee.id">
                                <td>@{{ index + 1 }}</td>
                                <td>@{{ employee.name }}</td>
                                <td>@{{ employee.nama_jabatan }}</td>
                                <td>
                                    <!-- Checkbox for individual row -->
                                    <input
                                            type="checkbox"
                                            :value="employee.id"
                                            v-model="selected_ids"
                                    />
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="form-group">
                        <label for="inputStartDate" class="float-left">Tanggal Mulai</label>
                        <input
                                type="date"
                                class="form-control"
                                id="inputStartDate"
                                name="start_date"
                                autofocus
                                v-model="startDateModel">
                    </div>

                    <div class="form-group">
                        <label for="inputLastDate" class="float-left">Tanggal Selesai</label>
                        <input
                                type="date"
                                class="form-control"
                                id="inputLastDate"
                                name="end_date"
                                autofocus
                                required
                                v-model="endDateModel">
                    </div>

                    <div class="form-check">
                        <input
                                type="checkbox"
                                class="form-check-input"
                                v-model="isLockLocation"
                                required
                                id="isLockLocationCheck">
                        <label class="form-check-label" for="isLockLocationCheck">Lock Location</label>
                    </div>

                    <button type="submit" class="btn btn-primary float-right" id="btnSubmitAssign">Submit</button>
                </form>
            </div>
        </div>
    </div>

    @push('script')
        <script>
            $(document).ready(function(){
                $('.clockpicker').clockpicker({
                    donetext: 'Done'
                });

                $('body').on('keyup', '.clockpicker', function (event) {
                    var val = $(this).val();
                    val = val.replace(/[^0-9:]/g, '');
                    val = val.replace(/:+/g, ':');
                    $(this).val(val);
                });
            });
        </script>
    @endpush
@endsection
