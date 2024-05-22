document.addEventListener("DOMContentLoaded", function() {
  var defaultGreeting = "Heart Rate";
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

document.getElementById('saveButton').addEventListener('click', function() {
  var heartRate = document.getElementById('heartRateInput').value;
  var date = new Date().toLocaleDateString("en-US");
  var range = getRange(heartRate);

  // Update the color indicator based on the BPM
  updateColorIndicator(parseInt(heartRate, 10));

  // Add entry to history table
  var historyList = document.getElementById('historyList');
  var row = historyList.insertRow(); // Insert a new row at the end of the table
  var cell1 = row.insertCell(0); // Create a cell for the reading
  var cell2 = row.insertCell(1); // Create a cell for the range
  var cell3 = row.insertCell(2); // Create a cell for the date

  cell1.textContent = heartRate;
  cell2.textContent = range;
  cell3.textContent = date;

  // Clear input
  document.getElementById('heartRateInput').value = '';

  // Check for maximum and minimum heart rates
  if (range === 'Maximum') {
      alert('Your heart rate has reached the maximum level!');
  } else if (range === 'Very Light') {
      alert('Your heart rate has reached the lowest level!');
  }
});

function updateColorIndicator(bpm) {
  var element = document.querySelector(".color-indicator");
  element.children[0].className = "";
  element.children[1].className = "";
  element.children[2].className = "";
  element.children[3].className = "";
  element.children[4].className = "";

  if (bpm < 60) element.children[4].className = "verylight";
  else if (bpm >= 60 && bpm < 70) element.children[3].className = "light";
  else if (bpm >= 70 && bpm < 85) element.children[2].className = "moderate";
  else if (bpm >= 85 && bpm < 100) element.children[1].className = "hard";
  else element.children[0].className = "maximum";
}

function getRange(bpm) {
  bpm = parseInt(bpm, 10);
  if (bpm < 60) return 'Very Light';
  else if (bpm >= 60 && bpm < 70) return 'Light';
  else if (bpm >= 70 && bpm < 85) return 'Moderate';
  else if (bpm >= 85 && bpm < 100) return 'Hard';
  else return 'Maximum';
}
