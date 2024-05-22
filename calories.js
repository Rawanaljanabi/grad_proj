document.addEventListener("DOMContentLoaded", function() {
    var defaultGreeting = "Calories & Steps";
    var greetingElement = document.getElementById("greeting");
    greetingElement.textContent = defaultGreeting;

    var logoutButton = document.getElementById("logoutButton");
    logoutButton.addEventListener("click", function() {
        var confirmation = confirm("Are you sure you want to log out?");
        if (confirmation) {
            window.location.href = "login1.php";
        }
    });

    document.getElementById('calorieForm').addEventListener('submit', calculateSteps);
    document.getElementById('stepsInput').addEventListener('input', updateProgressBar); // Listen for input changes on steps
});

function calculateSteps(event) {
    event.preventDefault();
    const caloriesGoal = parseFloat(document.getElementById('caloriesInput').value);
    const weight = parseFloat(document.getElementById('weightInput').value);
    
    // Assuming 0.04 calories per step and an average speed of 100 steps/min (5 km/h)
    // Adjusting calories per step based on weight
    const caloriesPerStep = 0.0005 * weight; // Adjusted based on user's weight
    const stepsPerMinute = 100;

    const stepsNeeded = Math.round(caloriesGoal / caloriesPerStep);
    const minutesRequired = Math.round(stepsNeeded / stepsPerMinute);

    document.getElementById('stepsNeeded').textContent = `Steps needed: ${stepsNeeded}`;
    document.getElementById('timeRequired').textContent = `Time required: ${minutesRequired} minutes`;
    document.getElementById('stepsGoal').value = stepsNeeded; // Setting the steps goal dynamically

    updateProgressBar(); // Update progress bar
}

function updateProgressBar() {
    const stepsGoal = parseFloat(document.getElementById('stepsGoal').value || 0);
    const stepsTaken = parseFloat(document.getElementById('stepsInput').value || 0);
    const percentage = stepsTaken / stepsGoal * 100;
    
    const progressCircle = document.querySelector('.progress-circle');
    progressCircle.style.setProperty('--percentage', `${Math.min(Math.round(percentage), 100)}%`); // Ensure the percentage is between 0 and 100
    progressCircle.setAttribute('data-percentage', Math.min(Math.round(percentage), 100));
    document.querySelector('.progress-value').textContent = `${Math.min(Math.round(percentage), 100)}%`;
}
