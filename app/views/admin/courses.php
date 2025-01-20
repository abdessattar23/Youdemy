<?php include __DIR__ . '/../components/head.php' ?>

<body>
    <main>
        <!-- start the project -->
        <!-- app layout -->
        <div id="app-layout" class="overflow-x-hidden flex">
            <?php include __DIR__ . '/../components/sidebar.php' ?>

            <div class="container mx-auto px-6 py-8">
                <h1 class="text-2xl font-semibold mb-4">Courses</h1>
                <div class="overflow-x-auto bg-white shadow-md rounded-lg">
                    <?php require_once __DIR__ . '/../components/flash.php'; ?>
                    <table id="coursesTable" class="w-full min-w-full leading-normal">
                        <thead>
                            <tr>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Course Name
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Teacher
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Category
                                </th>
                                <th
                                    class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                    Actions
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($courses as $course): ?>
                            <tr>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <?= htmlspecialchars($course['title']) ?>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <?= htmlspecialchars($course['teacher_name']) ?>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <?= htmlspecialchars($course['category_name']) ?>
                                </td>
                                <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                    <a href="/courses/view/<?= $course['id'] ?>"
                                        class="text-blue-600 hover:text-blue-900">View</a>
                                    <button onclick="deleteId('<?= $course['id'] ?>')"
                                        class="text-red-600 hover:text-red-900 ml-3">Delete</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <?php if ($lastPage > 1): ?>
                    <div class="px-5 py-5 bg-white border-t flex flex-col xs:flex-row items-center xs:justify-between">
                        <div class="inline-flex mt-2 xs:mt-0">
                            <?php if ($currentPage > 1): ?>
                            <a href="?page=<?= $currentPage - 1 ?>"
                                class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-l">
                                Previous
                            </a>
                            <?php endif; ?>

                            <?php if ($currentPage < $lastPage): ?>
                            <a href="?page=<?= $currentPage + 1 ?>"
                                class="text-sm bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-r<?= $currentPage > 1 ? '' : ' rounded-l' ?>">
                                Next
                            </a>
                            <?php endif; ?>
                        </div>
                        <span class="text-xs xs:text-sm text-gray-900">
                            Showing Page <?= $currentPage ?> of <?= $lastPage ?>
                        </span>
                    </div>
                    <?php endif; ?>
                </div>
            </div>

            <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
            <script>
            $(document).ready(function() {
                $('#coursesTable').DataTable();
            });

            function deleteId(courseId) {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        fetch(`/admin/courses/delete/${courseId}`, {
                                method: 'DELETE',
                            })
                            .then(response => {
                                Swal.fire(
                                    'Deleted!',
                                    'Your course has been deleted.',
                                    'success'
                                ).then(() => {
                                    window.location.href = '/admin/courses';
                                });
                            })
                            .catch(error => {
                                console.error(error);
                            });
                    }
                });
            }
            </script>


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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/simplebar/6.3.0/simplebar.min.js"></script>
    <script src="/assets/js/theme.js"></script>
</body>

</html>