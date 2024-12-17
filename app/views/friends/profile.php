 <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<div class="max-w-4xl mx-auto bg-transparent p-8 rounded-lg shadow-lg relative">
    <div class="flex items-center space-x-4 bg-transparent border border-[#afaaaa] p-2 rounded-md">
        <div class="relative">
            <img 
                src="<?= !empty($userData['profile_image']) 
                    ? '/uploads/profile/' . htmlspecialchars($userData['profile_image']) 
                    : '/uploads/default/default.jpg' ?>" 
                alt="Profile Image" 
                class="w-24 h-24 px-1 py-1 rounded-full object-cover"
                onclick="window.location.href='/profile/<?= $userData['id'] ?>'"
            />
        </div>
    

        <div class="flex flex-col">
            <h1 class="text-[22px] font-semibold text-white"><?= htmlspecialchars($userData['username']) ?></h1>
            <p class="text-gray-500 text-[14px]"><?= htmlspecialchars($userData['email']) ?></p>
        </div>


        <div class="mt-8 grid grid-cols-2 gap-8 absolute">
            <div class="text-center flex ml-[6rem] mt-[3rem] space-x-2">
                <p class="text-xs font-semibold hover:text-white transition-all duration-500 ease-in-out text-gray-500">Total Threads:</p>
                <p  class="text-[12px] font-bold  text-blue-600"><?= count($threads) ?></p>
            </div>
        </div>  
    </div>
                  
   

    <div class="mt-8">
    <h3 class="text-xl font-bold text-white">Threads</h3>
    <?php foreach ($threads as $thread): ?>
        <div class="mt-4 p-4 bg-transparent border border-[#afaaaa] rounded-lg">
        <p class="text-[11px] text-gray-400">Posted on <?= date ('Y-m-d', strtotime($thread['created_at'])) ?></p>
            <p class="text-white"><?= htmlspecialchars($thread['content']) ?></p>
            <hr class="border-t-1 border-gray-600 w-full mb-4 mt-2"/>
            <?php if (!empty($thread['image'])): ?>
                <img 
                    src="/<?= htmlspecialchars($thread['image']) ?>" 
                    alt="Thread Image" 
                    class="w-full h-auto mt-4 rounded-lg"
                />
            <?php endif; ?>
            
            <?php if (!empty($thread['video'])): ?>
                <video 
                    controls 
                    class="w-full h-auto mt-4 rounded-lg">
                    <source src="/<?= htmlspecialchars($thread['video']) ?>" type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            <?php endif; ?>

           
            
        </div>
    <?php endforeach; ?>
</div>

    </div>
</div>
