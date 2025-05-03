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
    let pElement = document.getElementById('exercise-name')
    let originalText = pElement.getAttribute('original-text')
    
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

    // Limit the text content based on the original text' length and screen width
    if (originalText.length > charLimit) {
        pElement.textContent = originalText.substring(0, charLimit) + '...'
    }
    else {
        pElement.textContent = originalText  // Show full text if it's shorter than the limit
    }
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

    modal.classList.toggle('openOrClose')
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