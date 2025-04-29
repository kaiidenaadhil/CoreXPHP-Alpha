
</div>
<!-- footer.php -->
<style>
/* Global Styles */
html, body {
    height: 100%;
    margin: 0;
    padding: 0;
}

body {
    display: flex;
    flex-direction: column;
}

/* Footer styling */
.footer {
    color: #333; /* Dark text color */
    padding: 10px 20px; /* Padding */
     text-align: center;
    position: relative;
    margin-top: auto; /* Pushes the footer to the bottom of the viewport */
}

.footer-content {
    font-size: 11px;
    margin: 0 auto; /* Center align content */
    padding: 10px; /* Padding around content */
}

.footer p {
    margin: 5px 0; /* Margins for paragraphs */
}

.footer-logo {
    height: 20px; /* Set a specific height for the logo */
    vertical-align: middle; /* Align logo vertically with text */
    margin-left: 5px; /* Margin to the left of the logo */
}

.footer a {
    color: #007bff; /* Link color */
    text-decoration: none; /* Remove underline from links */
}

.footer a:hover {
    text-decoration: underline; /* Underline on hover */
}

</style>

<footer class="footer">
    <div class="footer-content">
        <p>&copy; 2024 CoreXPHP. All rights reserved.</p>
        <p>Developed by <a href="https://avantvista.com" target="_blank" rel="noopener noreferrer">
            <img src="https://avantvista.com/assets/alpha-theme/img/logo.svg" alt="Avant Vista Venture Logo" class="footer-logo">
        </a></p>
    </div>
</footer>

<script>
document.addEventListener('DOMContentLoaded', function() {
    function adjustFooter() {
        const footer = document.querySelector('.footer');
        const body = document.body;
        const html = document.documentElement;
        const documentHeight = Math.max(body.scrollHeight, body.offsetHeight, html.clientHeight, html.scrollHeight, html.offsetHeight);

        // If content height is less than viewport height, keep the footer at the bottom
        if (documentHeight < window.innerHeight) {
            footer.style.position = 'fixed';
            footer.style.bottom = '0';
        } else {
            footer.style.position = 'relative';
            footer.style.bottom = 'auto';
        }
    }

    window.addEventListener('resize', adjustFooter);
    window.addEventListener('load', adjustFooter);
});
</script>

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
      copyButton.textContent = "Copied";
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