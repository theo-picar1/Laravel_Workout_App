@extends('layouts.pages')

@section('content')
    <script>
        // Check if the success session exists, then call the function to close the modal
        @if (session('Added exercise success'))
            alert('Success!')
            closePopupModal('add-exercise-modal')
        @elseif (session('Deleted exercise success'))
            alert('Success!')
            closePopupModal('delete-pop-up-modal')
            closeModal('specific-exercise-view-modal')
        @endif
    </script>

    <div class="exercises-page">
        <div class="pop-up-modal" id="general-pop-up-modal">
            <div class="pop-up-modal-content">
                <h4 id="general-pop-up-modal-title"></h4>

                <p id="general-pop-up-modal-description"></p>

                <div>
                    <button id="general-pop-up-modal-cancel-button"
                        onclick="closePopupModal('general-pop-up-modal')"></button>
                    <button id="general-pop-up-modal-continue-button"
                        onclick="closePopupModal('general-pop-up-modal'); closeModal('specific-exercise-view-modal')"></button>
                </div>
            </div>
        </div>

        <div id="add-exercise-modal" class="crud-modal">
            <div class="add-exercise-content crud-content">
                <div class="title">
                    <div onclick="closePopupModal('add-exercise-modal')" class="image-container">
                        <img src="{{ asset('images/close-icon 09.57.33.png') }}">
                    </div>

                    <p>Create new exercise</p>

                    <button type="submit" form="add-exercise-form" id="save-added-button"
                        class="crud-save-button">Save</button>
                </div>

                <form id="add-exercise-form" method="POST" action="{{ route('exercises.store') }}">
                    @csrf {{-- IMPORTANT! --}}

                    <input type="text" name="name" autocomplete="off" placeholder="Exercise name"
                        id="new-exercise-name" class="crud-input" oninput="showOrHideSaveButton(event)" required>

                    <div class="choose-equipment-section">
                        <p>Equipment Type</p>

                        <div class="equipment-types">
                            @foreach ($equipment_types as $equipment)
                                <label>
                                    <span>{{ $equipment->name }}</span>

                                    <input type="radio" name="equipment_type_id"
                                        value="{{ $equipment->equipment_type_id }}" required>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <div id="edit-exercise-modal" class="crud-modal" exercise-id="">
            <div class="edit-exercise-content crud-content">
                <div class="title">
                    <div onclick="closePopupModal('edit-exercise-modal')" class="image-container">
                        <img src="{{ asset('images/close-icon 09.57.33.png') }}">
                    </div>

                    <p>Edit exercise</p>

                    <button type="submit" id="save-edited-button" class="crud-save-button" form="edit-exercise-form" onclick="confirmEdit()">Save</button>
                </div>

                <form method="POST" id="edit-exercise-form">
                    @csrf
                    @method('PUT')

                    <input type="text" name="name" autocomplete="off" placeholder="Exercise name" id="edited-exercise-name" value="" class="crud-input" oninput="showOrHideSaveButton(event)">

                    <div class="choose-equipment-section">
                        <p>Equipment Type</p>

                        <div class="equipment-types">
                            @foreach ($equipment_types as $equipment)
                                <label>
                                    <span>{{ $equipment->name }}</span>

                                    <input type="radio" name="equipment_type_id"
                                        class="{{ $equipment->equipment_type_id }}-checkboxes"
                                        value={{ $equipment->equipment_type_id }}>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </form>
            </div>
        </div>

        {{-- Pop up modal for deleting since there is a form --}}
        <div class="pop-up-modal" id="delete-pop-up-modal" exercise-id="">
            <div class="pop-up-modal-content">
                <h4 id="delete-pop-up-modal-title"></h4>

                <p id="delete-pop-up-modal-description"></p>

                <div>
                    <button id="delete-pop-up-modal-cancel-button"
                        onclick="closePopupModal('delete-pop-up-modal')"></button>
                    <button id="delete-pop-up-modal-continue-button" onclick="confirmDelete()"></button>
                </div>

                <form id="delete-exercise-form" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </div>

        <header class="exercises-page-header">
            <p class="add-exercise-p"
                onclick="setIdsForSaveButton('new-exercise-name', 'save-added-button'); openCustomPopUpModal('add-exercise-modal'); showOrHideSaveButtonByClick('new-exercise-name')">
                Add exercise</p>

            <p>Exercises</p>

            <p class="hidden-element" style="visibility: hidden">.</p>
        </header>

        <div class="main-content">
            <label class="exercises-searchbar-container"
                onclick="setClearSearchAndInputId('clear-exercise-search-button', 'exercises-searchbar')">
                <div class="left-side">
                    <img src="{{ asset('images/search-icon.png') }}">

                    <input autocomplete="off" type="text" placeholder="Search for an exercise" id="exercises-searchbar">
                </div>
            </label>

            <div class="exercises-list">
                @foreach ($exercises as $exercise)
                    <div exercise-name="{{ $exercise->name }}" class="exercise exercise-view-row"
                        onclick="openModal('specific-exercise-view-modal'); fillExerciseViewModal('{{ $exercise->name }}', '{{ $exercise->instructions }}', '{{ $exercise->image_url }}', '{{ $exercise->equipment_type_id }}', '{{ $exercise->exercise_id }}')">
                        <div class="left-side">
                            <div class="image-container">
                                <img src="{{ $exercise->image_url ?? asset('images/weight-icon.png') }}"
                                    class="{{ $exercise->image_url ? 'exercise-image' : 'placeholder-image' }}">
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
                <div>
                    <img src="{{ asset('images/back-icon.png') }}" onclick="closeModal('specific-exercise-view-modal')"
                        id="image">
                </div>

                <div>
                    <p id="selected-exercise-name"></p>
                </div>

                <div>
                    <p style="visibility: hidden">.</p>
                </div>
            </header>

            <div class="edit-or-delete-section">
                <p onclick="openPopupModal('delete-pop-up-modal', 'Delete exercise?', 'Deleting this exercise is permanent. Proceed anyways?', 'Cancel', 'Delete', '#171717', '#ff0000'); setExerciseIdForCrudModals('delete-pop-up-modal', 'exercise-id')"
                    class="delete">Delete</p>

                <p onclick="openCustomPopUpModal('edit-exercise-modal'); setCheckedEquipmentAndName(); setIdsForSaveButton('edited-exercise-name', 'save-edited-button');  showOrHideSaveButtonByClick('edited-exercise-name'); setExerciseIdForCrudModals('edit-exercise-modal', 'exercise-id')"
                    class="edit">Edit</p>
            </div>

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
