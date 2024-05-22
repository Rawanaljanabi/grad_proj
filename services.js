document.addEventListener("DOMContentLoaded", function() {
    const serviceItems = document.querySelectorAll('.service-item .toggle-input');
    const saveButton = document.getElementById('saveButton');

    saveButton.addEventListener('click', function() {
        const updates = [];

        serviceItems.forEach(item => {
            const serviceName = item.closest('.service-item').querySelector('.service-name').textContent.trim();
            const isActive = item.checked;

            updates.push({
                serviceName: serviceName,
                isActive: isActive
            });
        });

        fetch('services.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(updates)
        }).then(response => response.text())
        .then(data => alert(data))
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while updating the service status.');
        });
    });
});
