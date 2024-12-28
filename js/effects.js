function checkSectionVisibility() {
    // Select all sections with the .main-content class
    var sections = document.querySelectorAll('.main-content');
    
    sections.forEach(function (section) {
        var sectionPosition = section.getBoundingClientRect();

        // Check if the section is in the viewport (within the visible area of the screen)
        if (sectionPosition.top >= 0 && sectionPosition.top < window.innerHeight) {
            // Make the section visible (fade-in effect)
            section.style.opacity = 1;
            section.style.transition = 'opacity 1s ease-in-out';
        }
    });
}

// Listen for the scroll event to check if the sections are in the viewport
window.addEventListener('scroll', checkSectionVisibility);

// Initially check if the sections are in the viewport
checkSectionVisibility();