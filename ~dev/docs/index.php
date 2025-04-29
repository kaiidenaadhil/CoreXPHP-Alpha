<?php include_once"../components/docs-header.php"; ?>

    <main class="content">
    <div class="breadcrumb">
            <a href="#">Docs</a> > <a href="#">Intro</a> > Describing the UI
        </div>
        <h1>Describing the UI</h1>
        <h2>Introduction</h2>
        <p><strong>React</strong> is a JavaScript library for rendering user interfaces (UI). UI is built from small units like buttons, text, and images.</p>
        <p><strong>Key Points:</strong></p>
        <ul>
            <li>React allows for the creation of reusable components.</li>
            <li>Components can be nested within each other.</li>
            <li>Everything on the screen can be broken down into components.</li>
        </ul>
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
  // Sample PHP Code
  function greet($name) {
      echo "Hello, " . $name . "!";
  }

  greet('World');
?&gt;
    </code></pre>
  </div>

        <div class="pagination">
            <a href="#" class="prev-page">Previous Page</a>
            <a href="#" class="next-page">Next Page</a>
        </div>
    </main>
</div>
<?php include_once"../components/docs-footer.php"; ?>