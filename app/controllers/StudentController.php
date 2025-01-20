<?php

class StudentController extends BaseController
{
    private $UserModel;
    private $StudentModel;
    private $TeacherModel;

    public function __construct()
    {
        try {
            $this->UserModel = new User();
            $this->TeacherModel = new Teacher();
            $this->StudentModel = new Student();
        } catch (Exception $e) {
            $this->setError('Failed to initialize student dashboard');
            redirect('/login');
        }
    }

    public function index()
    {
        try {
            if (!isset($_SESSION['email'])) {
                $this->setError('Please login to access the student dashboard');
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

            $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
            $perPage = 9;

            $email = $_SESSION['email'];
            $data = [
                'user' => [
                    'name' => $_SESSION['name'],
                    'email' => $email
                ],
                'enrolled_courses' => $this->StudentModel->getEnrolledCourses($email),
                'courses' => $this->StudentModel->getAvailableCourses($page, $perPage)
            ];

            $this->render('student/dashboard', $data);

        } catch (Exception $e) {
            $this->setError('Failed to load student dashboard: ' . $e->getMessage());
            echo $e->getMessage();
        }
    }

    public function enrolled()
    {
        $data = [
            'user' => [
                'name' => $_SESSION['name'],
                'email' => $_SESSION['email']
            ],
            'enrolled_courses' => $this->StudentModel->getEnrolledCourses($_SESSION['email'])
        ];
        $this->render('student/enrolled', $data);
    }

    public function view($id)
    {
        $course = $this->TeacherModel->getCourseById($id);
        // dd($course);
        $this->render('student/view', ['course' => $course]);
    }

    public function enroll($id)
    {
        $this->StudentModel->enroll($id);
        redirect('/student');
    }
}