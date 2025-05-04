import './bootstrap'

import Alpine from 'alpinejs'
window.Alpine = Alpine
Alpine.start()

let timerInterval
let startTime

// Event listeners
window.addEventListener('resize', formatExerciseName)
window.addEventListener('load', formatExerciseName)  

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
        document.getElementById('time').textContent = '00:00'
    }

    modal.classList.remove('openOrClose')
}

window.minimiseModal = function (modalToMinimise, imageToFlip) {
    let modal = document.getElementById(modalToMinimise)
    let image = document.getElementById(imageToFlip)

    modal.classList.toggle('minimise')
    image.classList.toggle('minimise')
}

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

window.closePopupModal = function(modalToClose) {
    let modal = document.getElementById(modalToClose)

    modal.classList.remove('openPopup')
}

// Function to fill in the specified elements depending on what exercise was chosen
window.fillExerciseViewModal = function (exerciseName, exerciseInstructions, exerciseImage) {
    let nameElement = document.getElementById('selected-exercise-name')
    nameElement.textContent = exerciseName

    let htmlString = ""
    let instructions = exerciseInstructions.match(/\d+\.\s[^(\d+\.)]+/g) || [];
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