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
                    <?php if (isset($error)): ?>
                    <div class="alert alert-danger">
                        <?php echo $error; ?>
                    </div>
                    <?php endif; ?>
                    <?php require_once __DIR__ . '/../components/flash.php'; ?>
                    <form action="/teacher/courses/create" method="POST" enctype="multipart/form-data"
                        class="space-y-6">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
                            <input type="text" id="title" name="title" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
                            <textarea id="description" name="description" rows="3" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"></textarea>
                        </div>
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-gray-700">Category</label>
                            <select id="category_id" name="category_id" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">Select a category</option>
                                <?php foreach ($categories as $category): ?>
                                <option value="<?php echo $category['id']; ?>">
                                    <?php echo htmlspecialchars($category['name']); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>

                        <div>
                            <span class="block text-sm font-medium text-gray-700">Tags</span>
                            <div class="mt-2 grid grid-cols-2 gap-2 sm:grid-cols-3 md:grid-cols-4">
                                <?php foreach ($tags as $tag): ?>
                                <div class="flex items-center">
                                    <input id="tag_<?php echo $tag['id']; ?>" name="tags[]" type="checkbox"
                                        value="<?php echo $tag['id']; ?>"
                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    <label for="tag_<?php echo $tag['id']; ?>" class="ml-2 text-sm text-gray-600">
                                        <?php echo htmlspecialchars($tag['name']); ?> </label>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div>
                            <span class="block text-sm font-medium text-gray-700">Document Type</span>
                            <div class="mt-2 space-y-2">
                                <div class="flex items-center">
                                    <input id="doctype_video" name="doctype" type="radio" value="video" checked
                                        class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    <label for="doctype_video" class="ml-2 text-sm text-gray-600">Video</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="doctype_document" name="doctype" type="radio" value="document"
                                        class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    <label for="doctype_document" class="ml-2 text-sm text-gray-600">Document</label>
                                </div>
                            </div>
                        </div>

                        <div>
                            <span class="block text-sm font-medium text-gray-700">Content Type</span>
                            <div class="mt-2 space-y-2">
                                <div class="flex items-center">
                                    <input id="content_type_url" name="content_type" type="radio" value="url" checked
                                        class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    <label for="content_type_url" class="ml-2 text-sm text-gray-600">URL</label>
                                </div>
                                <div class="flex items-center">
                                    <input id="content_type_file" name="content_type" type="radio" value="file"
                                        class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                    <label for="content_type_file" class="ml-2 text-sm text-gray-600">File
                                        Upload</label>
                                </div>
                            </div>
                        </div>
                        <div id="url_content">
                            <label for="content_url" class="block text-sm font-medium text-gray-700">Content URL</label>
                            <input type="url" id="content_url" name="content_url"
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        </div>
                        <div id="file_content" class="hidden">
                            <label for="content_file" class="block text-sm font-medium text-gray-700">Content
                                File</label>
                            <input type="file" id="content_file" name="content_file"
                                class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                            <p class="mt-1 text-sm text-gray-500">Allowed file types: MP4, PDF, DOC, DOCX</p>
                        </div>
                        <button type="submit"
                            class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Create
                            Course</button>
                    </form>
                </div>
                <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const urlContent = document.getElementById('url_content');
                    const fileContent = document.getElementById('file_content');
                    const contentTypeUrl = document.getElementById('content_type_url');
                    const contentTypeFile = document.getElementById('content_type_file');
                    const contentUrl = document.getElementById('content_url');
                    const contentFile = document.getElementById('content_file');

                    function toggleContentType() {
                        if (contentTypeUrl.checked) {
                            urlContent.style.display = 'block';
                            fileContent.style.display = 'none';
                            contentUrl.required = true;
                            contentFile.required = false;
                        } else {
                            urlContent.style.display = 'none';
                            fileContent.style.display = 'block';
                            contentUrl.required = false;
                            contentFile.required = true;
                        }
                    }
                    contentTypeUrl.addEventListener('change', toggleContentType);
                    contentTypeFile.addEventListener('change', toggleContentType);
                });
                </script>
            </div>
        </div>
        </div>
        </div>
        </div>
    </main>
    <?php include __DIR__ . '/../components/footer.php' ?>
</body>

</html>