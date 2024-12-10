<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white">
    <div class="container mx-auto px-64 py-8 ml-[-64]">

        <?php if (!empty($threads)): ?>
            <?php foreach ($threads as $thread): ?>
                <div class="bg-gray-800 p-2 rounded-lg mb-6 shadow-lg">
                    <div class="flex justify-between">
                        <p class="text-xs text-gray-400"><?= htmlspecialchars($thread['created_at']) ?></p>

                        <button class="text-gray-400 hover:text-white">
                            <a href="/thread/edit/<?= $thread['id'] ?>" class="no-underline flex items-center space-x-2 mr-2">
                                <span class="material-icons">more_horiz</span>
                            </a>
                        </button>
                    </div>
                    
                    <div class="flex">
                        <!-- profile placeholder -->
                        <img 
                            src="<?= !empty($thread['profile_image']) ? '/uploads/profile/' . htmlspecialchars($thread['profile_image']) : '/uploads/default/default.jpg' ?>" 
                            alt="Profile Image" 
                            class="w-16 h-16 rounded-full object-cover ml-2"
                        />
                            <div class="flex-col px-4 py-4 w-11/12 ml-[-6px]">
                                <div class="flex justify-between w-full mt-[-10px]">
                                    <div>
                                        <?= isset($thread['username']) ? htmlspecialchars($thread['username']) : 'Unknown User' ?>
                                    </div>
                                    <div>tags</div>
                                </div>

                                <div class="flex-grow">
                                <p class="text-lg font-medium"><?= htmlspecialchars($thread['content']) ?></p>
                                </div>
                            </div>
                        </div>
                
                    <!-- Media content (image/video) -->
                    <?php if (!empty($thread['image'])): ?>
                        <div class="w-full h-90 overflow-hidden box-border">
                        <img src="/<?= htmlspecialchars($thread['image']) ?>" alt="Thread Image" class="ml-20 pb-4 max-w-full max-h-full w-auto h-auto object-contain rounded-md">
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($thread['video'])): ?>
                        <div class="add here">
                            <div class=" w-full h-96 overflow-hidden box-border">
                                <video controls class="ml-20 pb-4 max-w-full max-h-full w-auto h-auto object-contain rounded-md">
                                    <source src="/<?= htmlspecialchars($thread['video']) ?>" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Button actions -->
                    <div class="ml-20 p-1 flex items-center justify-between ">
                        <div class="flex space-x-6">
                            <!-- Heart button (like) -->
                            <button class="heart-btn text-gray-400 hover:text-red-500 flex items-center space-x-2" data-thread-id="<?= $thread['id'] ?>">
                                <span class="material-icons">favorite_border</span>
                                <span><?= $thread['hearts'] ?></span>
                            </button>
                            <!-- Comment button -->
                            <button class="text-gray-400 hover:text-blue-500 flex items-center space-x-2" id="openModalButton" data-thread-id="<?= $thread['id'] ?>">
                                <span class="material-icons">comment</span>
                                <span>Comment</span>
                            </button>
                        </div>
                    </div>
                    
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-gray-400">No threads to display.</p>
        <?php endif; ?>
    </div>

    <!-- Include Modals -->
    <?php include __DIR__ . '/../threads/commentModal.php'; ?>

    <!-- <script src="/scripts/heart.js"></script> -->
    <script src="/scripts/modal.js"></script>
</body>
</html>
