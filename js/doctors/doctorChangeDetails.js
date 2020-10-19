window.onload = () => {
    // Back button listener
    let backArrow = document.getElementById('back');
    console.log(backArrow)
    backArrow.onclick = function(event) {
        window.location.href = '../../pages/doctors.php';
    }

    let appointButton = document.getElementById('btn-appoint');
    let form = document.getElementById('form-particular');
    appointButton.onclick = function(event) {
        form.submit();
    }
}