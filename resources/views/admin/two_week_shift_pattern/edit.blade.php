@extends('templates.dashboard')

@push('pre-script')
    <script type="text/javascript">
        const shift_pattern_id = Number('{{ $id }}');
    </script>
    <script src="/js/pages/admin/two_week_shift_pattern/edit.js" type="module"></script>
@endpush

@section('isi')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Edit Shift Pattern
                    </h3>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <form @submit.prevent="">
                        <div class="form-group">
                            <label for="inputName">Nama shift pattern</label>
                            <input
                                    type="text"
                                    class="form-control"
                                    id="inputName"
                                    placeholder=""
                                    v-model="nameModel"
                                    required>
                        </div>
                        <div class="form-group">
                            <label for="inputStartDate">Tanggal Mulai</label>
                            <input
                                    type="text"
                                    class="form-control"
                                    id="inputStartDate"
                                    placeholder=""
                                    v-model="startDateModel"
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
                            <tr>
                                <td>8</td>
                                <td>Senin</td>
                                <td>
                                    <select class="form-control" v-model="secondMondayShiftIdModel">
                                        <option
                                                v-for="shift in shifts"
                                                :value="shift.id">
                                            @{{ shift.nama_shift }}
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>9</td>
                                <td>Selasa</td>
                                <td>
                                    <select class="form-control" v-model="secondTuesdayShiftIdModel">
                                        <option
                                                v-for="shift in shifts"
                                                :value="shift.id">
                                            @{{ shift.nama_shift }}
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>10</td>
                                <td>Rabu</td>
                                <td>
                                    <select class="form-control" v-model="secondWednesdayShiftIdModel">
                                        <option
                                                v-for="shift in shifts"
                                                :value="shift.id">
                                            @{{ shift.nama_shift }}
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>11</td>
                                <td>Kamis</td>
                                <td>
                                    <select class="form-control" v-model="secondThursdayShiftIdModel">
                                        <option
                                                v-for="shift in shifts"
                                                :value="shift.id">
                                            @{{ shift.nama_shift }}
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>12</td>
                                <td>Jum'at</td>
                                <td>
                                    <select class="form-control" v-model="secondFridayShiftIdModel">
                                        <option
                                                v-for="shift in shifts"
                                                :value="shift.id">
                                            @{{ shift.nama_shift }}
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>13</td>
                                <td>Sabtu</td>
                                <td>
                                    <select class="form-control" v-model="secondSaturdayShiftIdModel">
                                        <option
                                                v-for="shift in shifts"
                                                :value="shift.id">
                                            @{{ shift.nama_shift }}
                                        </option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>14</td>
                                <td>Minggu</td>
                                <td>
                                    <select class="form-control" v-model="secondSundayShiftIdModel">
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

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">
                        Assign Karyawan
                    </h3>
                </div><!-- /.card-header -->
                <div class="card-body">
                    <form @submit.prevent="onAssignEmployee">
                        <table class="table table-bordered table-striped mb-3">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Jabatan</th>
                                <th>
                                    <input
                                            type="checkbox"
                                            @change="toggleSelectAll($event)"
                                            :checked="areAllSelected"
                                    />
                                </th>
                            </tr>
                            </thead>
                            <tr v-for="(user, index) in users" :key="user.id">
                                <td>@{{ index + 1 }}</td>
                                <td>@{{ user.name }}</td>
                                <td>@{{ user.nama_jabatan }}</td>
                                <td>
                                    <!-- Checkbox for individual row -->
                                    <input
                                            type="checkbox"
                                            :value="user.id"
                                            v-model="selected_ids"
                                    />
                                </td>
                            </tr>
                        </table>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-info float-right" role="submit">Simpan</button>
                        </div>
                    </form>
                </div><!-- /.card-header -->
            </div>
        </div>
    </div>
@endsection
