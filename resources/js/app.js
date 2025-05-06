import './bootstrap'
import axios from 'axios';

import Alpine from 'alpinejs'
window.Alpine = Alpine
Alpine.start()

let timerInterval
let startTime

let clearSearchButton
let searchInput
let clearSearchButtonId

let equipmentTypeId
let exerciseId
let exerciseName
let exerciseInstructions

let routineId
let routineName

let saveButton
let input
// ********** Event listeners **********

window.addEventListener('resize', formatExerciseName)
window.addEventListener('load', formatExerciseName)

// For the searchbar in the exercises page view
let searchBar = document.getElementById('exercises-searchbar')

// If statement so that the entire javascript file does not break
if (searchBar) {
    searchBar.addEventListener('keypress', function (e) {
        if (e.key === 'Enter') {
            let name = this.value
            searchExercisesByName(name)
        }
    })
}

// *************************************

function formatExerciseName() {
    let exerciseNames = document.getElementsByClassName('exercise-name')

    let screenWidth = window.innerWidth
    let charLimit = 50

    // Adjust character limit based on screen width
    if (screenWidth < 375) {
        charLimit = 28
    }
    else if (screenWidth < 425) {
        charLimit = 35
    }
    else {
        charLimit = 50
    }

    // Loop through all elements
    Array.from(exerciseNames).forEach(name => {
        let originalText = name.getAttribute('original-text')

        if (originalText.length > charLimit) {
            name.textContent = originalText.substring(0, charLimit) + '...'
        }
        else {
            name.textContent = originalText
        }
    })
}

let addInstructionCount = 1 // 1 Because there is alreay a text area in the container
// Function that will allow the user to add another step to either their new or edited exercise
window.addInstructionInput = function (containerId, textareaClass) {
    if (addInstructionCount >= 5) {
        alert("Can only have 5 instructions for each exercise")
        return
    }

    addInstructionCount++
    let container = document.getElementById(containerId)

    let textarea = document.createElement('textarea')
    textarea.classList.add('added-textarea')
    textarea.classList.add(textareaClass)
    textarea.placeholder = `Step ${addInstructionCount}`
    textarea.autocomplete = 'off'
    textarea.style.resize = "none"

    container.appendChild(textarea)
}

let editInstructionCount = 0
let alreadyCalled = false
// Function to fill in the textarea inputs in the edit modal 
window.fillEditTextAreas = function () {
    if (alreadyCalled) return // Just to stop repeatedly filling the modal with text areas

    let container = document.getElementById('edit-instructions-container')
    let instructionsToPut = exerciseInstructions.match(/\d+\.\s.*?(?=\d+\.\s|$)/gs)?.map(step => step.replace(/^\d+\.\s/, '').trim()) || [] // Separate into paragraphs but I also remove the numbers in case of future errors

    instructionsToPut.forEach(instruction => {
        editInstructionCount++

        let textarea = document.createElement('textarea')
        textarea.classList.add('added-textarea')
        textarea.classList.add('edit-exercise-textarea')
        textarea.placeholder = `Step ${instruction}`
        textarea.autocomplete = 'off'
        textarea.style.resize = "none"
        textarea.value = `${instruction}`

        container.appendChild(textarea)
    })

    addInstructionCount = editInstructionCount
    alreadyCalled = true
}

window.setCountToZero = function () {
    addInstructionCount = 0
    alreadyCalled = false
}

//Function to set the routine fields depending 
window.setRoutineFields = function (selectedRoutineId, selectedRoutineName, modalToSetAttributes) {
    routineId = selectedRoutineId
    routineName = selectedRoutineName

    let modal = document.getElementById(modalToSetAttributes)

    modal.setAttribute('routineId', routineId)
    modal.setAttribute('routineName', routineName)
}

