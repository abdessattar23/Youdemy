<?php include __DIR__ . '/../components/head.php' ?>

<body>
    <main>
        <!-- start the project -->
        <!-- app layout -->
        <div id="app-layout" class="overflow-x-hidden flex">
            <?php include __DIR__ . '/../components/sidebar.php' ?>
            <!-- heading -->
            <div class="border-b border-gray-300 px-5 py-4">
                <h4>New Courses</h4>
            </div>
            <div class="relative overflow-x-auto">
                <div class="mx-auto px-4 mt-4 w-full">
                    <?php require_once __DIR__ . '/../components/flash.php'; ?>
                    <form action="/teacher/courses/edit/<?= $course['id'] ?>" method="POST"
                        enctype="multipart/form-data" class="space-y-6">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" name="title" id="title"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                value="<?= htmlspecialchars($course['title']) ?>" required>
                        </div>
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea name="description" id="description" rows="3"
                                class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                required><?= htmlspecialchars($course['description']) ?></textarea>
                        </div>
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                            <select name="category_id" id="category_id"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                required>
                                <?php foreach ($categories as $category): ?>
                                <option value="<?= $category['id'] ?>"
                                    <?= $category['id'] == $course['category_id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($category['name']) ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label for="tags" class="block text-sm font-medium text-gray-700">Tags</label>
                            <select name="tags[]" id="tags"
                                class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                multiple>
                                <?php foreach ($tags as $tag): ?>
                                <option value="<?= $tag['id'] ?>"
                                    <?= isset($course['tags'][$tag['id']]) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($tag['name']) ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <input type="hidden" name="content_type" value="<?= $course['TYPE'] ?>">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Content</label>
                            <div class="mt-2">
                                <div class="flex items-center">
                                    <input type="radio" name="content_source" value="url" id="url_radio"
                                        class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                        <?= filter_var($course['link'], FILTER_VALIDATE_URL) ? 'checked' : '' ?>>
                                    <label for="url_radio" class="ml-2 block text-sm text-gray-700">
                                        URL
                                    </label>
                                </div>
                                <div class="flex items-center mt-2">
                                    <input type="radio" name="content_source" value="file" id="file_radio"
                                        class="focus:ring-indigo-500 h-4 w-4 text-indigo-600 border-gray-300"
                                        <?= !filter_var($course['link'], FILTER_VALIDATE_URL) ? 'checked' : '' ?>>
                                    <label for="file_radio" class="ml-2 block text-sm text-gray-700">
                                        File Upload
                                    </label>
                                </div>
                            </div>
                            <div id="url_content" class="mt-2" style="display: none;">
                                <input type="url" name="content_url"
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md"
                                    value="<?= filter_var($course['link'], FILTER_VALIDATE_URL) ? $course['link'] : '' ?>">
                            </div>
                            <div id="file_content" class="mt-2" style="display: none;">
                                <input type="file" name="content_file"
                                    class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300"
                                    accept=".pdf,.doc,.docx,.mp4">
                                <p class="mt-1 text-sm text-gray-500">Current file:
                                    <?= htmlspecialchars(basename($course['link'])) ?></p>
                            </div>
                        </div>
                        <div class="flex justify-between items-center">
                            <button type="submit"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Update
                                Course</button>
                            <button type="button" onclick="deleteCourse(<?= $course['id'] ?>)"
                                class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Delete
                                Course</button>
                        </div>
                    </form>
                </div>
                <script>
                function deleteCourse(courseId) {
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
                            fetch(`/teacher/courses/delete/${courseId}`, {
                                    method: 'DELETE',
                                })
                                .then(response => {
                                    Swal.fire(
                                        'Deleted!',
                                        'Your course has been deleted.',
                                        'success'
                                    ).then(() => {
                                        window.location.href = '/teacher/courses';
                                    });
                                })
                                .catch(error => {
                                    Swal.fire(
                                        'Error!',
                                        error.message,
                                        'error'
                                    );
                                });
                        }
                    });
                }

                document.addEventListener('DOMContentLoaded', function() {
                    const urlContent = document.getElementById('url_content');
                    const fileContent = document.getElementById('file_content');
                    const urlRadio = document.getElementById('url_radio');
                    const fileRadio = document.getElementById('file_radio');

                    function updateContentVisibility() {
                        urlContent.style.display = urlRadio.checked ? 'block' : 'none';
                        fileContent.style.display = fileRadio.checked ? 'block' : 'none';
                    }

                    urlRadio.addEventListener('change', updateContentVisibility);
                    fileRadio.addEventListener('change', updateContentVisibility);

                    // Initial visibility
                    updateContentVisibility();
                });
                </script>
            </div>
        </div>
        </div>
        </div>
        <?php include __DIR__ . '/../components/footer.php' ?>