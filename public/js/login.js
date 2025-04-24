document.addEventListener("DOMContentLoaded", function() {
    var userType = "{{ session('userType') }}";  // Get the user type from the session
    console.log("User Type from Session: ", userType);  // Debugging: log userType
    var loginForm = document.getElementById('loginForm');
    var loadingDiv = document.querySelector(".loading");

    // Check if userType is set in session
    if (userType != null && userType !== '') {
        try {
            let routeUrl;
            
            if (userType == 'Admin') {
                routeUrl = "{{ route('admin') }}";
            } else if (userType == 'Proctor') {
                routeUrl = "{{ route('proctor') }}";
            } else if (userType == 'Directorate') {
                routeUrl = "{{ route('directorate') }}";
            } else if (userType == 'Coordinator') {
                routeUrl = "{{ route('coordinator') }}";
            } else if (userType == 'Student') {
                routeUrl = "{{ route('student') }}";
            } else if (userType == 'Registrar') {
                routeUrl = "{{ route('registrar') }}";
            } else if (userType == 'Maintenance') {
                routeUrl = "{{ route('maintenance') }}";
            } else {
                console.log('Unknown userType: ', userType);
            }

            if (routeUrl) {
                window.location.href = routeUrl; // Redirect to the generated URL
            } else {
                alert("No route defined for user type: " + userType);
            }
        } catch (e) {
            console.error("Error while redirecting:", e);
            alert("Unknown error occurred during redirection.");
            loginForm.style.display = 'block'; // Ensure login form is shown if redirection fails
            loadingDiv.style.display = 'none'; // Hide loading message
        }
    } else {
        console.log("No userType session found, showing login form.");
        loginForm.style.display = 'block'; // Show login form if session is cleared or not found
        loadingDiv.style.display = 'none'; // Hide loading message
    }
});
