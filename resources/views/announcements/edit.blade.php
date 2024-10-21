@extends('templates.dashboard')

@push('style')
    <link rel="stylesheet" href="/css/pages/announcements/edit.css">
@endpush

@push('script')
    <script src="/js/pages/announcements/edit.js" type="module"></script>
@endpush

@section('isi')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4>Edit Pengumuman</h4>
            </div>
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ url('/pengumuman/'.$announcement->id.'/update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Menggunakan PUT untuk mengindikasikan pembaruan data -->

                    <div class="form-group">
                        <label for="judul">Judul Pengumuman</label>
                        <input type="text" name="title" class="form-control" id="judul" value="{{ old('title') != null ? old('title') : $announcement->title }}" required>
                    </div>
                    <div class="form-group">
                        <label for="konten">Konten Pengumuman</label>
                        <textarea name="content" class="form-control" id="konten" rows="5" required>{{ old('content') != null ? old('content') : $announcement->content }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="inputFile">File</label>
                        <input type="file" name="file" class="form-control d-none" id="inputFile" accept="application/pdf">
                        <p id="oldFileNameP">{{ $announcement->file }}<span style='font-size:1em;color:red' class="ml=2" id="oldFileNameCross">&#10006;</span></p>
                    </div>

                    <!-- Checkbox for "Ditujukan untuk Semua" -->
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" name="is_for_all" id="is_for_all" value="1" onchange="toggleTargetUsers()" {{ $announcement->is_for_all ? 'checked' : '' }}>
                        <label class="form-check-label" for="is_for_all">Ditujukan untuk Semua</label>
                    </div>

                    <!-- Target Users Section -->
                    <div class="form-group" id="target_users_section">
                        <label>Tujukan Kepada</label><br>
                        @foreach ($jabatans as $jabatan)
                            <div class="form-check">
                                <input type="checkbox" name="target_users[]" value="{{ $jabatan->id }}" class="form-check-input" id="jabatan_{{ $jabatan->id }}"
                                    {{ in_array($jabatan->id, $targetUsers) ? 'checked' : '' }}>
                                <label class="form-check-label" for="jabatan_{{ $jabatan->id }}">{{ $jabatan->nama_jabatan }}</label>
                            </div>
                        @endforeach
                        <small class="form-text text-muted">Pilih satu atau lebih jabatan.</small>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan Pengumuman</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    // Fungsi untuk menampilkan atau menyembunyikan bagian target users
    function toggleTargetUsers() {
        const isForAll = document.getElementById('is_for_all').checked;
        const targetUsersSection = document.getElementById('target_users_section');

        targetUsersSection.style.display = isForAll ? 'none' : 'block';
    }

    // Panggil fungsi untuk menyesuaikan tampilan saat halaman dimuat
    document.addEventListener("DOMContentLoaded", function() {
        toggleTargetUsers(); // Menyesuaikan tampilan berdasarkan status checkbox
    });
</script>
@endsection
