<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thread</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-900 text-white">
    <div class="container mx-auto px-4 py-8">
       

        <!-- Button to Open Modal -->
        <button id="openModal" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-4">View Comments</button>

        <!-- Modal -->
        <div id="commentModal" class="fixed inset-0 bg-gray-900 bg-opacity-75 flex items-center justify-center hidden">
            <div class="bg-gray-800 p-6 rounded-lg w-3/4 max-w-lg">
                <button id="closeModal" class="text-white float-right">X</button>
                <h3 class="text-xl font-bold mb-4">Comments</h3>

                <!-- Comment Form -->
                <form action="/add-comment" method="POST" class="mb-4">
                    <textarea name="content" class="w-full bg-gray-700 text-white p-3 rounded" placeholder="Add a comment..." required></textarea>
                    <input type="hidden" name="thread_id" value="<?= $threadId ?>">
                    <input type="hidden" name="parent_id" value="">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2">Post Comment</button>
                </form>

                <!-- Display Comments -->
                <?php foreach ($comments as $comment): ?>
                    <div class="comment mb-4">
                        <p class="font-semibold"><?= htmlspecialchars($comment['username'] ?? 'Anonymous') ?></p>
                        <p><?= htmlspecialchars($comment['content'] ?? 'No content') ?></p>
                        <small class="text-gray-400"><?= htmlspecialchars($comment['created_at'] ?? 'Unknown date') ?></small>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

    
</body>
</html> 