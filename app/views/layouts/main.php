<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}?>


<!DOCTYPE html>
<html lang="en" class="dark">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ThreadClone</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=logout" />
    <link rel="stylesheet" href="/styles/layouts.css">
    <link rel="stylesheet" href="/styles/global.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white">

    <div class="flex min-h-screen" id="heroDiv">
  
    <?php if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']): ?>
        <aside class="w-[5rem] h-full p-6 fixed border-r-[1px] border-[#383838]" id="heroSide">
            <div class="flex flex-col space-y-16 justify-center items-center min-h-screen">
              
                <a href="/home" class="font-semibold text-gray-200" id="herobtn">
                    <span class="material-icons-outlined text-4xl hover:text-yellow-400 transition-all duration-1000" id="heroIcon">home</span>
                </a>

           
                <a href="/thread/create" class="text-lg font-semibold text-gray-200" id="herobtn">
                    <span class="material-icons-outlined text-4xl hover:text-orange-400 transition-all duration-1000" id="heroIcon">add</span>
                </a>

                <a href="/profile/view" class="text-lg font-semibold text-gray-200" id="herobtn">
                    <span class="material-icons-outlined text-4xl hover:text-blue-400 transition-all duration-1000" id="heroIcon">person</span>
                </a>
            </div>
        </aside>
    <?php endif; ?>

        <main class="flex-1 p-8">

        <div class="fixed top-0 right-3 p-4 rounded-lg">
            <a href="/logout" class="text-white">
                <span class="material-symbols-outlined text-[#4a4a4aea] hover:text-white transition-all
                duration-700 ease-in-out">logout</span>
            </a>
        </div>
            <?php echo $content; ?>
        </main>
    </div>
</body>
</html>
