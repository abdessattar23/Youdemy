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
            <div class="-mt-12 mx-6 mb-6 grid grid-cols-1 gap-x-6 gap-y-6 sm:grid-cols-2 xl:grid-cols-2">
                <!-- card -->
                <?php require_once __DIR__ . '/../components/flash.php'; ?>
                <div class="card shadow">
                    <!-- card body -->
                    <div class="card-body">
                        <!-- content -->
                        <div class="flex justify-between items-center">
                            <h4>Courses</h4>
                            <div
                                class="bg-indigo-600 bg-opacity-10 rounded-md w-10 h-10 flex items-center justify-center text-center text-indigo-600">
                                <i data-feather="briefcase"></i>
                            </div>
                        </div>
                        <div class="mt-4 flex flex-col gap-0 text-base">
                            <h2 class="text-xl font-bold"><?= $data['statistics']['total_courses']; ?></h2>
                        </div>
                    </div>
                </div>
                <!-- card -->
                <div class="card shadow">
                    <!-- card boduy -->
                    <div class="card-body">
                        <!-- content -->
                        <div class="flex justify-between items-center">
                            <h4>Total Students Enrolled</h4>
                            <div
                                class="bg-indigo-600 bg-opacity-10 rounded-md w-10 h-10 flex items-center justify-center text-center text-indigo-600">
                                <i data-feather="list"></i>
                            </div>
                        </div>
                        <div class="mt-4 flex flex-col gap-0 text-base">
                            <h2 class="text-xl font-bold"><?= $data['statistics']['total_enrolled']; ?></h2>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mx-6 grid grid-cols-1 xl:grid-cols-2 grid-rows-1 grid-flow-row-dense gap-6">
                <div class="xl:col-span-2">
                    <div class="card h-full shadow">
                        <!-- heading -->
                        <div class="border-b border-gray-300 px-5 py-4">
                            <h4>Your Courses</h4>
                        </div>
                        <div class="relative overflow-x-auto">
                            <!-- table -->
                            <table class="text-left w-full whitespace-nowrap">
                                <thead class="text-gray-700">
                                    <tr>
                                        <th scope="col" class="border-b bg-gray-100 px-6 py-3">Course Name</th>
                                        <th scope="col" class="border-b bg-gray-100 px-6 py-3">Description</th>
                                        <th scope="col" class="border-b bg-gray-100 px-6 py-3">Category</th>
                                        <th scope="col" class="border-b bg-gray-100 px-6 py-3">Tags</th>
                                        <th scope="col" class="border-b bg-gray-100 px-6 py-3">Created At</th>
                                        <th scope="col" class="border-b bg-gray-100 px-6 py-3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($courses['data'] as $course): ?>
                                    <tr>
                                        <td class="border-b border-gray-300 font-medium py-3 px-6 text-left">
                                            <div class="flex items-center">
                                                <h5 class="ml-4"><a
                                                        href="/teacher/courses/edit/<?= $course['id'] ?>"><?= $course['title'] ?></a>
                                                </h5>
                                            </div>
                                        </td>
                                        <td class="border-b border-gray-300 py-3 px-6"><?= $course['description'] ?>
                                        </td>
                                        <td class="border-b border-gray-300 py-3 px-6">
                                            <span
                                                class="inline-flex items-center gap-1.5 py-0.5 px-2 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                                <span class="w-1 h-1 bg-green-400 rounded-full"></span>
                                                <span><?= $course['category_name']; ?></span>
                                            </span>
                                        </td>
                                        <td class="border-b border-gray-300 py-3 px-6">
                                            <?php foreach (explode(',', $course['tags_list']) as $category): ?>
                                            <span
                                                class="inline-flex items-center gap-1.5 py-0.5 px-2 rounded-full text-xs font-medium bg-green-100 text-green-700">
                                                <span class="w-1 h-1 bg-green-400 rounded-full"></span>
                                                <span><?= $category; ?></span>
                                            </span>
                                            <?php endforeach; ?>
                                        </td>

                                        <td class="border-b border-gray-300 py-3 px-6">
                                            <?= date('Y-m-d H:i:s', strtotime($course['created_at'])); ?>

                                        </td>
                                        <td class="border-b border-gray-300 py-3 px-6">
                                            <a href="/teacher/courses/edit/<?= $course['id'] ?>"
                                                class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <?php if ($courses['total_pages'] > 1): ?>
                        <div
                            class="flex items-center justify-between border-t border-gray-200 bg-white px-4 py-3 sm:px-6">
                            <div class="flex flex-1 justify-between sm:hidden">
                                <?php if ($courses['current_page'] > 1): ?>
                                <a href="?page=<?= $courses['current_page'] - 1 ?>"
                                    class="relative inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Previous</a>
                                <?php endif; ?>
                                <?php if ($courses['current_page'] < $courses['total_pages']): ?>
                                <a href="?page=<?= $courses['current_page'] + 1 ?>"
                                    class="relative ml-3 inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50">Next</a>
                                <?php endif; ?>
                            </div>
                            <div class="hidden sm:flex sm:flex-1 sm:items-center sm:justify-between">
                                <div>
                                    <p class="text-sm text-gray-700">
                                        Showing page <span class="font-medium"><?= $courses['current_page'] ?></span> of
                                        <span class="font-medium"><?= $courses['total_pages'] ?></span> pages
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
        </div>

</body>

</html>