// Function to finalise fields and call the corresponding route for editing a routine's name
window.confirmDeleteRoutine = function () {
    let modal = document.getElementById('delete-routine-pop-up-modal')
    let routineId = modal.getAttribute('routineId') // This will be filled in from the function so there will be no errors, hopefully

    let form = document.getElementById('delete-routine-form')
    form.setAttribute('action', `/workout/${routineId}`) // then we set the action attribute in the form to match the route thing
    form.submit()
}

// Function to delete the corresponding route
window.confirmEditRoutine = function () {
    let modal = document.getElementById('edit-routine-modal')
    let routineId = modal.getAttribute('routineId') // This will be filled in from the function so there will be no errors, hopefully

    let form = document.getElementById('edit-routine-form')
    form.setAttribute('action', `/workout/${routineId}`) // then we set the action attribute in the form to match the route thing
    form.submit()
}

// TIME FUNCTION (FOR WORKOUTS) Code by: ChatGPT
function startStopwatch() {
    let timeElement = document.getElementById('time')
    startTime = Date.now()

    timerInterval = setInterval(() => {
        let elapsed = Math.floor((Date.now() - startTime) / 1000) // seconds

        let hours = Math.floor(elapsed / 3600) // This calculates the hours
        let minutes = Math.floor((elapsed % 3600) / 60) // This calculates minutes from remainder of hours
        let seconds = elapsed % 60 // And the remainder is just seconds

        if (hours > 0) {
            timeElement.textContent = `${hours}:${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}` // This is the hour format
        }
        else {
            timeElement.textContent = `${String(minutes).padStart(2, '0')}:${String(seconds).padStart(2, '0')}` // This is the regular mm::ss format
        }
    },
        1000) // This is updating the timer every 1 second (1000ms)
}

// Function that will check the corresponding equipment checkbox when clicking the edit button in the exercise view modal
window.setCheckedEquipmentAndName = function () {
    let checkboxes = document.getElementsByClassName(`${equipmentTypeId}-checkboxes`)
    let input = document.getElementById('edited-exercise-name')

    input.value = exerciseName

    Array.from(checkboxes).forEach(checkbox => {
        if (checkbox.value === equipmentTypeId) { checkbox.checked = true }
        else { checkbox.checked = false }
    })
}

window.setIdsForSaveButton = function (inputId, saveId) {
    saveButton = document.getElementById(saveId)
    input = document.getElementById(inputId)
}

// To submit the add or edit modal. It's mainly just to get all the text area values and put them as one string
window.finaliseAndSubmit = function (textareaIds) {
    let textareas = document.getElementsByClassName(textareaIds)

    console.log(textareaIds)

    let instructionsToSend = []
    let count = 1

    Array.from(textareas).forEach(textarea => {
        // Ignore all text areas that do not have a value in them
        if (textarea.value.trim() !== "") {
            instructionsToSend.push(`${count}. ${textarea.value.trim()}`) // Format it as 1. 'Instructions' for formatting purposes
            count++
        }
    })

    document.getElementById('instructions-to-send').value = instructionsToSend.join(' ') // Put the array into the corresponding input by breaking up each element with \n

    document.getElementById('add-exercise-form').submit()
}

// Function to set the data attribute in the corresponding crud modal so we can either delete or edit the corresponding exercise the user chose
window.setExerciseIdForCrudModals = function (modal, attribute) {
    document.getElementById(modal).setAttribute(attribute, exerciseId)
}

// Then we can delete
window.confirmDelete = function () {
    let modal = document.getElementById('delete-pop-up-modal')
    let exerciseId = modal.getAttribute('exercise-id') // This will be filled in from the function so there will be no errors, hopefully

    let form = document.getElementById('delete-exercise-form')
    form.setAttribute('action', `/exercises/${exerciseId}`) // then we set the action attribute in the form to match the route thing
    form.submit()
}

