<div class="max-w-lg mx-auto mt-12 bg-gray-800 p-8 rounded-lg shadow-lg">
    <h2 class="text-xl font-bold text-white mb-4">Upload Profile Photo</h2>
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
        <button 
            type="submit" 
            class="w-full px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600"
        >
            Upload
        </button>
    </form>
</div>
