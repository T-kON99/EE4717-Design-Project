window.onload = () => {
    let categoryCards = document.getElementById('category-cards-container').children;
    let doctorCards = document.getElementById('doctors-cards-container');
    let changeParticular = document.getElementById('change-particular');
    for(let i = 0; i < categoryCards.length; i++) {
        const category = categoryCards[i];
        category.onclick = (event) => {
            category.classList.toggle('card-row-active');
            let clickedCategory = String(category.getElementsByClassName('card-title-sm')[0].innerHTML).replace(' ', '_');
            let matchDoctors = doctorCards.getElementsByClassName(clickedCategory);
            for(const doctor of matchDoctors) {
                doctor.classList.toggle('hidden');
                // On clicking, we can see the details of the related doctor.
                doctor.onclick = (event) => {
                    if (!doctor.classList.contains('not-clickable'))
                        doctor.submit();
                }
            }
        }
    }

    if (changeParticular !== null) {
        changeParticular.onclick = function() {
            changeParticular.submit();
        }
    }
}