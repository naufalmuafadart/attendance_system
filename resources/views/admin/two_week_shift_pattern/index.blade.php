@extends('templates.dashboard')

@push('pre-script')
    <script src="/js/pages/admin/two_week_shift_pattern/index.js" type="module"></script>
@endpush

@section('isi')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h3>2 Weeks Shift Pattern</h3>
                        <a href="/admin/two_week_shift_pattern/add"><button class="btn btn-primary">+ Tambah</button></a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-for="(shift_pattern, index) in shift_patterns">
                            <td>@{{ index + 1 }}</td>
                            <td>@{{ shift_pattern.name }}</td>
                            <td><a :href="`/admin/two_week_shift_pattern/edit/${shift_pattern.id}`"><i class="fa fa-solid fa-edit"></i></a></td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
