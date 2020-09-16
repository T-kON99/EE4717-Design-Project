window.onload = () => {
    let categoryCards = document.getElementById('category-cards-container').children;
    let doctorCards = document.getElementById('doctors-cards-container');
    for(let i = 0; i < categoryCards.length; i++) {
        const category = categoryCards[i];
        category.onclick = (event) => {
            category.classList.toggle('card-row-active');
            let clickedCategory = String(category.getElementsByClassName('card-title-sm')[0].innerHTML).replace(' ', '_');
            let matchDoctors = doctorCards.getElementsByClassName(clickedCategory);
            for(const doctor of matchDoctors) {
                doctor.classList.toggle('hidden');
            }
        }
    }
}