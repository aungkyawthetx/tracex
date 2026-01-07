<div class="bg-white rounded-xl shadow-sm p-8">
  <div class="flex flex-col lg:flex-row items-start lg:items-center gap-8">
    <!-- Profile Image Section -->
    <div class="shrink-0 text-center lg:text-left">
      <div class="relative inline-block">
        <img src="https://ui-avatars.com/api/?name=Admin+User&background=6366f1&color=fff&size=128" alt="Profile" class="w-32 h-32 rounded-full shadow-lg">
      </div>
      <div class="mt-4">
        <h3 class="text-xl font-semibold text-gray-800"> <?= $_SESSION['user_name'] ?? 'Guest' ?> </h3>
      </div>
    </div>
    
    <!-- Profile Details Section -->
    <form class="flex-1 w-full mt-2" action="" method="POST">
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-2">Full Name</label>
          <input type="text" value="<?= $_SESSION['user_name'] ?>" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
        </div>
        <div>
          <label class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
          <input type="email" value="<?= $_SESSION['user_email'] ?>" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
        </div>
        <!-- <div>
          <label class="block text-sm font-semibold text-gray-700 mb-2">Phone</label>
          <input type="text" value="+1 (555) 123-4567" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors">
        </div> -->
        <div class="md:col-span-2">
          <label class="block text-sm font-semibold text-gray-700 mb-2">Bio</label>
          <textarea rows="1" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 transition-colors resize-none">Managing expenses and financial reports for the organization.</textarea>
        </div>
         <div>
           <label class="block text-sm font-semibold text-gray-700 mb-2">Profile Image</label>
           <div class="relative">
             <input type="file" accept="image/*" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition-colors file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 cursor-pointer">
           </div>
         </div>
      </div>

      <div class="flex sm:flex-row justify-start mt-5 gap-4">
        <button type="button" class="px-3 py-2 border border-gray-300 rounded-lg text-gray-700 hover:bg-gray-50 transition-colors font-medium cursor-pointer">
          <i class="fas fa-times mr-2"></i> Cancel
        </button>
        <button class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition-colors font-medium cursor-pointer">
          <i class="fas fa-save mr-2"></i> Save
        </button>
      </div>
    </form>
  </div>
</div>