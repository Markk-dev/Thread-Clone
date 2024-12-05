<?php $this->layout('layouts/main') ?>

<div class="max-w-md mx-auto bg-gray-800 p-8 rounded-lg">
    <h2 class="text-2xl font-semibold text-center text-gray-200 mb-6">Edit Profile</h2>

    <form action="/update-profile" method="POST" enctype="multipart/form-data" class="space-y-6">
        <div>
            <label for="username" class="block text-gray-400">Username</label>
            <input type="text" name="username" id="username" class="bg-gray-700 text-white p-4 rounded-md w-full" value="<?= htmlspecialchars($user['username']) ?>" required>
        </div>
        <div>
            <label for="email" class="block text-gray-400">Email</label>
            <input type="email" name="email" id="email" class="bg-gray-700 text-white p-4 rounded-md w-full" value="<?= htmlspecialchars($user['email']) ?>" required>
        </div>
        <div>
            <label for="profile_image" class="block text-gray-400">Profile Image</label>
            <input type="file" name="profile_image" id="profile_image" class="bg-gray-700 text-white p-4 rounded-md w-full">
        </div>
        <button type="submit" class="w-full bg-blue-500 text-white py-2 rounded-md">Save Changes</button>
    </form>
</div>
