<?php
require_once __DIR__ . '/../config/db.php';
class Teacher extends DB {
    public function __construct() {
        parent::__construct();
    }
    public function getTotalCoursesN($email) {
        try {
            $sql = "SELECT COUNT(*) as total FROM courses JOIN users ON courses.teacher_id = users.id WHERE users.email = :email";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':email' => $email
            ]);
            $total = $stmt->fetch(PDO::FETCH_ASSOC);
            return $total['total'];
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function getCourses($email, $page = 1, $limit = 10) {
        try {
            $offset = ($page - 1) * $limit;
            $sql = "SELECT courses.*, 
                   users.name AS teacher_name, 
                   categories.name AS category_name,
                   GROUP_CONCAT(tags.name SEPARATOR ', ') AS tags_list
                   FROM courses 
                   JOIN users ON courses.teacher_id = users.id 
                   LEFT JOIN categories ON courses.category_id = categories.id
                   LEFT JOIN courseTags ON courses.id = courseTags.course_id
                   LEFT JOIN tags ON courseTags.tag_id = tags.id
                   WHERE users.email = :teacher_email
                   GROUP BY courses.id
                   ORDER BY courses.created_at DESC
                   LIMIT :courses_limit OFFSET :courses_offset";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':teacher_email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':courses_limit', $limit, PDO::PARAM_INT);
            $stmt->bindParam(':courses_offset', $offset, PDO::PARAM_INT);
            $stmt->execute();
            $courses = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $courses;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function getTotalEnrolled($email) {
        try {
            $sql = "SELECT COUNT(*) as total 
                    FROM enrolments 
                    JOIN courses ON enrolments.course_id = courses.id 
                    JOIN users ON courses.teacher_id = users.id 
                    WHERE users.email = :email";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([
                ':email' => $email
            ]);
            $total = $stmt->fetch(PDO::FETCH_ASSOC);
            return $total['total'];
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }

    public function getCourseById($courseId) {
        try {
            $sql = "SELECT c.*, u.email as teacher_email, u.name as teacher_name 
                   FROM courses c 
                   JOIN users u ON c.teacher_id = u.id 
                   WHERE c.id = :course_id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':course_id', $courseId, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error getting course: " . $e->getMessage());
        }
    }

    public static function getCategories() {
        try {
            $db = new DB();
            $sql = "SELECT * FROM categories";
            $stmt = $db->getConnection()->prepare($sql);
            $stmt->execute();
            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $categories;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
    public static function getTags() {
        try {
            $db = new DB();
            $sql = "SELECT * FROM tags";
            $stmt = $db->getConnection()->prepare($sql);
            $stmt->execute();
            $tags = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $tags;
        } catch (PDOException $e) {
            return $e->getMessage();
        }
    }
}