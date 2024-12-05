<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ThreadClone</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-900 text-white font-inter">

    <div class="flex min-h-screen">
  
        <aside class="w-64 bg-gray-800 p-6">
            <div class="flex flex-col space-y-6">
                <a href="/thread/create" class="text-lg font-semibold text-gray-200">Create Thread</a>
                <a href="/search" class="text-lg font-semibold text-gray-200">Search</a>
                <a href="#" class="text-lg font-semibold text-gray-200">Friends</a>
            </div>
        </aside>

       
        <main class="flex-1 p-8">
        
            <div class="fixed top-0 right-0 bg-gray-700 p-4 rounded-lg">
                <p>Friend Request</p>
            </div>

           
            <?php echo $content; ?>
        </main>
    </div>
</body>
</html>
