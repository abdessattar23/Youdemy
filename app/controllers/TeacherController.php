<?php
require_once __DIR__ . '/../../autoload.php';

class TeacherController extends BaseController
{
    private $UserModel;
    private $TeacherModel;

    public function __construct()
    {
        try {
            $this->UserModel = new User();
            $this->TeacherModel = new Teacher();
        } catch (Exception $e) {
            $this->setError('Failed to initialize teacher dashboard');
            redirect('/login');
        }
    }

    public function index()
    {
        try {
            if (!isset($_SESSION['email'])) {
                $this->setError('Please login to access the teacher dashboard');
                redirect('/login');
                return;
            }

            $status = $this->UserModel->getStatus($_SESSION['email']);
            switch ($status) {
                case 'banned':
                    $this->render('components/banned');
                    return;
                case 'inactive':
                    $this->render('components/inactive');
                    return;
            }

            $page = isset($_GET['page']) ? max(1, (int)$_GET['page']) : 1;
            $limit = 10;
            $email = $_SESSION['email'];

            $totalCourses = $this->TeacherModel->getTotalCoursesN($email);
            $totalPages = max(1, ceil($totalCourses / $limit));

            if ($page > $totalPages) {
                $page = $totalPages;
            }

            $data = [
                'user' => [
                    'name' => $_SESSION['name'],
                    'email' => $email
                ],
                'courses' => [
                    'data' => $this->TeacherModel->getCourses($email, $page, $limit),
                    'current_page' => $page,
                    'total_pages' => $totalPages
                ],
                'statistics' => [
                    'total_enrolled' => $this->TeacherModel->getTotalEnrolled($email),
                    'total_courses' => $totalCourses
                ]
            ];

            $this->render('teacher/dashboard', $data);

        } catch (Exception $e) {
            $this->setError('Failed to load teacher dashboard: ' . $e->getMessage());
            redirect('/teacher');
        }
    }
}