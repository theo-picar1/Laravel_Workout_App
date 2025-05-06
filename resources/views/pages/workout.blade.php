@extends('layouts.pages')

@section('content')
    {{-- Finish workout pop up modal --}}
    <div class="pop-up-modal" id="finish-workout-pop-up-modal">
        <div class="pop-up-modal-content">
            <h4 id="finish-workout-pop-up-modal-title"></h4>

            <p id="finish-workout-pop-up-modal-description"></p>

            <div>
                <button id="finish-workout-pop-up-modal-cancel-button"
                    onclick="closePopupModal('finish-workout-pop-up-modal')"></button>
                <button id="finish-workout-pop-up-modal-continue-button"
                    onclick="closeModal('start-empty-workout-modal'); closePopupModal('finish-workout-pop-up-modal')"></button>
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
                <button id="general-pop-up-modal-continue-button"
                    onclick="closePopupModal('general-pop-up-modal'); closeModal('start-empty-workout-modal')"></button>
            </div>
        </div>
    </div>

    {{-- Delete pop up modal --}}
    <div class="pop-up-modal" id="delete-routine-pop-up-modal" routineId="" routineName="">
        <div class="pop-up-modal-content">
            <h4 id="delete-routine-pop-up-modal-title"></h4>

            <p id="delete-routine-pop-up-modal-description"></p>

            <div>
                <button id="delete-routine-pop-up-modal-cancel-button" onclick="closePopupModal('delete-routine-pop-up-modal')"></button>

                <button id="delete-routine-pop-up-modal-continue-button" onclick="confirmDeleteRoutine()"></button>
            </div>

            <form id="delete-routine-form" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
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

                <button
                    onclick="openPopupModal('finish-workout-pop-up-modal', 'Finish workout?', 'Any inputs not filled in will be discarded. Would you like to continue?', 'Cancel', 'Finish', '#171717', '#81fe5e')">Finish</button>
            </div>
        </div>

        <p id="time">0:00:00</p>

        {{-- For each of exercises here with weight, reps and sets --}}
        <div class="exercises-list"></div> 

        <div class="buttons-section">
            <button id="add-exercises-button">Add Exercises</button>
            <button
                onclick="openPopupModal('general-pop-up-modal', 'Cancel workout?', 'Are you sure you want to cancel the workout? All progress will be lost!', 'Resume', 'Finish', '#171717', '#ff0000')">Cancel
                Workout</button>
        </div>
    </div>

    {{-- Add routine modal --}}
    <div id="add-routine-modal" class="crud-modal">
        <div class="crud-content">
            <div class="title">
                <div class="image-container" onclick="closePopupModal('add-routine-modal')">
                    <img src="{{ asset('images/close-icon 09.57.33.png') }}">
                </div>

                <h4>Add new routine</h4>

                <button type="submit" form="add-routine-form" class="crud-save-button" id="add-routine-save-button">Save</button>
            </div>

            <form id="add-routine-form" method="POST" action="{{ route('routines.store') }}">
                @csrf

                <input type="text" class="crud-input" placeholder="Enter routine name" id="new-routine-name" name="routine_name" autocomplete="off" oninput="showOrHideSaveButton(event)">
            </form>
        </div>
    </div>

    {{-- Edit routine modal --}}
    <div id="edit-routine-modal" class="crud-modal" routineId="" routineName="">
        <div class="crud-content">
            <div class="title">
                <div class="image-container" onclick="closePopupModal('edit-routine-modal'); showOrHideSaveButtonByClick('edit-routine-name')">
                    <img src="{{ asset('images/close-icon 09.57.33.png') }}">
                </div>

                <h4>Edit routine</h4>

                <button class="crud-save-button" id="edit-routine-save-button" onclick="confirmEditRoutine()">Save</button>
            </div>

            <form id="edit-routine-form" method="POST">
                @csrf
                @method('PUT')

                <input type="text" class="crud-input" placeholder="Enter routine name" id="edit-routine-name" name="routine_name" autocomplete="off" oninput="showOrHideSaveButton(event)">
            </form>
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
                <button onclick="openCustomPopUpModal('add-routine-modal'); setIdsForSaveButton('new-routine-name', 'add-routine-save-button')">Add Routine</button>
            </div>

            <div class="routines-list">
                @foreach ($routines as $routine)
                    <div class="routine">
                        <div class="routine-pop-up-modal">
                            <div></div>
                        </div>

                        <div class="title">
                            <h2>{{ $routine->routine_name }}</h2>

                            <div style="display: flex; flex-direction: row; gap: 5px;">
                                <img src="{{ asset('images/edit-icon.png') }}" onclick="openCustomPopUpModal('edit-routine-modal'); setRoutineFields('{{ $routine->routine_id }}', '{{ $routine->routine_name }}', 'edit-routine-modal'); setIdsForSaveButton('edit-routine-name', 'edit-routine-save-button')">

                                <img src="{{ asset('images/remove-icon.png') }}" onclick="openPopupModal('delete-routine-pop-up-modal', 'Delete routine?', 'Deleting this routine is permanent. Proceed anyways?', 'Cancel', 'Remove', '#171717', '#ff0000'); setRoutineFields('{{ $routine->routine_id }}', '{{ $routine->routine_name }}', 'delete-routine-pop-up-modal')">
                            </div>
                        </div>

                        <div class="exercises-preview">
                            @foreach ($routine->exercises as $exercise)
                                <p>{{ $exercise->name }}</p>
                            @endforeach
                        </div>

                        <button>Start routine</button>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <footer id="workout-page-footer">
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
