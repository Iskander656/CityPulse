document.addEventListener("DOMContentLoaded", function () {
    const mapElement = document.getElementById("admin-city-map");

    if (!mapElement || typeof L === "undefined") {
        return;
    }

    const reportsElement = document.getElementById("admin-map-reports");
    const reports = JSON.parse(reportsElement.textContent);

    const map = L.map("admin-city-map").setView([37.9601, 58.3261], 12);

    L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution: "&copy; OpenStreetMap contributors",
        maxZoom: 19,
    }).addTo(map);

    const statusColors = {
        submitted: "#06b6d4",
        "under-review": "#3b82f6",
        "in-progress": "#8b5cf6",
        rejected: "#ef4444",
    };

    const markers = [];

    reports.forEach(function (report) {
        const latitude = Number(report.latitude);
        const longitude = Number(report.longitude);

        if (!Number.isFinite(latitude) || !Number.isFinite(longitude)) {
            return;
        }

        const status = report.status?.slug ?? "submitted";
        const color = statusColors[status] ?? "#64748b";

        const marker = L.circleMarker([latitude, longitude], {
            radius: 9,
            color: "#ffffff",
            weight: 2,
            fillColor: color,
            fillOpacity: 1,
        }).addTo(map);

        const popup = `
    <div class="admin-report-popup">
        <div class="popup-header">
            <span class="popup-label">CITYPULSE REPORT</span>
            <span class="popup-status">${escapeHTML(report.status?.name ?? "Unknown")}</span>
        </div>

        <h3>${escapeHTML(report.title ?? "Untitled Report")}</h3>

        <div class="popup-category">
            ${escapeHTML(report.category?.name ?? "Uncategorized")}
        </div>

        <div class="popup-divider"></div>

        <div class="popup-section">
            <span class="popup-field">DESCRIPTION</span>
            <p>${escapeHTML(report.description ?? "No description provided.")}</p>
        </div>

        <div class="popup-section">
            <span class="popup-field">LOCATION</span>
            <p>${escapeHTML(report.address ?? "No address provided")}</p>
        </div>

        <div class="popup-footer">
            <span>SUBMITTED</span>
            <span>${formatDate(report.created_at)}</span>
        </div>
    </div>
`;

        marker.bindPopup(popup);
        markers.push(marker);
    });
    function formatDate(date) {
        if (!date) return "Unknown";

        return new Date(date).toLocaleString();
    }
    function escapeHTML(value) {
        return String(value).replace(/[&<>"']/g, function (character) {
            return {
                "&": "&amp;",
                "<": "&lt;",
                ">": "&gt;",
                '"': "&quot;",
                "'": "&#039;",
            }[character];
        });
    }
});
