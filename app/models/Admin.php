<?php

require_once __DIR__ . '/../config/db.php';

class Admin extends DB {
    
    public function __construct() {
        parent::__construct();
    }

    public function getAdminStats() {
        $sql = "SELECT
            (SELECT COUNT(*) FROM users WHERE role = 'teacher' AND status = 'inactive') AS pendingTeachers,
            (SELECT COUNT(*) FROM courses) AS totalCourses,
            (SELECT title FROM enrolments LEFT JOIN courses ON enrolments.course_id = courses.id GROUP BY course_id ORDER BY COUNT(course_id) DESC LIMIT 1) AS topCourse;";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $stats = $stmt->fetch(PDO::FETCH_ASSOC);

        $topTeachersQuery = "SELECT u.name, u.id,
                COUNT(DISTINCT c.id) as course_count,
                COUNT(DISTINCT e.student_id) as student_count
            FROM users u
            JOIN courses c ON u.id = c.teacher_id
            LEFT JOIN enrolments e ON c.id = e.course_id
            WHERE u.role = 'teacher'
            GROUP BY u.id, u.name
            ORDER BY student_count DESC
            LIMIT 3";
        
        $stmt = $this->db->prepare($topTeachersQuery);
        $stmt->execute();
        $stats['topTeachers'] = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = $this->db->prepare("SELECT COUNT(courses.id) AS total_courses, categories.name FROM courses JOIN categories ON courses.category_id = categories.id GROUP BY categories.name ORDER BY total_courses DESC");
        $stmt->execute();
        $stats['categoryStats'] = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $stats;
    }

    public function getPendingTeachers(){
        $sql = "SELECT * FROM users WHERE status = 'inactive' AND role = 'teacher'";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function validateTeacher($id, $action){
        switch ($action) {
            case 'approve':
                $stmt = $this->db->prepare("UPDATE users SET status = 'active' WHERE id = :id");
                $stmt->execute([
                    ':id' => $id
                ]);
                break;
            
            case 'reject':
                $stmt = $this->db->prepare("UPDATE users SET status = 'banned' WHERE id = :id");
                $stmt->execute([
                    ':id' => $id
                ]);
                break;
        }
    }

    public function getAllCourses($page = 1, $perPage = 10) {
        $offset = ($page - 1) * $perPage;
        
        $countSql = "SELECT COUNT(*) as total FROM courses";
        $countStmt = $this->db->prepare($countSql);
        $countStmt->execute();
        $totalCount = $countStmt->fetch(PDO::FETCH_ASSOC)['total'];
        
        $sql = "SELECT c.*, u.name as teacher_name, cat.name as category_name 
                FROM courses c 
                JOIN users u ON c.teacher_id = u.id 
                JOIN categories cat ON c.category_id = cat.id
                ORDER BY c.created_at DESC
                LIMIT :limit OFFSET :offset";
        
        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':limit', $perPage, PDO::PARAM_INT);
        $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
        $stmt->execute();
        
        return [
            'courses' => $stmt->fetchAll(PDO::FETCH_ASSOC),
            'total' => $totalCount,
            'currentPage' => $page,
            'perPage' => $perPage,
            'lastPage' => ceil($totalCount / $perPage)
        ];
    }

    public function getAllCategories() {
        $sql = "SELECT * FROM categories ORDER BY name ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAllTags() {
        $sql = "SELECT * FROM tags ORDER BY name ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addCategories($categories) {
        try {
            $this->db->beginTransaction();
            $sql = "INSERT INTO categories (name) VALUES (:name)";
            $stmt = $this->db->prepare($sql);

            foreach ($categories as $name) {
                // Skip if category already exists
                $checkSql = "SELECT COUNT(*) as count FROM categories WHERE name = :name";
                $checkStmt = $this->db->prepare($checkSql);
                $checkStmt->execute([':name' => $name]);
                if ($checkStmt->fetch(PDO::FETCH_ASSOC)['count'] > 0) {
                    continue;
                }

                $stmt->execute([':name' => $name]);
            }

            $this->db->commit();
            return true;
        } catch (PDOException $e) {
            $this->db->rollBack();
            return false;
        }
    }

    public function addTags($tags) {
        try {
            $this->db->beginTransaction();
            $sql = "INSERT INTO tags (name) VALUES (:name)";
            $stmt = $this->db->prepare($sql);

            foreach ($tags as $name) {
                $checkSql = "SELECT COUNT(*) as count FROM tags WHERE name = :name";
                $checkStmt = $this->db->prepare($checkSql);
                $checkStmt->execute([':name' => $name]);
                if ($checkStmt->fetch(PDO::FETCH_ASSOC)['count'] > 0) {
                    continue;
                }

                $stmt->execute([':name' => $name]);
            }

            $this->db->commit();
            return true;
        } catch (PDOException $e) {
            $this->db->rollBack();
            return false;
        }
    }

    public function deleteCategory($id) {
        try {
            $checkSql = "SELECT COUNT(*) as count FROM courses WHERE category_id = :id";
            $checkStmt = $this->db->prepare($checkSql);
            $checkStmt->execute([':id' => $id]);
            $count = $checkStmt->fetch(PDO::FETCH_ASSOC)['count'];

            if ($count > 0) {
                return false; 
            }

            $sql = "DELETE FROM categories WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function deleteTag($id) {
        try {
            $deleteRelationsSql = "DELETE FROM coursetags WHERE tag_id = :id";
            $deleteRelationsStmt = $this->db->prepare($deleteRelationsSql);
            $deleteRelationsStmt->execute([':id' => $id]);

            $sql = "DELETE FROM tags WHERE id = :id";
            $stmt = $this->db->prepare($sql);
            $stmt->execute([':id' => $id]);
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    public function getAllTeachers() {
        $sql = "SELECT * FROM users WHERE role = 'teacher' AND status != 'inactive' ORDER BY name ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateTeacherStatus($teacherId, $status) {
        try {
            if (!in_array($status, ['active', 'inactive', 'banned'])) {
                return false;
            }

            $sql = "UPDATE users SET status = :status WHERE id = :id AND role = 'teacher'";
            $stmt = $this->db->prepare($sql);
            return $stmt->execute([
                ':status' => $status,
                ':id' => $teacherId
            ]);
        } catch (PDOException $e) {
            return false;
        }
    }
}