<div class="max-w-md mx-auto bg-gray-800 p-8 rounded-lg">
    <h2 class="text-2xl font-semibold text-center text-gray-200 mb-6">Login</h2>

    <form action="/login" method="POST" class="space-y-6">
        <div>
            <label for="email_or_username" class="block text-gray-400">Email or Username</label>
            <input type="text" name="email_or_username" id="email_or_username" class="bg-gray-700 text-white p-4 rounded-md w-full" required>
        </div>
        <div>
            <label for="password" class="block text-gray-400">Password</label>
            <input type="password" name="password" id="password" class="bg-gray-700 text-white p-4 rounded-md w-full" required>
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md">Login</button>
    </form>

    <div class="text-center mt-4">
        <a href="/register" class="text-blue-400 hover:underline">Don't have an account? Register here</a>
    </div>
</div>
