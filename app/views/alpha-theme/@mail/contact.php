<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Inquiry Received</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> <!-- FontAwesome -->
    <style>
        body, html {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
        }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            background: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #e0e0e0;
        }

        .email-header {
            background-color: #005a87;
            color: #ffffff;
            padding: 20px;
            text-align: center;
        }

        .email-header img {
            max-width: 120px;
            height: auto;
            margin-bottom: 10px;
        }

        .email-header h1 {
            margin: 0;
            font-size: 22px;
            font-weight: 500;
        }

        .email-body {
            padding: 20px;
        }

        .email-body h2 {
            color: #005a87;
            font-size: 20px;
            margin-bottom: 10px;
            text-align: center;
        }

        .email-body .section {
            margin-bottom: 20px;
        }

        .email-body .section h3 {
            font-size: 18px;
            color: #005a87;
            margin-bottom: 10px;
        }

        .details-section, .message-section {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #e0e0e0;
            background-color: #f9f9f9;
        }

        .detail-item {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .detail-item i {
            font-size: 20px;
            margin-right: 10px;
            color: #005a87;
        }

        .detail-item p {
            margin: 0;
            font-size: 16px;
        }

        .email-footer {
            background-color: #f0f0f0;
            padding: 10px;
            text-align: center;
            font-size: 14px;
            color: #777;
        }

        .email-footer a {
            color: #005a87;
            text-decoration: none;
            font-weight: bold;
        }

        .email-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header Section -->
        <div class="email-header">
            <img src="https://avantvista.com/assets/alpha-theme/img/logo1.png" alt="Avant Vista Ventures Logo">
            <h1>New Contact Inquiry Received</h1>
        </div>

        <!-- Body Section -->
        <div class="email-body">
            <h2>You Have a New Contact!</h2>
            <p>You have received a new contact inquiry via your website. Below are the details:</p>

            <!-- Details Section -->
            <div class="section">
                <h3>Details Section</h3>
                <div class="details-section">
                    <div class="detail-item">
                        <i class="fas fa-user"></i>
                        <p><strong>Name:</strong> <?= $name ?></p>
                    </div>
                    <div class="detail-item"> 
                        <i class="fab fa-whatsapp"></i>
                        <p><strong>WhatsApp:</strong> <?= $whatsapp ?></p>
                    </div>
                </div>
            </div>

            <!-- Message Section -->
            <div class="section">
                <h3>Written Message Section</h3>
                <div class="message-section">
                    <p style="margin: 0; font-size: 16px; line-height: 1.5; color: #333;">
                        <?= nl2br($message) ?>
                    </p>
                </div>
            </div>
        </div>

        <!-- Footer Section -->
        <div class="email-footer">
            <p>Thank you for contacting us! We’ll get back to you shortly.</p>
            <p><a href="https://avantvista.com">Visit our website</a> for more information.</p>
        </div>
    </div>
</body>
</html>
