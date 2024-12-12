const openModalButtons = document.querySelectorAll('#openModalButton');
const commentModal = document.getElementById('commentModal');
const closeModalButton = document.getElementById('closeModal');
const commentsList = document.getElementById('commentsList');
const commentForm = document.getElementById('commentForm');


function fetchComments(threadId) {
    fetch(`/comments/${threadId}`)
        .then(response => response.json())
        .then(data => {
            commentsList.innerHTML = ''; 
            data.comments.forEach(comment => appendComment(comment));
        });
}

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
            <button class="text-red-400 hover:text-red-600 deleteCommentButton" data-comment-id="${comment.id}">Delete</button>
            <div class="replies mt-4 ml-6"></div>
        </div>
    `;

    if (comment.replies && comment.replies.length > 0) {
        const repliesList = commentElement.querySelector('.replies');
        comment.replies.forEach(reply => appendCommentToReplies(reply, repliesList));
    }

    commentsList.appendChild(commentElement);
}


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
            <button class="text-red-400 hover:text-red-600 deleteCommentButton" data-comment-id="${reply.id}">Delete</button>
        </div>
    `;

    repliesContainer.appendChild(replyElement);
}


commentsList.addEventListener('click', function (event) {
    if (event.target.classList.contains('replyButton')) {
        const parentId = event.target.getAttribute('data-parent-id');
        const parentComment = event.target.closest('.comment');
        
        
        const existingReplyBox = document.querySelector('.reply-box');
        if (existingReplyBox) existingReplyBox.remove();

        
        const replyBox = document.createElement('div');
        replyBox.classList.add('reply-box', 'mt-2', 'ml-6');
        replyBox.innerHTML = `
            <textarea class="w-full bg-gray-700 text-white p-3 rounded" placeholder="Reply to this comment..." required></textarea>
            <button class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2 replySubmitButton">Post Reply</button>
        `;
        parentComment.appendChild(replyBox);

        
        replyBox.querySelector('.replySubmitButton').addEventListener('click', () => {
            const replyContent = replyBox.querySelector('textarea').value;
            if (!replyContent.trim()) {
                alert('Reply content cannot be empty.');
                return;
            }

            
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
                        fetchComments(document.getElementById('threadIdInput').value);
                        replyBox.remove();
                    } else {
                        alert(data.message);
                    }
                });
        });
    }
});


openModalButtons.forEach(button => {
    button.addEventListener('click', () => {
        const threadId = button.getAttribute('data-thread-id');
        document.getElementById('threadIdInput').value = threadId;

        commentsList.innerHTML = ''; 
        fetchComments(threadId); 
        commentModal.classList.remove('hidden'); 
    });
});


closeModalButton.addEventListener('click', () => {
    commentModal.classList.add('hidden');
});


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
                fetchComments(document.getElementById('threadIdInput').value);
                commentForm.reset();
            } else {
                alert(data.message);
            }
        });
});

commentsList.addEventListener('click', function (event) {
    if (event.target.classList.contains('deleteCommentButton')) {
        const commentId = event.target.getAttribute('data-comment-id');

        if (confirm("Are you sure you want to delete this comment?")) {
            fetch('/comment/delete', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ comment_id: commentId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Remove the deleted comment from the DOM
                    const commentElement = event.target.closest('.comment');
                    commentElement.remove();
                } else {
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while deleting the comment.');
            });
        }
    }
});

