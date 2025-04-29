<?php include_once"../components/docs-header.php"; ?>
<main class="content">
    <div class="breadcrumb">
        <a href="#">Docs</a> > <a href="#">Intro</a> > CoreXPHP Introduction
    </div>
    
    <h1>CoreXPHP - Introduction</h1>
    
    <p>
        <strong>CoreXPHP</strong> is a lightweight, flexible, and powerful PHP framework designed to simplify the development of web applications. 
        It follows the <strong>MVC (Model-View-Controller)</strong> architecture and offers a developer-friendly environment for building scalable applications.
    </p>
    
    <h2>Goal of CoreXPHP</h2>
    <p>
        CoreXPHP aims to provide a comprehensive yet easy-to-use framework that addresses the common challenges in PHP development, while also offering advanced features for modern web applications.
        Its main focus is on <strong>performance</strong>, <strong>flexibility</strong>, and <strong>simplicity</strong>, making it ideal for both beginner and advanced developers.
    </p>

    <h2>Core Features of CoreXPHP</h2>
    <ul>
        <li><strong>Routing System:</strong> Flexible routing system supporting static, dynamic routes, and advanced patterns.</li>
        <li><strong>MVC Architecture:</strong> Separation of application logic, UI, and data handling.</li>
        <li><strong>Middleware:</strong> Easily implement middleware for tasks like authentication, logging, etc.</li>
        <li><strong>Customizable Request and Response Handling:</strong> Efficient request-response cycle management.</li>
        <li><strong>Database Integration:</strong> PDO-based ORM with built-in Query Builder for complex queries.</li>
        <li><strong>Templating Engine:</strong> Fast and simple templating engine for dynamic HTML pages.</li>
        <li><strong>Validation and Error Handling:</strong> Integrated tools for input validation and robust error handling.</li>
        <li><strong>Environment Configurations:</strong> Manage environments (development, production) using environment variables.</li>
        <li><strong>Composer Support:</strong> Full Composer integration for dependency management and class autoloading.</li>
        <li><strong>CLI Tools:</strong> Command-line tools for generating components and managing tasks.</li>
        <li><strong>CoreXBuilder:</strong> Web-supported development tool for automatic CRUD operations and code generation.</li>
    </ul>
    
    <h2>Why Choose CoreXPHP?</h2>
    <p>
        CoreXPHP focuses on offering more flexibility and control to developers by taking the best practices from popular frameworks and adding unique features.
    </p>

    <h3>1. Lightweight and High Performance</h3>
    <p>Optimized for performance with minimal overhead and faster response times.</p>
    
    <h3>2. Flexibility in Routing</h3>
    <p>Full control over routing patterns, including advanced dynamic route structures.</p>

    <h3>3. Comprehensive ORM with Query Builder</h3>
    <p>Work with both ORM and direct SQL queries, offering flexibility in database interactions.</p>

    <h3>4. Easy Learning Curve</h3>
    <p>Designed for beginners while offering powerful features for experienced developers.</p>

    <h3>5. Developer-Friendly Features</h3>
    <p>Automatic CRUD generation, code scaffolding, and web-based tools for faster development.</p>

    <h3>6. Support for Modern PHP</h3>
    <p>Leverages the latest PHP features, making it future-proof and robust.</p>

    <h2>CoreXPHP vs. Other PHP Frameworks</h2>
    <table>
        <thead>
            <tr>
                <th>Feature</th>
                <th>CoreXPHP</th>
                <th>Laravel</th>
                <th>Symfony</th>
                <th>CodeIgniter</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Routing</td>
                <td>Advanced routing with custom symbols and patterns</td>
                <td>Standard routing with dynamic handling</td>
                <td>Robust routing but complex</td>
                <td>Simple routing for basic apps</td>
            </tr>
            <tr>
                <td>ORM/Database Integration</td>
                <td>PDO-based ORM with Query Builder</td>
                <td>Eloquent ORM</td>
                <td>Doctrine ORM</td>
                <td>Basic database support</td>
            </tr>
            <tr>
                <td>Performance</td>
                <td>High performance, low overhead</td>
                <td>Good performance, can be heavy</td>
                <td>Flexible but resource-intensive</td>
                <td>Fast and lightweight</td>
            </tr>
            <tr>
                <td>Middleware</td>
                <td>Simple middleware implementation</td>
                <td>Extensive middleware support</td>
                <td>Advanced, requires configuration</td>
                <td>Basic middleware</td>
            </tr>
            <tr>
                <td>Learning Curve</td>
                <td>Easy for beginners, powerful for experts</td>
                <td>Steep learning curve</td>
                <td>Highly configurable, steep curve</td>
                <td>Very beginner-friendly</td>
            </tr>
            <tr>
                <td>Automatic CRUD Generation</td>
                <td>Built-in CoreXBuilder for fast CRUD</td>
                <td>Requires Artisan commands</td>
                <td>Requires custom configuration</td>
                <td>Manual CRUD generation</td>
            </tr>
            <tr>
                <td>Composer Support</td>
                <td>Full Composer integration</td>
                <td>Full Composer integration</td>
                <td>Full Composer integration</td>
                <td>Limited Composer support</td>
            </tr>
        </tbody>
    </table>
    
    <h1>System Requirements</h1>
    <p>
        CoreXPHP is designed to be efficient and lightweight, with minimal dependencies to make setup straightforward. Below are the system requirements you need to meet in order to run CoreXPHP:
    </p>

    <h2>Server Requirements</h2>
    <table class="responsive-table">
        <thead>
            <tr>
                <th>Requirement</th>
                <th>Version</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>PHP</td>
                <td>8.0 or higher</td>
            </tr>
            <tr>
                <td>Web Server</td>
                <td>Apache/Nginx</td>
            </tr>
            <tr>
                <td>Database</td>
                <td>MySQL 5.7 or higher / MariaDB / PostgreSQL</td>
            </tr>
            <tr>
                <td>Composer</td>
                <td>Latest version</td>
            </tr>
            <tr>
                <td>PHP Extensions</td>
                <td>
                    <ul>
                        <li>PDO</li>
                        <li>Mbstring</li>
                        <li>Tokenizer</li>
                        <li>JSON</li>
                        <li>OpenSSL</li>
                    </ul>
                </td>
            </tr>
        </tbody>
    </table>

    <h1>Licensing & Open Source Philosophy</h1>
    <p>
        CoreXPHP is built with an open-source mindset to provide flexibility, control, and community-driven improvements. Here is what defines our licensing and open-source approach:
    </p>

    <h2>Open Source Philosophy</h2>
    <p>
        CoreXPHP is distributed under the MIT License. We believe in empowering developers with the freedom to use, modify, and distribute our framework without heavy restrictions.
    </p>

    <h2>Why Open Source?</h2>
    <p>
        Open-source software encourages collaboration, innovation, and transparency. We want CoreXPHP to be a tool that anyone can improve, customize, and scale for their own needs while contributing back to the community.
    </p>

    <h2>Licensing Terms</h2>
    <p>
        The MIT License is a permissive open-source license that allows you to:
        <ul>
            <li>Use the software freely in personal and commercial projects.</li>
            <li>Modify the software as per your needs.</li>
            <li>Redistribute the software, with or without modifications.</li>
            <li>Include it in proprietary software with proper attribution.</li>
        </ul>
    </p>
    <h2>Next Steps</h2>
    <ul>
        <li><a href="#">Installation</a>: Learn how to set up CoreXPHP in your local environment.</li>
        <li><a href="#">Routing</a>: Discover how to define and manage routes.</li>
        <li><a href="#">Controllers</a>: Understand Controllers and their interactions with models and views.</li>
        <li><a href="#">Database Integration</a>: Work with CoreXPHP's database handling, Query Builder, and ORM.</li>
        <li><a href="#">Templating</a>: Learn how to create reusable and dynamic views with CoreXPHP.</li>
    </ul>
    
    <div class="pagination">
            <a href="#" class="prev-page">Previous Page</a>
            <a href="#" class="next-page">Next Page</a>
        </div>
</main>



    

    <?php include_once"../components/docs-footer.php"; ?>