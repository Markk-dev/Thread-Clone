<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ThreadClone</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <!-- Load all Material Icons instead of just specific ones -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="/path/to/output/tailwind.css" rel="stylesheet">
</head>
<body class="bg-gray-900 text-white font-inter">

    <div class="flex min-h-screen">
  
        <aside class="w-[5rem] h-full bg-gray-800 p-6 fixed">
            <div class="flex flex-col space-y-16 justify-center items-center min-h-screen">
                <!-- Home Icon -->
                <a href="/home" class="font-semibold text-gray-200">
                    <span class="material-icons-outlined text-4xl">home</span>
                </a>

                <!-- Add Icon -->
                <a href="/thread/create" class="text-lg font-semibold text-gray-200">
                    <span class="material-icons-outlined text-4xl">add</span>
                </a>

                <!-- Search Icon -->
                <a href="/search" class="text-lg font-semibold text-gray-200">
                    <span class="material-icons-outlined text-4xl">search</span>
                </a>

                <!-- Friends Icon -->
                <a href="#" class="text-lg font-semibold text-gray-200">
                    <span class="material-icons-outlined text-4xl">group</span>
                </a>

                <!-- Profile Icon -->
                <a href="/profile/view" class="text-lg font-semibold text-gray-200">
                    <span class="material-icons-outlined text-4xl">person</span>
                </a>
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
