<div class="max-w-4xl mx-auto mt-12 bg-gray-800 p-8 rounded-lg shadow-lg relative">
    <div class="flex items-center space-x-4">
        <!-- Profile Image with Settings Icon -->
        <div class="relative">
        <img 
            src="<?= !empty($userData['profile_image']) 
                ? '/uploads/profile/' . htmlspecialchars($userData['profile_image']) 
                : '/uploads/default/default.jpg' ?>" 
            alt="Profile Image" 
            class="w-32 h-32 rounded-full object-cover"
        />
            <button 
                class="absolute bottom-0 right-0 bg-gray-700 text-white p-2 rounded-full shadow-md hover:bg-gray-800"
                onclick="openModal()"
            >
                <i class="fa-solid fa-bars"></i>
            </button>
        </div>
        <!-- User Info -->
        <div class="flex flex-col">
            <h1 class="text-3xl font-semibold text-white"><?= htmlspecialchars($userData['username']) ?></h1>
            <p class="text-gray-400"><?= htmlspecialchars($userData['email']) ?></p>
        </div>
    </div>

    <!-- Profile Stats -->
    <div class="mt-8 grid grid-cols-2 gap-8">
        <div class="text-center">
            <p class="text-lg font-semibold text-white">Total Threads:</p>
            <p class="text-2xl font-bold text-blue-400"><?= $totalThreads ?></p>
        </div>
        <div class="text-center">
            <p class="text-lg font-semibold text-white">Total Friends:</p>
            <p class="text-2xl font-bold text-green-400"><?= $profileData['friends'] ?? 0 ?></p>
        </div>
    </div>

    <!-- About Me Section -->
    <div class="mt-8">
        <h2 class="text-xl font-bold text-white">About Me:</h2>
        <p class="text-gray-300 mt-2"><?= htmlspecialchars($profileData['description'] ?? 'No description available.') ?></p>
    </div>

    <!-- Modal -->
    <div id="profileSettingsModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg space-y-4">
            <button 
                class="w-full px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600"
                onclick="location.href='/profile/edit'"
            >
                Edit Profile
            </button>
            <button 
                class="w-full px-4 py-2 bg-gray-500 text-white rounded-lg hover:bg-gray-600"
                onclick="location.href='/profile/upload-photo'"
            >
                Upload Photo
            </button>
            <button 
                class="w-full px-4 py-2 bg-red-500 text-white rounded-lg hover:bg-red-600"
                onclick="removePhoto()"
            >
                Remove Photo
            </button>
            <button 
                class="w-full px-4 py-2 bg-gray-300 rounded-lg hover:bg-gray-400"
                onclick="closeModal()"
            >
                Cancel
            </button>
        </div>
    </div>
</div>

<script>
function openModal() {
    document.getElementById('profileSettingsModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('profileSettingsModal').classList.add('hidden');
}

function removePhoto() {
    if (confirm('Are you sure you want to remove your profile photo?')) {
        location.href = '/profile/remove-photo';
    }
}
</script>
