document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchForm = document.getElementById('searchForm');
    if (searchForm) {
        searchForm.addEventListener('submit', function(e) {
            e.preventDefault();
            const searchTerm = document.getElementById('searchInput').value;
            // AJAX call to search.php to get results
            // Update searchResults div with the results
        });
    }

    // Register event functionality
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            e.preventDefault();
            // Collect form data
            // AJAX call to register.php to save the event
            // Show success message or redirect
        });
    }

    // Event registration button
    const registerButton = document.getElementById('registerButton');
    if (registerButton) {
        registerButton.addEventListener('click', function() {
            // AJAX call to register user for the event
            // Show success message or update button state
        });
    }
});