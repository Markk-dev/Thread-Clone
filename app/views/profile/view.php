<head>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>

<div class="max-w-4xl mx-auto p-8 rounded-lg shadow-lg relative">
    <div class="flex items-center space-x-4 bg-transparent border border-[#afaaaa] p-2 rounded-md">
        <div class="relative">
            <img 
                src="<?= !empty($userData['profile_image']) 
                    ? '/uploads/profile/' . htmlspecialchars($userData['profile_image']) 
                    : '/uploads/default/default.jpg' ?>" 
                alt="Profile Image" 
                class="w-24 h-24 px-1 py-1 rounded-full object-cover"
            />
        </div>
        
        <div class="flex flex-col">
            <h1 class="text-[22px] font-semibold text-white"><?= htmlspecialchars($userData['username']) ?></h1>
            <p class="text-gray-500 text-[14px]"><?= htmlspecialchars($userData['email']) ?></p>
        </div>

        <div class="mt-8">
            <div class="text-center flex ml-80 space-x-2">
                <p class="text-md font-semibold text-white">Total Threads:</p>
                <p class="text-[18px] font-bold text-blue-400"><?= $totalThreads ?></p>
            </div>
        </div>
    </div>


    <div class="mt-4 space-y-4 flex">
        <div class="bg-transparent border border-[#afaaaa] w-full flex justify-start p-2 rounded-md space-x-2 mt-2">
            <button 
                class="w-10 h-10 bg-blue-500 text-white rounded-xl flex items-center justify-center hover:bg-blue-600"
                onclick="openEditProfileModal()">
                <i class="fa-solid fa-edit"></i>
            </button>

            <button 
                class="w-10 h-10 bg-gray-500 text-white rounded-xl flex items-center justify-center hover:bg-gray-600"
                onclick="openUploadPhotoModal()">
                <i class="fa-solid fa-camera"></i>
            </button>

            <button 
                class="w-10 h-10 bg-red-500 text-white rounded-xl flex items-center justify-center hover:bg-red-600"
                onclick="location.href='/profile/remove-photo'">
                <i class="fa-solid fa-trash"></i>
            </button>
        </div>
    </div>
</div>


<div id="editProfileModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="max-w-4xl mx-auto mt-12 bg-[#0f0f10] border border-[#afaaaa] p-8 rounded-lg shadow-lg">
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
                />
            </div>

          
            <div class="flex space-x-4">
                <div class="w-full mb-4">
                    <label class="block text-white mb-2" for="current_password">Current Password:</label>
                    <input 
                        type="password" 
                        id="current_password" 
                        name="current_password" 
                        class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white focus:ring-2 focus:ring-blue-400"
                    />
                </div>
                <div class="w-full mb-4">
                    <label class="block text-white mb-2" for="new_password">New Password:</label>
                    <input 
                        type="password" 
                        id="new_password" 
                        name="new_password" 
                        class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white focus:ring-2 focus:ring-blue-400"
                    />
                </div>
            </div>

            <div class="flex space-x-4"> 
                <button 
                    type="submit" 
                    class="w-full sm:w-auto px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600"
                >
                    Save Changes
                </button>
                <button 
                    type="button" 
                    onclick="closeEditProfileModal()" 
                    class="w-full sm:w-auto px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700"
                >
                    Close
                </button>
            </div>
        </form>
    </div>
</div>


<div id="uploadPhotoModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="max-w-lg mx-auto mt-12 bg-[#0f0f10] border border-[#afaaaa] p-8 rounded-lg shadow-lg">
        <h2 class="text-xl font-bold text-white mb-4">Upload Profile</h2>
        <form action="/profile/upload-photo" method="POST" enctype="multipart/form-data">
            <div class="mb-4">
                <label class="block text-white mb-2" for="profile_image">Select Photo:</label>
                <input 
                    type="file" 
                    id="profile_image" 
                    name="profile_image" 
                    accept="image/*" 
                    class="w-full px-4 py-2 rounded-lg bg-gray-700 text-white"
                    required
                />
            </div>
            <div class="flex space-x-4"> 
                <button 
                    type="submit" 
                    class="w-full px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600"
                >
                    Upload
                </button>
                <button 
                    type="button" 
                    onclick="closeUploadPhotoModal()" 
                    class="w-full px-4 py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700"
                >
                    Close
                </button>
            </div>
        </form>
    </div>
</div>

<script src="/scripts/global.js"></script>