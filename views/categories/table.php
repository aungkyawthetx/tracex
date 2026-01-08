<div class="bg-white rounded-lg shadow overflow-hidden">
    <div class="flex flex-col md:flex-row md:items-center md:justify-between p-4 border-b border-gray-200">
        <div class="mb-4 md:mb-0">
            <div class="relative max-w-xs">
                <label for="search" class="sr-only">Search</label>
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                    <i class="fas fa-search text-gray-400"></i>
                </div>
                <input type="text" id="search" class="block w-full pl-10 pr-3 py-2 border border-gray-300 rounded-md leading-5 bg-white placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm placeholder:italic" placeholder="Search categories...">
            </div>
        </div>
        <div class="flex">
            <button class="px-3 py-1 border border-gray-300 cursor-pointer rounded-md text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                <i class="fas fa-download mr-1"></i> Export
            </button>
        </div>
    </div>
    
    <div class="overflow-x-auto">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Monthly Budget (Ks)</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Expense Count</th>
                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php foreach($categories as $category): ?>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="flex items-center">
                                <div class="shrink-0 h-10 w-10 rounded-full bg-red-100 flex items-center justify-center">
                                    <i class="fa-solid fa-<?= $category['icon'] ?>" style="color: <?= $category['color'] ?>"></i>
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm font-medium text-gray-900"> <?= $category['name'] ?? 'N/A' ?> </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"> <?= $category['description'] ?? 'N/A' ?> </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"> <?= number_format($category['monthly_budget']) ?? 'N/A' ?> Ks</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">42</td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <button onclick="openEditCategoryModal()" class="text-indigo-600 hover:text-indigo-900 mr-3"><i class="fas fa-edit"></i></button>
                            <button onclick="openDeleteCategoryModal()" class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
</div>