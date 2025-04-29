<?php include_once "../components/docs-header.php";?>
<main class="content">
    <div class="breadcrumb">
        <a href="#">Docs</a> > <a href="#">Routing</a> >  Introduction
    </div>

    <h1>CorexPHP Routing System</h1>

    <p>
        <strong>CorexPHP</strong>
         provides a robust and flexible routing system that maps URLs to controllers or functions, enabling dynamic and static routes, handling parameters, and supporting resourceful routes. Here's how you can define and use routes in CorexPHP.
<!-- <br><br>

<strong>Table of Contents:</strong>
<ul>
  <li> Static Routes</li>
  <li> Controller Method Routes</li>
  <li> Dynamic Parameter Routes</li>
  <li> Nested Parameters</li>
  <li> Resource Routes</li>
  <li> Wildcard Routes</li>
  <li> Static File Routes</li>
  <li> Symbol-based Routes</li>
  <li> Running the Application</li>
</ul> -->
    </p>


<h2> Static Routes </h2>
<p>
A static route is a simple path that maps directly to a function or a controller method.
<ul>
  <li>
  The first route maps the home page ('') to an inline function that returns a welcome message.

  </li>
  <li>
  The second route maps the <code>/about</code> URL to the <code>aboutPage</code> view.
  </li>
</ul>
</p>
<!--Code Container-->
    <div class="code-container">
    <!-- Sticky Header with Code Type and Copy Button -->
    <div class="code-header">
      <div class="dot-container">
        <div class="dot"></div>
        <span>PHP</span>
      </div>
      <button class="copy-button" data-clipboard-target="#phpCode">Copy Code</button>
    </div>

    <!-- PHP Code Block with Highlighting -->
    <pre><code class="php" id="phpCode">
&lt;?php
// Maps to a callback function
$app->router->get('', function () {
    return 'Welcome to CodeXPHP World, a place where core PHP is used to create dynamic apps';
});
// Maps to a specific page view
$app->router->get('/about', 'aboutPage');
?&gt;
    </code></pre>
  </div>
<!--Code Container-->

<h2>Controller Method Routes</h2>
<p>You can map routes to specific methods inside controller classes.
  <ul>
    <li>The <code>/home</code> route is mapped to the <code>index</code> method inside <code>HomeController</code>.</li>
  </ul>
</p>
<!--Code Container-->
<div class="code-container">
    <!-- Sticky Header with Code Type and Copy Button -->
    <div class="code-header">
      <div class="dot-container">
        <div class="dot"></div>
        <span>PHP</span>
      </div>
      <button class="copy-button" data-clipboard-target="#phpCode">Copy Code</button>
    </div>

    <!-- PHP Code Block with Highlighting -->
    <pre><code class="php" id="phpCode">
&lt;?php
$app->router->get('/home', [HomeController::class, 'index']);

?&gt;
    </code></pre>
  </div>
<!--Code Container-->




<h2>Dynamic Parameter Routes</h2>
<p>Dynamic segments allow capturing parts of the URL and passing them as parameters to a controller method.
  <ul>
    <li>The <code>{id}</code> is a placeholder for dynamic values. When accessing <code> /user/5</code> , the show method in <code>UserController</code> will receive <code>5</code> as the <code>$id</code> parameter.</li>
  </ul>
</p>
<!--Code Container-->
<div class="code-container">
    <!-- Sticky Header with Code Type and Copy Button -->
    <div class="code-header">
      <div class="dot-container">
        <div class="dot"></div>
        <span>PHP</span>
      </div>
      <button class="copy-button" data-clipboard-target="#phpCode">Copy Code</button>
    </div>

    <!-- PHP Code Block with Highlighting -->
    <pre><code class="php" id="phpCode">
&lt;?php
$app->router->get('/user/{id}', [UserController::class, 'show']);

?&gt;
    </code></pre>
  </div>
<!--Code Container-->






<h2>Nested Parameters</h2>
<p>Nested parameters allow capturing multiple dynamic segments from the URL.
  <ul>
    <li>This route captures both <code>postId</code> and <code>commentId</code> from the URL and passes them to the <code>show</code> method in <code>CommentController</code></li>
  </ul>
</p>
<!--Code Container-->
<div class="code-container">
    <!-- Sticky Header with Code Type and Copy Button -->
    <div class="code-header">
      <div class="dot-container">
        <div class="dot"></div>
        <span>PHP</span>
      </div>
      <button class="copy-button" data-clipboard-target="#phpCode">Copy Code</button>
    </div>

    <!-- PHP Code Block with Highlighting -->
    <pre><code class="php" id="phpCode">
&lt;?php
$app->router->get('/post/{postId}/comment/{commentId}', [CommentController::class, 'show']);

?&gt;
    </code></pre>
  </div>
<!--Code Container-->



