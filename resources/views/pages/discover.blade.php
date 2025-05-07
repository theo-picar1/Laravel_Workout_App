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
                        <div class="athlete-card">
                            <div class="profile-pic">
                                <img src="https://i.pravatar.cc/150?img=3" alt="coolGuy19">
                            </div>
                            <span class="username">coolGuy19</span>
                            <button class="follow-btn">Follow</button>
                        </div>
                        <div class="athlete-card">
                            <div class="profile-pic">
                                <img src="https://i.pravatar.cc/150?img=5" alt="coolGirl29">
                            </div>
                            <span class="username">coolGirl29</span>
                            <button class="follow-btn">Follow</button>
                        </div>
                        <div class="athlete-card">
                            <div class="profile-pic">
                                <img src="https://i.pravatar.cc/150?img=7" alt="guy4">
                            </div>
                            <span class="username">guy4</span>
                            <button class="follow-btn">Follow</button>
                        </div>
                        <div class="athlete-card">
                            <div class="profile-pic">
                                <img src="https://i.pravatar.cc/150?img=9" alt="fitRunner22">
                            </div>
                            <span class="username">fitRunner22</span>
                            <button class="follow-btn">Follow</button>
                        </div>
                        <div class="athlete-card">
                            <div class="profile-pic">
                                <img src="https://i.pravatar.cc/150?img=11" alt="gymQueen">
                            </div>
                            <span class="username">gymQueen</span>
                            <button class="follow-btn">Follow</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="recent-posts">
                <h2>Recent Posts</h2>
                <div class="post-card">
                    <div class="post-header">
                        <div class="post-user">
                            <div class="post-profile-pic">
                                <img src="https://i.pravatar.cc/150?img=13" alt="guywiththesulfly">
                            </div>
                            <span class="post-username">guywiththesulfly</span>
                        </div>
                        <span class="post-date">Tuesday, Mar 11, 2025</span>
                    </div>
                    <div class="post-content">
                        <h3 class="routine-name">Routine name 2</h3>
                        <div class="workout-stats">
                            <div class="stat">
                                <span class="stat-label">Time</span>
                                <span class="stat-value">1hr45min</span>
                            </div>
                            <div class="stat">
                                <span class="stat-label">Volume</span>
                                <span class="stat-value">8.987kg</span>
                            </div>
                        </div>
                        <p class="workout-description">18 sets of Goblet Squat</p>
                    </div>
                    <div class="post-footer">
                        {{-- <button class="like-btn" data-post-id="{{ $post->id }}">
                            <i class="fas fa-heart"></i> <span class="like-count">{{ $post->likes->count() }}</span> Likes
                        </button> --}}
                        <span class="comments">0 comments</span>
                    </div>
                </div>
                <div class="post-card">
                    <div class="post-header">
                        <div class="post-user">
                            <div class="post-profile-pic">
                                <img src="https://i.pravatar.cc/150?img=13" alt="guywiththesulfly">
                            </div>
                            <span class="post-username">guywiththesulfly</span>
                        </div>
                        <span class="post-date">Tuesday, Mar 11, 2025</span>
                    </div>
                    <div class="post-content">
                        <h3 class="routine-name">Routine name 2</h3>
                        <div class="workout-stats">
                            <div class="stat">
                                <span class="stat-label">Time</span>
                                <span class="stat-value">1hr45min</span>
                            </div>
                            <div class="stat">
                                <span class="stat-label">Volume</span>
                                <span class="stat-value">8.987kg</span>
                            </div>
                        </div>
                        <p class="workout-description">18 sets of Goblet Squat</p>
                    </div>
                    <div class="post-footer">
                        {{-- <button class="like-btn" data-post-id="{{ $post->id }}">
                            <i class="fas fa-heart"></i> <span class="like-count">{{ $post->likes->count() }}</span> Likes
                        </button> --}}
                        <span class="comments">0 comments</span>
                    </div>
                </div>
                @foreach ($posts as $post)
                    <div class="post-card">
                        <div class="post-header">
                            <div class="post-user">
                                <div class="post-profile-pic">
                                    <a href="{{ route('profile.show', $post->user->id) }}">
                                        <img src="{{ $post->user->profile_picture ?? asset('images/profile-icon.png') }}" alt="{{ $post->user->username }}">
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
                            {{-- <span class="comments">{{ $post->comments->count() }} comments</span> --}}
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
