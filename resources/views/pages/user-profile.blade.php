@extends('layouts.pages')

@section('content')

    <head>
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <div class="profile-page">
        <header>
            <p id="header-title">{{ $user->username }}'s Profile</p>
        </header>

        <div class="main-content">
            <div id="user-profile-section">
                <div>

                    <h2>Account Details</h2>

                    <div class="user-profile-picture-section">
                        @if ($user->profile_picture == null)
                            <img src="{{ asset('images/profile-icon.png') }}" alt="Profile Picture" class="profile-pic">
                        @elseif (str_starts_with($user->profile_picture, 'data:image'))
                            <img src="{{ $user->profile_picture }}" alt="Profile Picture" class="profile-pic">
                        @else
                            <img src="{{ asset($user->profile_picture) }}" alt="Profile Picture" class="profile-pic">
                        @endif

                        <div class="user-profile-details">
                            <p>{{ $user->username }}</p>

                            <div class="user-profile-stats">
                                <div>
                                    <p class="title">Followers</p>
                                    <p>{{ $user->followers()->count() }}</p>
                                </div>
                                <div>
                                    <p class="title">Following</p>
                                    <p>{{ $user->following()->count() }}</p>
                                </div>
                            </div>

                            @if (auth()->check() && auth()->id() !== $user->id)
                                <form method="POST" action="{{ route('follow.toggle', $user->id) }}" class="follow-form">
                                    @csrf
                                    <button type="submit" class="follow-btn">
                                        {{ auth()->user()->following->contains($user->id) ? 'Unfollow' : 'Follow' }}
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>

                <div>
                    <h2>Bio</h2>

                    <div class="user-bio-section">
                        @if ($user->bio != null)
                            <p>{{ $user->bio }}</p>
                        @else
                            <p>No bio</p>
                        @endif
                    </div>
                </div>

                <div>
                    <h2>Progress</h2>

                    <div class="user-progress-section">
                        <div>
                            <h1>47</h1>
                            <h3>Workouts Completed</h3>
                        </div>
                        <div>
                            <h1>90</h1>
                            <h3>Days on the App</h3>
                        </div>
                        <div>
                            <h1>1039kg</h1>
                            <h3>Total Weight</h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <footer id="profile-page-footer">
            <a href="{{ route('pages.profile') }}" id="profile-href">
                <img src="{{ asset('images/profile-icon.png') }}">
                <p>Profile</p>
            </a>
            <a href="{{ route('pages.discover') }}">
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
@endsection
