@extends('layouts.pages')

@section('content')
    <div class="profile-page">
        <header>
            <p>Edit profile</p>
            <p id="header-title">Profile</p>
            {{-- This is just some logging-out functionality --}}
            <div x-data id="logout">
                <p @click="$refs.logoutForm.submit()" class="logout-button" style="width: min-content">Logout</p>

                <form x-ref="logoutForm" method="POST" action="{{ route('logout') }}" style="display: none" hidden>
                    @csrf
                </form>
            </div>

        </header>

        <div class="main-content">
            <div>
                <h2>Account Details</h2>

                <div class="user-profile-picture-section">
                    <img src="{{ asset('images/profile-icon.png') }}">

                    <div class="user-profile-details">
                        <p>username here</p>

                        <div class="user-profile-stats">
                            <div>
                                <p class="title">Workouts</p>
                                <p>0</p>
                            </div>
                            <div>
                                <p class="title">Followers</p>
                                <p>9</p>
                            </div>
                            <div>
                                <p class="title">Following</p>
                                <p>11</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div>
                <h2>Bio</h2>

                <div class="user-bio-section">
                    <p>
                        Newbie weightlifter 💪. Started 3 months ago and getting better each day!
                        😤 Critique and feedback to my workouts would be helpful 😎
                    </p>
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

        <footer id="profile-page-footer">
            <a href="{{ route('pages.profile') }}" id="profile-href">
                <img src="{{ asset('images/profile-icon.png') }}">
                <p>Profile</p>
            </a>
            <a href="{{ route('pages.exercises') }}">
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
