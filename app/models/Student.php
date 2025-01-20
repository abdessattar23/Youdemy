<?php

require_once __DIR__ . '/../config/db.php';

class Student extends DB {

    public function getEnrolledCourses($email) {
        $sql = "SELECT c.*, cat.name AS category_name, GROUP_CONCAT(t.name SEPARATOR ', ') AS tags
                FROM courses c
                JOIN enrolments e ON c.id = e.course_id
                JOIN users u ON e.student_id = u.id
                LEFT JOIN categories cat ON c.category_id = cat.id
                LEFT JOIN courseTags ct ON c.id = ct.course_id
                LEFT JOIN tags t ON ct.tag_id = t.id
                WHERE u.email = :email
                GROUP BY c.id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':email' => $email]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAvailableCourses($page = 1, $perPage = 9) {
        $offset = ($page - 1) * $perPage;
        
        $countSql = "SELECT COUNT(DISTINCT c.id) as total 
                     FROM courses c
                     LEFT JOIN categories cat ON c.category_id = cat.id";
        $countStmt = $this->db->prepare($countSql);
        $countStmt->execute();
        $totalCount = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];
        
        $sql = "SELECT c.*, cat.name as category,
                       u.name as teacher_name,
                       (SELECT COUNT(*) FROM enrolments WHERE course_id = c.id) as enrolled_count
                FROM courses c
                LEFT JOIN categories cat ON c.category_id = cat.id
                LEFT JOIN users u ON c.teacher_id = u.id
                GROUP BY c.id
                ORDER BY c.created_at DESC
                LIMIT :offset, :perPage";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindValue(':perPage', $perPage, PDO::PARAM_INT);
        $stmt->execute();
        
        return [
            'data' => $stmt->fetchAll(PDO::FETCH_ASSOC),
            'total' => $totalCount,
            'per_page' => $perPage,
            'current_page' => $page,
            'total_pages' => ceil($totalCount / $perPage)
        ];
    }

    public function enroll($id) {
        $sql = "SELECT COUNT(*) as count FROM enrolments WHERE student_id = :student_id AND course_id = :course_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':student_id' => $_SESSION['id'], ':course_id' => $id]);
        $count = $stmt->fetch(PDO::FETCH_ASSOC)['count'];

        if ($count == 0) {
            $sql = "INSERT INTO enrolments (student_id, course_id) VALUES (:student_id, :course_id)";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':student_id' => $_SESSION['id'], ':course_id' => $id]);
        }
    }
}