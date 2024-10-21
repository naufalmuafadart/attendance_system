{{-- resources/views/pengumuman/index.blade.php --}}
@extends('templates.blogs')

@section('container')
    <!-- preloade -->
    <div class="preload preload-container">
        <div class="preload-logo">
            <div class="spinner"></div>
        </div>
    </div>
    <!-- /preload -->
    <div class="header is-fixed">
        <div class="tf-container">
            <div class="tf-statusbar d-flex justify-content-center align-items-center">
                <a href="{{ url()->previous() }}" class="back-btn"> <i class="icon-left"></i> </a>
                <h3>{{ $title}}</h3>
            </div>
        </div>
    </div>
    <div id="app-wrap" class="style1">
        <div class="tf-container">
            @if ($filtered_announcements->isNotEmpty())
                @foreach ($filtered_announcements as $announcement)
                    <div class="food-box">
                        <a href="{{ url('/pengumuman/show/'.$announcement->id) }}">
                            <div class="content">
                                <!-- Link to the detailed view of the announcement -->
                                <h4>
                                    {{ $announcement->title }}
                                </h4>
                                <!-- You can add more fields from the announcement like date, created_by, etc. -->
                                <span>{{ $announcement->created_at->format('d M Y') }}</span>
                            </div>
                        </a>
                    </div>
                    <hr>
                @endforeach
            @else
                <!-- Show a message if no announcements are found -->
                <p>No announcements available for you.</p>
            @endif
        </div>
    </div>
@endsection
