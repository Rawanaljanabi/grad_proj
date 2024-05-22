document.addEventListener('DOMContentLoaded', function() {
    fetchInstitutes();

    function fetchInstitutes() {
        // Fetch institutes from server
        fetch('getInstitutes.php')
        .then(response => response.json())
        .then(data => {
            const select = document.getElementById('instituteSelect');
            data.forEach(institute => {
                const option = document.createElement('option');
                option.value = institute.id;
                option.textContent = institute.name;
                select.appendChild(option);
            });
        });
    }
});
function fetchInstitutes() {
    fetch('getInstitutes.php') // Make sure the URL is correct
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        const select = document.getElementById('instituteSelect');
        select.innerHTML = ''; // Clear existing options
        data.forEach(institute => {
            const option = document.createElement('option');
            option.value = institute.id;
            option.textContent = institute.name;
            select.appendChild(option);
        });
    })
    .catch(error => {
        console.error('Error fetching institutes:', error);
    });
}


function submitPeriod() {
    const institute = document.getElementById('instituteSelect').value;
    const startDate = document.getElementById('startDate').value;
    const endDate = document.getElementById('endDate').value;
    const startTime = document.getElementById('startTime').value;
    const endTime = document.getElementById('endTime').value;

    // Construct FormData to send to server
    const formData = new FormData();
    formData.append('institute', institute);
    formData.append('startDate', startDate);
    formData.append('endDate', endDate);
    formData.append('startTime', startTime);
    formData.append('endTime', endTime);

    fetch('setPeriods.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        alert('Period set successfully!');
        // Optionally reset the form or handle other logic
    })
    .catch(error => {
        console.error('Error:', error);
    });
}
