<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-900 text-white">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Recent Threads</h1>

        <?php if (!empty($threads)): ?>
            <?php foreach ($threads as $thread): ?>
                <div class="bg-gray-800 p-4 rounded mb-4">
                    <p class="text-sm text-gray-400"><?= htmlspecialchars($thread['created_at']) ?></p>
                    <p class="text-lg font-medium"><?= htmlspecialchars($thread['content']) ?></p>
                    
            
                    <?php if (!empty($thread['image'])): ?>
                        <img src="/<?= htmlspecialchars($thread['image']) ?>" alt="Thread Image" class="mt-4 rounded">
                    <?php endif; ?>

                
                    <div class="mt-4 flex space-x-4">
                        <button class="heart-btn" data-thread-id="<?= $thread['id'] ?>">❤️ <?= $thread['hearts'] ?></button>
                       
                        <button class="text-blue-400 hover:text-blue-600" id="openModalButton" data-thread-id="<?= $thread['id'] ?>">
                            💬 Comment
                        </button>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-gray-400">No threads to display.</p>
        <?php endif; ?>

    </div>

    
    <?php include __DIR__ . '/../threads/commentModal.php'; ?>

    <script src="/scripts/heart.js"></script>
    <script src="/scripts/modal.js"></script>
</body>
</html>
