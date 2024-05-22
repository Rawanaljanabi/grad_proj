
                document.addEventListener("DOMContentLoaded", function() {
                    var defaultTitle = "Reports section";
                    var titleElement = document.getElementById("title");
                    var add = document.querySelector(".add");
                    var History = document.querySelector(".History"); // Adjust selector as necessary
                    var urgentButton = document.getElementById("Urgent");
                    var organizeButton = document.getElementById("Organize"); // Ensure this ID matches your HTML
                
                    titleElement.textContent = defaultTitle;
                
                    function hideAllContentSections() {
                        add.style.display = "none";
                        History.style.display = "none"; // Hide organize appointments content
                        // Hide other content sections as needed
                    }
                
                    urgentButton.addEventListener("click", function() {
                        hideAllContentSections(); // Hide all sections
                        HistoryContent.style.display = "block"; // Show this section
                        titleElement.textContent = "History"; // Update title
                    });
                
                   
                
                    var logoutButton = document.getElementById("logoutButton");
                    logoutButton.addEventListener("click", function() {
                        var confirmation = confirm("Are you sure you want to log out?");
                        if (confirmation) {
                            window.location.href = "page1.html";
                        }
                    });
                });
                function simulateClick() {
    document.getElementById('fileInput').click();
}

function fileSelected() {
    var fileInput = document.getElementById('fileInput');
    var filePathElement = document.getElementById('filePath');
    var fileNameDisplay = document.getElementById('fileName');
    if (fileInput.files.length > 0) {
        var fileName = fileInput.files[0].name;
        filePathElement.value = fileName; // Update the text field with the file name
        fileNameDisplay.innerText = "Selected file: " + fileName; // Display selected file name
    }
}

function submitFile() {
    var filePath = document.getElementById('filePath').value;
    if (filePath) {
        alert("File submitted: " + filePath);
        // Here you can handle the file submission, e.g., uploading to a server
    } else {
        alert("No file selected.");
    }
}
function displayFileDetails() {
    var fileInput = document.getElementById('fileInput');
    var fileNameDisplay = document.getElementById('fileName');
    var fileTypeDisplay = document.getElementById('fileType');
    var fileDetails = document.getElementById('fileDetails');

    if (fileInput.files.length > 0) {
        var selectedFile = fileInput.files[0];
        fileNameDisplay.textContent = selectedFile.name;
        fileTypeDisplay.textContent = selectedFile.type || 'Unknown';
        fileDetails.style.display = 'block'; // Show file details
    }
}

document.getElementById('submitBtn').addEventListener('click', function() {
    var fileInput = document.getElementById('fileInput');
    if (fileInput.files.length > 0) {
        // Implement the code to submit the file
        // For example, using FormData and fetch API to send the file to a server
        alert("Submit the file here. File: " + fileInput.files[0].name);
    } else {
        alert("No file selected.");
    }
});
 