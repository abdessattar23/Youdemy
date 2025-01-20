<?php

class AuthController extends BaseController
{
    private $UserModel;
    private $StudentModel;
    
    public function __construct()
    {
        try {
            $this->UserModel = new User();
            $this->StudentModel = new Student();
        } catch (Exception $e) {
            $this->setError('Failed to initialize authentication system');
            redirect('/');
        }
    }

    public function showLogin()
    {
        try {
            $this->render('auth/sign-in');
        } catch (Exception $e) {
            $this->setError('Failed to display login page');
            redirect('/');
        }
    }

    public function showSignUp()
    {
        try {
            $this->render('auth/sign-up');
        } catch (Exception $e) {
            $this->setError('Failed to display registration page');
            redirect('/');
        }
    }

    public function register()
    {
        if (!isset($_POST['submit'])) {
            $this->setError('Invalid request');
            redirect('/register');
            return;
        }

        try {
            $name = sanitize($_POST['fullname']);
            $email = sanitize($_POST['email']);
            $password = sanitize($_POST['password']);
            $role = sanitize($_POST['role']);

            if (empty($name) || empty($email) || empty($password) || empty($role)) {
                $this->setError('All fields are required');
                redirect('/register');
                return;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->setError('Invalid email format');
                redirect('/register');
                return;
            }

            if (strlen($password) < 6) {
                $this->setError('Password must be at least 6 characters long');
                redirect('/register');
                return;
            }

            $result = $this->UserModel->register($name, $email, $password, $role);
            
            if (!$result) {
                $this->setError('Failed to create account. Please try again.');
                redirect('/register');
                return;
            }

            $this->setSuccess('Account created successfully! Please login.');
            redirect('/login');

        } catch (Exception $e) {
            $this->setError($e->getMessage());
            redirect('/register');
        }
    }

    public function login()
    {
        if (!isset($_POST['submit'])) {
            $this->setError('Invalid request');
            redirect('/login');
            return;
        }

        try {
            $email = sanitize($_POST['email']);
            $password = sanitize($_POST['password']);

            if (empty($email) || empty($password)) {
                $this->setError('Email and password are required');
                redirect('/login');
                return;
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $this->setError('Invalid email format');
                redirect('/login');
                return;
            }

            $result = $this->UserModel->login($email, $password);
            
            if (!$result) {
                $this->setError('Invalid email or password');
                redirect('/login');
                return;
            }

            $_SESSION['name'] = $result['name'];
            $_SESSION['email'] = $result['email'];
            $_SESSION['role'] = $result['role'];
            $_SESSION['id'] = $result['id'];

            switch ($result['role']) {
                case 'admin':
                    redirect('/admin');
                    break;
                case 'teacher':
                    redirect('/teacher');
                    break;
                case 'student':
                    redirect('/student');
                    break;
                default:
                    throw new Exception('Invalid user role');
            }

        } catch (Exception $e) {
            $this->setError($e->getMessage());
            redirect('/login');
        }
    }

    public function logout()
    {
        try {
            session_destroy();
            redirect('/login');
        } catch (Exception $e) {
            $this->setError('Failed to logout. Please try again.');
            redirect('/');
        }
    }


    public function visitor() {
        try {
            $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
            $perPage = 9;
            $data = [
                'courses' => $this->StudentModel->getAvailableCourses($page, $perPage)
            ];

            $this->render('visitor/visitor', $data);

        } catch (Exception $e) {
            $this->setError('Failed to load courses: ' . $e->getMessage());
            echo $e->getMessage();
        }
    }
}