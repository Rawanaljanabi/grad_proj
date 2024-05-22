document.getElementById('registrationForm').addEventListener('submit', function(event) {
  event.preventDefault(); // Prevent the form from submitting via the browser

  var data = {
    full_name: document.getElementById('fullName').value,
    phone_number: document.getElementById('phoneNumber').value,
    email: document.getElementById('email').value,
    password: document.getElementById('password').value
  };

  fetch('http://localhost:3000/register', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(data),
  })
  .then(response => response.json())
  .then(data => {
    console.log('Success:', data);
    alert('Registration successful!');
  })
  .catch((error) => {
    console.error('Error:', error);
    alert('Error registering user.');
  });
});

