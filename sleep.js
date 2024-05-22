document.getElementById('saveGoalButton').addEventListener('click', function() {
    const sleepGoal = document.getElementById('sleepGoalInput').value;
    localStorage.setItem('sleepGoal', sleepGoal); // Save sleep goal locally
  });
  
  document.getElementById('saveSleepButton').addEventListener('click', function() {
    const sleepGoal = localStorage.getItem('sleepGoal'); // Retrieve the saved sleep goal
    const hoursSlept = document.getElementById('hoursSleptInput').value;
    const currentDate = new Date().toISOString().slice(0, 10); // Get current date in YYYY-MM-DD format
  
    // Add new entry to the table
    const table = document.getElementById('historyList');
    const row = table.insertRow();
    const cell1 = row.insertCell(0);
    const cell2 = row.insertCell(1);
    const cell3 = row.insertCell(2);
    cell1.textContent = sleepGoal;
    cell2.textContent = hoursSlept;
    cell3.textContent = currentDate;
  });
  
  // Load sleep goal on page load
  window.onload = function() {
    const savedGoal = localStorage.getItem('sleepGoal');
    if (savedGoal) {
      document.getElementById('sleepGoalInput').value = savedGoal;
    }
  };
  document.addEventListener("DOMContentLoaded", function() {
    var defaultGreeting = "Sleep Tracking";
    var greetingElement = document.getElementById("greeting");

    greetingElement.textContent = defaultGreeting;
});

document.addEventListener("DOMContentLoaded", function() {
    var logoutButton = document.getElementById("logoutButton");
    logoutButton.addEventListener("click", function() {
        var confirmation = confirm("Are you sure you want to log out?");
        if (confirmation) {
            window.location.href = "login.html";
        }
    });
});  