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
        <h1>Transform Your Business Digitally</h1>
        <p>Hi <?= $name ?>,</p>
        <p>At Avant Vista Ventures, we’re passionate about empowering businesses like yours with innovative digital solutions. From strategy to execution, we are here to help you stay ahead in an ever-evolving digital landscape.</p>
        
        <h2>Why Choose Us?</h2>
        <p>We believe in providing end-to-end solutions, offering everything your business needs to thrive online. Here’s why businesses trust us:</p>
        <ul>
          <li><strong>Holistic Approach:</strong> We integrate strategy, creativity, and technology for maximum impact.</li>
          <li><strong>Data-Driven Decisions:</strong> Our actions are backed by analytics to ensure measurable results.</li>
          <li><strong>Collaborative Process:</strong> We work as an extension of your team, tailoring every solution to your unique goals.</li>
        </ul>

        <h2>Our Comprehensive Services</h2>
        <p>Explore how we can help your business:</p>
        <ul>
          <li><strong>Consultancy & Strategy:</strong> Business analysis, market research, and strategic planning tailored to your needs.</li>
          <li><strong>Digital Marketing:</strong> From SEO to PPC, social media management, and email marketing, we ensure maximum visibility for your brand.</li>
          <li><strong>Web Design & Development:</strong> Stunning websites that blend design with functionality, including e-commerce and CMS solutions.</li>
          <li><strong>Creative Services:</strong> Engaging content, strong brand identities, and exceptional digital experiences.</li>
        </ul>

        <h2>Success Stories</h2>
        <p>Here’s how we’ve helped businesses succeed:</p>
        <p><strong>Case Study 1:</strong> A local café saw a 150% increase in online orders within three months, thanks to our social media strategy.</p>
        <p><strong>Case Study 2:</strong> A startup in the retail industry achieved a 300% growth in website traffic with our tailored SEO solutions.</p>

        <h2>Ready to Take the Next Step?</h2>
        <p>Whether you’re looking to launch a new project, optimize your existing digital presence, or scale your business, we’re here to help.</p>
        <a href="https://avantvista.com/quote" class="cta-button">Get a Free Consultation Today</a>
        
        <p>Let’s connect on social media:</p>
        <p>
          <a href="https://facebook.com/avantvista.ventures">Facebook</a> | 
          <a href="https://x.com/avantvista.ventures">Instagram</a> | 
          <a href="https://www.linkedin.com/avantvista.ventures">LinkedIn</a>
        </p>
        
        <p>If you have any questions, feel free to contact us at [info@avantvista.com]. We look forward to collaborating with you!</p>
        <p><strong>— The Avant Vista Ventures Team</strong></p>
      </td>
    </tr>
  </table>
</body>
</html>
