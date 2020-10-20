window.onload = () => {
    let backArrow = document.getElementById('back');
    console.log(backArrow)
    backArrow.onclick = function(event) {
        window.history.back();
    }
}