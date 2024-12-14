<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="/styles/global.css">
</head>
<body class="Herobody">
    <section class="container">
        <div id="cards">
            <div class="card">
                <div class="card-content">
                    <h2 class="text-2xl font-semibold text-center text-gray-200 my-3">Login</h2>
                    <p class="text-[12px] text-gray-600 mt-[-2px] mb-4 ml-[11.5rem]">It's Quick and Easy</p>
                    <hr class="border-t-1 border-gray-600 w-[27rem] mx-auto mb-4"/>

                    <form action="/login" method="POST" class="space-y-6">
                        <div class="mt-4">
                            <label for="email_or_username" class="block text-gray-400 text-[10px] ml-6">Email or Username</label>
                            <input type="text" name="email_or_username" id="email_or_username" 
                            class="bg-transparent border border-[#afaaaa] ml-4  mt-2 text-white p-2 rounded-[5px] w-[28rem] text-[12px]
                             hover:bg-[#1e1e1ebe] transition-all duration-700 ease-in-out" required>
                        </div>

                        <div>
                            <label for="password" class="block text-gray-400 text-[10px] ml-6">Password</label>
                            <input type="password" name="password" id="password"
                            class="bg-transparent border border-[#afaaaa] ml-4  mt-2 text-white p-2 rounded-[5px] w-[28rem] text-[12px]
                            hover:bg-[#1e1e1ebe] transition-all duration-700 ease-in-out" required> 
                        </div>
                        <button type="submit" 
                        class="w-[28rem] ml-[1em] hover:bg-blue-500 transition duration-500 ease-in-out bg-gray-700 text-white py-2 rounded-md">Login</button>
                    </form>
                </div>
          

            </div>
        </div>
    </section>

    <div class="HeroRegister">
        <a href="/register" class="text-blue-200 hover:text-blue-600 transition-all duration-500 ease-in-out text-[12px]">Don't have an account? Register here</a>
    </div>
    

    <script src="/scripts/global.js"></script>
</body>
</html>
