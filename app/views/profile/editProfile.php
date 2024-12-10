

<div class="max-w-lg mx-auto mt-12 bg-gray-800 p-8 rounded-lg shadow-lg">
    <h2 class="text-xl font-bold text-white mb-4">Edit Profile</h2>
    <form action="/profile/update" method="POST">
        <div class="mb-4">
            <label class="block text-white mb-2" for="username">Username:</label>
            <input 
                type="text" 
                id="username" 
                name="username" 
                value="<?= htmlspecialchars($userData['username']) ?>" 
                class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white focus:ring-2 focus:ring-blue-400"
                required
            />
        </div>
        <div class="mb-4">
            <label class="block text-white mb-2" for="email">Email:</label>
            <input 
                type="email" 
                id="email" 
                name="email" 
                value="<?= htmlspecialchars($userData['email']) ?>" 
                class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white focus:ring-2 focus:ring-blue-400"
                required
            />
        </div>
        <button 
            type="submit" 
            class="w-full px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600"
        >
            Save Changes
        </button>
    </form>
</div>

<script src="https://cdn.tailwindcss.com"></script>
