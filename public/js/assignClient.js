// JavaScript to populate the multiselects based on user selection
document.getElementById('userSelect').addEventListener('change', function() {
    // Retrieve the selected user ID
    var selectedUserId = this.value;

    // Make an AJAX request to fetch owned and available clients for the selected user
    fetch('/account-manager/user-clients-data?user_id=' + selectedUserId)
    //fetch("marsman/{{ route('accountmanager.client.data') }}/user_id=" + selectedUserId)
        .then(response => response.json())
        .then(data => {

            console.log(data);
            // Populate the 'ownedClients' multiselect
            var ownedClientsSelect = document.getElementById('ownedClients');
            ownedClientsSelect.innerHTML = '';
            data.ownedClients.forEach(clientId => {
                var option = document.createElement('option');
                option.value = clientId.id;
                option.textContent = clientId.name; // Adjust this based on your client data
                ownedClientsSelect.appendChild(option);
            });

            // Populate the 'availableClients' multiselect
            var availableClientsSelect = document.getElementById('availableClients');
            availableClientsSelect.innerHTML = '';
            data.availableClients.forEach(client => {
                var option = document.createElement('option');
                option.value = client.id;
                option.textContent = client.name; // Adjust this based on your client data
                availableClientsSelect.appendChild(option);
            });
        })
        .catch(error => {
            console.error('Error:', error);
        });


    // Add double-click event listeners to both select lists
    const ownedClientsSelect = document.getElementById('ownedClients');
    const availableClientsSelect = document.getElementById('availableClients');

    ownedClientsSelect.addEventListener('dblclick', () => {
        // Move selected options from "Owned Clients" to "Available Clients"
        moveOptions(ownedClientsSelect, availableClientsSelect);
    });

    availableClientsSelect.addEventListener('dblclick', () => {
        // Move selected options from "Available Clients" to "Owned Clients"
        moveOptions(availableClientsSelect, ownedClientsSelect);
    });

    // Helper function to move selected options between select lists
    function moveOptions(sourceSelect, targetSelect) {
        const selectedOptions = Array.from(sourceSelect.selectedOptions);
        selectedOptions.forEach(option => {
            targetSelect.appendChild(option);

            console.log(selectedOptions);
        });
    }


    // Add an event listener for the "Save" button
    document.getElementById('saveButton').addEventListener('click', function () {
        const ownedClientsSelect = document.getElementById('ownedClients');

        // Select all items in the "Owned Clients" select list
        for (let i = 0; i < ownedClientsSelect.options.length; i++) {
            ownedClientsSelect.options[i].selected = true;
        }
    });

});

// Function to reset the "User" select element
function resetUserSelect() {
    const userSelect = document.getElementById('userSelect');
    userSelect.value = ''; // Reset to the default (no value) option
}

// Check if the page is being refreshed
const navigationEntries = performance.getEntriesByType("navigation");
if (navigationEntries.length > 0 && navigationEntries[0].type === "reload") {
    // Page is being refreshed, so reset the "User" dropdown
    resetUserSelect();
}