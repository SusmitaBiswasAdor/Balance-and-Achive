

<?php $__env->startSection('content'); ?>
<div class="admin-container bg-gray-100 min-h-screen p-8">
    <div class="max-w-7xl mx-auto bg-white p-6 rounded-lg shadow-md">
        <h1 class="text-3xl font-bold mb-4 text-gray-900">Admin Panel - User Management</h1>
        <p class="text-lg mb-6 text-gray-700">Manage users efficiently.</p>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Users Management Section -->
            <div class="feature bg-blue-50 p-4 rounded-lg shadow-sm hover:shadow-md transition-shadow duration-300">
                <h2 class="text-2xl font-semibold mb-2 text-blue-800">User Management</h2>
                <p class="text-gray-600">Manage the users in your system with ease and efficiency.</p>
                <a href="<?php echo e(route('admin.manage-users')); ?>" class="mt-4 inline-block px-6 py-2 bg-blue-600 text-white rounded-lg shadow-sm hover:bg-blue-700 transition-colors duration-300">Manage All Users</a>
            </div>
            <!-- Add more features related to admin functionalities as needed -->
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH F:\task-and-budget\task-and-budget\resources\views/admin/index.blade.php ENDPATH**/ ?>