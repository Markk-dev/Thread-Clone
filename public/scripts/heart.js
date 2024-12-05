



document.querySelectorAll('.heart-btn').forEach(button => {
    button.addEventListener('click', function() {
        let threadId = this.getAttribute('data-thread-id');

        // Send AJAX request to like the thread
        fetch(`/home/heart/` + threadId, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-Requested-With': 'XMLHttpRequest'
            },
            body: JSON.stringify({ thread_id: threadId })
        })
        .then(response => response.json())
        .then(data => {
            // Update the heart count on success
            if (data.success) {
                this.textContent = '❤️ ' + data.newHeartCount;  // Update the heart count on the button
            } else {
                alert('Failed to like the thread');
            }
        })
        .catch(error => console.error('Error:', error));
    });
});

