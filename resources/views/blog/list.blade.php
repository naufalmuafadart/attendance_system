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

            <div class="tf-tab">
                <br>
                <form method="GET" action="{{ url('/blog-list') }}">
                    <div class="input-group">
                        <!-- Input untuk pencarian -->
                        <input type="text" name="search" class="form-control" placeholder="Cari acara..." value="{{ request('search') }}">

                        <!-- Tombol pencarian dengan ikon -->
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary btn-lg">
                                <i class="fas fa-search"></i> <!-- Simbol pencarian -->
                            </button>
                        </div>
                    </div>
                </form>

                <div class="content-tab mt-2">
                    @if ($blog->isNotEmpty())
                        <div class="tab-gift-item">
                            <!-- Loop through each announcement -->
                            @foreach ($blog as $blogs)
                            <div class="food-box">
                                <a href="{{ url('/blog/'.$blogs->slug) }}">
                                    <div class="img-box">
                                        <!-- Display the blogs image if available, else use a placeholder -->
                                        <img src="{{ asset('storage/' . $blogs->banner_image) }}" alt="blogs Banner">

                                    </div>
                                    <div class="content">
                                        <!-- Link to the detailed view of the blogs -->
                                        <h4>
                                            {{ $blogs->title }}
                                        </h4>
                                        <!-- You can add more fields from the blogs like date, created_by, etc. -->
                                        <span>Dipublish pada {{ \Carbon\Carbon::parse($blogs->created_at)->format('d-m-Y H:i') }}</span>
                                    </div>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <!-- Show a message if no blogss are found -->
                        <p>No blogs available for you.</p>
                    @endif

                </div>
            </div>


        </div>
    </div>

@endsection
