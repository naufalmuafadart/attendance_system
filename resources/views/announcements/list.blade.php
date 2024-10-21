{{-- resources/views/pengumuman/index.blade.php --}}
@extends('templates.app')

@section('container')
    <div class="card-secton transfer-section">
        <div class="tf-container">
            <div class="tf-balance-box">
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
    </div>
    <br>
    <br>
@endsection
