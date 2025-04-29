<?php include_once "./components/header.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help & Support - CorexPHP</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <style>
        /* Help & Support Styles */
        .corex-support-section {
            --primary: #767e87;
            --secondary: #4f46e5;
            --bg: #ffffff;
            --text: #1f2937;
            --border: #e5e7eb;
            background: var(--bg);
            color: var(--text);
            line-height: 1.6;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        @media (prefers-color-scheme: dark) {
            .corex-support-section {
                --bg: #111827;
                --text: #f3f4f6;
                --border: #374151;
            }
        }

        .corex-support-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 4rem 1.5rem;
        }

        .corex-support-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .corex-support-title {
            font-size: clamp(2rem, 5vw, 2.5rem);
            margin-bottom: 1rem;
            color: var(--primary);
            position: relative;
        }

        .corex-support-title::after {
            content: '';
            display: block;
            width: 50px;
            height: 3px;
            background: var(--primary);
            margin: 1rem auto 0;
            border-radius: 2px;
        }

        .corex-support-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin: 3rem 0;
        }

        .corex-support-card {
            padding: 2rem;
            border: 1px solid var(--border);
            border-radius: 12px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: var(--bg);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .corex-support-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .corex-support-card i {
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 1rem;
            transition: color 0.3s ease;
        }

        /* Enhanced FAQ Accordion */
        .corex-faq-section {
            margin-top: 4rem;
        }

        .corex-faq-item {
            border: 1px solid var(--border);
            border-radius: 8px;
            margin-bottom: 1rem;
            overflow: hidden;
        }

        .corex-faq-header {
            padding: 1.5rem;
            cursor: pointer;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: var(--bg);
            transition: background 0.2s ease;
        }

        .corex-faq-header:hover {
            background: rgba(0, 0, 0, 0.03);
        }

        .corex-faq-header.active {
            background: rgba(79, 70, 229, 0.05);
            color:#767e87;
        }

        .corex-faq-content {
            max-height: 0;
            overflow: hidden;
            transition: all 0.3s ease;
            padding: 0 1.5rem;
        }

        .corex-faq-content p {
            padding: 1rem 0;
        }

        .corex-faq-toggle {
            transition: transform 0.3s ease;
        }

        .corex-faq-header.active .corex-faq-toggle {
            transform: rotate(180deg);
        }

        /* Polished Email Section */
        .corex-contact-options {
            margin-top: 3rem;
            text-align: center;
            padding: 2rem;
            border: 1px solid var(--border);
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .corex-contact-options:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .corex-contact-options i {
            font-size: 1.5rem;
            margin-right: 0.5rem;
            color: var(--primary);
        }
        .corex-support-links{
            padding:1rem;
        }
        .corex-support-link{
            padding:0.5rem;
        }
        @media (max-width: 768px) {
            .corex-support-container {
                padding: 2rem 1rem;
            }

            .corex-support-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .corex-faq-header {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>



    <section class="corex-support-section">
        <div class="corex-support-container">
            <div class="corex-support-header">
                <h1 class="corex-support-title">Help & Support</h1>
                <p style="text-align:center">Get assistance with CorexPHP through our resources and community</p>
            </div>

            <div class="corex-support-grid">
                <div class="corex-support-card">
                    <i class="uil uil-book-open"></i>
                    <h3>Documentation</h3>
                    <p>Comprehensive guides and API references for getting started</p>
                    <a href="#" class="corex-cta">View Docs</a>
                </div>

                <div class="corex-support-card">
                    <i class="uil uil-question-circle"></i>
                    <h3>FAQs</h3>
                    <p>Find answers to common questions and troubleshooting</p>
                    <a href="#faq" class="corex-cta">Browse FAQs</a>
                </div>

                <div class="corex-support-card">
                    <i class="uil uil-users-alt"></i>
                    <h3>Community Support</h3>
                    <p>Connect with other developers in our community forums</p>
                    <a href="#" class="corex-cta">Join Community</a>
                </div>
            </div>

            <!-- Enhanced Email Support -->
            <div class="corex-contact-options">
                <div class="corex-contact-card">
                    <h3><i class="uil uil-envelope"></i>Email Support</h3>
                    <b style="margin: 1rem 0;">
                        <a href="mailto:support@corexphp.com" style="color: var(--primary);">
                            support@corexphp.com
                        </a>
    </b>
                    <small style="display: block; color: var(--text); opacity: 0.8;">
                        <i class="uil uil-clock"></i>
                        Typical response time: 24-48 hours
                    </small>
                </div>
            </div>

            <!-- Enhanced FAQ Section -->
            <div class="corex-faq-section" id="faq">
                <h2 style="margin-bottom: 2rem;">Frequently Asked Questions</h2>

                <div class="corex-faq-item">
                    <div class="corex-faq-header">
                        <h3>How do I install CorexPHP?</h3>
                        <i class="uil uil-angle-down corex-faq-toggle"></i>
                    </div>
                    <div class="corex-faq-content">
                        <p>Use Composer: <code>composer create-project corexphp/starter-project</code></p>
                    </div>
                </div>

                <div class="corex-faq-item">
                    <div class="corex-faq-header">
                        <h3>What are the system requirements?</h3>
                        <i class="uil uil-angle-down corex-faq-toggle"></i>
                    </div>
                    <div class="corex-faq-content">
                        <p>PHP 8.1+, MySQL 5.7+ or PostgreSQL 10+, 2GB RAM minimum</p>
                    </div>
                </div>

                <div class="corex-faq-item">
                    <div class="corex-faq-header">
                        <h3>Where can I report bugs?</h3>
                        <i class="uil uil-angle-down corex-faq-toggle"></i>
                    </div>
                    <div class="corex-faq-content">
                        <p>Submit issues through our GitHub repository's issue tracker</p>
                    </div>
                </div>
            </div>

            <!-- Community Support -->
            <div class="corex-support-links">
                <h2>Community Support</h2>
                <div class="corex-support">
                    <a href="#" class="corex-support-link">
                        <i class="uil uil-github"></i>
                        GitHub Discussions
                    </a>
                    <a href="#" class="corex-support-link">
                        <i class="uil uil-discord"></i>
                        Join Discord
                    </a>
                    <a href="#" class="corex-support-link">
                        <i class="uil uil-lightbulb"></i>
                        Feature Requests
                    </a>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Accordion functionality
        document.querySelectorAll('.corex-faq-header').forEach(header => {
            header.addEventListener('click', () => {
                const activeHeader = document.querySelector('.corex-faq-header.active');
                if(activeHeader && activeHeader !== header) {
                    activeHeader.classList.remove('active');
                    activeHeader.nextElementSibling.style.maxHeight = null;
                }

                header.classList.toggle('active');
                const content = header.nextElementSibling;
                if(header.classList.contains('active')) {
                    content.style.maxHeight = content.scrollHeight + 'px';
                } else {
                    content.style.maxHeight = null;
                }
            });
        });
    </script>
</body>
</html>
<?php include_once "./components/footer.php"; ?>