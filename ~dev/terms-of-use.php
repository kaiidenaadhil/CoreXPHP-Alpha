<?php include_once "./components/header.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Legal - CorexPHP</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <style>
        /* Legal Page Styles */
        .corex-legal-section {
            --primary: #767e87;
            --secondary: #4f46e5;
            --bg: #ffffff;
            --text: #1f2937;
            --border: #e5e7eb;
            --radius: 12px;
            background: var(--bg);
            color: var(--text);
            line-height: 1.7;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        @media (prefers-color-scheme: dark) {
            .corex-legal-section {
                --bg: #111827;
                --text: #f3f4f6;
                --border: #374151;
            }
        }

        .corex-legal-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 4rem 1.5rem;
        }

        .corex-legal-header {
            text-align: center;
            margin-bottom: 4rem;
        }

        .corex-legal-title {
            font-size: clamp(2rem, 5vw, 2.5rem);
            color: var(--primary);
            margin-bottom: 1.5rem;
            position: relative;
        }

        .corex-legal-title::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background: var(--primary);
            margin: 1rem auto 0;
            border-radius: 2px;
        }

        .corex-legal-content {
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 3rem;
            margin: 2rem 0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .corex-legal-content h2 {
            color: var(--primary);
            margin: 2rem 0 1rem;
            font-size: 1.5rem;
        }

        .corex-legal-content h3 {
            margin: 1.5rem 0 0.5rem;
            font-size: 1.2rem;
        }

        .corex-legal-content ul {
            padding-left: 1.5rem;
            margin: 1rem 0;
        }

        .corex-legal-contact {
            text-align: center;
            margin-top: 3rem;
            padding: 2rem;
            border-top: 1px solid var(--border);
        }

        @media (max-width: 768px) {
            .corex-legal-container {
                padding: 2rem 1rem;
            }

            .corex-legal-content {
                padding: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <section class="corex-legal-section">
        <div class="corex-legal-container">
            <!-- Terms of Use -->
            <div class="corex-legal-header">
                <h1 class="corex-legal-title">Terms of Use</h1>
                <p>Effective: 7 April 2025 • In loving memory of our founder's father</p>
            </div>

            <div class="corex-legal-content">
                <h2>1. Acceptance of Terms</h2>
                <p>By accessing or using CorexPHP (available at www.avantvista.com/~dev), you agree to these terms. CorexPHP is a PHP framework developed by Avant Vista Ventures following MVC architecture.</p>

                <h2>2. License & Usage</h2>
                <h3>Open Source Commercial Use</h3>
                <ul>
                    <li>Free for personal and commercial projects</li>
                    <li>Attribution appreciated but not required</li>
                    <li>No redistribution as commercial product without consent</li>
                </ul>

                <h2>3. Prohibited Uses</h2>
                <p>You agree not to use CorexPHP for:</p>
                <ul>
                    <li>Pornography or adult content platforms</li>
                    <li>Gambling or betting systems</li>
                    <li>Any activity prohibited under Islamic ethics</li>
                    <li>Illegal or harmful purposes</li>
                </ul>

                <h2>4. Warranty & Liability</h2>
                <p>Provided "AS IS" without warranties. Lifetime compatibility warranty with PHP versions current at time of release.</p>
            </div>

            
            <div class="corex-legal-contact">
                <h3>Contact Us</h3>
                <p>
                    <i class="uil uil-envelope"></i>
                    <a href="mailto:support@avantvista.com">support@avantvista.com</a>
                </p>
                <p>Avant Vista Ventures • www.avantvista.com/~dev</p>
            </div>
        </div>
    </section>
</body>
</html>
<?php include_once "./components/footer.php"; ?>