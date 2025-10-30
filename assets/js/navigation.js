document.addEventListener("DOMContentLoaded", () => {
    const toggle = document.getElementById("navToggle");
    const mobile = document.getElementById("navMobile");

    toggle.addEventListener("click", () => {
        mobile.classList.toggle("open");
    });
});