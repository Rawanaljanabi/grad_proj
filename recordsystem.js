 
    document.addEventListener("DOMContentLoaded", function() {
      var defaultGreeting = "Welcom to Record System";
      var greetingElement = document.getElementById("greeting");

      greetingElement.textContent = defaultGreeting;
  });
  
  document.addEventListener("DOMContentLoaded", function() {
      var logoutButton = document.getElementById("logoutButton");
      logoutButton.addEventListener("click", function() {
          var confirmation = confirm("Are you sure you want to log out?");
          if (confirmation) {
              window.location.href = "login1.php";
          }
      });
  });
  