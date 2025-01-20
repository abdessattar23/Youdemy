<?php require_once __DIR__ . '/../components/head.php'; ?>

<div class="bg-white">
    <!-- Hero section -->
    <?php require_once __DIR__ . '/../components/flash.php'; ?>
    <div class="relative isolate px-6 pt-14 lg:px-8">
        <div class="mx-auto max-w-2xl py-32 sm:py-48 lg:py-56">
            <div class="text-center">
                <h1 class="text-4xl font-bold tracking-tight text-gray-900 sm:text-6xl">Welcome to Youdemy</h1>
                <p class="mt-6 text-lg leading-8 text-gray-600">Your gateway to knowledge. Join our community of
                    learners and educators to explore a world of online courses.</p>
                <div class="mt-10 flex items-center justify-center gap-x-6">
                    <a href="/register"
                        class="rounded-md bg-indigo-600 px-3.5 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Get
                        started</a>
                    <a href="/login" class="text-sm font-semibold leading-6 text-gray-900">Sign in <span
                            aria-hidden="true">→</span></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics section -->
    <div class="bg-white py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <dl class="grid grid-cols-1 gap-x-8 gap-y-16 text-center lg:grid-cols-3">
                <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                    <dt class="text-base leading-7 text-gray-600">Total Courses</dt>
                    <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900">
                        <?= number_format($total_courses) ?></dd>
                </div>
                <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                    <dt class="text-base leading-7 text-gray-600">Active Students</dt>
                    <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900">
                        <?= number_format($total_students) ?></dd>
                </div>
                <div class="mx-auto flex max-w-xs flex-col gap-y-4">
                    <dt class="text-base leading-7 text-gray-600">Expert Teachers</dt>
                    <dd class="order-first text-3xl font-semibold tracking-tight text-gray-900">
                        <?= number_format($total_teachers) ?></dd>
                </div>
            </dl>
        </div>
    </div>

    <!-- Featured courses section -->
    <?php if (!empty($featured_courses)): ?>
    <div class="bg-gray-100 py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 lg:px-8">
            <div class="mx-auto max-w-2xl text-center">
                <h2 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Featured Courses</h2>
                <p class="mt-2 text-lg leading-8 text-gray-600">Explore our most popular courses and start learning
                    today.</p>
            </div>
            <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-x-8 gap-y-20 lg:mx-0 lg:max-w-none lg:grid-cols-3">
                <?php foreach ($featured_courses as $course): ?>
                <article class="flex flex-col items-start">
                    <div class="w-full">
                        <div class="relative w-full">
                            <img src="<?= $course['thumbnail'] ?? '/images/course-placeholder.jpg' ?>" alt=""
                                class="aspect-[16/9] w-full rounded-2xl bg-gray-100 object-cover sm:aspect-[2/1] lg:aspect-[3/2]">
                        </div>
                        <div class="max-w-xl">
                            <div class="mt-8 flex items-center gap-x-4 text-xs">
                                <time datetime="<?= $course['created_at'] ?>"
                                    class="text-gray-500"><?= date('M j, Y', strtotime($course['created_at'])) ?></time>
                                <span
                                    class="relative z-10 rounded-full bg-gray-50 px-3 py-1.5 font-medium text-gray-600 hover:bg-gray-100"><?= htmlspecialchars($course['category']) ?></span>
                            </div>
                            <div class="group relative">
                                <h3
                                    class="mt-3 text-lg font-semibold leading-6 text-gray-900 group-hover:text-gray-600">
                                    <span class="absolute inset-0"></span>
                                    <?= htmlspecialchars($course['title']) ?>
                                </h3>
                                <p class="mt-5 line-clamp-3 text-sm leading-6 text-gray-600">
                                    <?= htmlspecialchars($course['description']) ?></p>
                            </div>
                            <div class="relative mt-8 flex items-center gap-x-4">
                                <div class="text-sm leading-6">
                                    <p class="font-semibold text-gray-900">
                                        <span class="absolute inset-0"></span>
                                        <?= htmlspecialchars($course['teacher_name']) ?>
                                    </p>
                                    <p class="text-gray-600">Instructor</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/../componenets/footer.php'; ?>