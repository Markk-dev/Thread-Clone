
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Thread</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="/styles/global.css">
</head>
<body class="bg-gray-900 text-white">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Create Thread</h1>
       
        <div class="flex items-center mb-6 mt-[40px]">
            <img 
                src="<?= !empty($userData['profile_image']) ? '/uploads/profile/' . htmlspecialchars($userData['profile_image']) : '/uploads/default/default.jpg' ?>" 
                alt="Profile Image" 
                class="w-[3rem] h-[3rem] rounded-full object-cover ml-2"
            />
            <span class="ml-4 font-semibold"><?= htmlspecialchars($userData['username']) ?></span>
        </div>
     
        <!-- <?php if (isset($_SESSION['error'])): ?>
            <div class="bg-red-600 text-white p-4 rounded mb-4">
                <?= htmlspecialchars($_SESSION['error']) ?>
                <?php unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?> -->

        <form action="/save-thread" method="POST" enctype="multipart/form-data" class="space-y-4">
        
            <div class="ml-[4.5rem] mt-[-20px]">
                <textarea name="content" id="content" rows="2"
                    class="mt-1 block w-full p-3 border border-[#afaaaa] bg-black text-white rounded-[5px] resize-none text-[12px]"
                    placeholder="What's on your mind?"></textarea>
            </div>

            <div class="flex space-x-5 ml-20">
                <!-- Attach Image -->
                <div class="flex items-center gap-4">
                    <label for="image" class="flex items-center cursor-pointer">
                        <span class="material-symbols-outlined text-4xl text-blue-500">image</span>
                        <span class="ml-2 text-sm">Image</span>
                    </label>
                    <input type="file" name="image" id="image" class="hidden-file-input">
                </div>

                <!-- Attach Video -->
                <div class="flex items-center gap-4">
                    <label for="video" class="flex items-center cursor-pointer">
                        <span class="material-symbols-outlined text-4xl text-red-500">movie</span>
                        <span class="ml-2 text-sm">Video</span>
                    </label>
                    <input type="file" name="video" id="video" class="hidden-file-input">
                </div>

                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Post Thread
                </button>
            </div>
            <div>
               
            </div>
        </form>
</body>
</html>
