
<style>

body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f6f8fa;
}

.container {
    display: flex;
    flex-direction: row;
    padding: 20px;
    background-color: #f6f8fa;
}

.sidebar {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 10;
    margin: 20px;
    width: 250px;
    background-color: #ffffff;
    padding: 20px;
    border-right: 1px solid #ddd;
    height: 100vh;
    overflow-y: auto;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

/* Custom Scrollbar */
.sidebar::-webkit-scrollbar {
    width: 8px;
}

.sidebar::-webkit-scrollbar-thumb {
    background-color: #cccccc;
    border-radius: 8px;
}

.sidebar nav ul {
    list-style-type: none;
    padding: 0;
    margin: 0;
}

.sidebar nav ul li a{
color:#6ca8e0;
text-decoration:none;
}

/* General Styling for the Hamburger */
.hamburger {
    display: none;
    cursor: pointer;
    position: relative;
    width: 30px;
    height: 20px;
}

.hamburger span {
    background-color: #333;
    position: absolute;
    height: 3px;
    width: 100%;
    transition: all 0.3s ease;
    border-radius: 2px;
}

/* Position the spans */
.hamburger span:nth-child(1) {
    top: 0;
}

.hamburger span:nth-child(2) {
    top: 8px;
}

.hamburger span:nth-child(3) {
    top: 16px;
}

/* Transition for when the menu is active */
.hamburger.active span:nth-child(1) {
    transform: rotate(45deg);
    top: 8px;
}

.hamburger.active span:nth-child(2) {
    opacity: 0;
}

.hamburger.active span:nth-child(3) {
    transform: rotate(-45deg);
    top: 8px;
}

.logo-and-hamburger {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
}

.logo img {
    width: 150px; /* Adjust the size of the logo as needed */
}

.menu-item {
    margin: 10px 0;
    font-weight: bold;
    cursor: pointer;
    padding: 10px;
    border-radius: 5px;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.menu-item:hover {
    background-color: #f0f0f0;
}

.menu-item.active {
    background-color: rgb(230, 247, 255);
    color: rgb(8, 126, 164);
}

.submenu {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.3s ease;
    list-style-type: none;
    padding-left: 20px;
    margin: 0;
    line-height: 1.8; /* Adjusted line height for readability */
}

.submenu li {
    padding: 8px 0; /* Increased padding for better spacing */
    font-weight: normal;
}

.menu-item.active .submenu {
    max-height: 500px;
}

.menu-item span {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-weight: bolder;
    color:#68727f;
}

.menu-item span::after {
    content: url('http://localhost:8082/assets/img/angle-up.svg');
    display: inline-block;
    width: 20px; /* Adjust as needed */
    height: 20px; /* Adjust as needed */
    vertical-align: middle; /* Ensure alignment */
}

.menu-item.active span::after {
    content: url('http://localhost:8082/assets/img/angle-down.svg');
    display: inline-block;
    width: 20px; /* Adjust as needed */
    height: 20px; /* Adjust as needed */
    vertical-align: middle; /* Ensure alignment */
}




.content {
    padding: 20px;
    background-color: #ffffff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    flex-grow: 1;
    margin-left: 310px; /* Increased margin-left to make space for the fixed sidebar */
    transition: all 0.3s ease;
}

.content h1, .content h2 {
    color: rgb(8, 126, 164);
}

.content p {
    line-height: 1.6;
    margin-bottom: 15px;
}

.content strong {
    font-weight: bold;
}

.content ul {
    margin-left: 20px;
    margin-bottom: 20px;
    line-height: 1.8; /* Increased line height for better readability */
}

.content li {
    margin-bottom: 8px; /* Added spacing between list items */
}

.pagination {
    display: flex;
    justify-content: space-between;
    margin-top: 30px;
}

.pagination a {
    color: rgb(8, 126, 164);
    text-decoration: none;
    padding: 10px 15px;
    background-color: rgb(230, 247, 255);
    border-radius: 5px;
    transition: background-color 0.3s ease, color 0.3s ease;
}

.pagination a:hover {
    background-color: rgb(8, 126, 164);
    color: white;
}

/* Responsive Styles */
@media screen and (max-width: 1024px) {
    .container {
        flex-direction: column;
    }
    
    .sidebar {
        position: relative; /* Change to relative for smaller screens */
        width: 100%;
        height: auto;
        border-right: none;
        margin: 0;
        padding: 0;
    }
    
    .content {
        margin-left: 0;
    }
}

@media screen and (max-width: 1024px) {
    .container{
        padding:0px;
    }
    .sidebar {
        margin: 0;
        padding: 0;
        border-radius: 0px;
    }
    
    .content {
        margin-top: 50px;
        padding: 15px;
    }
    
    .menu-item {
        font-size: 14px;
        padding: 8px;
    }
    
    .content h1, .content h2 {
        font-size: 20px;
    }

    #nav-menu {
        display: none;
        position: fixed;
        top: 50px; /* Adjusted to allow space for the header */
        left: 0;
        width: 100%;
        background-color: #ffffff;
        z-index: 1000;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        overflow-y: auto; /* Enable vertical scrolling */
        max-height: calc(100vh - 50px); /* Limit menu height */
    }

    /* Custom Scrollbar */
    #nav-menu::-webkit-scrollbar {
    width: 8px;
}

#nav-menu::-webkit-scrollbar-thumb {
    background-color: #cccccc;
    border-radius: 8px;
}

    #nav-menu.open {
        display: block;
    }

    .hamburger {
        display: block;
    }

    .logo-and-hamburger {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #f6f8fa;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1001; /* Ensure the header stays above the menu */
    }

}

