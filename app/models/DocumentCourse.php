<?php

require_once __DIR__ . '/../../autoload.php';
class DocumentCourse extends Course {
    public function create($title, $description, $category_id, $tags, $link) {

        $stmt = $this->db->prepare('INSERT INTO courses (title, description, category_id, type, link, teacher_id) VALUES (:title, :description, :category_id, "document", :link, :teacher_id)');
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':link', $link);
        $stmt->bindParam(':teacher_id', $_SESSION['id']);
        $stmt->execute();
        $course_id = $this->db->lastInsertId();
        foreach ($tags as $tag) {
            $stmt = $this->db->prepare('INSERT INTO courseTags (course_id, tag_id) VALUES (:course_id, :tag_id)');
            $stmt->bindParam(':course_id', $course_id);
            $stmt->bindParam(':tag_id', $tag);
            $stmt->execute();
        }
        return $course_id;
    }

    public function display($courseId) {
        $stmt = $this->db->prepare('SELECT c.*, GROUP_CONCAT(t.id) as tag_ids, GROUP_CONCAT(t.name) as tag_names FROM courses c LEFT JOIN courseTags ct ON c.id = ct.course_id LEFT JOIN tags t ON ct.tag_id = t.id WHERE c.id = :course_id GROUP BY c.id');
        $stmt->bindParam(':course_id', $courseId);
        $stmt->execute();
        $course = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($course) {
            $course['tags'] = [];
            if ($course['tag_ids']) {
                $tagIds = explode(',', $course['tag_ids']);
                $tagNames = explode(',', $course['tag_names']);
                $course['tags'] = array_combine($tagIds, $tagNames);
            }
            unset($course['tag_ids'], $course['tag_names']);
        }
        return $course;
    }
}