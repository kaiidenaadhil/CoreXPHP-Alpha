<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>PHP Documentation with Copy and Highlighting</title>

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

    /* Dot before code type */
    .code-header .dot-container {
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .dot {
      width: 0.75rem;
      height: 0.75rem;
      background-color: #d34f2d;
      border-radius: 50%;
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
</head>
<body>

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

  <!-- Highlight.js and Clipboard.js scripts -->
  <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/11.7.0/highlight.min.js"></script>
  <script src="//cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
  
  <script>
    // Initialize syntax highlighting
    hljs.highlightAll();

    // Initialize clipboard functionality
    var clipboard = new ClipboardJS('.copy-button');

    // Notify when code is copied
    clipboard.on('success', function(e) {
      var copyButton = e.trigger;
      var originalText = copyButton.textContent;

      // Change button text to "Code copied!"
      copyButton.textContent = "Code copied!";
      copyButton.style.backgroundColor = "green";

      // Revert to original text after 2 seconds
      setTimeout(function() {
        copyButton.textContent = originalText;
        copyButton.style.backgroundColor = "rgb(8, 126, 164)";
      }, 2000);

      e.clearSelection();
    });

    clipboard.on('error', function(e) {
      console.error('Error copying:', e);
    });
  </script>

</body>
</html>
