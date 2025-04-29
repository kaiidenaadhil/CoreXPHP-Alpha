<?php 
class Request{

    public function getPath(){
        $scheme = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
        $port = $_SERVER['SERVER_PORT'];
        $portSuffix = (($scheme === 'http' && $port == 80) || ($scheme === 'https' && $port == 443)) ? '' : ':' . $port;
    
        $path = $scheme . "://" . $_SERVER['SERVER_NAME'] . $portSuffix . $_SERVER['REQUEST_URI'] ?? '/';
    
        $path = str_replace(ROOT, "", $path);
        $position = strpos($path, '?');
    
        if ($position === false) {
            return $path;
        }
    
        return substr($path, 0, $position);
    }


    public function method(){

        return strtolower($_SERVER['REQUEST_METHOD']);

    }

    public function isGet(){
        return $this->method() === 'get';
    }

    public function isPost(){
        return $this->method() === 'post';
    }

    public function getBody(){
        $body = [];
    
        if ($this->isGet()) {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
       
        if ($this->isPost()) {
            $contentType = isset($_SERVER['CONTENT_TYPE']) ? trim($_SERVER['CONTENT_TYPE']) : '';
            if ($contentType === 'application/json') {
                $input = file_get_contents('php://input');
                $body = json_decode($input, true);
                if ($body === null) {
                    // JSON decoding failed
                    $body = [];
                }
            } else {
                foreach ($_POST as $key => $value) {
                    $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
                }
            }
        }
    
        return $body;
    }
    
    


}