@media screen and (max-width: 480px) {
    .sidebar {
        margin: 0;
        padding: 0;
    }
    
    .content {
        padding: 10px;
    }
    
    .content h1, .content h2 {
        font-size: 18px;
    }
    
    .pagination a {
        padding: 8px 12px;
        font-size: 14px;
    }

    .logo img {
        width: 120px; /* Smaller logo size for mobile */
    }

    .logo-and-hamburger {
        padding: 10px;
        background-color: #f6f8fa; /* Background color for header on mobile */
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Adding shadow for header */
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1000;
    }

    .hamburger {
        position: absolute;
        right: 10px;
    }

    .content {
        padding-top: 60px; /* Make room for fixed header */
    }
}

.breadcrumb {
    font-size: 14px;
    color: rgb(8, 126, 164);
    margin-bottom: 20px;
}

.breadcrumb a {
    color: rgb(8, 126, 164);
    text-decoration: none;
    transition: color 0.3s ease;
}

.breadcrumb a:hover {
    text-decoration: underline;
}

/* Table Container for Responsiveness */
.table-responsive {
    width: 100%;
    overflow-x: auto;
    margin-bottom: 20px;
}

/* Table Styling */
table {
    width: 100%;
    border-collapse: collapse;
    margin: 20px 0;
    font-size: 16px;
    text-align: left;
}

table thead th {
    background-color: #f4f4f4;
    color: #333;
    padding: 12px;
    border-bottom: 2px solid #ddd;
}

table tbody td {
    padding: 12px;
    border-bottom: 1px solid #ddd;
}

table tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

table tbody tr:hover {
    background-color: #f1f1f1;
}

/* Unordered List Styling */
ul {
    padding-left: 20px;
    margin: 20px 0;
    list-style-type: disc;
}

ul li {
    margin-bottom: 10px;
}

/* Anchor (Link) Styling */
a {
    color: #007BFF;
    text-decoration: none;
}

a:hover {
    text-decoration: underline;
}

/* Responsive Table for Smaller Screens */
@media (max-width: 768px) {
    table {
        font-size: 14px; /* Reduce font size for smaller screens */
    }

    table thead {
        display: none; /* Hide table headers on small screens */
    }

    table, table tbody, table tr, table td {
        display: block;
        width: 100%;
    }

    table tr {
        margin-bottom: 15px;
        border-bottom: 1px solid #ddd;
    }

    table td {
        padding-left: 50%;
        position: relative;
    }

    table td::before {
        content: attr(data-label); /* Add labels before each cell */
        position: absolute;
        left: 0;
        top: 0;
        width: 45%;
        padding-left: 10px;
        font-weight: bold;
        background-color: #f4f4f4;
        border-right: 1px solid #ddd;
    }
}

