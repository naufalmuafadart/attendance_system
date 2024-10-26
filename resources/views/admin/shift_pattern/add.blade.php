@extends('templates.dashboard')

@push('pre-script')
    <script src="/js/pages/admin/shift_pattern/add.js" type="module"></script>
@endpush

@section('isi')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h3>Tambah Shift Pattern</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form @submit.prevent="onSubmit">
                        <div class="form-group">
                            <label for="inputShiftPattern">Nama shift pattern</label>
                            <input
                                    type="text"
                                    class="form-control"
                                    id="inputShiftPattern"
                                    placeholder=""
                                    v-model="nameModel"
                                    required>
                        </div>
                        <table class="table table-bordered mb-3">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Hari</th>
                                <th>Shift</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>1</td>
                                <td>Senin</td>
                                <td>
                                    <select class="form-control" v-model="mondayShiftIdModel">
                                        <option
                                                v-for="shift in shifts"
                                                :value="shift.id">
                                            @{{ shift.nama_shift }}
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Selasa</td>
                                <td>
                                    <select class="form-control" v-model="tuesdayShiftIdModel">
                                        <option
                                                v-for="shift in shifts"
                                                :value="shift.id">
                                            @{{ shift.nama_shift }}
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>Rabu</td>
                                <td>
                                    <select class="form-control" v-model="wednesdayShiftIdModel">
                                        <option
                                                v-for="shift in shifts"
                                                :value="shift.id">
                                            @{{ shift.nama_shift }}
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Kamis</td>
                                <td>
                                    <select class="form-control" v-model="thursdayShiftIdModel">
                                        <option
                                                v-for="shift in shifts"
                                                :value="shift.id">
                                            @{{ shift.nama_shift }}
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Jum'at</td>
                                <td>
                                    <select class="form-control" v-model="fridayShiftIdModel">
                                        <option
                                                v-for="shift in shifts"
                                                :value="shift.id">
                                            @{{ shift.nama_shift }}
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Sabtu</td>
                                <td>
                                    <select class="form-control" v-model="saturdayShiftIdModel">
                                        <option
                                                v-for="shift in shifts"
                                                :value="shift.id">
                                            @{{ shift.nama_shift }}
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>Minggu</td>
                                <td>
                                    <select class="form-control" v-model="sundayShiftIdModel">
                                        <option
                                                v-for="shift in shifts"
                                                :value="shift.id">
                                            @{{ shift.nama_shift }}
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-info float-right">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
