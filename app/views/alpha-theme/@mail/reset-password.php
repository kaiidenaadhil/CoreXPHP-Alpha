<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Avant Vista Ventures Email</title>
  <style>
    /* General styles */
    body, html {
      margin: 0;
      padding: 0;
      font-family: Arial, sans-serif;
      background-color: #f7f7f7;
      color: #333;
    }
    
    table {
      width: 100%;
      border-spacing: 0;
    }

    /* Responsive table and layout */
    .email-container {
      max-width: 600px;
      margin: 0 auto;
      background-color: #fff;
      border-radius: 8px;
      overflow: hidden;
    }

    .email-header {
      background-color: #f0f0f0; /* Example color */
      padding: 20px;
      text-align: center;
    }

    .email-header img {
      max-width: 150px;
      height: auto;
    }

    .email-body {
      padding: 20px;
    }

    h1, h2, p {
      margin: 0 0 15px;
    }

    h1 {
      font-size: 24px;
      color: #005a87;
    }

    h2 {
      font-size: 20px;
    }

    p {
      font-size: 16px;
    }

    .cta-button {
      background-color: #000;
      color: white;
      text-decoration: none;
      padding: 10px 20px;
      border-radius: 5px;
      display: inline-block;
      font-weight: bold;
      margin: 10px 0;
    }

    .cta-button:hover {
      background-color: #003f5c;
    }

    /* Responsive styles */
    @media only screen and (max-width: 600px) {
      .email-container {
        width: 100% !important;
        padding: 10px;
      }
      
      .email-header {
        padding: 15px;
      }

      h1 {
        font-size: 22px;
      }

      .cta-button {
        padding: 12px 25px;
        font-size: 16px;
      }
    }
  </style>
</head>
<body>
  <table role="presentation" class="email-container">
    <tr>
      <td class="email-header">
        <img src="https://avantvista.com/assets/alpha-theme/img/logo1.png" alt="Avant Vista Ventures Logo">
      </td>
    </tr>
    <tr>
      <td class="email-body">
      <?=$link ?>
      </td>
    </tr>
  </table>
</body>
</html>
