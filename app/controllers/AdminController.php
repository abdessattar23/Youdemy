<?php
require_once __DIR__ . '/../../autoload.php';
class AdminController extends BaseController{

    private $AdminModel;

    public function __construct(){
        $this->AdminModel = new Admin();
    }

    public function dashboard(){
        $stats = $this->AdminModel->getAdminStats();
        $this->renderAdmin('dashboard', ['stats' => $stats]);
    }

    public function pendingTeachers(){
        $pendingTeachers = $this->AdminModel->getPendingTeachers();
        $activeTeachers = $this->AdminModel->getAllTeachers();
        $this->renderAdmin('pending-teachers', [
            'pendingTeachers' => $pendingTeachers,
            'activeTeachers' => $activeTeachers
        ]);
    }

    public function validateTeacher(){
        $teacherId = $_POST['teacher_id'];
        $action = $_POST['action'];
        $this->AdminModel->validateTeacher($teacherId, $action);
        $this->redirect('/admin/pending-teachers');
    }

    public function updateTeacherStatus() {
        if (!isset($_POST['teacher_id']) || !isset($_POST['status'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Teacher ID and status are required']);
            return;
        }

        $teacherId = $_POST['teacher_id'];
        $status = $_POST['status'];

        $result = $this->AdminModel->updateTeacherStatus($teacherId, $status);

        if ($result) {
            http_response_code(200);
            echo json_encode(['message' => 'Teacher status updated successfully']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to update teacher status']);
        }
    }

    public function courses(){
        $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
        $perPage = 10;
        
        $coursesData = $this->AdminModel->getAllCourses($page, $perPage);
        $this->renderAdmin('courses', $coursesData);
    }

    public function statistics(){
        $stats = $this->AdminModel->getAdminStats();
        // dd($stats);
        $this->renderAdmin('statistics', [
            'stats' => $stats
        ]);
    }

    public function manageCategories(){
        $categories = $this->AdminModel->getAllCategories();
        $tags = $this->AdminModel->getAllTags();
        $this->renderAdmin('categories', [
            'categories' => $categories,
            'tags' => $tags
        ]);
    }

    public function addCategory() {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if (!isset($data['categories']) || !is_array($data['categories'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Categories array is required']);
            return;
        }

        $categories = array_map('trim', $data['categories']);
        $categories = array_filter($categories);

        if (empty($categories)) {
            http_response_code(400);
            echo json_encode(['error' => 'No valid categories provided']);
            return;
        }

        $result = $this->AdminModel->addCategories($categories);

        if ($result) {
            http_response_code(200);
            echo json_encode(['message' => 'Categories added successfully']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to add categories']);
        }
    }

    public function addTag() {
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if (!isset($data['tags']) || !is_array($data['tags'])) {
            http_response_code(400);
            echo json_encode(['error' => 'Tags array is required']);
            return;
        }

        $tags = array_map('trim', $data['tags']);
        $tags = array_filter($tags); 

        if (empty($tags)) {
            http_response_code(400);
            echo json_encode(['error' => 'No valid tags provided']);
            return;
        }

        $result = $this->AdminModel->addTags($tags);

        if ($result) {
            http_response_code(200);
            echo json_encode(['message' => 'Tags added successfully']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to add tags']);
        }
    }

    public function deleteCategory($id) {
        if (!$id) {
            http_response_code(400);
            echo json_encode(['error' => 'Category ID is required']);
            return;
        }

        $result = $this->AdminModel->deleteCategory($id);

        if ($result) {
            http_response_code(200);
            echo json_encode(['message' => 'Category deleted successfully']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to delete category. It may be in use by courses.']);
        }
    }

    public function deleteTag($id) {
        if (!$id) {
            http_response_code(400);
            echo json_encode(['error' => 'Tag ID is required']);
            return;
        }

        $result = $this->AdminModel->deleteTag($id);

        if ($result) {
            http_response_code(200);
            echo json_encode(['message' => 'Tag deleted successfully']);
        } else {
            http_response_code(500);
            echo json_encode(['error' => 'Failed to delete tag']);
        }
    }
}