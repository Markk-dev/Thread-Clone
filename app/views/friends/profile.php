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
                onclick="window.location.href='/profile/<?= $userData['id'] ?>'"
            />
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
            <p class="text-2xl font-bold text-blue-400"><?= count($threads) ?></p>
        </div>
        <div class="text-center">
            <p class="text-lg font-semibold text-white">Total Friends:</p>
            <p class="text-2xl font-bold text-green-400"><?= $userData['friends'] ?? 0 ?></p>
        </div>
    </div>

    <!-- About Me Section -->
    <div class="mt-8">
        <h2 class="text-xl font-bold text-white">About Me:</h2>
        <p class="text-gray-300 mt-2"><?= htmlspecialchars($userData['description'] ?? 'No description available.') ?></p>
    </div>


    <!-- User's Posts (Threads) -->
    <div class="mt-8">
        <h3 class="text-xl font-bold text-white">Posts</h3>
        <?php foreach ($threads as $thread): ?>
            <div class="mt-4 p-4 bg-gray-700 rounded-lg">
                <p class="text-white"><?= htmlspecialchars($thread['content']) ?></p>
                <p class="text-sm text-gray-400">Posted on <?= date('Y-m-d', strtotime($thread['created_at'])) ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</div>


<script>
    document.getElementById('friendRequestForm-<?= $thread['user_id'] ?>').addEventListener('submit', function(event) {
        event.preventDefault();
        const userId = <?= $thread['user_id'] ?>;
        const formData = new FormData(this);
        fetch(`/friend/sendRequest/${userId}`, {
            method: 'POST',
            body: formData
        }).then(response => {
            if (response.ok) {
                document.getElementById(`sendRequestButton-${userId}`).innerText = 'Request Sent';
                document.getElementById(`sendRequestButton-${userId}`).classList.add('bg-gray-500', 'hover:bg-gray-600');
                document.getElementById(`sendRequestButton-${userId}`).disabled = true;
            }
        });
    });
</script>