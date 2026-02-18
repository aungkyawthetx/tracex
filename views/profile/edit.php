<form action="profile.php?edit=1" method="POST">
    <div class="space-y-6">
    <div class="space-y-2">
        <div class="flex items-center text-gray-500 text-sm font-medium">
        <i class="fas fa-user-circle mr-2 text-indigo-500"></i>
        Name
        </div>
        <input type="text" 
        name="name" 
        class="p-4 text-sm bg-gray-50 rounded-lg border-2 border-gray-200 w-full focus:ring-2 focus:ring-indigo-500 outline-none"
        value="<?= htmlspecialchars($user['name'] ?? '') ?>" 
        />
        <?php if (!empty($updateErrors['name'])): ?>
            <p class="text-red-500 text-xs italic mt-1"><?= htmlspecialchars($updateErrors['name']) ?></p>
        <?php endif; ?>
    </div>

    <!-- Email -->
    <div class="space-y-2">
        <div class="flex items-center text-gray-500 text-sm font-medium">
        <i class="fas fa-envelope mr-2 text-indigo-500"></i>
        Email Address
        </div>
        <input type="email" 
        name="email" 
        class="p-4 text-sm bg-gray-50 rounded-lg border-2 border-gray-200 w-full focus:ring-2 focus:ring-indigo-500 outline-none"
        value="<?= htmlspecialchars($user['email'] ?? '') ?>" 
        />
        <?php if (!empty($updateErrors['email'])): ?>
            <p class="text-red-500 text-xs italic mt-1"><?= htmlspecialchars($updateErrors['email']) ?></p>
        <?php endif; ?>
    </div>
    </div>
    <div class="flex justify-start mt-5 gap-4">
    <a href="profile.php" class="px-4 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 font-medium">Cancel</a>
    <button type="submit" name="btnUpdateProfile" class="px-5 py-2 bg-indigo-600 text-white rounded-lg cursor-pointer hover:bg-indigo-700 font-medium">Save</button>
    </div>
</form>
