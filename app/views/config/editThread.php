<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Thread</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-900 text-white relative">

    <div class="container flex justify-center items-center px-4 py-8 w-full">
        <!-- Reduced width with increased height -->
        <div class="w-full p-6 rounded-lg">
            <h1 class="text-2xl font-semibold text-white mb-6">Edit Thread</h1>
            
            <hr class="border-t-1 border-gray-600" />

            <form action="/thread/update/<?= $thread['id'] ?>" method="POST" enctype="multipart/form-data">
                <div class="py-2 my-2">
                    <label for="content" class="block text-sm font-medium text-gray-300 mt-3 ml[-2px] mb-3">Content</label>
                    <div class="mt-">
                      <textarea id="content" name="content" class="mt-1 block w-full p-2 border border-[#afaaaa] bg-black text-white rounded-[5px] resize-none" 
                       rows="2"><?= htmlspecialchars($thread['content']) ?></textarea>
                     </div>
                </div>

                <!-- Action Buttons -->
                <div class="flex items-center justify-end space-x-6">
                    

                    <!-- Update Button -->
                    <button type="submit" class="inline-flex items-center px-6 py-3 rounded-[25px] bg-black hover:text-blue-400
                    hover:rounded-[25px] hover:transition-all duration-700 ease-in-out text-white font-semibold text-sm focus:outline-none
                     focus:ring-2 focus:ring-gray-500 transition">
                        Update
                    </button>
                    
                    <!-- Delete Button -->
                    <button type="button" onclick="window.location.href='/thread/delete/<?= $thread['id'] ?>'"
                     class="inline-flex items-center px-6 py-3 rounded-[25px] hover:rounded-[25px]
                      hover:transition-all duration-1000 ease-in-out hover:text-red-700 text-white font-semibold text-sm focus:outline-none focus:ring-2
                       focus:ring-red-500 transition">
                        Delete Thread
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