// Or edit
window.confirmEdit = function () {
    let modal = document.getElementById('edit-exercise-modal')
    let exerciseId = modal.getAttribute('exercise-id') // This will be filled in from the function so there will be no errors, hopefully

    let textareas = document.getElementsByClassName('edit-exercise-textarea')
    let instructionsToSend = []

    let count = 1
    Array.from(textareas).forEach(textarea => {
        // Ignore all text areas that do not have a value in them
        if (textarea.value.trim() !== "") {
            instructionsToSend.push(`${count}. ${textarea.value.trim()}`) // Format it as 1. 'Instructions' for formatting purposes
            count++
        }
    })

    document.getElementById('instructions-to-send-for-edit').value = instructionsToSend.join(' ')

    let form = document.getElementById('edit-exercise-form')
    form.setAttribute('action', `/exercises/${exerciseId}`) // then we set the action attribute in the form to match the route thing
    form.submit()
}

// Function that will make it so that save button is not accessible if the input is blank
window.showOrHideSaveButton = function (e) {
    if (e.target.value === "" || e.target.length < 1) {
        saveButton.style.pointerEvents = "none"
        saveButton.style.color = "#808080"
    }
    else {
        saveButton.style.pointerEvents = "auto"
        saveButton.style.color = "#ff0000"
    }
}

// Same as above but with a click of a button due to a bug
window.showOrHideSaveButtonByClick = function () {
    if (input.value === "" || input.length < 1) {
        saveButton.style.pointerEvents = "none"
        saveButton.style.color = "#808080"
    }
    else {
        saveButton.style.pointerEvents = "auto"
        saveButton.style.color = "#ff0000"
    }
}

// MODAL FUNCTIONS
window.openModal = function (modalToOpen) {
    let modal = document.getElementById(modalToOpen)

    // So that the stopwatch ONLY starts when the user decides to start a workout
    if (modalToOpen === 'start-empty-workout-modal') {
        startStopwatch()
    }

    modal.classList.add('openOrClose')
}

window.closeModal = function (modalToClose) {
    let modal = document.getElementById(modalToClose)

    if (modalToClose === 'start-empty-workout-modal') {
        clearInterval(timerInterval)
        let timeElement = document.getElementById('time')

        if (timeElement) {
            document.getElementById('time').textContent = '00:00'
        }
    }

    modal.classList.remove('openOrClose')
}

window.minimiseModal = function (modalToMinimise, imageToFlip) {
    let modal = document.getElementById(modalToMinimise)
    let image = document.getElementById(imageToFlip)

    modal.classList.toggle('minimise')
    image.classList.toggle('minimise')
}

// Function for general popups that have the exact same layout
window.openPopupModal = function (modalToOpen, title, description, cancelText, continueText, cancelColor, continueColor) {
    let modal = document.getElementById(modalToOpen)
    let modalTitle = document.getElementById(`${modalToOpen}-title`)
    let modalDesc = document.getElementById(`${modalToOpen}-description`)
    let cancelButton = document.getElementById(`${modalToOpen}-cancel-button`)
    let continueButton = document.getElementById(`${modalToOpen}-continue-button`)

    modalTitle.textContent = title
    modalDesc.textContent = description
    cancelButton.textContent = cancelText
    continueButton.textContent = continueText

    cancelButton.style.backgroundColor = cancelColor
    continueButton.style.backgroundColor = continueColor

    modal.classList.add('openPopup')
}

window.openCustomPopUpModal = function (modalToOpen) {
    let modal = document.getElementById(modalToOpen)

    modal.classList.add('openPopup')
}

window.closePopupModal = function (modalToClose) {
    let modal = document.getElementById(modalToClose)

    modal.classList.remove('openPopup')
}

