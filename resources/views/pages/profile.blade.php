@extends('layouts.pages')

@section('content')
    <div class="edit-profile-page">
        <header>
            <p>Edit profile</p>
            <p id="header-title">Profile</p>
            <div x-data id="logout">
                <p @click="$refs.logoutForm.submit()" class="logout-button" style="width: min-content">Logout</p>

                <!-- Hidden logout form placed away from the visual layout -->
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
    </div>
@endsection