code{
    background-color: #ececec;
    border-radius: .25rem;
    color: #0d0d0d;
    font-size: .875em;
    font-weight: 500;
    padding: .15rem .3rem;
}
</style>
 <!-- Highlight.js for Syntax Highlighting -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/styles/default.min.css"> 



<style>
    
    /* Style the container */
    .code-container {
      position: relative;
      display: flex;
      flex-direction: column;
      margin: 20px;
      max-width: 100%;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Fixed header for code type and copy button */
    .code-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      background-color: #f0f0f0;
      padding: 10px;
      border-radius: 8px 8px 0 0;
      position: sticky;
      top: 0;
      z-index: 1;
      font-size: 14px;
      font-weight: bold;
    }

    .browser {
    overflow: hidden;
    width: 4rem;
    float: left;
}
.browser>span {
    display: flex;
    position: relative;
    width: .65rem;
    height: .65rem;
    background: #d34f2d;
    border-radius: 50%;
}

.browser>span::before, .browser>span::after {
    content: "";
    position: absolute;
    top: 0;
    left: 1.2rem;
    display: block;
    width: .65rem;
    height: .65rem;
    background: #f7cc76;
    border-radius: 50%;
}

.browser>span::after {
    left: 2.4rem;
    background: #1d4b40;
}
.code-type{
width: 85%;
}
    /* Code block styling */
    pre {
      background-color: #f5f5f5;
      padding: 15px;
      border-radius: 0 0 8px 8px;
      max-height: 300px;
      overflow: auto;
      white-space: pre;
      font-size: 14px;
      line-height: 1.6;
      margin: -2px 0px;
    }

    /* Custom scrollbar */
    pre::-webkit-scrollbar {
      width: 8px;
      height: 8px;
    }

    pre::-webkit-scrollbar-thumb {
      background-color: #888;
      border-radius: 10px;
    }

    pre::-webkit-scrollbar-thumb:hover {
      background-color: #555;
    }

    /* Copy button styling */
    .copy-button {
      cursor: pointer;
      border: none;
      background-color: rgb(8, 126, 164);
      color: white;
      padding: 5px 10px;
      border-radius: 4px;
      font-size: 14px;
      transition: background-color 0.3s;
    }

    .copy-button:hover {
      background-color: rgb(6, 99, 128);
    }

    /* Responsive design */
    @media (max-width: 768px) {
      pre {
        max-height: 200px;
        font-size: 12px;
      }

      .copy-button {
        font-size: 12px;
        padding: 4px 8px;
      }

      .code-header {
        font-size: 12px;
      }
    }
  
  </style>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const menuItems = document.querySelectorAll('.menu-item');

    menuItems.forEach(item => {
        item.addEventListener('click', () => {
            const submenu = item.querySelector('.submenu');

            // Close all other submenus
            menuItems.forEach(i => {
                if (i !== item) {
                    i.classList.remove('active');
                    const sub = i.querySelector('.submenu');
                    if (sub) {
                        sub.style.maxHeight = null;
                    }
                }
            });

            // Toggle current submenu
            item.classList.toggle('active');
            if (submenu) {
                submenu.style.maxHeight = submenu.style.maxHeight ? null : submenu.scrollHeight + "px";
            }
        });
    });
});

</script>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const hamburger = document.querySelector(".hamburger");
    const navMenu = document.getElementById("nav-menu");
    const menuItems = document.querySelectorAll(".menu-item");

    // Toggle menu on hamburger click
    hamburger.addEventListener("click", function () {
        navMenu.classList.toggle("open");
        hamburger.classList.toggle("active");
    });

    // Close menu when a menu item or submenu item is clicked
    menuItems.forEach(function (menuItem) {
        menuItem.addEventListener("click", function () {
            if (window.innerWidth <= 768) {
               // navMenu.classList.remove("open");
                hamburger.classList.remove("active");
            }
        });
    });

    // Close the menu if clicked outside (optional, for better UX)
    document.addEventListener("click", function (event) {
        if (!navMenu.contains(event.target) && !hamburger.contains(event.target)) {
           // navMenu.classList.remove("open");
            hamburger.classList.remove("active");
        }
    });
});

