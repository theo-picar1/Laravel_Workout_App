@extends('layouts.pages')

@section('content')

    <head>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    </head>

    <div class="profile-page">
        <header>
            <p onClick="toggleEditProfileModal()">Edit profile</p>
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
            <div id="user-profile-section">
                <div>
                    <h2>Account Details</h2>

                    <div class="user-profile-picture-section">
                        @if (auth()->user()->profile_picture == null)
                            <img src="https://i.pravatar.cc/150?img=5" alt="Profile Picture" class="profile-pic">
                        @else
                            <img src="data:image/{{ auth()->user()->profile_picture_type }};base64,{{ auth()->user()->profile_picture }}"
                                alt="Profile Picture" class="profile-pic">
                        @endif

                        <div class="user-profile-details">
                            <p>{{ auth()->user()->username }}</p>

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
                            {{ auth()->user()->bio }}
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

            <div id="edit-profile-container">
                <div class="profile-edit-container">
                    <button class="modal-close-btn" onclick="toggleEditProfileModal()">&times;</button>
                    <div class="profile-picture-edit">
                        <div class="profile-pic-container">
                            @if (auth()->user()->profile_picture == null)
                                <img src="https://i.pravatar.cc/150?img=5" alt="Profile Picture" class="profile-pic">
                            @else
                                <img src="data:image/{{ auth()->user()->profile_picture_type }};base64,{{ auth()->user()->profile_picture }}"
                                    alt="Profile Picture" class="profile-pic">
                            @endif
                            <label for="profile_picture" class="change-photo-btn">
                                <i class="fas fa-camera"></i>
                            </label>
                        </div>
                    </div>

                    <form class="profile-edit-form" id="profileForm" method="POST" action="{{ route('profile.update') }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('POST')

                        <input type="file" id="profile_picture" name="profile_picture" style="display: none;">

                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" id="username" name="username" value="{{ auth()->user()->username }}"
                                placeholder="Enter your username" required>
                        </div>

                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" id="email" name="email" value="{{ auth()->user()->email }}"
                                placeholder="Enter your email" required>
                        </div>

                        <div class="form-group">
                            <label for="bio">Bio</label>
                            <textarea id="bio" name="bio" placeholder="Tell others about yourself">{{ auth()->user()->bio }}</textarea>
                        </div>

                        <div class="save-button-container">
                            <button type="submit" class="save-btn">Save Changes</button>
                        </div>
                    </form>
                    <div class="action-buttons">
                        <button class="change-password-btn">Change Password</button>
                        {{-- <div x-data id="logout">
                            <button @click="$refs.logoutForm.submit()" class="logout-button">Logout</botton>

                                <form x-ref="logoutForm" method="POST" action="{{ route('logout') }}"
                                    style="display: none" hidden>
                                    @csrf
                                </form>
                        </div> --}}
                        <form class="delete-account-form" id="deleteAccountForm" method="POST"
                            action="{{ route('profile.destroy') }}">
                            @csrf
                            @method('DELETE')

                            {{-- <div class="delete-button-container">
                                <button type="button" class="delete-btn" data-toggle="modal"
                                    data-target="#confirmDeleteModal">Delete Account</button>
                            </div> --}}

                            <form id="deleteAccountForm" method="POST" action="{{ route('profile.destroy') }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="delete-btn">Delete Account</button>
                            </form>
                        </form>

                        {{-- <div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog"
                            aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Delete</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete your account?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cancel</button>
                                        <button type="submit" form="deleteAccountForm"
                                            class="btn btn-danger">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
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
