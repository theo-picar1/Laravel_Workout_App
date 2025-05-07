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
                        @if ($user->profile_picture == null)
                            <img src="images/profile-icon.png" alt="Profile Picture" class="profile-pic">
                        @else
                            <img src="data:image/{{ $user->profile_picture_type }};base64,{{ $user->profile_picture }}"
                                alt="Profile Picture" class="profile-pic">
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

            <div id="edit-profile-container">
                <div class="profile-edit-container">
                    <button class="modal-close-btn" onclick="toggleEditProfileModal()">&times;</button>
                    <div class="profile-picture-edit">
                        <div class="profile-pic-container">
                            @if (auth()->user()->profile_picture == null)
                                <img src="images/profile-icon.png" alt="Profile Picture" class="profile-pic">
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
                        <button class="delete-btn" onClick="openCustomPopUpModal('deleteAccountModal')">
                            Delete Account
                        </button>

                        <div id="deleteAccountModal" class="modal">
                            <div onClick="closePopupModal('deleteAccountModal')"></div>

                            <div class="modal-content">
                                <div class="modal-body">
                                    <h3 class="modal-title">Delete Your Account?</h3>
                                    <p class="modal-text">This will permanently remove all your data. This action
                                        cannot be
                                        undone.</p>
                                </div>

                                <div class="modal-actions">
                                    <button type="button" onClick="closePopupModal('deleteAccountModal')"
                                        class="modal-button cancel-button">
                                        Cancel
                                    </button>

                                    <form id="deleteAccountForm" method="POST" action="{{ route('profile.destroy') }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="modal-button delete-button">
                                            Delete Account
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- <!-- Button to trigger modal -->
            <button class="confirm-password-btn" onclick="openCustomPopUpModal('password-modal')">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    viewBox="0 0 16 16">
                    <path
                        d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z" />
                </svg>
                Change Password
            </button> --}}

            {{-- <!-- Password Confirmation Modal -->
            <div id="password-modal">
                <div class="modal-content">
                    <div class="modal-header">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#4CAF50"
                            viewBox="0 0 16 16">
                            <path
                                d="M8 1a2 2 0 0 1 2 2v4H6V3a2 2 0 0 1 2-2zm3 6V3a3 3 0 0 0-6 0v4a2 2 0 0 0-2 2v5a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2z" />
                        </svg>
                        <h3>Security Verification</h3>
                        <p>For your security, please confirm your current password</p>
                    </div>

                    <form id="passwordForm">
                        @csrf
                        <div class="input-group">
                            <input type="password" name="password" id="password-input" placeholder="Enter current password" required>
                        </div>
                        <p id="password-error" class="error-message"></p>
                        <div class="modal-footer">
                            <button type="button" onclick="closePopupModal('password-modal')" class="btn btn-outline">
                                Cancel
                            </button>
                            <button type="submit" class="btn btn-primary">
                                Verify & Continue
                            </button>
                        </div>
                    </form>
                </div>
            </div> --}}
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
