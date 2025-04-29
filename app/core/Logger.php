<?php

class Logger {
    protected $logFile;

    /**
     * Logger constructor.
     *
     * @param string $filePath - The path to the log file.
     */
    public function __construct($filePath = '../logs/error.log') {
        $this->logFile = $filePath;
        if (!file_exists($this->logFile)) {
            file_put_contents($this->logFile, ""); // Create the log file if it doesn't exist
        }
    }

    /**
     * Log a general message.
     *
     * @param string $message - The message to log.
     * @param string $type - The type of log message (e.g., INFO, ERROR).
     */
    public function log($message, $type = 'INFO') {
        $date = new DateTime();
        $logMessage = "[" . $date->format('Y-m-d H:i:s') . "] [$type] $message" . PHP_EOL;
        file_put_contents($this->logFile, $logMessage, FILE_APPEND);
    }

    /**
     * Log an exception.
     *
     * @param Exception $exception - The exception to log.
     */
    public function logError($exception) {
        $this->log($exception->getMessage(), 'ERROR');
        $this->log("File: " . $exception->getFile() . " Line: " . $exception->getLine(), 'ERROR');
        $this->log("Trace: " . $exception->getTraceAsString(), 'ERROR');
    }
}
