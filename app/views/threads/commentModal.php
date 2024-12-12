<link rel="stylesheet" href="/styles/comments.css">

<div id="commentModal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center hidden">
    <div class="bg-gray-800 p-6 rounded-lg w-3/4 max-w-lg">
        <button id="closeModal" class="text-white float-right">X</button>
        <h3 class="text-xl font-bold mb-4">Comments</h3>

        <form id="commentForm" action="/add-comment" method="POST" class="mb-4">
            <textarea name="content" class="w-full bg-gray-700 text-white p-3 rounded" placeholder="Add a comment..." required></textarea>
            <input type="hidden" name="thread_id" id="threadIdInput">
            <input type="hidden" name="parent_id" value="">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2">Post Comment</button>
        </form>
        <div class="comment" data-comment-id="1">

        <div id="commentsList" class="mt-4">
            <!-- Example Comment with Delete Button -->

            </div>
        </div>
    </div>
</div>

<script src="/scripts/Comments.js"></script>
<script src="/scripts/delete.js"></script>
