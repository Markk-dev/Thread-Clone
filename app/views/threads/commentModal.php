<div id="commentModal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center hidden">
    <div class="bg-gray-800 p-6 rounded-lg w-3/4 max-w-lg">
        <button id="closeModal" class="text-white float-right">X</button>
        <h3 class="text-xl font-bold mb-4">Comments</h3>

        <!-- Comment Form -->
        <form id="commentForm" action="/add-comment" method="POST" class="mb-4">
            <textarea name="content" class="w-full bg-gray-700 text-white p-3 rounded" placeholder="Add a comment..." required></textarea>
            <input type="hidden" name="thread_id" id="threadIdInput">
            <input type="hidden" name="parent_id" value="">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2">Post Comment</button>
        </form>

        <!-- Display Comments -->
        <div id="commentsList" class="mt-4">
            <!-- Comments will be dynamically loaded here -->
        </div>
    </div>
</div>

<script>
// Open the modal when the Comment button is clicked
const openModalButtons = document.querySelectorAll('#openModalButton');
const commentModal = document.getElementById('commentModal');
const closeModalButton = document.getElementById('closeModal');
const commentsList = document.getElementById('commentsList');
const commentForm = document.getElementById('commentForm');

// Function to fetch and display comments for the thread
function fetchComments(threadId) {
    fetch(`/comments/${threadId}`)
        .then(response => response.json())
        .then(data => {
            if (data.comments) {
                commentsList.innerHTML = ''; // Clear current comments
                data.comments.forEach(comment => {
                    appendComment(comment);
                });
            }
        });
}

// Function to append a new comment to the list
function appendComment(comment) {
    const commentElement = document.createElement('div');
    commentElement.classList.add('comment', 'mb-4');
    commentElement.innerHTML = `
        <p class="font-semibold">${comment.username}</p>
        <p>${comment.content}</p>
        <small class="text-gray-400">${comment.created_at}</small>
        <button class="text-blue-400 hover:text-blue-600 replyButton" data-parent-id="${comment.id}">Reply</button>
    `;

    // Append replies (if any)
    if (comment.replies && comment.replies.length > 0) {
        const repliesList = document.createElement('div');
        comment.replies.forEach(reply => {
            const replyElement = document.createElement('div');
            replyElement.classList.add('ml-6', 'mt-2');
            replyElement.innerHTML = `
                <p class="font-semibold">${reply.username}</p>
                <p>${reply.content}</p>
                <small class="text-gray-400">${reply.created_at}</small>
            `;
            repliesList.appendChild(replyElement);
        });
        commentElement.appendChild(repliesList);
    }

    commentsList.appendChild(commentElement);
}

// Handle opening modal
openModalButtons.forEach(button => {
    button.addEventListener('click', () => {
        const threadId = button.getAttribute('data-thread-id');
        document.getElementById('threadIdInput').value = threadId;

        // Clear comments list before fetching new comments
        commentsList.innerHTML = '';

        // Fetch and display comments for this thread
        fetchComments(threadId);

        // Show the modal
        commentModal.classList.remove('hidden');
    });
});

// Close the modal
closeModalButton.addEventListener('click', () => {
    commentModal.classList.add('hidden');
});

// Handle comment form submission (AJAX)
commentForm.addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(commentForm);
    fetch('/add-comment', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Append new comment to the list
            const newComment = data.comments[data.comments.length - 1];
            appendComment(newComment);
            commentForm.reset(); // Clear the form
        } else {
            alert(data.message);
        }
    });
});

// Handle reply button click
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('replyButton')) {
        const parentId = event.target.getAttribute('data-parent-id');
        document.querySelector('input[name="parent_id"]').value = parentId;
    }
});

</script>
