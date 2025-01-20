<?php include __DIR__ . '/../components/head.php' ?>

<body>
    <main>
        <!-- start the project -->
        <!-- app layout -->
        <div id="app-layout" class="overflow-x-hidden flex">
            <?php include __DIR__ . '/../components/sidebar.php' ?>
            <!-- Stats Overview -->
            <div class="mx-6 mt-6 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <?php require_once __DIR__ . '/../components/flash.php'; ?>
                <!-- Total Courses -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex items-center">
                        <div class="p-3 bg-blue-100 rounded-full">
                            <i data-feather="book" class="w-6 h-6 text-blue-500"></i>
                        </div>
                        <div class="ml-4">
                            <h3 class="text-sm font-medium text-gray-500">Total Courses</h3>
                            <p class="text-2xl font-semibold"><?php echo $stats['totalCourses']; ?></p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top Teachers and Top Course -->
            <div class="mx-6 mt-6 grid grid-cols-1 lg:grid-cols-2 gap-6">
                <!-- Top Teachers -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-lg font-semibold mb-4">Top Teachers</h2>
                    <div class="space-y-4">
                        <?php foreach ($stats['topTeachers'] as $index => $teacher): ?>
                        <div class="flex items-center">
                            <div class="flex-shrink-0">
                                <div class="w-10 h-10 rounded-full bg-gray-200 flex items-center justify-center">
                                    <span class="text-lg font-semibold">#<?php echo $index + 1; ?></span>
                                </div>
                            </div>
                            <div class="ml-4">
                                <p class="text-sm font-medium"><?php echo htmlspecialchars($teacher['name']); ?></p>
                                <p class="text-sm text-gray-500"><?php echo $teacher['courses_count']; ?> courses
                                </p>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Top Course -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h2 class="text-lg font-semibold mb-4">Top Course</h2>
                    <?php if ($stats['topCourse']): ?>
                    <div class="space-y-4">
                        <h3 class="text-lg font-bold text-purple-600">
                            <?php echo htmlspecialchars($stats['topCourse']); ?></h3>
                    </div>
                    <?php else: ?>
                    <p class="text-gray-500">No courses available</p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Categories Table -->
            <div class="mx-6 mt-6 mb-6">
                <div class="bg-white rounded-lg shadow-sm">
                    <div class="p-6">
                        <h2 class="text-lg font-semibold mb-4">Categories Overview</h2>
                        <div class="overflow-x-auto">
                            <table class="min-w-full w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Category
                                        </th>
                                        <th
                                            class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Number of Courses
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <?php foreach ($stats['categoryStats'] as $category): ?>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            <?php echo htmlspecialchars($category['name']); ?>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <?php echo $category['total_courses']; ?>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>
    <?php require_once __DIR__ . '/../components/footer.php'; ?>
    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
    feather.replace();
    </script>
</body>

</html>