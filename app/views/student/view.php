<?php include __DIR__ . '/../components/head.php' ?>

<body>
    <main>
        <!-- start the project -->
        <!-- app layout -->
        <div id="app-layout" class="overflow-x-hidden flex">
            <?php include __DIR__ . '/../components/sidebar.php' ?>
            <div class="container mx-auto px-6 py-8">
                <h1 class="text-3xl font-bold mb-6 text-indigo-700">Course Details</h1>
                <div class="bg-white shadow-lg rounded-lg overflow-hidden">
                    <?php require_once __DIR__ . '/../components/flash.php'; ?>
                    <div class="p-4">
                        <h2 class="text-2xl font-bold mb-4 text-gray-800"><?= htmlspecialchars($course['title']) ?>
                        </h2>
                        <p class="text-gray-600 mb-6 leading-relaxed">
                            <?= htmlspecialchars($course['description']) ?></p>
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div class="bg-indigo-50 p-4 rounded-lg">
                                <span class="font-semibold text-indigo-700">Teacher:</span>
                                <p class="mt-1 text-gray-800"><?= htmlspecialchars($course['teacher_name']) ?></p>
                            </div>
                            <div class="bg-indigo-50 p-4 rounded-lg">
                                <span class="font-semibold text-indigo-700">Created At:</span>
                                <p class="mt-1 text-gray-800"><?= htmlspecialchars($course['created_at']) ?></p>
                            </div>
                        </div>
                        <div class="content-container bg-gray-100 p-4 rounded-lg">
                            <?php if ($course['TYPE'] == 'document'): ?>
                            <iframe src="<?= htmlspecialchars($course['link']) ?>"
                                class="w-full h-[600px] border-0 rounded-lg shadow-md"></iframe>
                            <?php elseif ($course['TYPE'] == 'video'): ?>
                            <video class="w-full h-[600px] rounded-lg shadow-md" controls>
                                <source src="<?= htmlspecialchars($course['link']) ?>" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        </div>
        </div>


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