<h2>Resource Routes</h2>
<p>Resource routes automatically map routes to standard CRUD operations (Create, Read, Update, Delete).
  <ul>
    <li>This resource route maps standard operations like:
    <li><code>GET /products</code> -> <code>index</code> method</li>
    <li><code>POST /products</code> -> <code>store</code> method</li>
    <li><code>PUT /products/{id}</code> -> <code>update</code> method</li>
    <li><code>DELETE /products/{id}</code> -> <code>destroy</code> method</li>
  </ul>
</p>
<!--Code Container-->
<div class="code-container">
    <!-- Sticky Header with Code Type and Copy Button -->
    <div class="code-header">
      <div class="dot-container">
        <div class="dot"></div>
        <span>PHP</span>
      </div>
      <button class="copy-button" data-clipboard-target="#phpCode">Copy Code</button>
    </div>

    <!-- PHP Code Block with Highlighting -->
    <pre><code class="php" id="phpCode">&lt;?php
    $app->router->resource('products', 'product', ProductController::class);
?&gt;</code></pre>
  </div>
<!--Code Container-->





<h2>Wildcard Routes</h2>
<p>A wildcard route can capture any path segment and pass it as a parameter.
  <ul>
    <li>The <code> {slug}</code> can be any string. When accessing <code>/page/contact</code>, <code>contact</code> will be passed to the <code>show</code> method in <code>PageController</code>.</li>
  </ul>
</p>
<!--Code Container-->
<div class="code-container">
    <!-- Sticky Header with Code Type and Copy Button -->
    <div class="code-header">
      <div class="dot-container">
        <div class="dot"></div>
        <span>PHP</span>
      </div>
      <button class="copy-button" data-clipboard-target="#phpCode">Copy Code</button>
    </div>

    <!-- PHP Code Block with Highlighting -->
    <pre><code class="php" id="phpCode">&lt;?php
    $app->router->get('/page/{slug}', [PageController::class, 'show']);
?&gt;</code></pre>
  </div>
<!--Code Container-->


<h2>Static File Routes</h2>
<p>Static file routes allow serving static files directly from the filesystem.
  <ul>
    <li>This route serves a static CSS file from the specified path.</li>
  </ul>
</p>
<!--Code Container-->
<div class="code-container">
    <!-- Sticky Header with Code Type and Copy Button -->
    <div class="code-header">
      <div class="dot-container">
        <div class="dot"></div>
        <span>PHP</span>
      </div>
      <button class="copy-button" data-clipboard-target="#phpCode">Copy Code</button>
    </div>

    <!-- PHP Code Block with Highlighting -->
    <pre><code class="php" id="phpCode">&lt;?php
    $app->router->get('/assets/css/style.css', function () {
    return file_get_contents('path/to/style.css');
});

?&gt;</code></pre>
  </div>
<!--Code Container-->



<h2>Symbol-based Routes</h2>
<p>CorexPHP supports special symbols like <code>@</code> and <code>~</code> for creating intuitive routes.
  <ul>
    <li>Captures a dynamic username parameter for user profiles.</li>
  </ul>
</p>
<h3><code>@</code>Symbol Route:</h3>
<!--Code Container-->
<div class="code-container">
    <!-- Sticky Header with Code Type and Copy Button -->
    <div class="code-header">
      <div class="dot-container">
        <div class="dot"></div>
        <span>PHP</span>
      </div>
      <button class="copy-button" data-clipboard-target="#phpCode">Copy Code</button>
    </div>

    <!-- PHP Code Block with Highlighting -->
    <pre><code class="php" id="phpCode">&lt;?php
    $app->router->get('/profile/@{username}', [ProfileController::class, 'show']);

?&gt;</code></pre>
  </div>
<!--Code Container-->
<h3><code>~</code> Symbol Route:</h3>
<!--Code Container-->
<div class="code-container">
    <!-- Sticky Header with Code Type and Copy Button -->
    <div class="code-header">
      <div class="dot-container">
        <div class="dot"></div>
        <span>PHP</span>
      </div>
      <button class="copy-button" data-clipboard-target="#phpCode">Copy Code</button>
    </div>

    <!-- PHP Code Block with Highlighting -->
    <pre><code class="php" id="phpCode">&lt;?php
    $app->router->get('/collections/~{collectionId}', [CollectionController::class, 'show']);
?&gt;</code></pre>
  </div>
<!--Code Container-->
<h3><code>+</code> Symbol Route:</h3>
<!--Code Container-->
<div class="code-container">
    <!-- Sticky Header with Code Type and Copy Button -->
    <div class="code-header">
      <div class="dot-container">
        <div class="dot"></div>
        <span>PHP</span>
      </div>
      <button class="copy-button" data-clipboard-target="#phpCode">Copy Code</button>
    </div>

    <!-- PHP Code Block with Highlighting -->
    <pre><code class="php" id="phpCode">&lt;?php
    $app->router->get('/collections/+{collectionId}', [CollectionController::class, 'show']);
?&gt;</code></pre>
  </div>
<!--Code Container-->
    <div class="pagination">
            <a href="#" class="prev-page">Previous Page</a>
            <a href="#" class="next-page">Next Page</a>
        </div>
</main>
    <?php include_once "../components/docs-footer.php";?>