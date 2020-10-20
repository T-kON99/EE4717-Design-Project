window.onload = () => {
    // Back button listener
    let backArrow = document.getElementById('back');
    console.log(backArrow)
    backArrow.onclick = function() {
        window.history.back();
    }

    // Appoint button listener
    let appointButton = document.getElementById('btn-appoint');
    let payload = document.getElementById('form-hidden');
    appointButton.onclick = function() {
        payload.submit();
    }
}