</script>

<?php
define('ROOT', 'http://localhost:8082');
?>

<div class="container">
    <aside class="sidebar">
    <div class="logo-and-hamburger">
    <a href="/docs">
    <div class="logo">
            <img src="../assets/img/logo.svg" alt="Logo" />
        </div>
    </a>
        <div class="hamburger" id="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </div>

    </div>
    <nav id="nav-menu">
    <ul>
        <li class="menu-item">
            <span><a href="<?=ROOT?>/docs/intro.php">Introduction</a></span>
            <ul class="submenu">
                <li>What is CoreXPHP?</li>
                <li>Key Features</li>
                <li>System Requirements</li>
                <li>Licensing & Open Source Philosophy</li>
            </ul>
        </li>

        <li class="menu-item">
            <span><a href="<?=ROOT?>/docs/install.php">Getting Started</a></span>
            <ul class="submenu">
                <li>Installation</li>
                <li>Project Structure Overview</li>
                <li>Basic Configuration</li>
            </ul>
        </li>

        <li class="menu-item">
            <span><a href="<?=ROOT?>/docs/route.php">Routing</a></span> 
            <ul class="submenu">
                <li>Defining Routes</li>
                <li>Resourceful Routing</li>
                <li>Route Groups</li>
                <li>Route Middleware</li>
                <li>SEO-Friendly Routing</li>
            </ul>
        </li>

        <li class="menu-item">
            <span><a href="<?=ROOT?>/docs/controllers.php">Controllers</a></span> 
            <ul class="submenu">
                <li>Creating Controllers</li>
                <li>Controller Methods</li>
                <li>Dependency Injection in Controllers</li>
            </ul>
        </li>

        <li class="menu-item">
            <span><a href="<?=ROOT?>/docs/models.php">Models</a></span> 
            <ul class="submenu">
                <li>Defining Models</li>
                <li>Working with Database</li>
                <li>Relationships</li>
                <li>Model Events & Observers</li>
            </ul>
        </li>

        <li class="menu-item">
            <span><a href="<?=ROOT?>/docs/views.php">Views</a></span> 
            <ul class="submenu">
                <li>Templating Engine</li>
                <li>Basic View Rendering</li>
                <li>View Inheritance</li>
                <li>Working with Static Assets</li>
            </ul>
        </li>

        <li class="menu-item">
            <span><a href="<?=ROOT?>/docs/middleware.php">Middleware</a></span> 
            <ul class="submenu">
                <li>Understanding Middleware</li>
                <li>Creating Middleware</li>
                <li>Applying Middleware to Routes</li>
            </ul>
        </li>

        <li class="menu-item">
            <span><a href="<?=ROOT?>/docs/request-handling.php">Request Handling</a></span> 
            <ul class="submenu">
                <li>Handling Incoming Requests</li>
                <li>Accessing Request Data</li>
                <li>Validation</li>
            </ul>
        </li>

        <li class="menu-item">
            <span><a href="<?=ROOT?>/docs/response-handling.php">Response Handling</a></span> 
            <ul class="submenu">
                <li>Returning Different Response Types</li>
                <li>Redirects</li>
                <li>Custom Responses</li>
            </ul>
        </li>

        <li class="menu-item">
            <span><a href="<?=ROOT?>/docs/database.php">Database</a></span> 
            <ul class="submenu">
                <li>Database Configuration</li>
                <li>Migrations</li>
                <li>Seeders & Factories</li>
            </ul>
        </li>

        <li class="menu-item">
            <span><a href="<?=ROOT?>/docs/validation.php">Validation</a></span> 
            <ul class="submenu">
                <li>Built-In Validation Rules</li>
                <li>Custom Validation Rules</li>
            </ul>
        </li>

        <li class="menu-item">
        <span><a href="<?=ROOT?>/docs/session-authentication.php">Session & Authentication</a></span> 
            <ul class="submenu">
                <li>Session Management</li>
                <li>Authentication</li>
                <li>Role-Based Access Control</li>
            </ul>
        </li>

        <li class="menu-item">
            <span><a href="<?=ROOT?>/docs/corexbuilder-tool.php">CoreXBuilder Tool</a></span> 
            <ul class="submenu">
                <li>Introduction to CoreXBuilder</li>
                <li>Generating Models, Controllers, Views</li>
            </ul>
        </li>

        <li class="menu-item">
            <span><a href="<?=ROOT?>/docs/file-management.php">File Management</a></span> 
            <ul class="submenu">
                <li>Handling File Uploads</li>
                <li>Managing Static Files</li>
            </ul>
        </li>

        <li class="menu-item">
            <span><a href="<?=ROOT?>/docs/error-handling-debugging.php">Error Handling & Debugging</a></span> 
            <ul class="submenu">
                <li>Custom Error Pages</li>
                <li>Exception Handling</li>
            </ul>
        </li>

        <li class="menu-item">
            <span><a href="<?=ROOT?>/docs/advanced-features.php">Advanced Features</a></span> 
            <ul class="submenu">
                <li>Using the Query Builder</li>
                <li>Working with Pagination</li>
                <li>Caching</li>
                <li>Multi-Language Support</li>
                <li>API Development</li>
            </ul>
        </li>

        <li class="menu-item">
            <span><a href="<?=ROOT?>/docs/cli-tooling.php">CLI Tooling</a></span> 
            <ul class="submenu">
                <li>Overview of CLI Commands</li>
                <li>Generating Controllers</li>
            </ul>
        </li>

        <li class="menu-item">
            <span><a href="<?=ROOT?>/docs/security.php">Security</a></span> 
            <ul class="submenu">
                <li>CSRF Protection</li>
                <li>XSS Prevention</li>
            </ul>
        </li>

        <li class="menu-item">
        <span><a href="<?=ROOT?>/docs/queues-jobs.php">Queues and Jobs</a></span> 

            <ul class="submenu">
                <li>Introduction to Queues</li>
                <li>Queue Drivers & Configuration</li>
            </ul>
        </li>

        <li class="menu-item">
            <span><a href="<?=ROOT?>/docs/testing.php">Testing</a></span> 
            <ul class="submenu">
                <li>Unit Testing</li>
                <li>Feature Testing</li>
            </ul>
        </li>

        <li class="menu-item">
        <span><a href="<?=ROOT?>/docs/localization-multi-language-support">Localization & Multi-language Support</a></span> 
            <ul class="submenu">
                <li>Setting up Language Files</li>
                <li>Switching Between Languages</li>
            </ul>
        </li>

        <li class="menu-item">
            <span><a href="<?=ROOT?>/docs/deployment">deployment</a></span> 
            <ul class="submenu">
                <li>Preparing for Deployment</li>
                <li>Deploying to a Web Server</li>
            </ul>
        </li>

        <li class="menu-item">
            <span><a href="<?=ROOT?>/docs/contributing.php">Contributing</a></span> 
            <ul class="submenu">
                <li>How to Contribute</li>
                <li>Coding Standards</li>
            </ul>
        </li>

        <li class="menu-item">
        <span><a href="<?=ROOT?>/docs/faqs.php">FAQs</a></span>
            <ul class="submenu">
                <li>Common Questions</li>
                <li>Troubleshooting Tips</li>
            </ul>
        </li>

        <li class="menu-item">
            <span><a href="<?=ROOT?>/docs/changelog.php">Changelog</a></span>
            <ul class="submenu">
                <li>Version History</li>
                <li>Release Notes</li>
            </ul>
        </li>
        <li class="menu-item">
            <span><a href="<?=ROOT?>/docs/hidden.php">Hidden</a></span>
            <ul class="submenu">
                <li>hidden topics</li>
            </ul>
        </li>
    </ul>
</nav>

    </aside>

    