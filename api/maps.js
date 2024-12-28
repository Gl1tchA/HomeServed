        // Initialize the map and set the view to a starting position
        const map = L.map('map').setView([51.505, -0.09], 13); // Default to London

        // Add OpenStreetMap tiles
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
          attribution: '© OpenStreetMap contributors',
        }).addTo(map);

        // Marker for the chosen location
        let marker;

        // Function to fetch the address using Nominatim API
        async function getAddress(lat, lng) {
          const response = await fetch(`https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1`);
          if (response.ok) {
            const data = await response.json();
            return data.display_name || "Address not found";
          } else {
            return "Unable to fetch address";
          }
        }

        // Handle map clicks
        map.on('click', async function (e) {
          const { lat, lng } = e.latlng;

          // Update or create marker
          if (marker) {
            marker.setLatLng([lat, lng]);
          } else {
            marker = L.marker([lat, lng]).addTo(map);
          }

          // Fetch and display address in the input field
          const address = await getAddress(lat, lng);
          document.getElementById('address-input').value = address; // Update input field with the selected address
        });

        // When the input field changes (manual address input)
        document.getElementById('address-input').addEventListener('input', function() {
          const inputValue = this.value;
          if (inputValue.trim() !== "") {
            // Address is updated directly in the input field (no need for other display)
          }
        });