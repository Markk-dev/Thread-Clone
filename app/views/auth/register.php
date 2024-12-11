<div class="max-w-md mx-auto bg-gray-800 p-8 rounded-lg">
    <h2 class="text-2xl font-semibold text-center text-gray-200 mb-6">Register</h2>

    <form action="/register" method="POST" class="space-y-6">
        <div>
            <label for="username" class="block text-gray-400">Username</label>
            <input type="text" name="username" id="username" class="bg-gray-700 text-white p-4 rounded-md w-full" required>
        </div>
        <div>
            <label for="email" class="block text-gray-400">Email</label>
            <input type="email" name="email" id="email" class="bg-gray-700 text-white p-4 rounded-md w-full" required>
        </div>
        <div>
            <label for="password" class="block text-gray-400">Password</label>
            <input type="password" name="password" id="password" class="bg-gray-700 text-white p-4 rounded-md w-full" required>
        </div>
        <div>
            <label for="confirm_password" class="block text-gray-400">Confirm Password</label>
            <input type="password" name="confirm_password" id="confirm_password" class="bg-gray-700 text-white p-4 rounded-md w-full" required>
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md">Register</button>
    </form>
</div>
