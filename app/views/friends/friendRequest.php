
<h2 class="text-2xl font-bold text-white">Friend Requests</h2>
<?php if (!empty($friendRequests)): ?>
    <ul>
        <?php foreach ($friendRequests as $request): ?>
            <li class="bg-gray-800 p-4 rounded-lg mb-4 shadow-md">
                <div class="flex justify-between">
                    <p class="text-lg"><?= htmlspecialchars($request['username']) ?></p>
                    <div class="flex space-x-4">
                        <form action="/friend/acceptRequest/<?= $request['id'] ?>" method="POST">
                            <button type="submit" class="bg-green-500 text-white py-2 px-4 rounded hover:bg-green-600">Accept</button>
                        </form>
                        <form action="/friend/rejectRequest/<?= $request['id'] ?>" method="POST">
                            <button type="submit" class="bg-red-500 text-white py-2 px-4 rounded hover:bg-red-600">Reject</button>
                        </form>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p class="text-gray-400">No friend requests.</p>
<?php endif; ?>
