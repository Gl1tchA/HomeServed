function showSectionsWithFade() {
    // Select all sections with the .main-content class
    var sections = document.querySelectorAll('.main-content');

    sections.forEach(function (section) {
        // Set the initial opacity and ensure transition is enabled
        section.style.opacity = 0;
        section.style.transition = 'opacity 1s ease-in-out';

        // Trigger the fade-in effect after a short delay
        setTimeout(function () {
            section.style.opacity = 1;
        }, 100); // Delay ensures initial state is rendered
    });
}

// Run the function immediately when the page loads
window.addEventListener('DOMContentLoaded', showSectionsWithFade);