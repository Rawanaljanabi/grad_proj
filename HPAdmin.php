<!DOCTYPE html>
<html lang="en">
<head>
  
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="HPAdmin.css">
    <title>Shift Schedual </title>
</head>
<body>
<img class="vectors" src="blu vec.png">
    <img class="vectors2" src="pink vec.png">
<!-- Sidebar -->
<aside class="sidebar">
  <h1>Care</h1>
  <ul> 
    <li><button onclick="location.href='Shift.php'" id="shift" type="button" class="buttons">Shift Schedule</button></li>
    <li><button onclick="location.href='report.php'" id="report" type="button" class="buttons">Reports</button></li>
    <li><button onclick="location.href='services.php'" id="services" type="button" class="buttons">Services</button></li>
    <li><button onclick="location.href='events.php'" id="events" type="button" class="buttons">Events</button></li>
    <li><button onclick="location.href='admincomplaints.php'" id="complaint" type="button" class="buttons">Complaints</button></li>
  </ul>
</aside>

<!-- Top bar -->
<header class="topbar">
  <div>
    <p id="greeting" style="white-space: nowrap;"> HomePage</p>
  </div>
  <ul>
    <li>
      <a href="HPAdmin.php" class="home-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-house" viewBox="0 0 16 16">
            <path d="M8.707 1.5a1 1 0 0 0-1.414 0L.646 8.146a.5.5 0 0 0 .708.708L2 8.207V13.5A1.5 1.5 0 0 0 3.5 15h9a1.5 1.5 0 0 0 1.5-1.5V8.207l.646.647a.5.5 0 0 0 .708-.708L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293zM13 7.207V13.5a.5.5 0 0 1-.5.5h-9a.5.5 0 0 1-.5-.5V7.207l5-5z"/>
        </svg>
    </a>
</li>
<li><button onclick="location.href='login1.php'" id="logoutButton" type="button" class="logout">Log Out</button></li>
    </ul>
</header>

<!-- Main content -->
<div class="container">
  
</div>

<script>
document.getElementById("shiftButton").addEventListener("click", function() {
    changeGreeting("HomePage");
    hideAllContentSections();
    document.querySelector('.shiftschedualcontent').style.display = 'block';
  });

document.getElementById("logoutButton").addEventListener("click", function() {
      if (confirm("Are you sure you want to log out?")) {
        window.location.href = "login1.php";
      }
  });
  </script>      
</body>
</html>