document.addEventListener("DOMContentLoaded", function () {
    const modal = document.getElementById("location-picker");
    const openButton = document.getElementById("open-location-picker");
    const closeButton = document.getElementById("close-location-picker");
    const cancelButton = document.getElementById("cancel-location-picker");
    const confirmButton = document.getElementById("confirm-location-picker");
    const searchInput = document.getElementById("location-search");
    const searchResults = document.getElementById("location-search-results");
    const status = document.getElementById("picker-status");
    const summary = document.getElementById("location-summary");
    const latitudeInput = document.getElementById("latitude");
    const longitudeInput = document.getElementById("longitude");
    const addressInput = document.querySelector('input[name="address"]');

    const currentLocationButton = document.getElementById("picker-current-location");

    if (
        !modal ||
        !openButton ||
        !closeButton ||
        !cancelButton ||
        !confirmButton ||
        !searchInput ||
        !searchResults ||
        !status ||
        !summary ||
        !latitudeInput ||
        !longitudeInput ||
        !addressInput ||
        !currentLocationButton ||
        !document.getElementById("cp-location-map")
    ) {
        return;
    }

    let map = null;
    let marker = null;
    let selected = null;
    let selectedAddress = "";
    let lookupTimer = null;
    let lookupSequence = 0;
    let lastNominatimRequest = 0;

    function setStatus(message) {
        status.textContent = message;
    }

    function openPicker() {
        if (!window.L) {
            setStatus("The map library could not load. Please refresh the page.");
            return;
        }
        modal.classList.add("is-open");
        modal.setAttribute("aria-hidden", "false");
        document.body.style.overflow = "hidden";

        if (!map) {
            map = L.map("cp-location-map", {
                zoomControl: false,
                preferCanvas: true,
            }).setView([37.95, 58.38], 13);
            L.tileLayer("https://tile.openstreetmap.org/{z}/{x}/{y}.png", {
                attribution:
                    '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap contributors</a>',
                maxZoom: 19,
            }).addTo(map);
            L.control.zoom({ position: "bottomright" }).addTo(map);
            map.on("click", (event) =>
                chooseLocation(event.latlng.lat, event.latlng.lng),
            );
        }

        setTimeout(() => {
            map.invalidateSize();
            const oldLat = parseFloat(latitudeInput.value);
            const oldLng = parseFloat(longitudeInput.value);
            if (Number.isFinite(oldLat) && Number.isFinite(oldLng)) {
                map.setView([oldLat, oldLng], 16);
                chooseLocation(oldLat, oldLng, false);
            }
        }, 150);
    }

    function closePicker() {
        modal.classList.remove("is-open");
        modal.setAttribute("aria-hidden", "true");
        document.body.style.overflow = "";
    }

    async function reverseGeocode(lat, lng, sequence) {
        clearTimeout(lookupTimer);
        lookupTimer = setTimeout(async () => {
            const wait = Math.max(
                0,
                1100 - (Date.now() - lastNominatimRequest),
            );
            await new Promise((resolve) => setTimeout(resolve, wait));
            if (sequence !== lookupSequence) return;
            lastNominatimRequest = Date.now();
            try {
                const response = await fetch(
                    `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`,
                );
                if (!response.ok) throw new Error("Address lookup failed");
                const data = await response.json();
                if (sequence !== lookupSequence) return;
                selectedAddress = data.display_name || "";
                setStatus(
                    selectedAddress ||
                        "Location selected. Address unavailable.",
                );
            } catch (error) {
                if (sequence === lookupSequence) {
                    selectedAddress = "";
                    setStatus("Location selected. Address lookup unavailable.");
                }
            }
        }, 500);
    }

    function chooseLocation(lat, lng, lookup = true) {
        selected = { lat, lng };
        if (!marker) {
            marker = L.marker([lat, lng], { draggable: true }).addTo(map);
            marker.on("dragend", () => {
                const point = marker.getLatLng();
                chooseLocation(point.lat, point.lng);
            });
        } else {
            marker.setLatLng([lat, lng]);
        }
        confirmButton.disabled = false;
        selectedAddress = "";
        setStatus(
            `Selected: ${lat.toFixed(6)}, ${lng.toFixed(6)} — finding address...`,
        );
        if (lookup) reverseGeocode(lat, lng, ++lookupSequence);
    }

    async function searchPlaces() {
        const query = searchInput.value.trim();
        if (!query) return;
        searchResults.textContent = "Searching...";
        try {
            const wait = Math.max(
                0,
                1100 - (Date.now() - lastNominatimRequest),
            );
            await new Promise((resolve) => setTimeout(resolve, wait));
            lastNominatimRequest = Date.now();
            const response = await fetch(
                `https://nominatim.openstreetmap.org/search?format=jsonv2&limit=5&q=${encodeURIComponent(query)}`,
            );
            if (!response.ok) throw new Error("Search failed");
            const places = await response.json();
            searchResults.replaceChildren();
            if (!places.length) {
                searchResults.textContent = "No locations found.";
                return;
            }
            places.forEach((place) => {
                const button = document.createElement("button");
                button.type = "button";
                button.className = "cp-location-result";
                button.textContent = place.display_name;
                button.addEventListener("click", () => {
                    const lat = Number(place.lat);
                    const lng = Number(place.lon);
                    map.setView([lat, lng], 17);
                    chooseLocation(lat, lng);
                    searchResults.replaceChildren();
                });
                searchResults.appendChild(button);
            });
        } catch (error) {
            searchResults.textContent = "Search is temporarily unavailable.";
        }
    }

    openButton.addEventListener("click", openPicker);
    closeButton.addEventListener("click", closePicker);
    cancelButton.addEventListener("click", closePicker);
    searchInput.addEventListener("keydown", (event) => {
        if (event.key === "Enter") {
            event.preventDefault();
            searchPlaces();
        }
        if (event.key === "Escape") searchResults.replaceChildren();
    });
    currentLocationButton.addEventListener("click", () => {
        if (!navigator.geolocation) {
            setStatus("Geolocation is not supported by this browser.");
            return;
        }
        setStatus("Finding your current location...");
        navigator.geolocation.getCurrentPosition(
            (position) => {
                const lat = position.coords.latitude;
                const lng = position.coords.longitude;
                map.setView([lat, lng], 17);
                chooseLocation(lat, lng);
            },
            (error) => {
                setStatus(
                    error.code === 1
                        ? "Location permission denied. Allow location access in your browser."
                        : "Unable to determine your location.",
                );
            },
            { enableHighAccuracy: true, timeout: 15000 },
        );
    });
    confirmButton.addEventListener("click", () => {
        if (!selected) return;
        latitudeInput.value = selected.lat.toFixed(7);
        longitudeInput.value = selected.lng.toFixed(7);
        if (selectedAddress) addressInput.value = selectedAddress;
        summary.textContent = selectedAddress
            ? selectedAddress
            : `${selected.lat.toFixed(6)}, ${selected.lng.toFixed(6)}`;
        summary.classList.remove("text-secondary");
        summary.classList.add("text-info");
        closePicker();
    });
    modal.addEventListener("click", (event) => {
        if (event.target === modal) closePicker();
    });
    document.addEventListener("keydown", (event) => {
        if (event.key === "Escape" && modal.classList.contains("is-open"))
            closePicker();
    });
});
