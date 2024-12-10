const openModalButtons = document.querySelectorAll('#openModalButton');
const commentModal = document.getElementById('commentModal');
const closeModalButton = document.getElementById('closeModal');
const commentsList = document.getElementById('commentsList');
const commentForm = document.getElementById('commentForm');

// Fetch comments for a thread
function fetchComments(threadId) {
    fetch(`/comments/${threadId}`)
        .then(response => response.json())
        .then(data => {
            commentsList.innerHTML = ''; // Clear comments
            data.comments.forEach(comment => appendComment(comment));
        });
}

// Append a comment to the list
function appendComment(comment) {
    const commentElement = document.createElement('div');
    commentElement.classList.add('comment', 'mb-4', 'flex', 'items-start', 'space-x-4');

    commentElement.innerHTML = `
      <img 
    src="${comment.profile_image ? '/uploads/profile/' + comment.profile_image : '/uploads/default/default.jpg'}" 
    alt="Profile Image" 
    class="w-10 h-10 rounded-full object-cover"
/>


        <div>
            <p class="font-semibold">${comment.username}</p>
            <p>${comment.content}</p>
            <small class="text-gray-400">${comment.created_at}</small>
            <button class="text-blue-400 hover:text-blue-600 replyButton" data-parent-id="${comment.id}">Reply</button>
            <div class="replies mt-4 ml-6"></div>
        </div>
    `;

    // Handle replies
    if (comment.replies && comment.replies.length > 0) {
        const repliesList = commentElement.querySelector('.replies');
        comment.replies.forEach(reply => appendCommentToReplies(reply, repliesList));
    }

    commentsList.appendChild(commentElement);
}


// Append a reply to a comment's replies
function appendCommentToReplies(reply, repliesContainer) {
    const replyElement = document.createElement('div');
    replyElement.classList.add('flex', 'items-start', 'space-x-4', 'mb-4');

    replyElement.innerHTML = `
        <img 
            src="${reply.profile_image ? '/uploads/profile/' + reply.profile_image : '/uploads/default/default.jpg'}" 
            alt="Profile Image" 
            class="w-8 h-8 rounded-full object-cover"
        />
        <div>
            <p class="font-semibold">${reply.username}</p>
            <p>${reply.content}</p>
            <small class="text-gray-400">${reply.created_at}</small>
        </div>
    `;

    repliesContainer.appendChild(replyElement);
}


// Handle reply button click
commentsList.addEventListener('click', function (event) {
    if (event.target.classList.contains('replyButton')) {
        const parentId = event.target.getAttribute('data-parent-id');
        const parentComment = event.target.closest('.comment');
        
        // Remove any existing reply box
        const existingReplyBox = document.querySelector('.reply-box');
        if (existingReplyBox) existingReplyBox.remove();

        // Create a reply box
        const replyBox = document.createElement('div');
        replyBox.classList.add('reply-box', 'mt-2', 'ml-6');
        replyBox.innerHTML = `
            <textarea class="w-full bg-gray-700 text-white p-3 rounded" placeholder="Reply to this comment..." required></textarea>
            <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2 replySubmitButton">Post Reply</button>
        `;
        parentComment.appendChild(replyBox);

        // Handle reply submission
        replyBox.querySelector('.replySubmitButton').addEventListener('click', () => {
            const replyContent = replyBox.querySelector('textarea').value;
            if (!replyContent.trim()) {
                alert('Reply content cannot be empty.');
                return;
            }

            // Send reply to the server
            const formData = new FormData();
            formData.append('content', replyContent);
            formData.append('parent_id', parentId);
            formData.append('thread_id', document.getElementById('threadIdInput').value);

            fetch('/add-comment', {
                method: 'POST',
                body: formData,
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Refresh comments to avoid duplicates
                        fetchComments(document.getElementById('threadIdInput').value);
                        replyBox.remove(); // Remove the reply box
                    } else {
                        alert(data.message);
                    }
                });
        });
    }
});

// Open the modal
openModalButtons.forEach(button => {
    button.addEventListener('click', () => {
        const threadId = button.getAttribute('data-thread-id');
        document.getElementById('threadIdInput').value = threadId;

        commentsList.innerHTML = ''; // Clear comments
        fetchComments(threadId); // Fetch and display comments
        commentModal.classList.remove('hidden'); // Show modal
    });
});

// Close the modal
closeModalButton.addEventListener('click', () => {
    commentModal.classList.add('hidden');
});

// Handle main comment form submission
commentForm.addEventListener('submit', function (event) {
    event.preventDefault();
    const formData = new FormData(commentForm);

    fetch('/add-comment', {
        method: 'POST',
        body: formData,
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Refresh comments to avoid duplicates
                fetchComments(document.getElementById('threadIdInput').value);
                commentForm.reset(); // Clear the form
            } else {
                alert(data.message);
            }
        });
});




