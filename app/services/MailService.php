<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class MailService {
    private $mailer;

    public function __construct() {
        $this->mailer = new PHPMailer(true);
        $this->initialize();
    }

    private function initialize() {
        // Configure PHPMailer
        $this->mailer->isSMTP();
        $this->mailer->Host = 'mail.avantvista.com'; // Replace with your SMTP host
        $this->mailer->SMTPAuth = true;
        $this->mailer->Username = 'info@avantvista.com'; // SMTP username
        $this->mailer->Password = 'Av@nt123Vist@';   // SMTP password
        $this->mailer->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $this->mailer->Port = 587; // Adjust the port if necessary
    }

    public function send($params = []) {
        try {
            // Set default values for parameters if not provided
            $to = $params['to'] ?? 'default@example.com';
            $subject = $params['subject'] ?? 'No Subject';
            $template = $params['template'] ?? null;
            $body = $params['body'] ?? 'This is the default email message.';
            $templateParams = $params['templateParams'] ?? [];

            // Configure recipient
            $this->mailer->setFrom('info@avantvista.com', 'Avant Vista Ventures');
            $this->mailer->addAddress($to);

            $this->mailer->isHTML(true);
            $this->mailer->Subject = $subject;

            // Use template if provided, otherwise use the body
            $this->mailer->Body = $template ? $this->renderTemplate($template, $templateParams) : $body;

            $this->mailer->send();
            return "Message sent successfully!";
        } catch (Exception $e) {
            return "Message could not be sent. Mailer Error: {$this->mailer->ErrorInfo}";
        }
    }

    private function renderTemplate($template, $params) {
        // Construct path using App::$ROOT_DIRECTORY and THEME
        $viewPath = App::$ROOT_DIRECTORY . "/app/views/" . THEME . "/@mail/{$template}.php";

        if (!file_exists($viewPath)) {
            throw new Exception("Email template {$template} not found.");
        }

        extract($params);
        ob_start();
        include $viewPath;
        return ob_get_clean();
    }
}
