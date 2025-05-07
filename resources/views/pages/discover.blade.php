@extends('layouts.pages')

@section('content')
    <div class="discover-page">

    @section('content')

        <head>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <meta name="csrf-token" content="{{ csrf_token() }}">
        </head>
        <div class="connect-container">
            <header>
                <p>Discover</p>
            </header>

            <div class="discover-athletes">
                <h2>Discover athletes</h2>
                <div class="athletes-scroll-container">
                    <div class="athletes-grid">
                        @foreach ($users as $user)
                            <div class="athlete-card">
                                <div class="profile-pic">
                                    <img src="{{ $user->profile_picture ?? asset('images/profile-icon.png') }}" alt="{{ $user->username }}">
                                </div>
                                <span class="username">{{ $user->username }}</span>
                                <form method="POST" action="{{ route('follow.toggle', $user->id) }}" class="follow-form">
                                    @csrf
                                    <button type="submit" class="follow-btn">
                                        {{ auth()->user()->following->contains($user->id) ? 'Unfollow' : 'Follow' }}
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="recent-posts">
                <h2>Recent Posts</h2>
                @foreach ($posts as $post)
                    <div class="post-card">
                        <div class="post-header">
                            <div class="post-user">
                                <div class="post-profile-pic">
                                    <a href="{{ route('profile.show', $post->user->id) }}">
                                        @if ($post->user->profile_picture)
                                            <img src="data:image/{{ $post->user->profile_picture_type }};base64,{{ $post->user->profile_picture }}"
                                                alt="{{ $post->user->username }}">
                                        @else
                                            <img src="{{ asset('images/profile-icon.png') }}" alt="{{ $post->user->username }}">
                                        @endif
                                    </a>
                                </div>
                                <span class="post-username">
                                    <a href="{{ route('profile.show', $post->user->id) }}">{{ $post->user->username }}</a>
                                </span>
                            </div>
                            <span class="post-date">{{ $post->created_at->format('F j, Y') }}</span>
                        </div>
                        <div class="post-content">
                            <h3 class="routine-name">{{ $post->title }}</h3>
                            @if ($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}">
                            @endif
                            <p>{{ $post->content }}</p>
                        </div>
                        <div class="post-footer">
                            <form method="POST" action="{{ route('posts.like', $post->id) }}" class="like-form">
                                @csrf
                                <button type="submit" class="like-btn {{ $post->likes->contains('user_id', auth()->id()) ? 'liked' : '' }}">
                                    <i class="fas fa-heart"></i> <span class="like-count">{{ $post->likes->count() }}</span> Likes
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <footer id="discover-page-footer">
            <a href="{{ route('pages.profile') }}">
                <img src="{{ asset('images/profile-icon.png') }}">
                <p>Profile</p>
            </a>
            <a href="{{ route('pages.discover') }}" id="discover-href">
                <img src="{{ asset('images/globe-icon.png') }}">
                <p>Discover</p>
            </a>
            <a href="{{ route('pages.workout') }}">
                <img src="{{ asset('images/add-icon.png') }}">
                <p>Workout</p>
            </a>
            <a href="{{ route('pages.exercises') }}">
                <img src="{{ asset('images/weight-icon.png') }}">
                <p>Exercises</p>
            </a>
            <a href="{{ route('pages.exercises') }}">
                <img src="{{ asset('images/history-icon.png') }}">
                <p>History</p>
            </a>
        </footer>
    </div>

    <div class="create-post-page">
        <h1>Create a New Post</h1>
        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf
            <div>
                <label for="title">Title</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div>
                <label for="content">Content</label>
                <textarea id="content" name="content" required></textarea>
            </div>
            <div>
                <label for="image">Image (optional)</label>
                <input type="file" id="image" name="image">
            </div>
            <button type="submit">Create Post</button>
        </form>
    </div>
    <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br> <br><br><br>
@endsection
