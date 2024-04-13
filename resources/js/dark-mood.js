

// Add event listener to theme toggle button
var themeToggleBtn = document.getElementById('theme-toggle');
if (themeToggleBtn) {
    // Function to toggle dark mode
function toggleDarkMode() {
    var isDarkMode = document.documentElement.classList.toggle('dark');
    localStorage.setItem('color-theme', isDarkMode ? 'dark' : 'light');
    
    // Toggle visibility of theme icons
    var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
    var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
    themeToggleDarkIcon.classList.toggle('hidden', isDarkMode);
    themeToggleLightIcon.classList.toggle('hidden', !isDarkMode);
}

// Function to set initial theme based on local storage or system preference
function setInitialTheme() {
    var theme = localStorage.getItem('color-theme');
    if (!theme) {
        // If theme is not set in local storage, check system preference
        if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
            theme = 'dark';
        } else {
            theme = 'light';
        }
    }
    
    // Apply the selected theme
    if (theme === 'dark') {
        document.documentElement.classList.add('dark');
    }
    
    // Toggle visibility of theme icons based on initial theme
    var themeToggleDarkIcon = document.getElementById('theme-toggle-dark-icon');
    var themeToggleLightIcon = document.getElementById('theme-toggle-light-icon');
    themeToggleDarkIcon.classList.toggle('hidden', theme !== 'light');
    themeToggleLightIcon.classList.toggle('hidden', theme !== 'dark');
}
    themeToggleBtn.addEventListener('click', toggleDarkMode);
    // Set initial theme on page load
    window.addEventListener('load', setInitialTheme);
}

