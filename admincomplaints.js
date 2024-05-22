document.addEventListener("DOMContentLoaded", function() {
  var defaultGreeting = "Complaints";
  var greetingElement = document.getElementById("greeting");

  greetingElement.textContent = defaultGreeting;

  loadInbox();
});

function loadInbox() {
  const complaintListElement = document.getElementById('complaintList');
  complaintListElement.innerHTML = '';

  fetch('fetch_complaintsa.php')
      .then(response => response.json())
      .then(complaints => {
          complaints.forEach(complaint => {
              const complaintDiv = document.createElement('div');
              complaintDiv.textContent = complaint.subject;
              if (complaint.response_status === 'new') {
                  const indicator = document.createElement('span');
                  indicator.className = 'new-complaint-indicator';
                  complaintDiv.appendChild(indicator);
              }
              complaintDiv.onclick = () => showComplaintDetail(complaint.id, complaint.subject, complaint.complaint_text);
              complaintListElement.appendChild(complaintDiv);
          });
      });
}

function showComplaintDetail(id, subject, text) {
  document.getElementById('complaintText').textContent = text;
  document.getElementById('replyTextarea').setAttribute('data-complaint-id', id);

  document.getElementById('inboxContainer').style.display = 'none';
  document.getElementById('complaintDetailContainer').style.display = 'block';

  history.pushState({ complaintId: id }, '', '#complaint-' + id);
}

function submitReply() {
  const complaintId = document.getElementById('replyTextarea').getAttribute('data-complaint-id');
  const reply = document.getElementById('replyTextarea').value;

  fetch('submit_reply.php', {
      method: 'POST',
      headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
      },
      body: `id=${complaintId}&reply=${reply}`
  })
  .then(response => response.text())
  .then(data => {
      alert(data);
      loadInbox();
      document.getElementById('inboxContainer').style.display = 'block';
      document.getElementById('complaintDetailContainer').style.display = 'none';
  });
}

window.onpopstate = function(event) {
  if (event.state && event.state.complaintId) {
      showComplaintDetail(event.state.complaintId);
  } else {
      document.getElementById('inboxContainer').style.display = 'block';
      document.getElementById('complaintDetailContainer').style.display = 'none';
  }
};

document.addEventListener('DOMContentLoaded', function() {
  const complaintId = window.location.hash.match(/#complaint-(\d+)/);
  if (complaintId && complaintId[1]) {
      showComplaintDetail(parseInt(complaintId[1], 10));
  } else {
      loadInbox();
  }
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
