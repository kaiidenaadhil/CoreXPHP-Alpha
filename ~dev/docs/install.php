<?php include_once "../components/docs-header.php"; ?>
<style>
    
</style>
<main class="content">
    <div class="breadcrumb">
        <a href="#">Docs</a> > <a href="#">Setup</a> > System Requirements
    </div>
    <h1>Getting Started with CoreXPHP</h1>
    <p>
        CoreXPHP is a lightweight, flexible MVC framework that provides developers with the tools to build modern web applications quickly. Whether you're a beginner or an experienced developer, this guide will help you get started with CoreXPHP step by step.
    </p>

    <h2>Prerequisites</h2>
    <p>
        Before starting with CoreXPHP, ensure you have the following installed on your system:
        <ul>
            <li>PHP 8.0 or higher</li>
            <li>Composer (dependency management)</li>
            <li>A web server like Apache or Nginx</li>
            <li>A database like MySQL, MariaDB, or PostgreSQL</li>
        </ul>
    </p>

    <h2>What You'll Build</h2>
    <p>
        In this guide, we'll help you set up a basic CoreXPHP project, configure your environment, and build your first route to display a "Hello World" page.
    </p>

    <h1>Installation</h1>
    <p>
        Installing CoreXPHP is simple. Follow these steps to install the framework and get your project started:
    </p>

    <h2>Step 1: Install via Composer</h2>
    <p>
        To begin, use Composer to install CoreXPHP. Run the following command in your terminal:
    </p>

    <pre><code>composer create-project avantvista/corexphp myproject</code></pre>

    <p>
        This command will create a new project in a directory called "myproject" and install all the necessary dependencies.
    </p>

    <h2>Step 2: Set Directory Permissions</h2>
    <p>
        Ensure your project has the correct directory permissions. You may need to update file permissions for the <code>storage</code> and <code>cache</code> directories:
    </p>

    <pre><code>chmod -R 775 storage/</code></pre>
    <pre><code>chmod -R 775 cache/</code></pre>

    <h2>Step 3: Configure Your Web Server</h2>
    <p>
        CoreXPHP works with Apache and Nginx. Make sure your server is configured to point to the <code>public</code> directory:
    </p>

    <pre><code>&lt;VirtualHost *:80&gt;
    DocumentRoot "/path/to/your/project/public"
    ServerName myproject.local
&lt;/VirtualHost&gt;</code></pre>

<h1>Project Structure Overview</h1>
    <p>
        When you create a new CoreXPHP project, the following directory structure is generated. Here's an overview of what each folder and file does:
    </p>

    <h2>Folder Breakdown</h2>


    <table class="responsive-table">
        <thead>
            <tr>
                <th>Directory</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><code>app/</code></td>
                <td>Contains your application's core logic, including controllers, models, and services.</td>
            </tr>
            <tr>
                <td><code>core/</code></td>
                <td>Framework core files like routing, request/response handling, and more.</td>
            </tr>
            <tr>
                <td><code>public/</code></td>
                <td>Web-accessible directory containing index.php and static assets (CSS, JS, images).</td>
            </tr>
            <tr>
                <td><code>config/</code></td>
                <td>Configuration files for your application (database, app settings, etc.).</td>
            </tr>
            <tr>
                <td><code>routes/</code></td>
                <td>All application routes are defined here.</td>
            </tr>
            <tr>
                <td><code>storage/</code></td>
                <td>Directory for logs, cache, and session data.</td>
            </tr>
            <tr>
                <td><code>vendor/</code></td>
                <td>Composer-managed dependencies.</td>
            </tr>
        </tbody>
    </table>

    <style>
    .content {
    font-family: Arial, sans-serif;
    padding: 20px;
}

.breadcrumb {
    margin-bottom: 20px;
}

.breadcrumb a {
    color: #3498db;
    text-decoration: none;
}

.breadcrumb a:hover {
    text-decoration: underline;
}

h1 {
    font-size: 24px;
    color: #2c3e50;
    margin-bottom: 20px;
}

.directory-structure {
    background-color: #f9f9f9;
    padding: 20px;
    border: 1px solid #e1e1e1;
    border-radius: 8px;
}

.directory-list {
    list-style-type: none;
    padding-left: 20px;
}

.directory-list ul {
    list-style-type: none;
    padding-left: 20px;
    margin: 5px 0;
}

.directory-list li {
    margin: 5px 0;
}

.folder {
    font-weight: bold;
    color: #2980b9;
    position: relative;
    cursor: pointer;
}

.folder::before {
    content: "📂";
    margin-right: 8px;
}

