<?php include __DIR__ . '/../components/head.php' ?>

<body>
    <main>
        <!-- start the project -->
        <!-- app layout -->
        <div id="app-layout" class="overflow-x-hidden flex">
            <?php include __DIR__ . '/../components/sidebar.php' ?>
            <div class="bg-indigo-600 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-center mb-3">
                <!-- title -->
                <h1 class="text-xl text-white">Course</h1>
                <a href="/teacher/courses/create"
                    class="btn bg-white text-gray-800 border-gray-600 hover:bg-gray-100 hover:text-gray-800 hover:border-gray-200 active:bg-gray-100 active:text-gray-800 active:border-gray-200 focus:outline-none focus:ring-4 focus:ring-indigo-300">
                    Create New Course
                </a>
            </div>
            <div class="mx-6 grid grid-cols-1 xl:grid-cols-2 grid-rows-1 grid-flow-row-dense gap-6">
                <div class="xl:col-span-2">
                    <div class="card h-full shadow">
                        <!-- heading -->
                        <div class="border-b border-gray-300 px-5 py-4">
                            <h4>Your Courses</h4>
                        </div>
                        <div class="relative overflow-x-auto">
                            <div class="space-y-4">
                                <?php require_once __DIR__ . '/../components/flash.php'; ?>
                                <?php foreach ($enrolled_courses as $course): ?>
                                <div class="card shadow overflow-hidden">
                                    <img class="w-full h-auto rounded-t-md object-cover"
                                        src="https://fakeimg.pl/1200x400/e3dfdf/7340db?text=<?= urlencode($course['title']) ?>"
                                        alt="Image Description" />
                                    <div class="card-body p-6">
                                        <h3 class="text-xl font-semibold text-indigo-600">
                                            <?= htmlspecialchars($course['title']) ?></h3>
                                        <p class="text-sm text-gray-500 mb-4">
                                            <?= date('Y-m-d H:i:s', strtotime($course['created_at'])) ?></p>
                                        <p class="text-gray-600 mb-4">
                                            <?= htmlspecialchars($course['description']) ?></p>
                                        <div class="flex flex-wrap gap-2 mb-4">
                                            <span
                                                class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-sm"><?= htmlspecialchars($course['category_name']) ?></span>
                                            <?php foreach (explode(',', $course['tags']) as $tag): ?>
                                            <span
                                                class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-sm"><?= htmlspecialchars($tag) ?></span>
                                            <?php endforeach; ?>
                                        </div>
                                        <a class="mt-2 btn gap-x-2 bg-indigo-600 text-white border-indigo-600 disabled:opacity-50 disabled:pointer-events-none hover:bg-indigo-800 hover:border-indigo-800 active:bg-indigo-800 active:border-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300"
                                            href="/courses/view/<?= $course['id'] ?>">View Course</a>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>

                            <?php if ($courses['total_pages'] > 1): ?>
                            <div class="mt-6">
                                <nav class="flex justify-center">
                                    <ul class="flex space-x-2">
                                        <?php for ($i = 1; $i <= $courses['total_pages']; $i++): ?>
                                        <li>
                                            <a href="?page=<?= $i ?>"
                                                class="px-3 py-2 bg-white border border-gray-300 text-gray-500 hover:bg-gray-50 <?= $i === $courses['current_page'] ? 'font-semibold' : '' ?>">
                                                <?= $i ?>
                                            </a>
                                        </li>
                                        <?php endfor; ?>
                                    </ul>
                                </nav>
                            </div>
                            <?php endif; ?>
                        </div>
                        <?php if ($courses['total_pages'] > 1): ?>
                        <div
                            class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
                            <div class="flex flex-1 justify-between sm:hidden">
                                <?php if ($courses['current_page'] > 1): ?>
                                <a href="?page=<?= $courses['current_page'] - 1 ?>"
                                    class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm"
                                    onclick="closeEnrolledStudentsModal()">
                                    Previous
                                </a>
                                <?php endif; ?>
                                <?php if ($courses['current_page'] < $courses['total_pages']): ?>
                                <a href="?page=<?= $courses['current_page'] + 1 ?>"
                                    class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                                    Next
                                </a>
                                <?php endif; ?>
                            </div>
                            <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                                <div>
                                    <p class="text-sm text-gray-700">
                                        Showing page <span class="font-medium"><?= $courses['current_page'] ?></span>
                                        of
                                        <span class="font-medium"><?= $courses['total_pages'] ?></span>
                                        pages
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
                                            class="relative inline-flex items-center px-4 py-2 text-sm font-semibold <?= $i === $courses['current_page'] ? 'z-10 bg-indigo-600 text-white focus:z-20 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600' : 'text-gray-900 ring-1 ring-inset ring-gray-300 hover:bg-gray-50 focus:z-20 focus:outline-offset-0' ?>">
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