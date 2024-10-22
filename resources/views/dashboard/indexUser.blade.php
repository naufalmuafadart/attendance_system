@extends('templates.app')
@section('container')
    <div class="card-secton">
        <div class="tf-container">
            <div class="tf-balance-box">
                <div class="balance">
                    <div class="row">
                        <div class="col-6 br-right">
                            <div class="inner-left">
                                <p>{{ $shift_karyawan->Shift->nama_shift ?? '-' }}</p>
                                <h4>{{ auth()->user()->Lokasi->nama_lokasi }}</h4>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="inner-right">
                                <p>Jam Kerja</p>
                                <h3>
                                    <span>{{ $shift_karyawan->Shift->jam_masuk ?? '' }} - {{ $shift_karyawan->Shift->jam_keluar ?? '' }}</span>
                                </h3>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="wallet-footer">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="wallet-card-item">
                            <a class="fw_6" href="{{ url('/absen') }}">
                                <svg xmlns="http://www.w3.org/2000/svg" id="icons" viewBox="0 0 60 60" width="35" height="35">
                                    <path d="M56.157,17.984a2.011,2.011,0,0,0,.579-1.613L56.1,8.727a2.084,2.084,0,0,0-1.37-1.795,1.99,1.99,0,0,0-2.124.474l-1.4,1.4A29.824,29.824,0,0,0,27,.149,30,30,0,0,0,30.025,60c.808,0,1.621-.032,2.434-.1A29.929,29.929,0,0,0,59.824,33.3a30.426,30.426,0,0,0-.466-9.485,3.016,3.016,0,0,0-2.938-2.372,3.209,3.209,0,0,0-.751.092,3,3,0,0,0-2.178,3.533A24.009,24.009,0,0,1,31.96,53.928a24.006,24.006,0,1,1,15-40.879l-1.367,1.367a2,2,0,0,0-.487,2.134,2.084,2.084,0,0,0,1.79,1.37l7.641.64A2.016,2.016,0,0,0,56.157,17.984ZM47,15.841l2.07-2.07a1,1,0,0,0,.029-1.385,25.982,25.982,0,1,0,6.759,20.391,26.3,26.3,0,0,0-.406-8.118,1,1,0,1,1,1.953-.431,28.462,28.462,0,0,1,.435,8.86A28,28,0,0,1,2.1,27.675,28.244,28.244,0,0,1,27.2,2.139Q28.608,2,30,2a27.8,27.8,0,0,1,20.454,8.914,1,1,0,0,0,.714.319,1.154,1.154,0,0,0,.724-.293l2.127-2.133.081.079.609,7.681-7.651-.64Z" style="fill: rgb(0, 9, 238)"/>
                                    <path d="M30,12a1,1,0,0,0,1-1V9a1,1,0,1,0-2,0v2A1,1,0,0,0,30,12Z"/>
                                    <path d="M21.366,13.047l-1-1.732a1,1,0,1,0-1.732,1l1,1.732a1,1,0,1,0,1.732-1Z"/>
                                    <path d="M14.046,19.635l-1.733-1a1,1,0,1,0-1,1.732l1.733,1a1,1,0,0,0,1-1.732Z"/>
                                    <path d="M12,30a1,1,0,0,0-1-1H9a1,1,0,0,0,0,2h2A1,1,0,0,0,12,30Z"/>
                                    <path d="M11.814,41.5a.992.992,0,0,0,.5-.134l1.733-1a1,1,0,1,0-1-1.732l-1.733,1a1,1,0,0,0,.5,1.866Z"/>
                                    <path d="M21,45.589a1,1,0,0,0-1.366.366l-1,1.733a1,1,0,1,0,1.732,1l1-1.733A1,1,0,0,0,21,45.589Z"/>
                                    <path d="M29,49v2a1,1,0,1,0,2,0V49a1,1,0,0,0-2,0Z"/>
                                    <path d="M40.366,45.955a1,1,0,1,0-1.732,1l1,1.733a1,1,0,0,0,1.732-1Z"/>
                                    <path d="M48.687,39.635l-1.733-1a1,1,0,1,0-1,1.732l1.733,1a.992.992,0,0,0,.5.134,1,1,0,0,0,.5-1.866Z"/>
                                    <path d="M52,30a1,1,0,0,0-1-1H49a1,1,0,0,0,0,2h2A1,1,0,0,0,52,30Z"/>
                                    <path d="M41,10.948a1,1,0,0,0-1.366.367l-1,1.732a1,1,0,1,0,1.732,1l1-1.732A1,1,0,0,0,41,10.948Z"/>
                                    <path d="M34.293,35.708a1,1,0,0,0,1.414-1.414L33.433,32.02A3.944,3.944,0,0,0,34,30a4,4,0,0,0-3-3.858V16a1,1,0,1,0-2,0V26.143A3.992,3.992,0,0,0,30,34a3.947,3.947,0,0,0,2.019-.567ZM28,30a2,2,0,1,1,3.415,1.412h0v0A2,2,0,0,1,28,30Z" style="fill: rgb(0, 9, 238)"/>
                                </svg>
                                Absensi
                            </a>
                        </div>
                        <div class="wallet-card-item">
                            <a href="{{ url('/cuti') }}" class="fw_6">
                                <svg xmlns="http://www.w3.org/2000/svg" id="icons" viewBox="0 0 60 60" width="35" height="35">
                                    <path d="M52,30.166V9a5.006,5.006,0,0,0-5-5H44V3a3,3,0,1,0-6,0V4H34V3a3,3,0,0,0-6,0V4H24V3a3,3,0,0,0-6,0V4H14V3A3,3,0,0,0,8,3V4H5A5.006,5.006,0,0,0,0,9V50a5.006,5.006,0,0,0,5,5H32.411A15.983,15.983,0,1,0,52,30.166ZM40,3a1,1,0,1,1,2,0V7a1,1,0,0,1-2,0ZM30,3a1,1,0,1,1,2,0V7a1,1,0,0,1-2,0ZM20,3a1,1,0,0,1,2,0V7a1,1,0,1,1-2,0ZM10,3a1,1,0,1,1,2,0V7a1,1,0,1,1-2,0ZM5,6H8V7a3,3,0,0,0,6,0V6h4V7a3,3,0,0,0,6,0V6h4V7a3,3,0,0,0,6,0V6h4V7a3,3,0,0,0,6,0V6h3a3,3,0,0,1,3,3v3H2V9A3,3,0,0,1,5,6ZM5,53a3,3,0,0,1-3-3V14H50V29.179A15.985,15.985,0,0,0,30.782,53Zm39,5A14,14,0,1,1,58,44,14.015,14.015,0,0,1,44,58Z" style="fill: rgb(0, 9, 238)"/>
                                    <path d="M13,17H7a3,3,0,0,0-3,3v2a3,3,0,0,0,3,3h6a3,3,0,0,0,3-3V20A3,3,0,0,0,13,17Zm1,5a1,1,0,0,1-1,1H7a1,1,0,0,1-1-1V20a1,1,0,0,1,1-1h6a1,1,0,0,1,1,1Z"/>
                                    <path d="M13,29H7a3,3,0,0,0-3,3v2a3,3,0,0,0,3,3h6a3,3,0,0,0,3-3V32A3,3,0,0,0,13,29Zm1,5a1,1,0,0,1-1,1H7a1,1,0,0,1-1-1V32a1,1,0,0,1,1-1h6a1,1,0,0,1,1,1Z"/>
                                    <path d="M13,41H7a3,3,0,0,0-3,3v2a3,3,0,0,0,3,3h6a3,3,0,0,0,3-3V44A3,3,0,0,0,13,41Zm1,5a1,1,0,0,1-1,1H7a1,1,0,0,1-1-1V44a1,1,0,0,1,1-1h6a1,1,0,0,1,1,1Z"/>
                                    <path d="M32,22V20a3,3,0,0,0-3-3H23a3,3,0,0,0-3,3v2a3,3,0,0,0,3,3h6A3,3,0,0,0,32,22ZM22,22V20a1,1,0,0,1,1-1h6a1,1,0,0,1,1,1v2a1,1,0,0,1-1,1H23A1,1,0,0,1,22,22Z"/>
                                    <path d="M39,25h6a3,3,0,0,0,3-3V20a3,3,0,0,0-3-3H39a3,3,0,0,0-3,3v2A3,3,0,0,0,39,25Zm-1-5a1,1,0,0,1,1-1h6a1,1,0,0,1,1,1v2a1,1,0,0,1-1,1H39a1,1,0,0,1-1-1Z"/>
                                    <path d="M48,43H46.816A3,3,0,0,0,45,41.185V38a1,1,0,0,0-2,0v3.184A2.993,2.993,0,1,0,46.816,45H48a1,1,0,0,0,0-2Zm-4,2a1,1,0,1,1,1-1A1,1,0,0,1,44,45Z" style="fill: rgb(0, 9, 238)"/>
                                    <path d="M44,35a1,1,0,0,0,1-1V33a1,1,0,0,0-2,0v1A1,1,0,0,0,44,35Z"/>
                                    <path d="M36.929,35.516a1,1,0,0,0-1.414,1.414l.707.707a1,1,0,0,0,1.414-1.414Z"/>
                                    <path d="M34,43H33a1,1,0,0,0,0,2h1a1,1,0,0,0,0-2Z"/>
                                    <path d="M36.222,50.365l-.707.707a1,1,0,1,0,1.414,1.414l.707-.707a1,1,0,0,0-1.414-1.414Z"/>
                                    <path d="M44,53a1,1,0,0,0-1,1v1a1,1,0,1,0,2,0V54A1,1,0,0,0,44,53Z"/>
                                    <path d="M51.778,50.365a1,1,0,0,0-1.414,1.414l.707.707a1,1,0,0,0,1.414-1.414Z"/>
                                    <path d="M53,44a1,1,0,0,0,1,1h1a1,1,0,0,0,0-2H54A1,1,0,0,0,53,44Z"/>
                                    <path d="M51.071,35.516l-.707.707a1,1,0,1,0,1.414,1.414l.707-.707a1,1,0,0,0-1.414-1.414Z"/>
                                </svg>
                                Cuti dan izin
                            </a>
                        </div>
                        <div class="wallet-card-item"><a class="fw_6" href="{{ url('/lembur') }}">
                                <svg id="icons" height="35" viewBox="0 0 60 60" width="35" xmlns="http://www.w3.org/2000/svg">
                                    <path d="m17.365 20c-6.039 4.951-9.365 11.347-9.365 18a22 22 0 0 0 21.984 22q.628 0 1.261-.035a22.124 22.124 0 0 0 20.743-21.25c.153-4.863-1.351-11.949-4.519-16.079a1.623 1.623 0 0 0 -2.778.437l-.37 1.007a3.628 3.628 0 0 1 -4.95 1.969 3.672 3.672 0 0 1 -1.8-4.337c2.335-9.283-.052-16.467-7.1-21.35a2 2 0 0 0 -2.123-.1 2.014 2.014 0 0 0 -1.033 1.887c.201 3.459-.83 10.381-9.95 17.851zm11.969-17.994c6.288 4.359 8.406 10.826 6.3 19.218a5.7 5.7 0 0 0 2.864 6.623 5.642 5.642 0 0 0 7.7-3.076l.115-.314c2.273 3.4 3.829 9.325 3.677 14.2a20.113 20.113 0 0 1 -18.855 19.313 20 20 0 0 1 -21.135-19.97c0-7.751 4.7-13.23 8.634-16.462 9.804-8.021 10.9-15.664 10.7-19.532z" style="fill: rgb(0, 9, 238)"/>
                                    <path d="m30 56a14 14 0 1 0 -14-14 14.015 14.015 0 0 0 14 14zm0-26a12 12 0 1 1 -12 12 12.013 12.013 0 0 1 12-12z"/>
                                    <path d="m30 35a1 1 0 0 0 1-1v-1a1 1 0 0 0 -2 0v1a1 1 0 0 0 1 1z"/>
                                    <path d="m23.636 37.051a1 1 0 0 0 1.414-1.414l-.707-.707a1 1 0 0 0 -1.414 1.414z"/>
                                    <path d="m21 43h1a1 1 0 1 0 0-2h-1a1 1 0 0 0 0 2z"/>
                                    <path d="m23.636 46.951-.707.707a1 1 0 1 0 1.414 1.414l.707-.707a1 1 0 0 0 -1.414-1.414z"/>
                                    <path d="m30 52a1 1 0 0 0 1-1v-1a1 1 0 0 0 -2 0v1a1 1 0 0 0 1 1z"/>
                                    <path d="m35.657 49.072a1 1 0 0 0 1.414-1.414l-.707-.707a1 1 0 1 0 -1.414 1.414z"/>
                                    <path d="m37 42a1 1 0 0 0 1 1h1a1 1 0 0 0 0-2h-1a1 1 0 0 0 -1 1z"/>
                                    <path d="m35.657 37.344a1 1 0 0 0 .707-.293l.707-.707a1 1 0 0 0 -1.414-1.414l-.707.707a1 1 0 0 0 .707 1.707z"/>
                                    <path d="m29.553 42.9 2 1a1 1 0 1 0 .894-1.789l-1.447-.728v-3.383a1 1 0 0 0 -2 0v4a1 1 0 0 0 .553.9z" style="fill: rgb(0, 9, 238)"/>
                                </svg>
                                Lembur
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="mt-5">
        <div class="tf-container">
            <div class="tf-title d-flex justify-content-between">
                <h3 class="fw_6">Layanan</h3>
            </div>
            <ul class="box-service mt-3">
                {{--Pengajuan Absensi--}}
                <li>
                    <a href="{{ url('/pengajuan-absensi') }}">
                        <div class="icon-box bg_service-2">
                            <svg id="icons" height="24" viewBox="0 0 60 60" width="24" xmlns="http://www.w3.org/2000/svg"><path d="m43 29.04v-21.04a3 3 0 0 0 -3-3h-36a3 3 0 0 0 -3 3v44a3 3 0 0 0 3 3h29.82z" fill="#a9725e"/><path d="m39 29.86v-19.86a1 1 0 0 0 -1-1h-32a1 1 0 0 0 -1 1v34l7 7h18.73z" fill="#fff"/><path d="m30 6v2a2.006 2.006 0 0 1 -2 2h-12a2.006 2.006 0 0 1 -2-2v-2a2.006 2.006 0 0 1 2-2h3a3 3 0 0 1 6 0h3a2.006 2.006 0 0 1 2 2z" fill="#b0ccdd"/><circle cx="44" cy="44" fill="#fff" r="15"/><path d="m12 45.17v5.83l-7-7h5.83a1.165 1.165 0 0 1 1.17 1.17z" fill="#b0ccdd"/><path d="m29 20a1 1 0 0 1 -.707-.293l-1-1a1 1 0 0 1 1.414-1.414l.185.185 2.308-3.078a1 1 0 0 1 1.6 1.2l-3 4a1 1 0 0 1 -.729.4z" fill="#e3c84c"/><path d="m29 30a1 1 0 0 1 -.707-.293l-1-1a1 1 0 0 1 1.414-1.414l.185.185 2.308-3.078a1 1 0 1 1 1.6 1.2l-3 4a1 1 0 0 1 -.729.4z" fill="#e3c84c"/><path d="m24 16h-14a1 1 0 0 1 0-2h14a1 1 0 0 1 0 2z" fill="#b0ccdd"/><path d="m18 20h-8a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2z" fill="#b0ccdd"/><path d="m24 26h-14a1 1 0 0 1 0-2h14a1 1 0 0 1 0 2z" fill="#b0ccdd"/><path d="m18 30h-8a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2z" fill="#b0ccdd"/><path d="m24 36h-14a1 1 0 0 1 0-2h14a1 1 0 0 1 0 2z" fill="#b0ccdd"/><path d="m18 40h-8a1 1 0 0 1 0-2h8a1 1 0 0 1 0 2z" fill="#b0ccdd"/><path d="m44 60a16 16 0 1 1 16-16 16.019 16.019 0 0 1 -16 16zm0-30a14 14 0 1 0 14 14 14.015 14.015 0 0 0 -14-14z" fill="#4295a8"/><path d="m43 43v-5a1 1 0 0 1 2 0v5z" fill="#e3c84c"/><g fill="#4295a8"><path d="m48 43a1 1 0 0 1 0 2h-4a1 1 0 0 1 -1-1v-1z"/><path d="m44 35a1 1 0 0 1 -1-1v-1a1 1 0 0 1 2 0v1a1 1 0 0 1 -1 1z"/><path d="m36.929 37.929a1 1 0 0 1 -.707-.293l-.707-.707a1 1 0 0 1 1.414-1.414l.707.707a1 1 0 0 1 -.707 1.707z"/><path d="m34 45h-1a1 1 0 0 1 0-2h1a1 1 0 0 1 0 2z"/><path d="m36.222 52.778a1 1 0 0 1 -.707-1.707l.707-.707a1 1 0 0 1 1.414 1.414l-.707.707a1 1 0 0 1 -.707.293z"/><path d="m44 56a1 1 0 0 1 -1-1v-1a1 1 0 0 1 2 0v1a1 1 0 0 1 -1 1z"/><path d="m51.778 52.778a1 1 0 0 1 -.707-.293l-.707-.707a1 1 0 0 1 1.414-1.414l.707.707a1 1 0 0 1 -.707 1.707z"/><path d="m55 45h-1a1 1 0 0 1 0-2h1a1 1 0 0 1 0 2z"/><path d="m51.071 37.929a1 1 0 0 1 -.707-1.707l.707-.707a1 1 0 0 1 1.414 1.414l-.707.707a1 1 0 0 1 -.707.293z"/></g><circle cx="44" cy="44" fill="#bfdbf0" r="2"/></svg>
                        </div>
                        Pengajuan Absensi
                    </a>
                </li>

                {{--Payroll--}}
                <li>
                    <a href="{{ url('/payroll') }}">
                        <div class="icon-box bg_color_2">
                            <svg id="icons" height="24" viewBox="0 0 60 60" width="24" xmlns="http://www.w3.org/2000/svg"><path d="m27.63 8.3-3.63 4.7-4 2-4-2-3.63-4.7a1.887 1.887 0 0 1 .49-2.7c.16-.11.33-.22.49-.31a8.337 8.337 0 0 1 1.83-.81 1.9 1.9 0 0 1 -.16-.77 1.985 1.985 0 0 1 1.13-1.77 8.354 8.354 0 0 1 7.7 0 1.959 1.959 0 0 1 .97 2.54 8.337 8.337 0 0 1 1.83.81c.16.09.33.2.49.31a1.887 1.887 0 0 1 .49 2.7z" fill="#925c4c"/><path d="m34.28 32.58-8.73-15.58-5.55-1-5.571 1-12.64 22.56a6.414 6.414 0 0 0 5.53 9.44h22.541z" fill="#925c4c"/><circle cx="44" cy="44" fill="#fff" r="15"/><rect fill="#e3c84c" height="4" rx="2" width="16" x="12" y="13"/><path d="m44 60a16 16 0 1 1 16-16 16.019 16.019 0 0 1 -16 16zm0-30a14 14 0 1 0 14 14 14.015 14.015 0 0 0 -14-14z" fill="#4295a8"/><path d="m43 43v-5a1 1 0 0 1 2 0v5z" fill="#e3c84c"/><g fill="#4295a8"><path d="m48 43a1 1 0 0 1 0 2h-4a1 1 0 0 1 -1-1v-1z"/><path d="m44 35a1 1 0 0 1 -1-1v-1a1 1 0 0 1 2 0v1a1 1 0 0 1 -1 1z"/><path d="m36.929 37.929a1 1 0 0 1 -.707-.293l-.707-.707a1 1 0 0 1 1.414-1.414l.707.707a1 1 0 0 1 -.707 1.707z"/><path d="m34 45h-1a1 1 0 0 1 0-2h1a1 1 0 0 1 0 2z"/><path d="m36.222 52.778a1 1 0 0 1 -.707-1.707l.707-.707a1 1 0 0 1 1.414 1.414l-.707.707a1 1 0 0 1 -.707.293z"/><path d="m44 56a1 1 0 0 1 -1-1v-1a1 1 0 0 1 2 0v1a1 1 0 0 1 -1 1z"/><path d="m51.778 52.778a1 1 0 0 1 -.707-.293l-.707-.707a1 1 0 0 1 1.414-1.414l.707.707a1 1 0 0 1 -.707 1.707z"/><path d="m55 45h-1a1 1 0 0 1 0-2h1a1 1 0 0 1 0 2z"/><path d="m51.071 37.929a1 1 0 0 1 -.707-1.707l.707-.707a1 1 0 0 1 1.414 1.414l-.707.707a1 1 0 0 1 -.707.293z"/></g><path d="m16.2 9.32a1.14 1.14 0 0 1 -.4.08 1 1 0 0 1 -.92-.6l-1.53-3.51a8.337 8.337 0 0 1 1.83-.81l1.54 3.52a1.013 1.013 0 0 1 -.52 1.32z" fill="#77483d"/><path d="m26.65 5.29-1.53 3.51a1.016 1.016 0 0 1 -.92.6 1.14 1.14 0 0 1 -.4-.08 1.013 1.013 0 0 1 -.52-1.32l1.54-3.52a8.337 8.337 0 0 1 1.83.81z" fill="#77483d"/><path d="m21 32.1v-5.916a3 3 0 0 1 2 2.816 1 1 0 0 0 2 0 5.009 5.009 0 0 0 -4-4.9v-.1a1 1 0 0 0 -2 0v.1a5 5 0 0 0 0 9.8v5.917a3 3 0 0 1 -2-2.817 1 1 0 0 0 -2 0 5.009 5.009 0 0 0 4 4.9v.1a1 1 0 0 0 2 0v-.1a5 5 0 0 0 0-9.8zm-4-3.1a3 3 0 0 1 2-2.816v5.632a3 3 0 0 1 -2-2.816zm4 10.816v-5.632a2.982 2.982 0 0 1 0 5.632z" fill="#e3c84c"/><circle cx="44" cy="44" fill="#bfdbf0" r="2"/></svg>
                        </div>
                        Payroll
                    </a>
                </li>

                {{--Dinas Luar--}}
                <li>
                    <a href="{{ url('/dinas-luar') }}">
                        <div class="icon-box bg_color_3">
                            <svg id="icons" height="24" viewBox="0 0 60 60" width="24" xmlns="http://www.w3.org/2000/svg"><path d="m37 10h-2v-5a2 2 0 0 0 -2-2h-16a2 2 0 0 0 -2 2v5h-2v-5a4 4 0 0 1 4-4h16a4 4 0 0 1 4 4z" fill="#5e3c34"/><path d="m49 20v9.86l-19.96 15.14h-25.04a3 3 0 0 1 -3-3v-22z" fill="#925c4c"/><path d="m49 12v8a5 5 0 0 1 -5 5h-38a5 5 0 0 1 -5-5v-8a3 3 0 0 1 3-3h42a3 3 0 0 1 3 3z" fill="#a9725e"/><path d="m20 25h10a0 0 0 0 1 0 0v4a2 2 0 0 1 -2 2h-6a2 2 0 0 1 -2-2v-4a0 0 0 0 1 0 0z" fill="#e3c84c"/><circle cx="44" cy="44" fill="#fff" r="15"/><g fill="#925c4c"><path d="m23 22h-2a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2z"/><path d="m17 22h-2a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2z"/><path d="m11 22h-2a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2z"/><path d="m5 15a1 1 0 0 1 -1-1v-1a1 1 0 0 1 2 0v1a1 1 0 0 1 -1 1z"/><path d="m5 20a1 1 0 0 1 -1-1v-1a1 1 0 0 1 2 0v1a1 1 0 0 1 -1 1z"/><path d="m29 22h-2a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2z"/><path d="m35 22h-2a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2z"/><path d="m41 22h-2a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2z"/><path d="m45 15a1 1 0 0 1 -1-1v-1a1 1 0 0 1 2 0v1a1 1 0 0 1 -1 1z"/><path d="m45 20a1 1 0 0 1 -1-1v-1a1 1 0 0 1 2 0v1a1 1 0 0 1 -1 1z"/></g><path d="m23 42h-2a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2z" fill="#7c483d"/><path d="m17 42h-2a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2z" fill="#7c483d"/><path d="m11 42h-2a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2z" fill="#7c483d"/><path d="m5 38a1 1 0 0 1 -1-1v-1a1 1 0 0 1 2 0v1a1 1 0 0 1 -1 1z" fill="#7c483d"/><path d="m29.3 42h-2.3a1 1 0 0 1 0-2h2.3a1 1 0 0 1 0 2z" fill="#7c483d"/><path d="m5 33a1 1 0 0 1 -1-1v-1a1 1 0 0 1 2 0v1a1 1 0 0 1 -1 1z" fill="#7c483d"/><path d="m44 60a16 16 0 1 1 16-16 16.019 16.019 0 0 1 -16 16zm0-30a14 14 0 1 0 14 14 14.015 14.015 0 0 0 -14-14z" fill="#4295a8"/><path d="m43 43v-5a1 1 0 0 1 2 0v5z" fill="#e3c84c"/><path d="m48 43a1 1 0 0 1 0 2h-4a1 1 0 0 1 -1-1v-1z" fill="#4295a8"/><path d="m44 35a1 1 0 0 1 -1-1v-1a1 1 0 0 1 2 0v1a1 1 0 0 1 -1 1z" fill="#4295a8"/><path d="m36.929 37.929a1 1 0 0 1 -.707-.293l-.707-.707a1 1 0 0 1 1.414-1.414l.707.707a1 1 0 0 1 -.707 1.707z" fill="#4295a8"/><path d="m34 45h-1a1 1 0 0 1 0-2h1a1 1 0 0 1 0 2z" fill="#4295a8"/><path d="m36.222 52.778a1 1 0 0 1 -.707-1.707l.707-.707a1 1 0 0 1 1.414 1.414l-.707.707a1 1 0 0 1 -.707.293z" fill="#4295a8"/><path d="m44 56a1 1 0 0 1 -1-1v-1a1 1 0 0 1 2 0v1a1 1 0 0 1 -1 1z" fill="#4295a8"/><path d="m51.778 52.778a1 1 0 0 1 -.707-.293l-.707-.707a1 1 0 0 1 1.414-1.414l.707.707a1 1 0 0 1 -.707 1.707z" fill="#4295a8"/><path d="m55 45h-1a1 1 0 0 1 0-2h1a1 1 0 0 1 0 2z" fill="#4295a8"/><path d="m51.071 37.929a1 1 0 0 1 -.707-1.707l.707-.707a1 1 0 0 1 1.414 1.414l-.707.707a1 1 0 0 1 -.707.293z" fill="#4295a8"/><circle cx="44" cy="44" fill="#bfdbf0" r="2"/></svg>
                        </div>
                        Dinas Luar
                    </a>
                </li>

                {{--Dokumen--}}
                <li>
                    <a href="{{ url('/my-dokumen') }}">
                    <div class="icon-box bg_color_4">
                        <svg id="icons" height="24" viewBox="0 0 60 60" width="24" xmlns="http://www.w3.org/2000/svg"><path d="m58.6 20.31a2.845 2.845 0 0 0 -.9-.96l-26-17.82a2.98 2.98 0 0 0 -3.4 0l-26 17.82a2.845 2.845 0 0 0 -.9.96 2.969 2.969 0 0 0 -.4 1.49v34.22a2.935 2.935 0 0 0 1 2.22 2.957 2.957 0 0 0 2 .76h52a2.993 2.993 0 0 0 3-2.98v-34.22a2.969 2.969 0 0 0 -.4-1.49z" fill="#2d747f"/><path d="m8 25.43v-18.43a2 2 0 0 1 2-2h40a2 2 0 0 1 2 2v18.43l-22 17.57z" fill="#e1efff"/><path d="m44 15a1 1 0 0 1 -.707-.293l-1-1a1 1 0 0 1 1.414-1.414l.185.185 2.308-3.078a1 1 0 1 1 1.6 1.2l-3 4a1 1 0 0 1 -.729.4z" fill="#c7af3e"/><path d="m44 25a1 1 0 0 1 -.707-.293l-1-1a1 1 0 0 1 1.414-1.414l.185.185 2.308-3.078a1 1 0 1 1 1.6 1.2l-3 4a1 1 0 0 1 -.729.4z" fill="#c7af3e"/><g fill="#9ebbce"><path d="m38 11h-25a1 1 0 0 1 0-2h25a1 1 0 0 1 0 2z"/><path d="m32 15h-19a1 1 0 0 1 0-2h19a1 1 0 0 1 0 2z"/><path d="m38 21h-25a1 1 0 0 1 0-2h25a1 1 0 0 1 0 2z"/><path d="m32 25h-19a1 1 0 0 1 0-2h19a1 1 0 0 1 0 2z"/><path d="m38 31h-25a1 1 0 0 1 0-2h25a1 1 0 0 1 0 2z"/><path d="m32 35h-16a1 1 0 0 1 0-2h16a1 1 0 0 1 0 2z"/></g><path d="m58 58.24a2.957 2.957 0 0 1 -2 .76h-52a2.957 2.957 0 0 1 -2-.76l25.61-19.44a3.96 3.96 0 0 1 4.78 0z" fill="#2d747f"/><path d="m26.4 39.72-24.4 18.52a2.935 2.935 0 0 1 -1-2.22v-34.22a2.969 2.969 0 0 1 .4-1.49z" fill="#4295a8"/><path d="m59 21.8v34.22a2.935 2.935 0 0 1 -1 2.22l-24.4-18.52 25-19.41a2.969 2.969 0 0 1 .4 1.49z" fill="#4295a8"/></svg>
                    </div>
                    Dokumen
                    </a>
                </li>

                {{--Histori Absen--}}
                <li>
                    <a href="{{ url('/my-absen') }}">
                        <div class="icon-box bg_color_5">
                            <svg id="icons" height="24" viewBox="0 0 60 60" width="24" xmlns="http://www.w3.org/2000/svg"><path d="m23 8v8.927a10.791 10.791 0 0 0 3.865 8.361l5.735 4.712-5.735 4.712a10.79 10.79 0 0 0 -3.865 8.36v8.928h32v-8.928a10.79 10.79 0 0 0 -3.865-8.36l-5.735-4.712 5.735-4.712a10.791 10.791 0 0 0 3.865-8.361v-8.927z" fill="#e1efff"/><path d="m20 1h38a1 1 0 0 1 1 1v4a3 3 0 0 1 -3 3h-34a3 3 0 0 1 -3-3v-4a1 1 0 0 1 1-1z" fill="#276268"/><path d="m22 51h34a3 3 0 0 1 3 3v4a1 1 0 0 1 -1 1h-38a1 1 0 0 1 -1-1v-4a3 3 0 0 1 3-3z" fill="#276268"/><path d="m28 51v-6.182a5.358 5.358 0 0 1 1.931-4.185l7.229-5.962a2.857 2.857 0 0 1 3.68 0l7.229 5.962a5.358 5.358 0 0 1 1.931 4.185v6.182z" fill="#dbb16e"/><path d="m50 9v6.182a5.358 5.358 0 0 1 -1.931 4.185l-7.229 5.962a2.857 2.857 0 0 1 -3.68 0l-7.229-5.962a5.358 5.358 0 0 1 -1.931-4.185v-6.182z" fill="#dbb16e"/><g fill="#347984"><rect height="14" rx="2" width="14" x="1" y="3"/><rect height="14" rx="2" width="14" x="1" y="23"/><rect height="14" rx="2" width="14" x="1" y="43"/></g><path d="m7 13a1 1 0 0 1 -.707-.293l-1-1a1 1 0 0 1 1.414-1.414l.185.185 2.308-3.078a1 1 0 1 1 1.6 1.2l-3 4a1 1 0 0 1 -.729.4z" fill="#fde05e"/><path d="m7 33a1 1 0 0 1 -.707-.293l-1-1a1 1 0 0 1 1.414-1.414l.185.185 2.308-3.078a1 1 0 0 1 1.6 1.2l-3 4a1 1 0 0 1 -.729.4z" fill="#fde05e"/><path d="m7 53a1 1 0 0 1 -.707-.293l-1-1a1 1 0 0 1 1.414-1.414l.185.185 2.308-3.078a1 1 0 1 1 1.6 1.2l-3 4a1 1 0 0 1 -.729.4z" fill="#fde05e"/></svg>
                        </div>
                        Histori Absen
                    </a>
                </li>

                {{--Kasbon--}}
                <li>
                    <a href="{{ url('/kasbon') }}">
                        <div class="icon-box bg_service-6">
                            <svg id="icons" height="24" viewBox="0 0 60 60" width="24" xmlns="http://www.w3.org/2000/svg"><path d="m24.48 50.95a25 25 0 1 1 26.47-26.47z" fill="#4295a8"/><path d="m22.2 46.65a21 21 0 1 1 24.45-24.45z" fill="#fff"/><path d="m59 40a19 19 0 1 1 -20-18.98c.33-.01.67-.02 1-.02s.67.01 1 .02a19.011 19.011 0 0 1 18 18.98z" fill="#e3c84c"/><path d="m26 11a1 1 0 0 1 -1-1v-1a1 1 0 0 1 2 0v1a1 1 0 0 1 -1 1z" fill="#4295a8"/><path d="m34 13.144a1 1 0 0 1 -.865-1.5l.5-.867a1 1 0 1 1 1.732 1l-.5.867a1 1 0 0 1 -.867.5z" fill="#4295a8"/><path d="m18 13.144a1 1 0 0 1 -.867-.5l-.5-.867a1 1 0 0 1 1.732-1l.5.867a1 1 0 0 1 -.865 1.5z" fill="#4295a8"/><path d="m12.143 19a.992.992 0 0 1 -.5-.134l-.867-.5a1 1 0 0 1 1-1.732l.867.5a1 1 0 0 1 -.5 1.866z" fill="#4295a8"/><path d="m10 27h-1a1 1 0 0 1 0-2h1a1 1 0 0 1 0 2z" fill="#4295a8"/><path d="m11.278 35.5a1 1 0 0 1 -.5-1.866l.867-.5a1 1 0 1 1 1 1.732l-.867.5a.992.992 0 0 1 -.5.134z" fill="#4295a8"/><path d="m26 26a1 1 0 0 1 -1-1v-11a1 1 0 0 1 2 0v11a1 1 0 0 1 -1 1z" fill="#e3c84c"/><g fill="#c7af3e"><path d="m41 21.02v4.98h-2v-4.98c.33-.01.67-.02 1-.02s.67.01 1 .02z"/><path d="m27.286 25.872 3.522 3.521-1.415 1.415-3.521-3.522c.226-.24.46-.488.693-.721s.481-.465.721-.693z"/><path d="m21.02 39h4.98v2h-4.98c-.01-.33-.02-.67-.02-1s.01-.67.02-1z"/><path d="m25.872 52.714 3.521-3.522 1.415 1.415-3.522 3.521c-.24-.226-.488-.46-.721-.693s-.465-.481-.693-.721z"/><path d="m39 58.98v-4.98h2v4.98c-.33.01-.67.02-1 .02s-.67-.01-1-.02z"/><path d="m52.714 54.128-3.522-3.521 1.415-1.415 3.521 3.522c-.226.24-.46.488-.693.721s-.481.465-.721.693z"/><path d="m58.98 41h-4.98v-2h4.98c.01.33.02.67.02 1s-.01.67-.02 1z"/><path d="m54.128 27.286-3.521 3.522-1.415-1.415 3.522-3.521c.24.226.488.46.721.693s.465.481.693.721z"/></g><path d="m47.73 22.64a18.261 18.261 0 0 0 -2.17-.82 20 20 0 1 0 -23.72 23.74 16.24 16.24 0 0 0 .81 2.18 22 22 0 1 1 25.08-25.1z" fill="#347984"/><circle cx="40" cy="40" fill="#fde05e" r="15"/><path d="m28.71 24.72-.02.02a18.587 18.587 0 0 0 -3.96 3.96l-.01.01a3 3 0 1 1 3.99-3.99z" fill="#bfdbf0"/><path d="m41 39.1v-5.916a3 3 0 0 1 2 2.816 1 1 0 0 0 2 0 5.009 5.009 0 0 0 -4-4.9v-.1a1 1 0 0 0 -2 0v.1a5 5 0 0 0 0 9.8v5.917a3 3 0 0 1 -2-2.817 1 1 0 0 0 -2 0 5.009 5.009 0 0 0 4 4.9v.1a1 1 0 0 0 2 0v-.1a5 5 0 0 0 0-9.8zm-4-3.1a3 3 0 0 1 2-2.816v5.632a3 3 0 0 1 -2-2.816zm4 10.816v-5.632a2.982 2.982 0 0 1 0 5.632z" fill="#c7af3e"/></svg>
                        </div>
                        Kasbon
                    </a>
                </li>

                {{--Histori dinas--}}
                <li>
                    <a href="{{ url('/my-dinas-luar') }}">
                        <div class="icon-box bg_surface_color">
                            <svg id="icons" height="24" viewBox="0 0 60 60" width="24" xmlns="http://www.w3.org/2000/svg"><path d="m5 53v-9.928a10.79 10.79 0 0 1 3.865-8.36l5.735-4.712-5.735-4.712a10.791 10.791 0 0 1 -3.865-8.361v-9.927h32v9.93a10.818 10.818 0 0 1 -3.86 8.36l-5.74 4.71 5.2 4.27.4 18.73z" fill="#e1efff"/><path d="m10 51v-6.18a5.381 5.381 0 0 1 1.93-4.19l7.23-5.96a2.87 2.87 0 0 1 3.68 0l6.66 5.49 1.23 10.84z" fill="#dbb16e"/><path d="m32 9v6.182a5.358 5.358 0 0 1 -1.931 4.185l-7.229 5.962a2.857 2.857 0 0 1 -3.68 0l-7.229-5.962a5.358 5.358 0 0 1 -1.931-4.185v-6.182z" fill="#dbb16e"/><path d="m2 1h38a1 1 0 0 1 1 1v4a3 3 0 0 1 -3 3h-34a3 3 0 0 1 -3-3v-4a1 1 0 0 1 1-1z" fill="#276268"/><path d="m30.73 51h-26.73a3 3 0 0 0 -3 3v4a1 1 0 0 0 1 1h38a1.03 1.03 0 0 0 .76-.35" fill="#276268"/><circle cx="44" cy="44" fill="#fff" r="15"/><path d="m44 60a16 16 0 1 1 16-16 16.019 16.019 0 0 1 -16 16zm0-30a14 14 0 1 0 14 14 14.015 14.015 0 0 0 -14-14z" fill="#4295a8"/><path d="m43 43v-5a1 1 0 0 1 2 0v5z" fill="#e3c84c"/><g fill="#4295a8"><path d="m48 43a1 1 0 0 1 0 2h-4a1 1 0 0 1 -1-1v-1z"/><path d="m44 35a1 1 0 0 1 -1-1v-1a1 1 0 0 1 2 0v1a1 1 0 0 1 -1 1z"/><path d="m36.929 37.929a1 1 0 0 1 -.707-.293l-.707-.707a1 1 0 0 1 1.414-1.414l.707.707a1 1 0 0 1 -.707 1.707z"/><path d="m34 45h-1a1 1 0 0 1 0-2h1a1 1 0 0 1 0 2z"/><path d="m36.222 52.778a1 1 0 0 1 -.707-1.707l.707-.707a1 1 0 0 1 1.414 1.414l-.707.707a1 1 0 0 1 -.707.293z"/><path d="m44 56a1 1 0 0 1 -1-1v-1a1 1 0 0 1 2 0v1a1 1 0 0 1 -1 1z"/><path d="m51.778 52.778a1 1 0 0 1 -.707-.293l-.707-.707a1 1 0 0 1 1.414-1.414l.707.707a1 1 0 0 1 -.707 1.707z"/><path d="m55 45h-1a1 1 0 0 1 0-2h1a1 1 0 0 1 0 2z"/><path d="m51.071 37.929a1 1 0 0 1 -.707-1.707l.707-.707a1 1 0 0 1 1.414 1.414l-.707.707a1 1 0 0 1 -.707.293z"/></g><circle cx="44" cy="44" fill="#bfdbf0" r="2"/></svg>
                        </div>
                        Histori dinas
                    </a>
                </li>

                {{--Lainnya--}}
                <li>
                    <a href="{{ url('/menu') }}">
                        <div class="icon-box bg_surface_color">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.00012 7H2.00012C0.895522 7 0.00012207 6.1046 0.00012207 5V2C0.00012207 0.8954 0.895522 0 2.00012 0H5.00012C6.10472 0 7.00012 0.8954 7.00012 2V5C7.00012 6.1046 6.10472 7 5.00012 7ZM16.0001 3.5C16.0001 1.567 14.4331 0 12.5001 0C10.5671 0 9.00012 1.567 9.00012 3.5C9.00012 5.433 10.5671 7 12.5001 7C14.4331 7 16.0001 5.433 16.0001 3.5ZM16.0001 14V11C16.0001 9.8954 15.1047 9 14.0001 9H11.0001C9.89552 9 9.00012 9.8954 9.00012 11V14C9.00012 15.1046 9.89552 16 11.0001 16H14.0001C15.1047 16 16.0001 15.1046 16.0001 14ZM7.00012 14V11C7.00012 9.8954 6.10472 9 5.00012 9H2.00012C0.895522 9 0.00012207 9.8954 0.00012207 11V14C0.00012207 15.1046 0.895522 16 2.00012 16H5.00012C6.10472 16 7.00012 15.1046 7.00012 14Z" fill="url(#paint0_linear_4516_5717)"/>
                                <defs>
                                <linearGradient id="paint0_linear_4516_5717" x1="12.8241" y1="-0.355" x2="2.90212" y2="16.83" gradientUnits="userSpaceOnUse">
                                <stop stop-color="#FFF3B0"/>
                                <stop offset="1" stop-color="#CA26FF"/>
                                </linearGradient>
                                </defs>
                            </svg>
                        </div>
                        Lainnya
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="mt-5 mb-9">
        <div class="tf-container">
            <div class="mt-5 d-none" id="announcementContainer">
                <div class="d-flex justify-content-between mb-3">
                    <h3>Pengumuman</h3>
                    <a href="{{ url('/pengumuman-list') }}" class="primary_color fw_6">View All</a>
                </div>
            </div>
            <template id="announcementTemplate">
                <a class="d-flex justify-content-between mb-2" href="/pengumuman/show/">
                    <p class="title"></p>
                    <p class="created_at"></p>
                </a>
            </template>
            <div class="mt-5">
                <div class="d-flex justify-content-between mb-3">
                        <h3>Informasi</h3>
                    <a href="{{ url('/euforia') }}" class="primary_color fw_6">View All</a>
                </div>
            </div>
            @if ($news->isNotEmpty())
            <div class="mt-5">
                <div class="d-flex justify-content-between">
                    <h3>News</h3>
                    <a href="{{ url('/blog-list') }}" class="primary_color fw_6">View All</a>
                </div>
                <div class="swiper-container tes-gift mt-5">
                    <div class="swiper-wrapper">
                        @foreach ($news as $berita) <!-- Loop through each blog post -->
                            <div class="swiper-slide">
                                <div class="food-box">
                                    <div class="img-box-dashboard">
                                        <!-- Use the image path from the blog post -->
                                        <img src="{{ asset('storage/' . $berita->banner_image) }}" alt="{{ $berita->title }}"> <!-- Assuming your image field is called 'image' -->
                                    </div>
                                    <div class="content">
                                        <h4>
                                            <a href="{{ url('/blog/' . $berita->slug) }}">{{ \Illuminate\Support\Str::limit($berita->title, 15, '...') }}</a> <!-- Assuming you want to link to a detail page using the slug -->
                                        </h4>
                                        <span>{{ $berita->created_at->format('d M Y') }}</span> <!-- Display the creation date -->
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
            @if ($acara->isNotEmpty())
            <div class="mt-5">
                <div class="d-flex justify-content-between">
                    <h3>Events</h3>
                    <a href="{{ url('/acara-list') }}" class="primary_color fw_6">View All</a>
                </div>
                <div class="swiper-container tes-gift mt-5">
                    <div class="swiper-wrapper">
                        @foreach ($acara as $acaras) <!-- Loop through each blog post -->
                            <div class="swiper-slide">
                                <div class="food-box">
                                    <div class="img-box-dashboard">
                                        <!-- Use the image path from the blog post -->
                                        <img src="{{ asset('storage/' . $acaras->image) }}" alt="{{ $acaras->judul }}"> <!-- Assuming your image field is called 'image' -->
                                    </div>
                                    <div class="content">
                                        <h4>
                                            <a href="{{ url('/acara/' . $acaras->slug) }}">{{ \Illuminate\Support\Str::limit($acaras->judul, 15, '...') }}</a> <!-- Assuming you want to link to a detail page using the slug -->
                                        </h4>
                                        <span>{{ $acaras->start_time }}</span> <!-- Display the creation date -->
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
            @endif
        </div>
    </div>
@endsection

@push('script')
    <script src="/js/pages/dashboard/indexUser.js"></script>
@endpush
