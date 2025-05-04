@extends('layouts.pages')

@section('content')
    <div class="discover-page">

    @section('content')
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
                        <span class="likes">18 likes</span>
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
                        <span class="likes">18 likes</span>
                        <span class="comments">0 comments</span>
                    </div>
                </div>
            </div>
        </div>

        <footer id="exercises-page-footer">
            <a href="{{ route('pages.profile') }}">
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