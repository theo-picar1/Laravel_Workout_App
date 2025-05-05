@extends('layouts.pages')

@section('content')
    <div class="exercises-page">
        <header>
            <p>Exercises</hp>
        </header>

        <div class="main-content">
            <label class="exercises-searchbar-container" onclick="setClearSearchAndInputId('clear-exercise-search-button', 'exercises-searchbar')">  
                <div class="left-side">
                    <img src="{{ asset('images/search-icon.png') }}">

                    <input autocomplete="off" type="text" placeholder="Search for an exercise" id="exercises-searchbar">
                </div>
            </label>

            <div class="exercises-list">
                @foreach ($exercises as $exercise)
                    <div exercise-name="{{ $exercise->name }}" class="exercise exercise-view-row" onclick="openModal('specific-exercise-view-modal'); fillExerciseViewModal('{{ $exercise->name }}', '{{ $exercise->instructions }}', '{{ $exercise->image_url }}')">
                        <div class="left-side">
                            <div class="image-container">
                                <img src="{{ $exercise->image_url ?? asset('images/weight-icon.png') }}" class="{{ $exercise->image_url ? 'exercise-image' : 'placeholder-image' }}">
                            </div>

                            <div class="name-and-muscle-group-container">
                                <p>{{ $exercise->name }}</p>
                                <p id="muscle-group">Muscle group</p>
                            </div>
                        </div>

                        <div class="right-side">
                            <img src="{{ asset('images/minimise-icon.png') }}" style="transform: rotate(270deg)">
                        </div>
                    </div>
                @endforeach
            </div>

            <button id="clear-exercise-search-button" onclick="clearSearchInput()">Reset</button>
        </div>

        <div id="specific-exercise-view-modal">
            <header>
                <img src="{{ asset('images/back-icon.png') }}" onclick="closeModal('specific-exercise-view-modal')">

                <p id="selected-exercise-name"></p>

                <p style="visibility: hidden">.</p>
            </header>

            <div id="exercise-details-section"></div>
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
            <a href="{{ route('pages.workout') }}" id="workout-href">
                <img src="{{ asset('images/add-icon.png') }}">
                <p>Workout</p>
            </a>
            <a href="{{ route('pages.exercises') }}" id="exercises-href">
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