<?php
include_once 'components/FormHandler.php';

$formHandler = new FormHandler();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $formHandler->handleLogin($_POST);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="/styles/global.css">
</head>
<body class="Herobody">
    <section class="container">
        <div id="cards">
            <div class="card">
                <div class="card-content">
                    <h2 class="text-2xl font-semibold text-center text-gray-200 my-3">Register</h2>
                    <p class="text-[12px] text-gray-600 mt-[-2px] mb-4 ml-[11.5rem]">It's Quick and Easy</p>
                    <hr class="border-t-1 border-gray-600 w-[27rem] mx-auto mb-4"/>

                    <form action="/register" method="POST" class="space-y-6">
                        <div class="mt-4">
                            <label for="username" class="block text-gray-400 text-[10px] ml-6">Username</label>
                            <input type="text" name="username" id="username" 
                            class="bg-transparent border border-[#afaaaa] ml-4 mt-2 text-white p-2 rounded-[5px] w-[28rem] text-[12px]
                             hover:bg-[#1e1e1ebe] transition-all duration-700 ease-in-out" required>
                        </div>

                        <div>
                            <label for="email" class="block text-gray-400 text-[10px] ml-6">Email</label>
                            <input type="email" name="email" id="email"
                            class="bg-transparent border border-[#afaaaa] ml-4 mt-2 text-white p-2 rounded-[5px] w-[28rem] text-[12px]
                             hover:bg-[#1e1e1ebe] transition-all duration-700 ease-in-out" required>
                        </div>

                        <div class="flex">
                            <label for="password" class="absolute text-gray-400 text-[10px] ml-6 mt-[-10px]">Password</label>
                            <input type="password" name="password" id="password"
                            class="bg-transparent border border-[#afaaaa] ml-4 mt-2 text-white p-2 rounded-[5px] w-[28rem] text-[12px]
                            hover:bg-[#1e1e1ebe] transition-all duration-700 ease-in-out" required> 


                            <label for="confirm_password" class="absolute text-gray-400 text-[10px] ml-[16.5rem] mt-[-10px]">Confirm Password</label>
                            <input type="password" name="confirm_password" id="confirm_password"
                            class="bg-transparent border border-[#afaaaa] ml-4 mt-2 text-white p-2 rounded-[5px] w-[28rem] text-[12px]
                            hover:bg-[#1e1e1ebe] transition-all duration-700 ease-in-out" required>
                        </div>
<!-- 
                        <div>
                            <label for="confirm_password" class="block text-gray-400 text-[10px] ml-6">Confirm Password</label>
                            <input type="password" name="confirm_password" id="confirm_password"
                            class="bg-transparent border border-[#afaaaa] ml-4 mt-2 text-white p-2 rounded-[5px] w-[28rem] text-[12px]
                            hover:bg-[#1e1e1ebe] transition-all duration-700 ease-in-out" required> 
                        </div> -->

                        <button type="submit" 
                        class="w-[28rem] ml-[1em] hover:bg-blue-500 transition duration-500 ease-in-out bg-gray-700 text-white py-2 rounded-md">Register</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <div class="HeroRegister">
        <a href="/login" class="text-blue-200 hover:text-red-500 transition-all duration-500 ease-in-out text-[12px]">Already have an account? Login here</a>
    </div>

    <script src="/scripts/global.js"></script>
</body>
</html>