.file {
    color: #34495e;
    position: relative;
}

.file::before {
    content: "📄";
    margin-right: 8px;
}

/* Hidden class to collapse */
.hidden {
    display: none;
}

@media (max-width: 768px) {
    .directory-structure {
        font-size: 14px;
    }
}

</style>
    <h1>CoreXPHP Directory Structure</h1>

    <div class="directory-structure">
        <ul class="directory-list">
            <li>
                <span class="folder">CoreXPHP/</span>
                <ul>
                    <li>
                        <span class="folder">app/</span>
                        <ul>
                            <li><span class="folder">controllers/</span>
                                <ul class="hidden">
                                    <li><span class="file">HomeController.php</span></li>
                                    <li>... (other controller files)</li>
                                </ul>
                            </li>
                            <li><span class="folder">models/</span>
                                <ul class="hidden">
                                    <li><span class="file">User.php</span></li>
                                    <li>... (other model files)</li>
                                </ul>
                            </li>
                            <li><span class="folder">middlewares/</span>
                                <ul class="hidden">
                                    <li><span class="file">User.php</span></li>
                                </ul>
                            </li>
                            <li><span class="folder">views/</span>
                                <ul class="hidden">
                                    <li><span class="folder">home/</span>
                                        <ul class="hidden">
                                            <li><span class="file">index.php</span></li>
                                            <li>... (other view files)</li>
                                        </ul>
                                    </li>
                                    <li><span class="folder">@layout/</span>
                                        <ul class="hidden">
                                            <li><span class="file">layout.php</span></li>
                                            <li><span class="file">adminLayout.php</span></li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            <li><span class="folder">core/</span>
                                <ul>
                                    <li><span class="file">App.php</span></li>
                                    <li><span class="file">Controller.php</span></li>
                                    <li><span class="file">Database.php</span></li>
                                    <li><span class="file">Function.php</span></li>
                                    <li><span class="file">Language.php</span></li>
                                    <li><span class="file">Model.php</span></li>
                                    <li><span class="file">Paginator.php</span></li>
                                    <li><span class="file">Request.php</span></li>
                                    <li><span class="file">Response.php</span></li>
                                    <li><span class="file">Router.php</span></li>
                                    <li><span class="file">Validator.php</span></li>
                                    <li><span class="file">View.php</span></li>
                                </ul>
                            </li>
                            <li><span class="folder">helpers/</span></li>
                            <li><span class="folder">router/</span>
                                <ul class="hidden">
                                    <li><span class="file">web.php</span></li>
                                    <li><span class="file">api.php</span></li>
                                </ul>
                            </li>
                            <li><span class="file">init.php</span></li>
                            <li><span class="file">.env</span></li>
                        </ul>
                    </li>
                    <li>
                        <span class="folder">public/</span>
                        <ul class="hidden">
                            <li><span class="folder">assets/</span>
                                <ul class="hidden">
                                    <li><span class="folder">css/</span></li>
                                    <li><span class="folder">js/</span></li>
                                    <li>... (other asset files)</li>
                                </ul>
                            </li>
                            <li><span class="file">index.php</span></li>
                        </ul>
                    </li>
                    <li><span class="file">.htaccess</span></li>
                </ul>
            </li>
        </ul>
    </div>
    <script>
    document.querySelectorAll('.folder').forEach(folder => {
        folder.addEventListener('click', function() {
            const siblingList = this.nextElementSibling;
            if (siblingList) {
                siblingList.classList.toggle('hidden');
            }
        });
    });
</script>

    <h1>Basic Configuration</h1>
    <p>
        After setting up the project, you'll need to configure the environment and basic settings.
    </p>

    <h2>Environment Configuration</h2>
    <p>
        CoreXPHP uses a `.env` file for environment configuration. You can create or modify the `.env` file to set your database credentials, application environment (development, production), and other settings.
    </p>

    <pre><code>APP_ENV=development
APP_DEBUG=true
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_database
DB_USERNAME=your_username
DB_PASSWORD=your_password
</code></pre>

    <h2>Routing Configuration</h2>
    <p>
        Define your routes in the <code>routes/web.php</code> file. Here's an example of setting up a route:
    </p>

    <pre><code>$app->router->get('/home', function () {
    return 'Welcome to CoreXPHP!';
});</code></pre>

    <h2>Database Configuration</h2>
    <p>
        Configure your database connection in the <code>config/database.php</code> file. Ensure you have set your correct database credentials in the `.env` file.
    </p>
</main>

<?php include_once"../components/docs-footer.php"; ?>