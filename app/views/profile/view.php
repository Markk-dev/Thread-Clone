 <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css">
 <div class="max-w-4xl mx-auto mt-12 bg-gray-800 p-8 rounded-lg shadow-lg">
    <div class="flex items-center space-x-4">
        <!-- Profile Image -->
        <img 
            src="<?= $userData['profile_image'] ? '/uploads/images/' . $userData['profile_image'] : '/default-profile.png' ?>" 
            alt="Profile Image" 
            class="w-32 h-32 rounded-full object-cover border-4 border-white"
        />
        
        <div class="flex flex-col">
            <!-- Username and Email -->
            <h1 class="text-3xl font-semibold text-white"><?= htmlspecialchars($userData['username']) ?></h1>
            <p class="text-gray-400"><?= htmlspecialchars($userData['email']) ?></p>
            
            <!-- Follow/Message Buttons -->
            <div class="mt-4 space-x-4">
                <button class="px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-400">Follow</button>
                <button class="px-4 py-2 bg-gray-700 text-white rounded-lg hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-400">Message</button>
            </div>
        </div>
    </div>

    <div class="mt-8 grid grid-cols-2 gap-8">
        <!-- Total Threads -->
        <div class="text-center">
            <p class="text-lg font-semibold text-white">Total Threads:</p>
            <p class="text-2xl font-bold text-blue-400"><?= $totalThreads ?></p>
        </div>

        <!-- Total Friends -->
        <div class="text-center">
            <p class="text-lg font-semibold text-white">Total Friends:</p>
            <p class="text-2xl font-bold text-green-400"><?= $profileData['friends'] ?? 0 ?></p>
        </div>
    </div>

    <div class="mt-8">
        <!-- About Me Section -->
        <h2 class="text-xl font-bold text-white">About Me:</h2>
        <p class="text-gray-300 mt-2"><?= htmlspecialchars($profileData['description'] ?? 'No description available.') ?></p>
    </div>
</div>
