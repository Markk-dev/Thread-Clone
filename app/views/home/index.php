<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-900 text-white">

<div class="container mx-auto px-18 py-18">

    <?php if (!empty($threads)): ?>
        <?php foreach ($threads as $thread): ?>
            <div class="p-2 mb-3">
                <div class="relative flex">
                <?php if (isset($thread['user_id']) && $thread['user_id'] == $_SESSION['user_id']): ?>
                    <button class="absolute top-0 right-0 text-[#4a4a4aea]
                     hover:text-white transition-all duration-700 ease-in-out">
                        <a href="/thread/edit/<?= $thread['id'] ?>" class="no-underline flex items-center space-x-2">
                            <span class="material-icons">more_horiz</span>
                        </a>
                    </button>
                <?php endif; ?>
            </div>

                <div class="flex py-6">
                    <!-- Profile Image -->
                    <a href="/profile/<?= $thread['user_id'] ?>"> 
                        <img 
                            src="<?= !empty($thread['profile_image']) ? '/uploads/profile/' . htmlspecialchars($thread['profile_image']) : '/uploads/default/default.jpg' ?>" 
                            alt="Profile Image" 
                            class="w-[3rem] h-[3rem] rounded-full object-cover ml-2"
                        />
                    </a>

                    <div class="flex-col px-4 w-11/12 ml-[-6px]">
                        <div class="flex justify-between w-full mt-[-10px]">
                            <div class="py-4">
                                <?= isset($thread['username']) ? htmlspecialchars($thread['username']) : 'Unknown User' ?>
                                <p class="text-[10px] text-gray-400"><?= htmlspecialchars($thread['created_at']) ?></p>
                            </div>
                        </div>

                    <div class="flex-grow my-[-12px]">
                       <p class="text-[16px] font-medium break-word" style="max-width: calc(40ch);">
                         <?= htmlspecialchars($thread['content']) ?>
                       </p>
                    </div>
                        </div>
                    </div>

               <div class="flex-col border-[1px] border-[#383838] py-2">
                    <?php if (!empty($thread['image'])): ?>
                        <div class="w-[650px] h-[300px] overflow-hidden box-border flex justify-center items-center ml-16">
                            <img src="/<?= htmlspecialchars($thread['image']) ?>" 
                                alt="Thread Image" 
                                class="w-full h-full object-cover object-center rounded-[3px]">
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($thread['video'])): ?>
                        <div class="w-[650px] h-[300px] overflow-hidden box-border flex justify-center items-center ml-16">
                            <video controls 
                                class="w-full h-full object-cover object-center rounded-[3px]">
                                <source src="/<?= htmlspecialchars($thread['video']) ?>" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        </div>
                    <?php endif; ?>
               </div>

                    <div class="ml-20 py-2 flex items-center justify-between">
                        <div class="flex space-x-6">
                        
                            <?php $isHearted = isset($thread['heartedUsers']) && in_array($userId, $thread['heartedUsers']);?>
                            <button class="heart-btn flex items-center space-x-2 <?= $isHearted ? 'text-red-500' : 'text-gray-400' ?>" data-thread-id="<?= $thread['id'] ?>">
                                <span class="material-icons  hover:text-red-500 transition-all duration-700 ease-in-out">
                                    <?= $isHearted ? 'favorite' : 'favorite_border' ?>
                                </span>
                                <span class="text-xs text-red-500"><?= $thread['hearts'] ?></span>
                            </button>
                        
                            <!-- Comment -->
                            <button class="text-gray-400 text-sm hover:text-blue-500 transition-all duration-700 ease-in-out flex items-center space-x-2" id="openModalButton" data-thread-id="<?= $thread['id'] ?>">
                                <span class="material-icons">comment</span>
                                <span>Comment</span>
                            </button>
                        </div>
                    </div>
                </div>

            <hr class=" border-t-1 border-gray-600" />

        <?php endforeach; ?>

    <?php else: ?>
        <p class="text-gray-400">No threads to display.</p>
    <?php endif; ?>

</div>

<?php include __DIR__ . '/../threads/commentModal.php'; ?>

<script src="/scripts/modal.js"></script>
<script src="/scripts/heart.js"></script>
</body>
</html>
