document.addEventListener("DOMContentLoaded", function() {
  var greetingElement = document.getElementById("greeting");
  var defaultGreeting = "Shift schedule ";
  var departmentDropdown = document.getElementById('departmentDropdown');
  var scheduleContentEmergency = document.getElementById('scheduleContent'); // Container for emergency department
  var scheduleTableEmergency = document.getElementById('scheduleTable'); // Table for emergency department
  var scheduleContentPediatrics = document.getElementById('scheduleContent2'); // Container for pediatrics department
  var scheduleTablePediatrics = document.getElementById('scheduleTable2'); // Table for pediatrics department

  greetingElement.textContent = defaultGreeting;

  // Change the greeting text
  function changeGreeting(text) {
    greetingElement.textContent = text;
  }

  // Hide all content sections
  function hideAllContentSections() {
    document.querySelectorAll('.shiftschedualcontent, .services-content').forEach(function(section) {
      section.style.display = 'none';
    });
  }

  // Show and hide schedule content based on the department selection
  function handleDepartmentChange() {
      scheduleContentEmergency.style.display = 'none';
      scheduleTableEmergency.style.display = 'none';
      scheduleContentPediatrics.style.display = 'none';
      scheduleTablePediatrics.style.display = 'none';

      if (departmentDropdown.value === 'emergency') {
          scheduleContentEmergency.style.display = 'block';
          scheduleTableEmergency.style.display = 'block';
      } else if (departmentDropdown.value === 'pediatrics') {
          scheduleContentPediatrics.style.display = 'block';
          scheduleTablePediatrics.style.display = 'block';
      }
  }

  // Event handler for changing departments
  departmentDropdown.addEventListener('change', handleDepartmentChange);

  // Event handler for the Shift Schedule button
  document.getElementById("shiftButton").addEventListener("click", function() {
    changeGreeting("Shift Schedule");
    hideAllContentSections();
    document.querySelector('.shiftschedualcontent').style.display = 'block';
  });

  // Logout button event handler
  document.getElementById("logoutButton").addEventListener("click", function() {
      if (confirm("Are you sure you want to log out?")) {
        window.location.href = "login1.html";
      }
  });
});
