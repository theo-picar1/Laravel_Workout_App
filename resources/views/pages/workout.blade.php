@extends('layouts.pages')

@section('content')
    <div class="workout-page">
        <h1>Start Workout</h1>

        <div class="quick-start-section">
            <h2>Quick start</h2>
            <button type="button">Start an empty workout</button>
        </div>

        <div class="routines-section">
            <div class="title">
                <h2>Routines</h2>
                <button>Add Routine</button>
            </div>

            <div class="routines-list">
                {{-- for-loop for this div --}}
                <div class="routine">
                    <div class="title">
                        <h2>title</h2>
                        <img src="{{ asset('images/more-icon.png') }} ">
                    </div>

                    <div class="exercises-preview">
                        <p>exercise</p>
                        <p> , exercise</p>
                        <p> , exercise</p>
                        <p> , exercise</p>
                        <p> , exercise</p>
                        <p> , exercise</p>
                        <p> , exercise</p>
                        <p> , exercise</p>
                    </div>

                    <button>Start routine</button>
                </div>

                <div class="routine">
                    <div class="title">
                        <h2>title</h2>
                        <img src="{{ asset('images/more-icon.png') }} ">
                    </div>

                    <div class="exercises-preview">
                        <p>exercise</p>
                        <p> , exercise</p>
                        <p> , exercise</p>
                        <p> , exercise</p>
                        <p> , exercise</p>
                        <p> , exercise</p>
                        <p> , exercise</p>
                        <p> , exercise</p>
                    </div>

                    <button>Start routine</button>
                </div>

                <div class="routine">
                    <div class="title">
                        <h2>title</h2>
                        <img src="{{ asset('images/more-icon.png') }} ">
                    </div>

                    <div class="exercises-preview">
                        <p>exercise</p>
                        <p> , exercise</p>
                        <p> , exercise</p>
                        <p> , exercise</p>
                        <p> , exercise</p>
                        <p> , exercise</p>
                        <p> , exercise</p>
                        <p> , exercise</p>
                    </div>

                    <button>Start routine</button>
                </div>

                <div class="routine">
                    <div class="title">
                        <h2>title</h2>
                        <img src="{{ asset('images/more-icon.png') }} ">
                    </div>

                    <div class="exercises-preview">
                        <p>exercise</p>
                        <p> , exercise</p>
                        <p> , exercise</p>
                        <p> , exercise</p>
                        <p> , exercise</p>
                        <p> , exercise</p>
                        <p> , exercise</p>
                        <p> , exercise</p>
                    </div>

                    <button>Start routine</button>
                </div>
            </div>
        </div>
    </div>

    <footer id="workout-page-footer">
        <a href="{{ route('pages.profile') }}">
            <img src="{{ asset('images/profile-icon.png') }}">
            <p>Profile</p>
        </a>
        <a href="{{ route('pages.profile') }}">
            <img src="{{ asset('images/globe-icon.png') }}">
            <p>Discover</p>
        </a>
        <a href="{{ route('pages.workout') }}" id="workout-href">
            <img src="{{ asset('images/add-icon.png') }}">
            <p>Workout</p>
        </a>
        <a href="{{ route('pages.profile') }}">
            <img src="{{ asset('images/weight-icon.png') }}">
            <p>Exercises</p>
        </a>
        <a href="{{ route('pages.profile') }}">
            <img src="{{ asset('images/history-icon.png') }}">
            <p>History</p>
        </a>
    </footer>
@endsection
