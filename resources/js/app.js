import './bootstrap'

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

// Function to add a selected exercise to the routine 
window.addExerciseToRoutine = function (selectedExerciseId, selectedExerciseName) {
    let htmlString = ""
    let container = document.getElementById('edit-routine-exercise-list')

    htmlString += `
    <div class="exercise" exerciseId="${selectedExerciseId}">
        <div class="exercise-header">
            <p class="exercise-name" original-text="${selectedExerciseName}">${selectedExerciseName}</p>
            <div
                onclick="openPopupModal('general-pop-up-modal', 'Remove exercise?', 'Are you sure you want to remove this exercise? You can add it again later.', 'Cancel', 'Remove', '#171717', '#ff0000')">
                <img src="/images/remove-icon.png" alt="Remove">
            </div>
        </div>

        <div class="exercise-stats">
            <div class="columns set-number-column">
                <p>Set</p>
                <div><p>1</p></div>
                <div><p>2</p></div>
                <div><p>3</p></div>
                <div><p>4</p></div>
                <div><p>5</p></div>
                <div><p>6</p></div>
            </div>

            <div class="columns previous-stat-column">
                <p>Previous</p>
                <div><p>--</p></div>
                <div><p>--</p></div>
                <div><p>--</p></div>
                <div><p>--</p></div>
                <div><p>--</p></div>
                <div><p>--</p></div>
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
                <img src="/images/check-icon.png" alt="Check">
                <label><input type="checkbox"><img src="/images/check-icon.png" alt="Check"></label>
                <label><input type="checkbox"><img src="/images/check-icon.png" alt="Check"></label>
                <label><input type="checkbox"><img src="/images/check-icon.png" alt="Check"></label>
                <label><input type="checkbox"><img src="/images/check-icon.png" alt="Check"></label>
                <label><input type="checkbox"><img src="/images/check-icon.png" alt="Check"></label>
                <label><input type="checkbox"><img src="/images/check-icon.png" alt="Check"></label>
            </div>
        </div>

        <div class="add-set-button">
            <img src="/images/add-icon.png" alt="Add">
            <p>Add Set</p>
        </div>
    </div>  
    `

    // 'beforeend' just inserts the htmlString inside the container I chose
    container.insertAdjacentHTML('beforeend', htmlString)
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

let originalProfilePicSrc = null

window.toggleEditProfileModal = function () {
    const form = document.getElementById('profileForm')
    const profilePic = document.querySelector('.profile-pic-container .profile-pic')
    const modal = document.getElementById('edit-profile-container')
    const mainProfileSection = document.getElementById('user-profile-section')

    // Toggle modal visibility
    const isModalOpen = modal.style.display === 'block'

    if (!isModalOpen) {
        // Store the original image source when opening the modal
        originalProfilePicSrc = profilePic.src
        modal.style.display = 'block'
        mainProfileSection.style.display = 'none'
    } else {
        // Reset the image and form when closing the modal
        if (originalProfilePicSrc) {
            // Reset all profile picture previews
            document.querySelectorAll('.profile-pic').forEach(img => {
                img.src = originalProfilePicSrc
            })
        }

        form.reset() // Reset the form fields
        modal.style.display = 'none'
        mainProfileSection.style.display = 'block'

        // Clear any selected file
        const fileInput = document.getElementById('profile_picture')
        if (fileInput) {
            fileInput.value = ''
        }
    }
}

// Wait for the DOM to fully load before executing the script
document.addEventListener('DOMContentLoaded', function() {
    // Get the file input element for profile picture upload
    const fileInput = document.getElementById('profile_picture')
    // Get the image element where the preview of the uploaded profile picture will be displayed
    const previewImage = document.querySelector('.profile-pic-container .profile-pic')
    // Get the camera icon button for triggering the file input
    const cameraIcon = document.querySelector('.change-photo-btn i')
    
    // Event listener for when a file is selected in the file input
    fileInput.addEventListener('change', function(e) {
        if (e.target.files && e.target.files[0]) {
            // Create a temporary URL for the selected file
            const objectUrl = URL.createObjectURL(e.target.files[0])
            // Set the preview image source to the temporary URL
            previewImage.src = objectUrl
            
            // Revoke the temporary URL after the image is loaded to free up memory
            previewImage.onload = function() {
                URL.revokeObjectURL(objectUrl)
            }
        }
    })
    // Event listener for the camera icon button to trigger the file input click
    document.querySelector('.change-photo-btn').addEventListener('click', function(e) {
        e.preventDefault() // Prevent the default button behavior
        fileInput.click() // Programmatically trigger the file input click
    })
})

// Set up AJAX with CSRF token for secure requests
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Get the CSRF token from the meta tag
    }
})

// Handle the like form submission using jQuery
$('.like-form').submit(function(e) {
    e.preventDefault() // Prevent the default form submission
    const form = $(this) // Get the current form
    const likeButton = form.find('.like-btn') // Get the like button within the form

    // Add a loading state to the like button
    likeButton.prop('disabled', true).addClass('loading')

    // Send an AJAX POST request to the form's action URL
    $.ajax({
        type: "POST",
        url: form.attr('action'), // Get the form's action URL
        data: form.serialize(), // Serialize the form data
        success: function(data) {
            // Update the like count displayed in the form
            form.find('.like-count').text(data.like_count)

            // Toggle the "liked" class based on the response status
            if (data.status === 'liked') {
                likeButton.addClass('liked')
            } else {
                likeButton.removeClass('liked')
            }
        },
        error: function(xhr, status, error) {
            console.error('Error:', error) // Log any errors to the console
        },
        complete: function() {
            // Remove the loading state from the like button
            likeButton.prop('disabled', false).removeClass('loading')
        }
    })
})

// Add event listeners to all like buttons after the DOM is loaded
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.like-btn').forEach(button => {
        button.addEventListener('click', function () {
            const postId = this.getAttribute('data-post-id') // Get the post ID from the button's data attribute
            const likeCountSpan = this.querySelector('.like-count') // Get the span element displaying the like count

            // Send a POST request to the like endpoint for the specific post
            fetch(`/posts/${postId}/like`, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), // Include the CSRF token
                    'Content-Type': 'application/json',
                },
            })
                .then(response => response.json()) // Parse the JSON response
                .then(data => {
                    // Update the button's appearance based on the like status
                    if (data.status === 'liked') {
                        this.classList.add('liked') 
                    } else {
                        this.classList.remove('liked')
                    }
                    // Update the like count displayed on the button
                    likeCountSpan.textContent = data.like_count
                })
                .catch(error => console.error('Error:', error)) // Log any errors to the console
        })
    })
})

// Handle the follow form submission using jQuery
$('.follow-form').submit(function (e) {
    e.preventDefault() // Prevent the default form submission
    const form = $(this) // Get the current form
    const button = form.find('.follow-btn') // Get the follow button within the form

    // Send an AJAX POST request to the form's action URL
    $.ajax({
        type: 'POST',
        url: form.attr('action'), // Get the form's action URL
        data: form.serialize(), // Serialize the form data
        success: function (data) {
            // Update the button text based on the follow status
            if (data.status === 'followed') {
                button.text('Unfollow')
            } else {
                button.text('Follow')
            }
            // Update the followers count displayed on the page
            $('.followers-count').text(data.followers_count)
        },
        error: function (xhr) {
            console.error(xhr.responseText) // Log any errors to the console
        }
    })
})