document.addEventListener("DOMContentLoaded", () => {
    //  Add sticky navbar, register this to onscroll event of window.
    let navbar = document.getElementById('navbar');
    let navbarWrapper = document.getElementById('navbar-wrapper');
    //  Fix the height caused by the sticky bar position being fixed so they jumped.
    window.addEventListener('resize', () => {
        navbarWrapper.style.height = navbar.clientHeight;
    });
    navbarWrapper.style.height = navbar.clientHeight;
    //  Dynamically set the navbar to be sticky.
    let stickyOffset = navbar.offsetTop;
    window.onscroll = () => {
        if (window.pageYOffset >= stickyOffset) {
            navbar.classList.add("sticky");
        } else {
            navbar.classList.remove("sticky");
        }
    };
});