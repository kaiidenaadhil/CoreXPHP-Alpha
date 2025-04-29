<?php include_once "./components/header.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=5.0">
    <title>CorexPHP - Modern PHP Framework</title>
    <link rel="stylesheet" href="https://unicons.iconscout.com/release/v4.0.8/css/line.css">
    <style>
        /* CorexPHP Section Styles */
        .corex-section {
            --primary: #767e87;
            --secondary: #4f46e5;
            --bg: #ffffff;
            --text: #1f2937;
            --border: #e5e7eb;
            --radius: 12px;
            background: var(--bg);
            color: var(--text);
            line-height: 1.6;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
        }

        @media (prefers-color-scheme: dark) {
            .corex-section {
                --bg: #111827;
                --text: #f3f4f6;
                --border: #374151;
            }
        }

        .corex-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 4rem 1.5rem;
        }

        .corex-header {
            text-align: center;
            margin-bottom: 3rem;
        }

        .corex-title {
            font-size: clamp(2rem, 5vw, 2.5rem);
            margin-bottom: 1.5rem;
            color: var(--primary);
            position: relative;
        }

        .corex-title::after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background: var(--primary);
            margin: 1rem auto 0;
            border-radius: 2px;
        }

        .corex-download {
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 2.5rem;
            text-align: center;
            margin: 3rem 0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .corex-download:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
        }

        .corex-version {
            color: var(--secondary);
            font-weight: 600;
            margin-bottom: 0.75rem;
            font-size: clamp(1rem, 3vw, 1.25rem);
            letter-spacing: 0.5px;
        }

        .corex-cta {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            background: var(--primary);
            color: white;
            padding: 1rem 2rem;
            border-radius: 8px;
            text-decoration: none;
            margin-top: 1.5rem;
            transition: all 0.3s ease;
            font-size: clamp(1rem, 3vw, 1.1rem);
        }

        .corex-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
        }

        .corex-features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(min(300px, 100%), 1fr));
            gap: 2rem;
            margin: 4rem 0;
        }

        .corex-feature-item {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            padding: 1.5rem;
            border: 1px solid var(--border);
            border-radius: var(--radius);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            background: var(--bg);
        }

        .corex-feature-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .corex-feature-item i {
            font-size: 1.75rem;
            color: var(--primary);
            flex-shrink: 0;
            width: 50px;
            text-align: center;
        }

        .corex-support {
            display: flex;
            flex-wrap: wrap;
            gap: 1.25rem;
            justify-content: center;
            margin-top: 4rem;
        }

        .corex-support-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 1.5rem;
            border: 1px solid var(--border);
            border-radius: 8px;
            text-decoration: none;
            color: var(--text);
            transition: all 0.3s ease;
            background: var(--bg);
        }

        .corex-support-link:hover {
            background: rgba(79, 70, 229, 0.05);
            border-color: var(--secondary);
        }

        @media (max-width: 768px) {
            .corex-container {
                padding: 2rem 1rem;
            }

            .corex-download {
                padding: 1.5rem;
                margin: 2rem 0;
            }

            .corex-feature-item {
                flex-direction: column;
                text-align: center;
                padding: 1.5rem;
            }

            .corex-feature-item i {
                margin-bottom: 1rem;
            }

            .corex-support-link {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
</head>
<body>
    <!-- CorexPHP Section -->
    <section class="corex-section">
        <div class="corex-container">
            <div class="corex-header">
                <h1 class="corex-title">CorexPHP</h1>
                <b>A minimalist PHP framework for modern web development</b>
            </div>

            <div class="corex-download">
                <div class="corex-version">v1.0.0 - Released April 2025</div>
                <a href="download/CoreXPHP-1.0.0.zip" class="corex-cta">
                    <i class="uil uil-download-alt"></i>
                    Download CorexPHP
                </a>
            </div>

            <div class="corex-features">
                <a href="#" class="corex-feature-item">
                    <i class="uil uil-github"></i>
                    <div>
                        <h3>Contribute on GitHub</h3>
                        <p>Join our open-source community</p>
                    </div>
                </a>

                <a href="#" class="corex-feature-item">
                    <i class="uil uil-comment-alt"></i>
                    <div>
                        <h3>Join Discord Community</h3>
                        <p>Collaborate with other developers</p>
                    </div>
                </a>

                <a href="#" class="corex-feature-item">
                    <i class="uil uil-lightbulb"></i>
                    <div>
                        <h3>Suggest Features</h3>
                        <p>Help shape the framework's future</p>
                    </div>
                </a>
            </div>

            <div class="corex-support">
                <a href="#" class="corex-support-link">
                    <i class="uil uil-star"></i>
                    Star on GitHub
                </a>
                <a href="#" class="corex-support-link">
                    <i class="uil uil-share-alt"></i>
                    Share Project
                </a>
                <a href="#" class="corex-support-link">
                    <i class="uil uil-coffee"></i>
                    Buy Coffee
                </a>
            </div>
        </div>
    </section>
</body>
</html>
<?php include_once "./components/footer.php"; ?>