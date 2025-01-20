<?php include __DIR__ . '/../components/head.php' ?>

<body>
    <main>
        <!-- start the project -->
        <!-- app layout -->
        <div id="app-layout" class="overflow-x-hidden flex">
            <!-- sidebar -->
            <?php include __DIR__ . '/../components/sidebar.php' ?>
            <div class="bg-indigo-600 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-center mb-3">
                <!-- title -->
                <h1 class="text-xl text-white">Course</h1>

            </div>
            <div class="mx-6">
                <div class="card shadow">
                    <!-- heading -->
                    <div class="border-b border-gray-300 px-5 py-4">
                        <h4>Available Courses</h4>
                    </div>
                    <div class="p-6">
                        <!-- Grid layout for courses -->
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            <?php require_once __DIR__ . '/../components/flash.php'; ?>
                            <?php foreach ($courses['data'] as $course): ?>
                            <div class="card shadow-sm hover:shadow-lg transition-shadow duration-300">
                                <img class="w-full h-48 object-cover rounded-t-lg"
                                    src="https://fakeimg.pl/800x400/e3dfdf/7340db?text=<?= urlencode($course['title']) ?>"
                                    alt="<?= htmlspecialchars($course['title']) ?>" />
                                <div class="p-4">
                                    <h3 class="text-lg font-semibold text-indigo-600 mb-2">
                                        <?= htmlspecialchars($course['title']) ?>
                                    </h3>
                                    <p class="text-sm text-gray-500 mb-2">
                                        <?= date('M d, Y', strtotime($course['created_at'])) ?>
                                    </p>
                                    <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                                        <?= htmlspecialchars($course['description']) ?>
                                    </p>
                                    <div class="flex flex-wrap gap-2 mb-4">
                                        <?php if (isset($course['category'])): ?>
                                        <span
                                            class="px-3 py-1 text-xs font-medium bg-indigo-100 text-indigo-800 rounded-full">
                                            <?= htmlspecialchars($course['category']) ?>
                                        </span>
                                        <?php endif; ?>
                                    </div>
                                    <?php $isEnrolled = false; ?>
                                    <?php foreach ($enrolled_courses as $enrolled_course): ?>
                                    <?php if ($enrolled_course['id'] === $course['id']): ?>
                                    <?php $isEnrolled = true; ?>
                                    <?php break; ?>
                                    <?php endif; ?>
                                    <?php endforeach; ?>

                                    <?php if ($isEnrolled): ?>
                                    <a href="/courses/view/<?= $course['id'] ?>"
                                        class="inline-flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        View Course
                                    </a>
                                    <?php else: ?>
                                    <a href="/courses/<?= $course['id'] ?>/enroll"
                                        class="inline-flex items-center justify-center w-full px-4 py-2 text-sm font-medium text-white bg-indigo-600 rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                        Enroll Course
                                    </a>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>

                        <!-- Pagination -->
                        <?php if ($courses['total_pages'] > 1): ?>
                        <div
                            class="mt-6 flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
                            <div class="flex flex-1 justify-between sm:hidden">
                                <?php if ($courses['current_page'] > 1): ?>
                                <a href="?page=<?= $courses['current_page'] - 1 ?>"
                                    class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                    Previous
                                </a>
                                <?php endif; ?>
                                <?php if ($courses['current_page'] < $courses['total_pages']): ?>
                                <a href="?page=<?= $courses['current_page'] + 1 ?>"
                                    class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">
                                    Next
                                </a>
                                <?php endif; ?>
                            </div>
                            <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                                <div>
                                    <p class="text-sm text-gray-700">
                                        Showing page <span class="font-medium"><?= $courses['current_page'] ?></span> of
                                        <span class="font-medium"><?= $courses['total_pages'] ?></span>
                                    </p>
                                </div>
                                <div>
                                    <nav class="isolate inline-flex -space-x-px rounded-md shadow-sm"
                                        aria-label="Pagination">
                                        <?php if ($courses['current_page'] > 1): ?>
                                        <a href="?page=<?= $courses['current_page'] - 1 ?>"
                                            class="relative inline-flex items-center rounded-l-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                            <span class="sr-only">Previous</span>
                                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"
                                                aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M12.79 5.23a.75.75 0 01-.02 1.06L8.832 10l3.938 3.71a.75.75 0 11-1.04 1.08l-4.5-4.25a.75.75 0 010-1.08l4.5-4.25a.75.75 0 011.06.02z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                        <?php endif; ?>

                                        <?php for($i = 1; $i <= $courses['total_pages']; $i++): ?>
                                        <a href="?page=<?= $i ?>"
                                            class="relative inline-flex items-center px-4 py-2 text-sm font-semibold <?= $i === $courses['current_page'] ? 'bg-indigo-600 text-white focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600' : 'text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:outline-offset-0' ?>">
                                            <?= $i ?>
                                        </a>
                                        <?php endfor; ?>

                                        <?php if ($courses['current_page'] < $courses['total_pages']): ?>
                                        <a href="?page=<?= $courses['current_page'] + 1 ?>"
                                            class="relative inline-flex items-center rounded-r-md px-2 py-2 text-gray-400 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0">
                                            <span class="sr-only">Next</span>
                                            <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor"
                                                aria-hidden="true">
                                                <path fill-rule="evenodd"
                                                    d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z"
                                                    clip-rule="evenodd" />
                                            </svg>
                                        </a>
                                        <?php endif; ?>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <?php include __DIR__ . '/../components/footer.php' ?>
        </div>
        </div>
    </main>

</body>

</html>