const header = document.querySelector('header');

// Function to toggle class based on scroll position
function fixedNavbar() {
    header.classList.toggle('scroll', window.pageYOffset > 0);
}

// Call the function initially
fixedNavbar();

// Add event listener for scroll event
window.addEventListener('scroll', fixedNavbar);

// Event listener for menu button
let menu = document.querySelector('#menu-btn');
if (menu) {
    menu.addEventListener('click', function() {
        let nav = document.querySelector('.navbar');
        if (nav) {
            nav.classList.toggle('active');
        }
    });
}

// Event listener for user button
let userBtn = document.querySelector('#user-btn');
if (userBtn) {
    userBtn.addEventListener('click', function() {
        let userBox = document.querySelector('.user-box');
        if (userBox) {
            userBox.classList.toggle('active');
        }
    });
}

// Event listener for close button
const closeBtn = document.querySelector('#close-form');
if (closeBtn) {
    closeBtn.addEventListener('click', () => {
        let updateContainer = document.querySelector('.update-container');
        if (updateContainer) {
            updateContainer.style.display = 'none';
        }
    });
}
