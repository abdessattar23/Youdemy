<?php include __DIR__ . '/../components/head.php' ?>

<body>
    <main>
        <!-- start the project -->
        <!-- app layout -->
        <div id="app-layout" class="overflow-x-hidden flex">
            <?php include __DIR__ . '/../components/sidebar.php' ?>

            <!-- Header Stats -->
            <div class="mx-6 mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Pending Teachers Card -->
                <div class="card shadow-sm">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-primary rounded-md p-3">
                                <i data-feather="users" class="text-white"></i>
                            </div>
                            <div class="ml-5">
                                <h3 class="text-lg font-semibold">Pending Teachers</h3>
                                <p class="text-3xl font-bold"><?php echo $stats['pendingTeachers']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Courses Card -->
                <div class="card shadow-sm">
                    <div class="p-5">
                        <div class="flex items-center">
                            <div class="flex-shrink-0 bg-success rounded-md p-3">
                                <i data-feather="book-open" class="text-white"></i>
                            </div>
                            <div class="ml-5">
                                <h3 class="text-lg font-semibold">Total Courses</h3>
                                <p class="text-3xl font-bold"><?php echo $stats['totalCourses']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Most Popular Course Card -->

            </div>

            <!-- Top Teachers Section -->
            <?php if (!empty($stats['topTeachers'])): ?>
            <div class="mx-6 mt-6">
                <div class="card shadow-sm">
                    <div class="border-b border-gray-200 px-5 py-4">
                        <h4 class="mb-0">Top Teachers</h4>
                    </div>
                    <div class="p-5">
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Teacher</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Courses</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Students</th>
                                        <th
                                            class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Status</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    <?php foreach ($stats['topTeachers'] as $teacher): ?>
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm font-medium text-gray-900">
                                                <?php echo htmlspecialchars($teacher['name']); ?>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                <?php echo htmlspecialchars($teacher['course_count']); ?></div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="text-sm text-gray-900">
                                                <?php echo htmlspecialchars($teacher['student_count']); ?></div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <span
                                                class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                                Active
                                            </span>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Flash Messages -->
            <?php if (isset($_SESSION['success'])): ?>
            <div class="mx-6 mt-6">
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative"
                    role="alert">
                    <span class="block sm:inline"><?php echo $_SESSION['success']; ?></span>
                    <?php unset($_SESSION['success']); ?>
                </div>
            </div>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
            <div class="mx-6 mt-6">
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                    <span class="block sm:inline"><?php echo $_SESSION['error']; ?></span>
                    <?php unset($_SESSION['error']); ?>
                </div>
            </div>
            <?php endif; ?>
        </div>
        </div>
        <!-- end of project -->
    </main>
    <?php require_once __DIR__ . '/../components/footer.php'; ?>
    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
    feather.replace();
    </script>
    <script src="https://dashui.codescandy.com/tailwindcss/assets/libs/feather-icons/dist/feather.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/simplebar/6.3.0/simplebar.min.js"></script>
    <script src="/assets/js/theme.js"></script>
</body>

</html>