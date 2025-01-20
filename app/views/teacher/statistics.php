<?php include __DIR__ . '/../components/head.php' ?>
<?php include __DIR__ . '/../components/sidebar.php' ?>
<div class="mx-6 grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
    <!-- Total Courses Card -->
    <div class="card shadow">
        <?php require_once __DIR__ . '/../components/flash.php'; ?>
        <div class="p-4">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h5 class="text-gray-700 text-sm font-semibold">Nombre de cours</h5>
                    <h4 class="text-2xl font-bold text-gray-800"><?= $totalCourses ?></h4>
                </div>
                <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center">
                    <i data-feather="book" class="w-6 h-6 text-indigo-600"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Total Students Card -->
    <div class="card shadow">
        <div class="p-4">
            <div class="flex items-center justify-between mb-4">
                <div>
                    <h5 class="text-gray-700 text-sm font-semibold">Nombre d'étudiants inscrits</h5>
                    <h4 class="text-2xl font-bold text-gray-800"><?= $totalStudents ?></h4>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                    <i data-feather="users" class="w-6 h-6 text-green-600"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . '/../components/footer.php' ?>