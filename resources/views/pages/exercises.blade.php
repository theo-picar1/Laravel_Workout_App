@extends('layouts.pages')

@section('content')
    <div class="exercises-page">
        <div class="pop-up-modal" id="general-pop-up-modal">
            <div class="pop-up-modal-content">
                <h4 id="general-pop-up-modal-title"></h4>
    
                <p id="general-pop-up-modal-description"></p>
    
                <div>
                    <button id="general-pop-up-modal-cancel-button" onclick="closePopupModal('general-pop-up-modal')"></button>
                    <button id="general-pop-up-modal-continue-button" onclick="closePopupModal('general-pop-up-modal'); closeModal('specific-exercise-view-modal')"></button>
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
    
                    <p id="save-added-button" class="crud-save-button" onclick="closePopupModal('add-exercise-modal'); clearInput('new-exercise-name')">Save</p>
                </div>

                <input type="text" autocomplete="off" placeholder="Exercise name" id="new-exercise-name" class="crud-input" oninput="showOrHideSaveButton(event)">

                <div class="choose-equipment-section">
                    <p>Equipment Type</p>
                    
                    <div class="equipment-types">
                        @foreach ($equipment_types as $equipment)
                            <label>
                                <span>{{ $equipment->name }}</span>

                                <input type="radio" name="equipment-type" value={{ $equipment->id }}>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div id="edit-exercise-modal" class="crud-modal">
            <div class="edit-exercise-content crud-content">
                <div class="title">
                    <div onclick="closePopupModal('edit-exercise-modal')" class="image-container">
                        <img src="{{ asset('images/close-icon 09.57.33.png') }}">
                    </div>
    
                    <p>Edit exercise</p>
    
                    <p id="save-edited-button" class="crud-save-button" onclick="closePopupModal('edit-exercise-modal'); clearInput('edited-exercise-name');">Save</p>
                </div>

                <input type="text" autocomplete="off" placeholder="Exercise name" id="edited-exercise-name" class="crud-input" oninput="showOrHideSaveButton(event)">

                <div class="choose-equipment-section">
                    <p>Equipment Type</p>
                    
                    <div class="equipment-types">
                        @foreach ($equipment_types as $equipment)
                            <label>
                                <span>{{ $equipment->name }}</span>

                                <input type="radio" name="equipment-type" class="{{ $equipment->equipment_type_id }}-checkboxes" value={{ $equipment->equipment_type_id }}>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <header class="exercises-page-header">
            <p class="add-exercise-p" onclick="setIdsForSaveButton('new-exercise-name', 'save-added-button'); openCustomPopUpModal('add-exercise-modal'); showOrHideSaveButtonByClick('new-exercise-name')">Add exercise</p>

            <p>Exercises</p>

            <p class="hidden-element" style="visibility: hidden">.</p>
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
                    <div exercise-name="{{ $exercise->name }}" class="exercise exercise-view-row" onclick="openModal('specific-exercise-view-modal'); fillExerciseViewModal('{{ $exercise->name }}', '{{ $exercise->instructions }}', '{{ $exercise->image_url }}', '{{ $exercise->equipment_type_id }}')">
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
                <div>
                    <img src="{{ asset('images/back-icon.png') }}" onclick="closeModal('specific-exercise-view-modal')" id="image">
                </div>

                <div>
                    <p id="selected-exercise-name"></p>
                </div>

                <div>
                    <p style="visibility: hidden">.</p>
                </div>
            </header>

            <div class="edit-or-delete-section">
                <p onclick="openPopupModal('general-pop-up-modal', 'Delete exercise?', 'Deleting this exercise is permanent. Proceed anyways?', 'Cancel', 'Delete', '#171717', '#ff0000')" class="delete">Delete</p>

                <p onclick="openCustomPopUpModal('edit-exercise-modal'); setCheckedEquipment(); setIdsForSaveButton('edited-exercise-name', 'save-edited-button');  showOrHideSaveButtonByClick('edited-exercise-name')" class="edit">Edit</p>
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