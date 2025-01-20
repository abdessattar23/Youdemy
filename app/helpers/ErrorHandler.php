<?php

class ErrorHandler {
    public static function setError($message, $type = 'error') {
        $_SESSION['flash'] = [
            'message' => $message,
            'type' => $type
        ];
    }

    public static function setSuccess($message) {
        self::setError($message, 'success');
    }

    public static function hasError() {
        return isset($_SESSION['flash']);
    }

    public static function getError() {
        if (isset($_SESSION['flash'])) {
            $flash = $_SESSION['flash'];
            unset($_SESSION['flash']);
            return $flash;
        }
        return null;
    }

    public static function displayError() {
        if (self::hasError()) {
            $flash = self::getError();
            $type = $flash['type'];
            $message = $flash['message'];
            
            $bgColor = $type === 'error' ? 'bg-red-100 border-red-400 text-red-700' : 'bg-green-100 border-green-400 text-green-700';
            
            echo "<div class='{$bgColor} border px-4 py-3 rounded relative mb-4' role='alert'>
                    <strong class='font-bold'>" . ucfirst($type) . "!</strong>
                    <span class='block sm:inline'>" . htmlspecialchars($message) . "</span>
                  </div>";
        }
    }

    

    
}