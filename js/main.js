document.addEventListener("DOMContentLoaded", () => {
    //  Add sticky navbar, register this to onscroll event of window.
    let navbar = document.getElementById('navbar');
    let stickyOffset = navbar.offsetTop;
    window.onscroll = () => {
        if (window.pageYOffset >= stickyOffset) {
            navbar.classList.add("sticky")
        } else {
            navbar.classList.remove("sticky");
        }
    };
});