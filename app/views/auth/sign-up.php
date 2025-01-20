<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="shortcut icon" type="image/x-icon" href="./assets/images/favicon/favicon.ico" />

    <!-- Libs CSS -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/simplebar/6.3.0/simplebar.css" />

    <!-- Theme CSS -->
    <link rel="stylesheet" href="./assets/css/theme.css" />
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width" />
    <meta name="description" content="Sign Up - TailwindCSS HTML Admin Template Free - Dash UI" />
    <title>Sign Up - TailwindCSS HTML Admin Template Free - Dash UI</title>
</head>

<body>
    <!-- start signup page -->
    <div class="flex flex-col items-center justify-center g-0 h-screen px-4">
        <!-- card -->
        <div class="justify-center items-center w-full bg-white rounded-md shadow lg:flex md:mt-0 max-w-md xl:p-0">
            <!-- card body -->
            <div class="p-6 w-full sm:p-8 lg:p-8">
                <div class="mb-4">
                    <a href="index.html"><img src="assets/images/brand/logo/logo-primary.svg" class="mb-1" alt="" /></a>
                    <p class="mb-6">Please enter your user information.</p>
                    <?php if (isset($_SESSION['error'])): ?>
                    <div class="bg-red-500 mb-3 text-white rounded-lg p-3" role="alert">
                        <p class="text-white text-sm font-bold"><?php echo $_SESSION['error']; ?></p>
                    </div>
                    <?php endif; ?>
                    <?php if (isset($_SESSION['success'])): ?>
                    <div class="bg-teal-500 mb-3 text-white rounded-lg p-3" role="alert">
                        <p class="text-white text-sm font-bold"><?php echo $_SESSION['success']; ?></p>
                    </div>
                    <?php endif; ?>
                </div>
                <?php require_once __DIR__ . '/../components/flash.php'; ?>
                <!-- form -->
                <form action="/register" method="POST">
                    <!-- username -->
                    <div class="lg:flex 2xl:block gap-4">
                        <div class="mb-3">
                            <label for="fullname" class="inline-block mb-2">Full Name</label>
                            <input type="text" id="fullname"
                                class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3 disabled:opacity-50 disabled:pointer-events-none"
                                name="fullname" placeholder="Full Name" required="" />
                        </div>
                        <!-- email -->
                        <div class="mb-3">
                            <label for="email" class="inline-block mb-2">Email</label>
                            <input type="email" id="email"
                                class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3 disabled:opacity-50 disabled:pointer-events-none"
                                name="email" placeholder="Email address here" required="" />
                        </div>
                    </div>
                    <!-- password -->
                    <div class="mb-3">
                        <label for="password" class="inline-block mb-2">Password</label>
                        <input type="password" id="password"
                            class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3 disabled:opacity-50 disabled:pointer-events-none"
                            name="password" placeholder="**************" required="" />
                    </div>
                    <!-- role -->
                    <div class="mb-5">
                        <label for="role" class="inline-block mb-2">Role</label>
                        <select type="text" id="role"
                            class="border border-gray-300 text-gray-900 rounded focus:ring-indigo-600 focus:border-indigo-600 block w-full p-2 px-3 disabled:opacity-50 disabled:pointer-events-none"
                            name="role" placeholder="Student" required="">
                            <option value="student">Student</option>
                            <option value="teacher">Teacher</option>
                        </select>
                    </div>
                    <div>
                        <!-- button -->
                        <div class="grid">
                            <button type="submit" name="submit"
                                class="btn bg-indigo-600 text-white border-indigo-600 hover:bg-indigo-800 hover:border-indigo-800 active:bg-indigo-800 active:border-indigo-800 focus:outline-none focus:ring-4 focus:ring-indigo-300">
                                Create Free Account
                            </button>
                        </div>
                        <div class="md:flex md:justify-between mt-4">
                            <div class="mb-2 mb-md-0">
                                Already member?
                                <a href="sign-in.html" class="text-indigo-600 hover:text-indigo-600">Login</a>
                            </div>
                            <div>
                                <a href="forget-password.html" class="text-indigo-600 hover:text-indigo-600">Forgot your
                                    password?</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feathers/5.0.31/index.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/simplebar/6.3.0/simplebar.min.js"></script>
    <script src="./assets/js/theme.js"></script>
</body>

</html>

<?php unset($_SESSION['error']); unset($_SESSION['success']); ?>