// Function to fill in the specified elements depending on what exercise was chosen
window.fillExerciseViewModal = function (selectedExerciseName, selectedExerciseInstructions, exerciseImage, selectedEquipmentTypeId, selectedExerciseId) {
    equipmentTypeId = selectedEquipmentTypeId
    exerciseId = selectedExerciseId
    exerciseName = selectedExerciseName
    exerciseInstructions = selectedExerciseInstructions

    let nameElement = document.getElementById('selected-exercise-name')
    nameElement.textContent = selectedExerciseName

    let htmlString = ""
    let instructions = exerciseInstructions.match(/\d+\.\s[^(\d+\.)]+/g) || []
    let imageToShow = exerciseImage ? exerciseImage : '/images/weight-icon.png'

    htmlString += `
    <div class="image-container">
        <img src="${imageToShow}">
    </div>

    <div class="exercise-instructions">
        <h2>Instructions</h2>`

    instructions.forEach(instruction => {
        htmlString += `
        <p>${instruction}</p>
        `
    })

    htmlString += `
    </div>
    `

    document.getElementById('exercise-details-section').innerHTML = htmlString
}

// FILTETRING FUNCTIONALITY
function searchExercisesByName(name) {
    let exercises = document.getElementsByClassName('exercise-view-row')

    clearSearchButton.style.display = "block"

    // Simple code to set the display type of all exercises that dont match to be "none". Otherwise display type is "flex"
    // The attribute needs to EXACTLY match the search input though
    Array.from(exercises).forEach(exercise => {
        if (name === '') {
            exercise.style.display = "flex"
            clearSearchButton.style.display = "none"
        }
        else if (exercise.getAttribute('exercise-name').toLowerCase() === name.toLowerCase()) {
            exercise.style.display = "flex"
        }
        else if (exercise.getAttribute('exercise-name').toLowerCase() !== name.toLowerCase()) {
            exercise.style.display = "none"
        }
    })
}

window.setClearSearchAndInputId = function (clearId, searchId) {
    clearSearchButton = document.getElementById(clearId)
    searchInput = document.getElementById(searchId)
    clearSearchButtonId = clearId // This is for the if statement in the clearSearchInput function
}

// Simple function to clear the search input 
window.clearSearchInput = function () {
    // Custom functionality for the exercises reset button. Just brings back all exercises
    if (clearSearchButtonId === "clear-exercise-search-button") {
        let exercises = document.getElementsByClassName('exercise-view-row')

        Array.from(exercises).forEach(exercise => { exercise.style.display = "flex" })
    }

    searchInput.value = ""
    clearSearchButton.style.display = "none"
}

// Come on now
window.clearInput = function (inputId) {
    let inputToClear = document.getElementById(inputId)

    inputToClear.value = ""
}

let originalProfilePicSrc = null;

window.toggleEditProfileModal = function () {
    const form = document.getElementById('profileForm');
    const profilePic = document.querySelector('.profile-pic-container .profile-pic');
    const modal = document.getElementById('edit-profile-container');
    const mainProfileSection = document.getElementById('user-profile-section');

    // Toggle modal visibility
    const isModalOpen = modal.style.display === 'block';

    if (!isModalOpen) {
        // Store the original image source when opening the modal
        originalProfilePicSrc = profilePic.src;
        modal.style.display = 'block';
        mainProfileSection.style.display = 'none';
    } else {
        // Reset the image and form when closing the modal
        if (originalProfilePicSrc) {
            // Reset all profile picture previews
            document.querySelectorAll('.profile-pic').forEach(img => {
                img.src = originalProfilePicSrc;
            });
        }

        form.reset(); // Reset the form fields
        modal.style.display = 'none';
        mainProfileSection.style.display = 'block';

        // Clear any selected file
        const fileInput = document.getElementById('profile_picture');
        if (fileInput) {
            fileInput.value = '';
        }
    }
};

document.addEventListener('DOMContentLoaded', function() {
    const fileInput = document.getElementById('profile_picture');
    const previewImage = document.querySelector('.profile-pic-container .profile-pic');
    const cameraIcon = document.querySelector('.change-photo-btn i');
    
    fileInput.addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            const objectUrl = URL.createObjectURL(e.target.files[0]);
            previewImage.src = objectUrl;
            
            previewImage.onload = function() {
                URL.revokeObjectURL(objectUrl);
            };
        }
    });
    
    document.querySelector('.change-photo-btn').addEventListener('click', function(e) {
        e.preventDefault();
        fileInput.click();
    });
});