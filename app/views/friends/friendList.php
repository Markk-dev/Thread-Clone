<h2 class="text-2xl font-bold text-white">Friends List</h2>


<?php if (!empty($pendingRequests)): ?>
    <h3 class="text-xl font-semibold text-gray-300">Pending Friend Requests</h3>
    <ul>
        <?php foreach ($pendingRequests as $request): ?>
            <li class="bg-gray-800 p-4 rounded-lg mb-4 shadow-md">
                <div class="flex justify-between">
                    <p class="text-lg"><?= htmlspecialchars($request['username']) ?></p>
                    <div>
                        <a href="/friend/acceptRequest/<?= $request['id'] ?>" class="text-green-500">Accept</a>
                        <a href="/friend/rejectRequest/<?= $request['id'] ?>" class="text-red-500 ml-4">Reject</a>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p class="text-gray-400">You have no pending friend requests.</p>
<?php endif; ?>


<h3 class="text-xl font-semibold text-gray-300">Your Friends</h3>
<?php if (!empty($friends)): ?>
    <ul>
        <?php foreach ($friends as $friend): ?>
            <li class="bg-gray-800 p-4 rounded-lg mb-4 shadow-md">
                <div class="flex justify-between">
                    <p class="text-lg"><?= htmlspecialchars($friend['username']) ?></p>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
<?php else: ?>
    <p class="text-gray-400">You have no friends yet.</p>
<?php endif; ?>
