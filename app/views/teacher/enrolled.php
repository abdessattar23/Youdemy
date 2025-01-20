<?php include __DIR__ . '/../components/head.php' ?>

<body>
    <main>
        <!-- start the project -->
        <!-- app layout -->
        <div id="app-layout" class="overflow-x-hidden flex">
            <?php include __DIR__ . '/../components/sidebar.php' ?>

            <div class="bg-indigo-600 px-8 pt-10 lg:pt-14 pb-16 flex justify-between items-center mb-3">
                <!-- title -->
                <h1 class="text-xl text-white"><?= htmlspecialchars($course['title']) ?> - Enrolled Students</h1>
            </div>
            <div class="mx-6">
                <div class="card shadow">
                    <!-- heading -->
                    <div class="border-b border-gray-300 px-5 py-4">
                        <h4>Enrolled Students</h4>
                    </div>
                    <div class="relative overflow-x-auto">
                        <?php require_once __DIR__ . '/../components/flash.php'; ?>
                        <table class="w-full text-left text-gray-500">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Name</th>
                                    <th scope="col" class="px-6 py-3">Email</th>
                                    <th scope="col" class="px-6 py-3">Enrollment Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($students as $student): ?>
                                <tr class="bg-white border-b hover:bg-gray-50">
                                    <td class="px-6 py-4 font-medium text-gray-900">
                                        <?= htmlspecialchars($student['name']) ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?= htmlspecialchars($student['email']) ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?= date('Y-m-d H:i:s', strtotime($student['enrollment_date'])) ?>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <?php include __DIR__ . '/../components/footer.php' ?>
        </div>
        </div>
    </main>
</body>

</html>