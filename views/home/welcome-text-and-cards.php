<div class="mb-6">
    <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
    <p class="text-gray-600">Welcome back, <?= $_SESSION['user_name'] ?? 'Guest'; ?>! Here's what's happening with your expenses today.</p>
</div>
<!-- Stats Cards -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-6">
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Total Expenses</p>
                <h3 class="text-2xl font-bold text-gray-800 mt-1"> 300,000 MMK</h3>
                <p class="text-green-500 text-sm mt-2">
                    <i class="fas fa-arrow-up mr-1"></i> 12% from last month
                </p>
            </div>
            <div class="bg-indigo-100 p-3 rounded-full">
                <i class="fas fa-wallet text-indigo-600 text-xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Monthly Budget</p>
                <h3 class="text-2xl font-bold text-gray-800 mt-1"> 450,000 MMK </h3>
                <p class="text-red-500 text-sm mt-2">
                    <i class="fas fa-arrow-down mr-1"></i> 8% over budget
                </p>
            </div>
            <div class="bg-green-100 p-3 rounded-full">
                <i class="fas fa-chart-line text-green-600 text-xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Categories</p>
                <h3 class="text-2xl font-bold text-gray-800 mt-1">14</h3>
                <p class="text-gray-500 text-sm mt-2">
                    <i class="fas fa-circle text-blue-500 mr-1"></i> 5 new this month
                </p>
            </div>
            <div class="bg-blue-100 p-3 rounded-full">
                <i class="fas fa-tags text-blue-600 text-xl"></i>
            </div>
        </div>
    </div>
    
    <div class="bg-white rounded-lg shadow p-6">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-gray-500 text-sm font-medium">Savings</p>
                <h3 class="text-2xl font-bold text-gray-800 mt-1"> 250,000 MMK </h3>
                <p class="text-green-500 text-sm mt-2">
                    <i class="fas fa-arrow-up mr-1"></i> 5% from last month
                </p>
            </div>
            <div class="bg-purple-100 p-3 rounded-full">
                <i class="fas fa-piggy-bank text-purple-600 text-xl"></i>
            </div>
        </div>
    </div>
</div>