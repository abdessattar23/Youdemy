<?php
require_once __DIR__ . '/../config/db.php';
abstract class Course extends DB {
    
    public function __construct() {
        parent::__construct();
    }

    abstract public function create($title, $description, $category_id, $tags, $link);
    abstract public function display($courseId);
    public function update($id, $title, $description, $category_id, $tags, $link) {
        if (empty($title) || empty($description) || empty($category_id)) {
            throw new Exception('Title, description and category are required fields');
        }

        $stmt = $this->db->prepare("SELECT teacher_id, type FROM courses WHERE id = ?");
        $stmt->execute([$id]);
        $course = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$course) {
            throw new Exception('Course not found');
        }
        
        if ($course['teacher_id'] != $_SESSION['id']) {
            throw new Exception('You do not have permission to update this course');
        }

        $this->db->beginTransaction();
        
        try {
            $stmt = $this->db->prepare("UPDATE courses SET title = ?, description = ?, category_id = ?, link = ? WHERE id = ?");
            $stmt->execute([$title, $description, $category_id, $link, $id]);

            $stmt = $this->db->prepare("DELETE FROM courseTags WHERE course_id = ?");
            $stmt->execute([$id]);
            
            if (!empty($tags)) {
                $insertTagStmt = $this->db->prepare('INSERT INTO courseTags (course_id, tag_id) VALUES (?, ?)');
                foreach ($tags as $tag) {
                    $insertTagStmt->execute([$id, $tag]);
                }
            }

            $this->db->commit();
            return $this->display($id);
        } catch (Exception $e) {
            $this->db->rollBack();
            throw new Exception('Failed to update course: ' . $e->getMessage());
        }
    }

    public function delete($id) {
        $stmt = $this->db->prepare("SELECT teacher_id, link, type FROM courses WHERE id = ?");
        $stmt->execute([$id]);
        $course = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$course) {
            $this->setError('Course not found');
            return false;
        }
        
        if ($course['teacher_id'] != $_SESSION['id']) {
            $this->setError('You do not have permission to delete this course');
            return false;
        }

        $this->db->beginTransaction();
        
        try {
            $stmt = $this->db->prepare("DELETE FROM courseTags WHERE course_id = ?");
            $stmt->execute([$id]);
            
            $stmt = $this->db->prepare("DELETE FROM courses WHERE id = ?");
            $stmt->execute([$id]);

            if (!filter_var($course['link'], FILTER_VALIDATE_URL)) {
                $filePath = __DIR__ . '/../../public' . $course['link'];
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }

            $this->db->commit();
            return true;
        } catch (Exception $e) {
            $this->db->rollBack();
            $this->setError('Failed to delete course: ' . $e->getMessage());
            return false;
        }
    }

    public function getEnrolledStudents($courseId) {
        try {
            $stmt = $this->db->prepare('
                SELECT u.name, u.email, e.enrolled_at 
                FROM users u 
                JOIN enrolments e ON u.id = e.student_id 
                WHERE e.course_id = :course_id 
                ORDER BY e.enrolled_at DESC
            ');
            
            $stmt->bindParam(':course_id', $courseId, PDO::PARAM_INT);
            $stmt->execute();
            
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Error fetching enrolled students: " . $e->getMessage());
        }
    }

    public function getCourseType($id) {
        $stmt = $this->db->prepare("SELECT type FROM courses WHERE id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if (!$result) {
            throw new Exception('Course not found');
        }
        
        return $result['type'];
    }

    public function createCourseInstance($id) {
        $type = $this->getCourseType($id);
        return $type == 'video' ? new VideoCourse() : new DocumentCourse();
    }

    public function getCourseForEdit($id) {
        $courseData = $this->display($id);
        
        if (!$courseData) {
            throw new Exception('Course not found');
        }
        
        if ($courseData['teacher_id'] != $_SESSION['id']) {
            throw new Exception('You do not have permission to edit this course');
        }

        return [
            'course' => $courseData,
            'categories' => Teacher::getCategories(),
            'tags' => Teacher::getTags(),
            'pageTitle' => 'Edit Course: ' . $courseData['title']
        ];
    }

    public function handleFileUpload($file) {
        $allowedTypes = [
            'application/pdf',
            'application/msword',
            'video/mp4'
        ];
        
        if (!in_array($file['type'], $allowedTypes)) {
            throw new Exception('Invalid file type. Only PDF, DOC, DOCX, and MP4 files are allowed.');
        }
        
        $uploadDir = __DIR__ . '/../../public/uploads/';
        $fileName = uniqid() . '_' . basename($file['name']);
        $uploadPath = $uploadDir . $fileName;

        if (!move_uploaded_file($file['tmp_name'], $uploadPath)) {
            throw new Exception('Failed to upload file.');
        }
        
        return [
            'link' => '/uploads/' . $fileName,
            'fileName' => $fileName,
            'originalName' => $file['name'],
            'type' => $file['type']
        ];
    }

    public function getTeacherCoursesCount($teacherId) {
        try {
            $query = "SELECT COUNT(*) as count FROM courses WHERE teacher_id = :teacher_id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':teacher_id', $teacherId);
            $stmt->execute();
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'];
        } catch (PDOException $e) {
            throw new Exception("Error getting course count: " . $e->getMessage());
        }
    }

    public function getTeacherTotalStudents($teacherId) {
        try {
            $query = "SELECT COUNT(DISTINCT e.student_id) as count 
                     FROM enrollments e 
                     JOIN courses c ON e.course_id = c.id 
                     WHERE c.teacher_id = :teacher_id";
            $stmt = $this->db->prepare($query);
            $stmt->bindParam(':teacher_id', $teacherId);
            $stmt->execute();
            
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['count'];
        } catch (PDOException $e) {
            throw new Exception("Error getting student count: " . $e->getMessage());
        }
    }
}