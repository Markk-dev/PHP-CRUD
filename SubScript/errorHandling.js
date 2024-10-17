document.addEventListener('DOMContentLoaded', () => {
        const errorMessage = document.querySelector('.error-message');
        if (errorMessage) {
            setTimeout(() => {
                errorMessage.classList.add('hidden'); 
            }, 2500); 
        }
    });

