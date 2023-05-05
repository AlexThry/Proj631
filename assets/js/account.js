
window.addEventListener('load', function() {
    let selectedButton = document.querySelector('aside > .btn-secondary');

    let buttons = document.querySelectorAll('aside .btn-secondary');
    buttons.forEach(button => {
        button.addEventListener('click', () => {
            if(selectedButton) {
                selectedButton.classList.add('btn-disabled');
            }

            button.classList.remove('btn-disabled');
            selectedButton = button;
        })
    })
});