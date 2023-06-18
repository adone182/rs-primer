import "./bootstrap";

import Alpine from "alpinejs";

window.Alpine = Alpine;

Alpine.start();

require("./bootstrap");

window.Echo.channel("notifikasi-channel").listen(
    ".NotifikasiDiterima",
    (data) => {
        const unreadCount = data.unreadCount;
        const badge = document.getElementById("unreadCountBadge");

        if (unreadCount > 0) {
            badge.textContent = unreadCount;
            badge.style.display = "inline";
        } else {
            badge.style.display = "none";
        }
    }
);
