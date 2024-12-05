<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Thread</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
</head>
<body class="bg-gray-900 text-white">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-bold mb-6">Create a New Thread</h1>

        <!-- Display Error Message -->
        <?php if (isset($_SESSION['error'])): ?>
            <div class="bg-red-600 text-white p-4 rounded mb-4">
                <?= htmlspecialchars($_SESSION['error']) ?>
                <?php unset($_SESSION['error']); ?>
            </div>
        <?php endif; ?>

        <form action="/save-thread" method="POST" enctype="multipart/form-data" class="space-y-4">
            <!-- Content Input -->
            <div>
                <label for="content" class="block font-medium">Content:</label>
                <textarea name="content" id="content" rows="5" class="w-full bg-gray-800 text-white p-3 rounded" placeholder="What's on your mind?"></textarea>
            </div>

            <!-- File Input -->
            <div>
                <label for="image" class="block font-medium">Attach Image:</label>
                <input type="file" name="image" id="image" class="bg-gray-800 text-white rounded p-2 w-full">
            </div>
            <div>
                <label for="video" class="block font-medium">Attach Video:</label>
                <input type="file" name="video" id="video" class="bg-gray-800 text-white rounded p-2 w-full">
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Post Thread
                </button>
            </div>
        </form>
</body>
</html>
