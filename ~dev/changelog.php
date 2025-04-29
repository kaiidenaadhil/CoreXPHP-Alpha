<?php include_once "./components/header.php"; ?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CoreXPHP - Changelog</title>
    <style>
        :root {
            --primary: #4a6bff;
            --secondary: #6c757d;
            --success: #28a745;
            --info: #17a2b8;
            --warning: #ffc107;
            --danger: #dc3545;
            --light: #f8f9fa;
            --dark: #343a40;
            --white: #ffffff;
            --gray: #6c757d;
            --gray-light: #e9ecef;
        }
        
   
        
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }
        
        .header {
            background: linear-gradient(135deg, var(--primary),rgb(47, 49, 58));
            color: var(--white);
            padding: 2rem 0;
            text-align: center;
            margin-bottom: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .header-content {
            max-width: 800px;
            margin: 0 auto;
        }
        
        h1 {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }
        
        .version-badge {
            display: inline-block;
            background-color: var(--success);
            color: white;
            padding: 0.3rem 0.8rem;
            border-radius: 20px;
            font-size: 0.9rem;
            margin-bottom: 1rem;
        }
        
        .release-date {
            color: var(--gray-light);
            font-size: 1rem;
        }
        
        .changelog-section {
            background-color: var(--white);
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            padding: 2rem;
            margin-bottom: 2rem;
        }
        
        h2 {
            color: var(--primary);
            margin-bottom: 1.5rem;
            padding-bottom: 0.5rem;
            border-bottom: 2px solid var(--gray-light);
        }
        
        h3 {
            color: var(--dark);
            margin: 1.5rem 0 1rem;
            display: flex;
            align-items: center;
        }
        
        h3::before {
            content: "•";
            color: var(--primary);
            font-size: 2rem;
            margin-right: 0.5rem;
            line-height: 1;
        }
        
        .feature-list {
            list-style-type: none;
        }
        
        .feature-list li {
            margin-bottom: 0.8rem;
            position: relative;
            padding-left: 1.5rem;
        }
        
        .feature-list li::before {
            content: "✓";
            color: var(--success);
            position: absolute;
            left: 0;
        }
        
        .feature-card {
            background-color: var(--light);
            border-left: 4px solid var(--primary);
            padding: 1rem;
            margin-bottom: 1rem;
            border-radius: 0 4px 4px 0;
        }
        
        .feature-card h4 {
            color: var(--primary);
            margin-bottom: 0.5rem;
        }
        
        code {
            background-color: var(--gray-light);
            padding: 0.2rem 0.4rem;
            border-radius: 4px;
            font-family: 'Courier New', Courier, monospace;
            font-size: 0.9rem;
        }
        
        pre {
            background-color: var(--dark);
            color: var(--light);
            padding: 1rem;
            border-radius: 6px;
            overflow-x: auto;
            margin: 1rem 0;
        }
        
        .contributors {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
            margin: 1rem 0;
        }
        
        .contributor {
            background-color: var(--light);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.9rem;
        }
        
        footer {
            text-align: center;
            padding: 2rem 0;
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        .social-links {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin: 1rem 0;
        }
        
        .social-link {
            color: var(--primary);
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .social-link:hover {
            color: var(--dark);
        }
        
        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }
            
            .changelog-section {
                padding: 1.5rem;
            }
        }
        
        @media (max-width: 480px) {
            h1 {
                font-size: 1.8rem;
            }
            
            .header-content {
                padding: 0 1rem;
            }
            
            .feature-card {
                padding: 0.8rem;
            }
        }
    </style>

        <div class="header">
        <div class="header-content">
            <h1>CoreXPHP: <br>
                Supercharge Your PHP Development</h1>
            <div class="version-badge">Version: 1.0.0 (Initial Release)</div>
            <div class="release-date">Release Date: April 18, 2025</div>
        </div>
        </div>

    
    <div class="container">
        <section class="changelog-section">
            <h2>Overview</h2>
            <p>CoreXPHP is a high-performance, lightweight PHP framework designed to expedite application development. It features an optimized MVC + PDO architecture that automates the generation of Models, Views, Controllers, Database Migrations, and Routing from a simple JSON schema. This framework is engineered for developers who require both speed and flexibility.</p>
        </section>
        
        <section class="changelog-section">
            <h2>New Features in v1.0.0 (Initial Release)</h2>
            
            <h3>Automatic Code Generation</h3>
            <ul class="feature-list">
                <li><strong>JSON-to-Code Automation:</strong> Simply define your database schema in a JSON format and CoreXPHP generates the entire application stack — Models, Views, Controllers, Database Migrations, and Routes.</li>
                <li><strong>CoreXBuilder:</strong> A web-based interface that facilitates rapid CRUD (Create, Read, Update, Delete) scaffolding for your application.</li>
            </ul>
            
            <h3>Powerful ORM & Query Builder</h3>
            <ul class="feature-list">
                <li><strong>PDO-Based ORM:</strong> Ensures secure, fast database interactions with minimal overhead.</li>
                <li><strong>Fluent Query Builder:</strong> Allows developers to construct complex SQL queries without raw SQL strings, leveraging a fluid API.</li>
                <li><strong>Relationship Management:</strong> Built-in support for relationships (1:1, 1:M, M:M) with automatic handling.</li>
            </ul>
            
            <h3>Advanced Routing System</h3>
            <div class="feature-card">
                <h4>RESTful Routes</h4>
                <p>Dynamic routing with minimal configuration, enabling efficient REST API development.</p>
            </div>
            <div class="feature-card">
                <h4>Middleware Support</h4>
                <p>Built-in support for common middleware types such as Authentication, Logging, CORS, and more.</p>
            </div>
            <div class="feature-card">
                <h4>Route Caching</h4>
                <p>Caching routes for faster response times in production environments.</p>
            </div>
            
            <h3>Templating Engine</h3>
            <ul class="feature-list">
                <li><strong>Flexible and Extensible:</strong> Simple to use and extendable for your needs.</li>
                <li><strong>Layouts, Partials, and Components:</strong> Supports the creation of reusable layouts and components to streamline development.</li>
            </ul>
            
            <h3>Security Features</h3>
            <ul class="feature-list">
                <li><strong>CSRF Protection:</strong> Automatically protects your application from Cross-Site Request Forgery (CSRF) attacks.</li>
                <li><strong>Input Validation & Sanitization:</strong> Ensures user inputs are validated and sanitized for security.</li>
                <li><strong>JWT Authentication:</strong> Optionally integrate JSON Web Token (JWT) for secure API authentication.</li>
            </ul>
            
            <h3>Developer Tools</h3>
            <ul class="feature-list">
                <li><strong>Environment Configuration:</strong> Full support for .env configuration files to streamline environment-specific settings.</li>
                <li><strong>CoreXBuilder Integration:</strong> Easily integrate with CoreXBuilder for a streamlined development process and automatic CRUD functionality.</li>
            </ul>
        </section>
        
        <section class="changelog-section">
            <h2>Bug Fixes</h2>
            <p>Initial Stable Release: No bug fixes are included as this is the first stable release of CoreXPHP.</p>
        </section>
        
        <section class="changelog-section">
            <h2>Upcoming Features & Enhancements</h2>
            <ul class="feature-list">
                <li><strong>Multi-Language Support:</strong> Expand your applications globally with built-in support for multiple languages.</li>
                <li><strong>Advanced Query Features:</strong> Enhanced capabilities for full-text search, indexing, and other complex database features.</li>
                <li><strong>File Upload Handling:</strong> Advanced file management features, including upload validation and file storage solutions.</li>
                <li><strong>API Rate Limiting:</strong> Manage and throttle API requests with customizable rate limits.</li>
            </ul>
        </section>
        
        <section class="changelog-section">
            <h2>Installation Guide</h2>
            <p>To get started with CoreXPHP, follow these steps:</p>
            
            <h3>1. Install CoreXPHP via Composer:</h3>
            <pre><code>composer require corexphp/corexphp</code></pre>
            
            <h3>2. Set up your environment configuration by creating a .env file:</h3>
            <pre><code>APP_ENV=local
DB_HOST=127.0.0.1
DB_NAME=your_database_name
DB_USER=your_database_user
DB_PASSWORD=your_database_password</code></pre>
            
            <h3>3. Run the CoreXBuilder to scaffold your application:</h3>
            <p>Open your browser and navigate to <code>http://localhost/corexphp-builder</code> to begin scaffolding your application.</p>
            
            <h3>4. Begin Developing</h3>
            <p>With your application set up, you can begin building your project immediately.</p>
        </section>
        
        <section class="changelog-section">
            <h2>Previous Releases</h2>
            <div class="feature-card">
                <h4>Version 1.0.0 (Initial Release) – April 18, 2025</h4>
                <p>First public release of CoreXPHP with all primary features and tools.</p>
            </div>
        </section>
        
        <section class="changelog-section">
            <h2>Contributors</h2>
            <p>CoreXPHP is the result of contributions from the following:</p>
            <div class="contributors">
                <span class="contributor">CoreXPHP Core Team</span>
                <span class="contributor">Community Contributors</span>
            </div>
        </section>
        
        <section class="changelog-section">
            <h2>Getting Help & Reporting Issues</h2>
            <p>For support, issue tracking, or contributing to the project, please refer to the following resources:</p>
            <ul class="feature-list">
                <li><strong>GitHub Repository:</strong> <a href="https://github.com/corexphp">https://github.com/corexphp</a></li>
                <li><strong>Official Website:</strong> <a href="https://corexphp.com">https://corexphp.com</a></li>
                <li><strong>Support Forum:</strong> Join the discussion on our CoreXPHP Forum</li>
            </ul>
        </section>
        
        <section class="changelog-section">
            <h2>Acknowledgements</h2>
            <p>We would like to thank all the contributors and the open-source community for their support in making CoreXPHP a reality. Special thanks to the developers who contributed through testing, feedback, and feature suggestions.</p>
        </section>
    </div>
    

<?php include_once "./components/footer.php"; ?>