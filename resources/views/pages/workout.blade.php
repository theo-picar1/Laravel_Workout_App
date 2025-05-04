@extends('layouts.pages')

@section('content')
    {{-- Finish workout pop up modal --}}
    <div class="pop-up-modal" id="finish-workout-pop-up-modal">
        <div class="pop-up-modal-content">
            <h4 id="finish-workout-pop-up-modal-title"></h4>

            <p id="finish-workout-pop-up-modal-description"></p>

            <div>
                <button id="finish-workout-pop-up-modal-cancel-button" onclick="closePopupModal('finish-workout-pop-up-modal')"></button>
                <button id="finish-workout-pop-up-modal-continue-button" onclick="closeModal('start-empty-workout-modal'); closePopupModal('finish-workout-pop-up-modal')"></button>
            </div>
        </div>
    </div>

    {{-- General pop up modal --}}
    <div class="pop-up-modal" id="general-pop-up-modal">
        <div class="pop-up-modal-content">
            <h4 id="general-pop-up-modal-title"></h4>

            <p id="general-pop-up-modal-description"></p>

            <div>
                <button id="general-pop-up-modal-cancel-button" onclick="closePopupModal('general-pop-up-modal')"></button>
                <button id="general-pop-up-modal-continue-button" onclick="closePopupModal('general-pop-up-modal'); closeModal('start-empty-workout-modal')"></button>
            </div>
        </div>
    </div>

    {{-- Start empty workout modal --}}
    <div id="start-empty-workout-modal">
        <div class="header">
            <div class="left-side">
                <h3>Name of workout</h3>

                <div>
                    <img src="{{ asset('images/more-icon.png') }}">
                </div>
            </div>

            <div class="right-side">
                <div>
                    <img src="{{ asset('images/minimise-icon.png') }}"
                        onclick="minimiseModal('start-empty-workout-modal', 'minimise-start-empty-workout-button')"
                        id="minimise-start-empty-workout-button">
                </div>

                <button onclick="openPopupModal('finish-workout-pop-up-modal', 'Finish workout?', 'Any inputs not filled in will be discarded. Would you like to continue?', 'Cancel', 'Finish', '#171717', '#81fe5e')">Finish</button>
            </div>
        </div>

        <p id="time">0:00:00</p>

        <div class="exercises-list">
            <div class="exercise">
                <div class="exercise-header">
                    <p class="exercise-name" original-text="Triceps Pushdown (Cable - Straight Bar)">Triceps Pushdown (Cable - Straight Bar)</p>

                    <div onclick="openPopupModal('general-pop-up-modal', 'Remove exercise?', 'Are you sure you want to remove this exercise? You can add it again later.', 'Cancel', 'Remove', '#171717', '#ff0000')">
                        <img src="{{ asset('images/remove-icon.png') }}">
                    </div>
                </div>

                <div class="exercise-stats">
                    <div class="columns set-number-column">
                        <p>Set</p>

                        <div>
                            <p>1</p>
                        </div>

                        <div>
                            <p>2</p>
                        </div>

                        <div>
                            <p>3</p>
                        </div>

                        <div>
                            <p>4</p>
                        </div>

                        <div>
                            <p>5</p>
                        </div>

                        <div>
                            <p>6</p>
                        </div>
                    </div>

                    <div class="columns previous-stat-column">
                        <p>Previous</p>
                        <div>
                            <p>10kg x 10rps</p>
                        </div>

                        <div>
                            <p>10kg x 10rps</p>
                        </div>

                        <div>
                            <p>10kg x 10rps</p>
                        </div>

                        <div>
                            <p>10kg x 10rps</p>
                        </div>

                        <div>
                            <p>10kg x 10rps</p>
                        </div>

                        <div>
                            <p>10kg x 10rps</p>
                        </div>
                    </div>

                    <div class="columns kg-column">
                        <p>KG</p>
                        <input type="number" placeholder="10" min="0" max="999">
                        <input type="number" placeholder="10" min="0" max="999">
                        <input type="number" placeholder="10" min="0" max="999">
                        <input type="number" placeholder="10" min="0" max="999">
                        <input type="number" placeholder="10" min="0" max="999">
                        <input type="number" placeholder="10" min="0" max="999">
                    </div>

                    <div class="columns reps-column">
                        <p>Reps</p>
                        <input type="number" placeholder="10" min="0" max="999">
                        <input type="number" placeholder="10" min="0" max="999">
                        <input type="number" placeholder="10" min="0" max="999">
                        <input type="number" placeholder="10" min="0" max="999">
                        <input type="number" placeholder="10" min="0" max="999">
                        <input type="number" placeholder="10" min="0" max="999">
                    </div>

                    <div class="columns is-finished-column">
                        <img src="{{ asset('images/check-icon.png') }}">

                        <label>
                            <input type="checkbox">
                            <img src="{{ asset('images/check-icon.png') }}">
                        </label>

                        <label>
                            <input type="checkbox">
                            <img src="{{ asset('images/check-icon.png') }}">
                        </label>

                        <label>
                            <input type="checkbox">
                            <img src="{{ asset('images/check-icon.png') }}">
                        </label>

                        <label>
                            <input type="checkbox">
                            <img src="{{ asset('images/check-icon.png') }}">
                        </label>

                        <label>
                            <input type="checkbox">
                            <img src="{{ asset('images/check-icon.png') }}">
                        </label>

                        <label>
                            <input type="checkbox">
                            <img src="{{ asset('images/check-icon.png') }}">
                        </label>
                    </div>
                </div>

                <div id="add-set-button">
                    <img src="{{ asset('images/add-icon.png') }}">
                    <p>Add Set</p>
                </div>
            </div>

            <div class="exercise">
                <div class="exercise-header">
                    <p class="exercise-name" original-text="Triceps Pushdown (Cable - Straight Bar)">Triceps Pushdown (Cable - Straight Bar)</p>

                    <div>
                        <img src="{{ asset('images/remove-icon.png') }}">
                    </div>
                </div>

                <div class="exercise-stats">
                    <div class="columns set-number-column">
                        <p>Set</p>

                        <div>
                            <p>1</p>
                        </div>

                        <div>
                            <p>2</p>
                        </div>

                        <div>
                            <p>3</p>
                        </div>

                        <div>
                            <p>4</p>
                        </div>

                        <div>
                            <p>5</p>
                        </div>

                        <div>
                            <p>6</p>
                        </div>
                    </div>

                    <div class="columns previous-stat-column">
                        <p>Previous</p>
                        <div>
                            <p>10kg x 10rps</p>
                        </div>

                        <div>
                            <p>10kg x 10rps</p>
                        </div>

                        <div>
                            <p>10kg x 10rps</p>
                        </div>

                        <div>
                            <p>10kg x 10rps</p>
                        </div>

                        <div>
                            <p>10kg x 10rps</p>
                        </div>

                        <div>
                            <p>10kg x 10rps</p>
                        </div>
                    </div>

                    <div class="columns kg-column">
                        <p>KG</p>
                        <input type="number" placeholder="10" min="0" max="999">
                        <input type="number" placeholder="10" min="0" max="999">
                        <input type="number" placeholder="10" min="0" max="999">
                        <input type="number" placeholder="10" min="0" max="999">
                        <input type="number" placeholder="10" min="0" max="999">
                        <input type="number" placeholder="10" min="0" max="999">
                    </div>

                    <div class="columns reps-column">
                        <p>Reps</p>
                        <input type="number" placeholder="10" min="0" max="999">
                        <input type="number" placeholder="10" min="0" max="999">
                        <input type="number" placeholder="10" min="0" max="999">
                        <input type="number" placeholder="10" min="0" max="999">
                        <input type="number" placeholder="10" min="0" max="999">
                        <input type="number" placeholder="10" min="0" max="999">
                    </div>

                    <div class="columns is-finished-column">
                        <img src="{{ asset('images/check-icon.png') }}">

                        <label>
                            <input type="checkbox">
                            <img src="{{ asset('images/check-icon.png') }}">
                        </label>

                        <label>
                            <input type="checkbox">
                            <img src="{{ asset('images/check-icon.png') }}">
                        </label>

                        <label>
                            <input type="checkbox">
                            <img src="{{ asset('images/check-icon.png') }}">
                        </label>

                        <label>
                            <input type="checkbox">
                            <img src="{{ asset('images/check-icon.png') }}">
                        </label>

                        <label>
                            <input type="checkbox">
                            <img src="{{ asset('images/check-icon.png') }}">
                        </label>

                        <label>
                            <input type="checkbox">
                            <img src="{{ asset('images/check-icon.png') }}">
                        </label>
                    </div>
                </div>

                <div id="add-set-button">
                    <img src="{{ asset('images/add-icon.png') }}">
                    <p>Add Set</p>
                </div>
            </div>
        </div>

        <div class="buttons-section">
            <button id="add-exercises-button">Add Exercises</button>
            <button onclick="openPopupModal('general-pop-up-modal', 'Cancel workout?', 'Are you sure you want to cancel the workout? All progress will be lost!', 'Resume', 'Finish', '#171717', '#ff0000')">Cancel Workout</button>
        </div>
    </div>

    <div class="workout-page">
        <h1>Start Workout</h1>

        <div class="quick-start-section">
            <h2>Quick start</h2>
            <button type="button" onclick="openModal('start-empty-workout-modal')">Start an empty workout</button>
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
        <a href="{{ route('pages.exercises') }}">
            <img src="{{ asset('images/globe-icon.png') }}">
            <p>Discover</p>
        </a>
        <a href="{{ route('pages.workout') }}" id="workout-href">
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
@endsection
