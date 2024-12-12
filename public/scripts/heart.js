document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.heart-btn').forEach(button => {
        button.addEventListener('click', function () {
            const threadId = this.dataset.threadId;
            const heartIcon = this.querySelector('.material-icons');
            const heartCountSpan = this.querySelector('span:last-child');

            fetch(`/heart-thread/${threadId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                }
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        if (data.status === "hearted") {
                            heartIcon.textContent = "favorite";
                            heartIcon.classList.add("text-red-500");
                            heartIcon.classList.remove("text-gray-400");
                        } else {
                            heartIcon.textContent = "favorite_border";
                            heartIcon.classList.add("text-gray-400");
                            heartIcon.classList.remove("text-red-500");
                        }
                        heartCountSpan.textContent = data.heartCount;
                    }
                })
                .catch(err => console.error("Error toggling heart:", err));
        });
    });
});
