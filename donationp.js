document.addEventListener("DOMContentLoaded", function() {
    var defaultGreeting = "Blood Donation ";
       var greetingElement = document.getElementById("greeting");
              greetingElement.textContent = defaultGreeting;

  var logoutButton = document.getElementById("logoutButton");
      logoutButton.addEventListener("click", function() {
          var confirmation = confirm("Are you sure you want to log out?");
          if (confirmation) {
              window.location.href = "login1.php";
          }
      });
      });
      document.addEventListener("DOMContentLoaded", function() {
// Your DOMContentLoaded code...

});
                document.addEventListener("DOMContentLoaded", function() {
    // Handle sidebar buttons for different health tracking features
    document.querySelectorAll('.sidebar .buttons').forEach(function(button) {
        button.addEventListener('click', function() {
            console.log(this.id + " button was clicked");
            // Example: Update main content view based on the button clicked
            updateMainContent(this.id);
        });
    });

   

  

    // Save button within the main content
    if (document.querySelector('.save-button')) {
        document.querySelector('.save-button').addEventListener('click', function() {
            console.log('Save button clicked');
            alert('Your settings have been saved.');
        });
    }

    // Appointment save and cancel buttons
    if (document.querySelector('.time-set')) {
        document.querySelectorAll('.time-set button').forEach(function(button) {
            button.addEventListener('click', function() {
                if (this.textContent.includes('Save')) {
                    console.log('Save appointment time button clicked');
                    alert('Appointment time has been saved.');
                } else if (this.textContent.includes('Cancel')) {
                    console.log('Cancel appointment button clicked');
                    alert('Appointment has been cancelled.');
                }
            });
        });
    }

    // Any additional buttons like Reset in appointments
    if (document.querySelector('.lower-buttons')) {
        document.querySelectorAll('.lower-buttons button').forEach(function(button) {
            button.addEventListener('click', function() {
                console.log(button.textContent + ' button clicked');
                if (this.textContent.includes('reset')) {
                    alert('Settings have been reset.');
                } else if (this.textContent.includes('save')) {
                    alert('Settings have been saved.');
                }
            });
        });
    }

    
});

function toggleDropdown(dropdownId) {
    // Find the dropdown content associated with the clicked button.
    var dropdownContent = document.getElementById(dropdownId);
  
    // Toggle the display of the dropdown content.
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  }
  
  // Close the dropdown menus if the user clicks outside of them.
  window.onclick = function(event) {
    if (!event.target.matches('.dropdown button')) {
      var dropdowns = document.getElementsByClassName("dropdown-content");
      for (var i = 0; i < dropdowns.length; i++) {
        var openDropdown = dropdowns[i];
        if (openDropdown.style.display === "block") {
          openDropdown.style.display = "none";
        }
      }
    }
  }

  function fetchUserBloodType(email) {
    fetch(`getBloodType.php?email=${email}`)
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('bloodTypeDisplay').textContent = `Your blood type is: ${data.bloodType}`;
        } else {
            console.error('Failed to fetch blood type:', data.message);
        }
    })
    .catch(error => console.error('Error fetching blood type:', error));
}

// Example usage
// Suppose the email is stored after login
const userEmail = 'user@example.com'; // This should be dynamically set based on the logged-in user
fetchUserBloodType(userEmail);
  