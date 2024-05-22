document.addEventListener("DOMContentLoaded", function() {
  const complaintListContainer = document.getElementById('complaintList');
  const complaintDetailContainer = document.getElementById('complaintDetailContainer');
  const complaintText = document.getElementById('complaintText');
  const replyTextarea = document.getElementById('replyTextarea');
  const logoutButton = document.getElementById('logoutButton');
  
  // Mock data for demonstration
  const complaints = [
      { id: 1, summary: "Issue with login", detail: "I cannot log into my account since yesterday." },
      { id: 2, summary: "App error", detail: "The app crashes every time I try to enter my data." }
  ];

  function displayComplaints() {
      complaints.forEach(complaint => {
          const complaintDiv = document.createElement('div');
          complaintDiv.textContent = complaint.summary;
          complaintDiv.className = 'complaint-item';
          complaintDiv.onclick = () => showComplaintDetail(complaint);
          complaintListContainer.appendChild(complaintDiv);
      });
  }

  function showComplaintDetail(complaint) {
      complaintText.textContent = complaint.detail;
      replyTextarea.value = '';
      complaintDetailContainer.style.display = 'block';
  }

  function submitReply() {
      const reply = replyTextarea.value;
      if (reply) {
          console.log(`Reply submitted for complaint: ${complaintText.textContent} Reply: ${reply}`);
          alert('Reply submitted successfully.');
          // Reset the reply area
          replyTextarea.value = '';
          complaintDetailContainer.style.display = 'none';
      } else {
          alert('Please write a reply before submitting.');
      }
  }

  // Event listener for logout
  logoutButton.addEventListener('click', function() {
      console.log('Logging out...');
      window.location.href = 'login.html'; // Redirect to login page on logout
  });

  // Initialize the complaints listing
  displayComplaints();

  // Expose submitReply to the global context so it can be called from HTML
  window.submitReply = submitReply;
});
