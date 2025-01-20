<?php
include_once __DIR__ . '/../../core/BaseController.php';
include_once __DIR__ . '/../../autoload.php';
class StatisticsController extends BaseController {
    private $TeacherModel;

    public function __construct() {
        $this->TeacherModel = new Teacher();
    }

    public function index() {
        try {
            $totalCourses = $this->TeacherModel->getTotalCoursesN($_SESSION['email']);

            $totalStudents = $this->TeacherModel->getTotalEnrolled($_SESSION['email']);

            $viewData = [
                'totalCourses' => $totalCourses,
                'totalStudents' => $totalStudents
            ];

            $this->render('teacher/statistics', $viewData);
        } catch (Exception $e) {
            $this->setError('Failed to fetch statistics');
            $this->render('errors/500');
        }
    }
}