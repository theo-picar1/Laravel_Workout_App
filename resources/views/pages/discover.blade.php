@extends('layouts.pages')

@section('content')
    <div class="discover-page">

    @section('content')

        <head>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            <meta name="csrf-token" content="{{ csrf_token() }}">
            <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
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
                                    <a href="{{ route('profile.show', $user->id) }}"> <!-- Link to the user's profile -->
                                        <img src="{{ $user->profile_picture ?? asset('images/profile-icon.png') }}"
                                            alt="{{ $user->username }}">
                                    </a>
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
                <button class="add-post-btn" onclick="openCustomPopUpModal('create-post-page')">+ Add Post</button>
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
                                            <img src="{{ asset('images/profile-icon.png') }}"
                                                alt="{{ $post->user->username }}">
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
                            <h3 class="routine-name">{{ $post->routine->routine_name ?? 'No Routine Attached' }}</h3>
                            <div class="workout-stats">
                                <div class="stat">
                                    <span class="stat-label">Time</span>
                                    <span class="stat-value">{{ $post->routine->time ?? 'N/A' }}</span>
                                </div>
                                <div class="stat">
                                    <span class="stat-label">Volume</span>
                                    <span class="stat-value">{{ $post->routine->volume ?? 'N/A' }}</span>
                                </div>
                            </div>
                            <p class="workout-description">
                                {{ $post->routine->description ?? 'No description available.' }}
                            </p>
                        </div>
                        <div class="post-footer">
                            <form method="POST" action="{{ route('posts.like', $post->id) }}" class="like-form">
                                @csrf
                                <button type="submit" class="like-btn">
                                    <i class="fas fa-heart {{ $post->likes->contains('user_id', auth()->id()) ? 'liked' : '' }}"></i>
                                    <span class="like-count">{{ $post->likes->count() }}</span>
                                </button>
                            </form>
                            <span class="comments">0 comments</span>
                        </div>
                    </div>
                @endforeach
                <div class="post-card">
                    <div class="post-header">
                        <div class="post-user">
                            <div class="post-profile-pic">
                                <a href="{{ route('profile.show', 14) }}"> <!-- Link to the user's profile -->
                                    <img src="https://i.pravatar.cc/150?img=7" alt="guy4">
                                </a>
                            </div>
                            <span class="post-username">
                                <a href="{{ route('profile.show', 14) }}" style="text-decoration: none; color: inherit;">
                                    guy4
                                </a>
                            </span>
                        </div>
                        <span class="post-date">Mar 11, 2025</span>
                    </div>
                    <div class="post-content">
                        <h3 class="routine-name">Leg press</h3>
                        <div class="workout-stats">
                            <div class="stat">
                                <span class="stat-label">Time</span>
                                <span class="stat-value">1hr</span>
                            </div>
                            <div class="stat">
                                <span class="stat-label">Volume</span>
                                <span class="stat-value">88kg</span>
                            </div>
                        </div>
                        <p class="workout-description">2 sets of Leg press</p>
                    </div>
                    <div class="post-footer">
                        <form method="POST" action="{{ route('posts.like', $post->id) }}" class="like-form">
                            @csrf
                            <button type="submit" class="like-btn">
                                <i
                                    class="fas fa-heart {{ $post->likes->contains('user_id', auth()->id()) ? 'liked' : '' }}"></i>
                                <span class="like-count">{{ $post->likes->count() }}</span>
                            </button>
                        </form>
                        <span class="comments">0 comments</span>
                    </div>
                </div>
                <div class="post-card">
                    <div class="post-header">
                        <div class="post-user">
                            <div class="post-profile-pic">
                                <a href="{{ route('profile.show', 13) }}">
                                    <img src="https://i.pravatar.cc/150?img=3" alt="coolGuy19">
                                </a>
                            </div>
                            <span class="post-username">
                                <a href="{{ route('profile.show', 13) }}" style="text-decoration: none; color: inherit;">
                                    coolGuy19
                                </a>
                            </span>
                        </div>
                        <span class="post-date">Mar 7, 2025</span>
                    </div>
                    <div class="post-content">
                        <h3 class="routine-name">Goblet Squat</h3>
                        <div class="workout-stats">
                            <div class="stat">
                                <span class="stat-label">Time</span>
                                <span class="stat-value">1hr45min</span>
                            </div>
                            <div class="stat">
                                <span class="stat-label">Volume</span>
                                <span class="stat-value">30kg</span>
                            </div>
                        </div>
                        <p class="workout-description">4 sets of Goblet Squat</p>
                    </div>
                    <div class="post-footer">
                        <form method="POST" action="{{ route('posts.like', $post->id) }}" class="like-form">
                            @csrf
                            <button type="submit" class="like-btn">
                                <i
                                    class="fas fa-heart {{ $post->likes->contains('user_id', auth()->id()) ? 'liked' : '' }}"></i>
                                <span class="like-count">{{ $post->likes->count() }}</span>
                            </button>
                        </form>
                        <span class="comments">0 comments</span>
                    </div>
                </div>
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

    <div id="create-post-page" class="modal">
        <div class="modal-content">
            <button class="modal-close-btn" onclick="closePopupModal('create-post-page')">&times;</button>
            <h1>Create a New Post</h1>
            <form method="POST" action="{{ route('posts.store') }}">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="content">Content</label>
                    <textarea id="content" name="content" required></textarea>
                </div>
                <div class="form-group">
                    <label for="routine_id">Select Routine</label>
                    <select id="routine_id" name="routine_id" required>
                        <option value="" disabled selected>Select a routine</option>
                        @foreach ($routines as $routine)
                            <option value="{{ $routine->id }}">{{ $routine->routine_name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="submit-btn">Create Post</button>
            </form>
        </div>
    </div>
@endsection
