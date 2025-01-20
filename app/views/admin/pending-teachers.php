<?php include __DIR__ . '/../components/head.php' ?>

<body>
    <main>
        <!-- start the project -->
        <!-- app layout -->
        <div id="app-layout" class="overflow-x-hidden flex">
            <?php include __DIR__ . '/../components/sidebar.php' ?>

            <!-- Pending Teachers Table -->
            <div class="mx-6 mt-6">
                <h2 class="text-lg font-semibold mb-4">Pending Teacher Applications</h2>

                <div class="card shadow-sm">
                    <div class="overflow-x-auto">
                    <?php require_once __DIR__ . '/../components/flash.php'; ?>
                        <table class="min-w-full w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Name</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Email</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Specialization</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php if (!empty($pendingTeachers)): ?>
                                <?php foreach ($pendingTeachers as $teacher): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php echo htmlspecialchars($teacher['name']); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php echo htmlspecialchars($teacher['email']); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php echo htmlspecialchars($teacher['specialization']); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <form action="/admin/validate-teacher" method="POST" class="inline-block">
                                            <input type="hidden" name="teacher_id"
                                                value="<?php echo $teacher['id']; ?>">
                                            <input type="hidden" name="action" value="approve">
                                            <button type="submit" class="text-green-600 hover:text-green-900 mr-3">
                                                <i data-feather="check" class="w-4 h-4"></i>
                                            </button>
                                        </form>
                                        <form action="/admin/validate-teacher" method="POST" class="inline-block">
                                            <input type="hidden" name="teacher_id"
                                                value="<?php echo $teacher['id']; ?>">
                                            <input type="hidden" name="action" value="reject">
                                            <button type="submit" class="text-red-600 hover:text-red-900">
                                                <i data-feather="x" class="w-4 h-4"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php else: ?>
                                <tr>
                                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">No pending teacher
                                        applications</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Active Teachers Table -->
            <div class="mx-6 mt-8">
                <h2 class="text-lg font-semibold mb-4">Active Teachers</h2>
                <div class="card shadow-sm">
                    <div class="overflow-x-auto">
                        <table class="min-w-full w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Name</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Email</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Status</th>
                                    <th scope="col"
                                        class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                <?php if (!empty($activeTeachers)): ?>
                                <?php foreach ($activeTeachers as $teacher): ?>
                                <tr>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php echo htmlspecialchars($teacher['name']); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <?php echo htmlspecialchars($teacher['email']); ?></td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                    <?php echo $teacher['status'] === 'active' ? 'bg-green-100 text-green-800' : 
                                                        ($teacher['status'] === 'inactive' ? 'bg-yellow-100 text-yellow-800' : 
                                                        'bg-red-100 text-red-800'); ?>">
                                            <?php echo ucfirst($teacher['status']); ?>
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <select onchange="updateTeacherStatus(this, <?php echo $teacher['id']; ?>)"
                                            class="form-select text-sm">
                                            <option value="active"
                                                <?php echo $teacher['status'] === 'active' ? 'selected' : ''; ?>>
                                                Active
                                            </option>
                                            <option value="inactive"
                                                <?php echo $teacher['status'] === 'inactive' ? 'selected' : ''; ?>>
                                                Inactive
                                            </option>
                                            <option value="banned"
                                                <?php echo $teacher['status'] === 'banned' ? 'selected' : ''; ?>>
                                                Banned
                                            </option>
                                        </select>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php else: ?>
                                <tr>
                                    <td colspan="5" class="px-6 py-4 text-center text-gray-500">No active teachers
                                        found</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </main>

    <!-- Feather Icons -->
    <script src="https://unpkg.com/feather-icons"></script>
    <script>
    feather.replace();

    async function updateTeacherStatus(selectElement, teacherId) {
        const status = selectElement.value;

        try {
            const response = await fetch('/admin/update-teacher-status', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `teacher_id=${teacherId}&status=${status}`
            });

            const data = await response.json();

            if (response.ok) {
                location.reload();
            } else {
                alert(data.error || 'Failed to update teacher status');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('An error occurred while updating teacher status');
        }
    }
    </script>
    <?php require_once __DIR__ . '/../components/footer.php'; ?>
</body>

</html>