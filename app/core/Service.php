<?php
class Service {
    private $services = [];

    public function __construct($servicesPath) {
        $this->loadAllServices($servicesPath);
    }

    public function register($key, $service) {
        $this->services[$key] = $service;
    }

    public function get($key) {
        if (!isset($this->services[$key])) {
            throw new Exception("Service not found: " . $key);
        }
        return $this->services[$key];
    }

    private function loadAllServices($servicesPath) {
        foreach (glob($servicesPath . '*Service.php') as $file) {
            require_once $file;

            // Extract class name from the file
            $className = basename($file, '.php');

            // Ensure the class exists before instantiating and registering
            if (class_exists($className)) {
                $serviceName = strtolower(preg_replace('/Service$/', '', $className)); // e.g., MailService -> mail
                $this->register($serviceName, new $className());
            }
        }
    }
}
