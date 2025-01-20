<?php
require_once __DIR__ . '/../../autoload.php';
require_once __DIR__ . '/../config/db.php';
class CourseController extends BaseController {

    private $courseModel;
    private $TeacherModel;
    private $db;

    public function __construct() {
        $this->courseModel = new DocumentCourse();
        $this->TeacherModel = new Teacher();
        $this->db = new DB();
    }

    public function index(){
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

            $this->render('teacher/courses', $data);
    }

    public function showCreate(){
        $categories = Teacher::getCategories();
        $tags = Teacher::getTags();
        $this->render('teacher/create', ['categories' => $categories, 'tags' => $tags]);
    }

    public function create(){
        $title = $_POST['title'];
        $description = $_POST['description'];
        $category_id = $_POST['category_id'];
        $tags = $_POST['tags'];
        $type = $_POST['doctype'];
        if(!empty($_POST['content_url'])) {
            $link = $_POST['content_url'];
        } else {
            $allowedTypes = ['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document', 'video/mp4'];
            $uploadDir = __DIR__ . '/../../public/uploads/';
            $file = $_FILES['content_file'];
            
            if (!in_array($file['type'], $allowedTypes)) {
                $this->setError('Invalid file type. Only PDF, DOC, DOCX, and MP4 files are allowed.');
                redirect('/teacher/courses/create');
            }
            
            $fileName = uniqid() . '_' . basename($file['name']);
            $uploadPath = $uploadDir . $fileName;
    
            if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
                $this->setError('Failed to upload file.');
                redirect('/teacher/courses/create');
            }
            
            $link = 'http://localhost:3000/uploads/' . $fileName;
            
        }
        if($type == 'video') {
            $course = new VideoCourse();
            $id = $course->create($title, $description, $category_id, $tags, $link);
            $result = $course->display($id);
            $categories = Teacher::getCategories();
            $tags = Teacher::getTags();
            $this->render('teacher/edit', ['course' => $result, 'categories' => $categories, 'tags' => $tags]);
        } else {
            $course = new DocumentCourse();
            $id = $course->create($title, $description, $category_id, $tags, $link);
            $result = $course->display($id);
            $categories = Teacher::getCategories();
            $tags = Teacher::getTags();
            $this->render('teacher/edit', ['course' => $result, 'categories' => $categories, 'tags' => $tags]);
        }   
    }

    public function update($id) {
        try {
            $course = $this->courseModel->createCourseInstance($id);
            
            $data = [
                'title' => $_POST['title'],
                'description' => $_POST['description'],
                'category_id' => $_POST['category_id'],
                'tags' => isset($_POST['tags']) ? $_POST['tags'] : [],
                'type' => $_POST['content_type']
            ];

            if (!empty($_POST['content_url'])) {
                $data['link'] = $_POST['content_url'];
            } else if (isset($_FILES['content_file']) && $_FILES['content_file']['error'] === UPLOAD_ERR_OK) {
                $uploadResult = $course->handleFileUpload($_FILES['content_file']);
                $data['link'] = $uploadResult['link'];
            } else {
                $currentCourse = $course->display($id);
                $data['link'] = $currentCourse['link'];
            }

            $course->update($id, $data['title'], $data['description'], $data['category_id'], $data['tags'], $data['link']);
            
            $this->setSuccess('Course updated successfully');
            redirect('/teacher/courses');

        } catch (Exception $e) {
            $viewData = $course->getCourseForEdit($id);
            $this->setError($e->getMessage());
            $this->render('teacher/edit', $viewData);
        }
    }

    public function showUpdate($id) {
        try {
            $course = $this->courseModel->createCourseInstance($id);
            
            $viewData = $course->getCourseForEdit($id);
            $this->render('teacher/edit', $viewData);

        } catch (Exception $e) {
            $this->setError($e->getMessage());
            redirect('/teacher/courses');
        }
    }

    public function delete($id) {
        try {
            $course = $this->courseModel->createCourseInstance($id);
            
            $course->delete($id);
            
            $this->setSuccess([], 'Course deleted successfully');
        } catch (Exception $e) {
            $this->setError($e->getMessage());
        }
    }

    public function getEnrolledStudents($courseId) {
        try {
            $email = $_SESSION['email'];
            $course = $this->TeacherModel->getCourseById($courseId);
            
            if (!$course || $course['teacher_email'] !== $email) {
                $this->setError('Unauthorized access');
                $this->render('errors/403');
                return;
            }

            $students = $this->courseModel->getEnrolledStudents($courseId);
            
            $viewData = [
                'course' => $course,
                'students' => array_map(function($student) {
                    return [
                        'name' => $student['name'],
                        'email' => $student['email'],
                        'enrollment_date' => $student['enrolled_at']
                    ];
                }, $students)
            ];
            
            $this->render('teacher/enrolled', $viewData);
        } catch (Exception $e) {
            $this->setError('Failed to fetch enrolled students');
            $this->render('errors/500');
        }
    }
}