<?php include __DIR__ . '/../components/head.php' ?>

<body>
    <main>
        <!-- start the project -->
        <!-- app layout -->
        <div id="app-layout" class="overflow-x-hidden flex">
            <?php include __DIR__ . '/../components/sidebar.php' ?>
            <!-- Content -->
            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Categories Section -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold">Categories</h2>
                    </div>
                    <?php require_once __DIR__ . '/../components/flash.php'; ?>
                    <form id="addCategoryForm" onsubmit="return addCategories(event)" class="mb-6">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Add Categories</label>
                            <input type="text" name="categories" class="form-input w-full"
                                placeholder="Enter categories separated by commas (e.g., Web Development, Mobile Apps, AI)"
                                required>
                        </div>
                        <button type="submit" class="btn btn-primary w-full">Add Categories</button>
                    </form>
                    <div class="space-y-4">
                        <?php foreach ($categories as $category): ?>
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                            <span><?php echo htmlspecialchars($category['name']); ?></span>
                            <button onclick="deleteCategory(<?php echo $category['id']; ?>)"
                                class="text-red-600 hover:text-red-800">
                                <i data-feather="trash-2" class="w-4 h-4"></i>
                            </button>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Tags Section -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-xl font-semibold">Tags</h2>
                    </div>
                    <form id="addTagForm" onsubmit="return addTags(event)" class="mb-6">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Add Tags</label>
                            <input type="text" name="tags" class="form-input w-full"
                                placeholder="Enter tags separated by commas (e.g., javascript, python, react)" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-full">Add Tags</button>
                    </form>
                    <div class="space-y-4">
                        <?php foreach ($tags as $tag): ?>
                        <div class="flex items-center justify-between p-3 bg-gray-50 rounded">
                            <span><?php echo htmlspecialchars($tag['name']); ?></span>
                            <button onclick="deleteTag(<?php echo $tag['id']; ?>)"
                                class="text-red-600 hover:text-red-800">
                                <i data-feather="trash-2" class="w-4 h-4"></i>
                            </button>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>

        <script>
        // AJAX functions for bulk operations
        async function addCategories(event) {
            event.preventDefault();
            const form = event.target;
            const categoriesInput = form.querySelector('input[name="categories"]');
            const categories = categoriesInput.value.split(',').map(cat => cat.trim()).filter(cat => cat);

            try {
                const response = await fetch('/admin/categories/add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        categories: categories
                    })
                });

                if (response.ok) {
                    location.reload();
                } else {
                    const data = await response.json();
                    alert(data.error || 'Failed to add categories');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred');
            }
        }

        async function addTags(event) {
            event.preventDefault();
            const form = event.target;
            const tagsInput = form.querySelector('input[name="tags"]');
            const tags = tagsInput.value.split(',').map(tag => tag.trim()).filter(tag => tag);

            try {
                const response = await fetch('/admin/tags/add', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        tags: tags
                    })
                });

                if (response.ok) {
                    location.reload();
                } else {
                    const data = await response.json();
                    alert(data.error || 'Failed to add tags');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred');
            }
        }

        async function deleteCategory(id) {
            if (!confirm('Are you sure you want to delete this category?')) return;

            try {
                const response = await fetch(`/admin/categories/delete/${id}`, {
                    method: 'POST'
                });

                if (response.ok) {
                    location.reload();
                } else {
                    const data = await response.json();
                    alert(data.error || 'Failed to delete category');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred');
            }
        }

        async function deleteTag(id) {
            if (!confirm('Are you sure you want to delete this tag?')) return;

            try {
                const response = await fetch(`/admin/tags/delete/${id}`, {
                    method: 'POST'
                });

                if (response.ok) {
                    location.reload();
                } else {
                    const data = await response.json();
                    alert(data.error || 'Failed to delete tag');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('An error occurred');
            }
        }
        </script>
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