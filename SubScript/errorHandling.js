document.addEventListener('DOMContentLoaded', () => {
        const errorMessage = document.querySelector('.error-message');
        if (errorMessage) {
            setTimeout(() => {
                errorMessage.classList.add('hidden'); 
            }, 2500); 
        }
    });

    function confirmDelete() {
        return confirm("Are you sure you want to delete this user?");
    }
    