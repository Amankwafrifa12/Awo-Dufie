<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="Awo Dufie - Human rights activist and researcher committed to advocating for justice, equality, and freedom worldwide. Explore projects, services, and research portfolio.">
    <meta name="keywords" content="Awo Dufie, human rights, advocacy, equality, research, portfolio, activism">
    <meta name="author" content="Awo Dufie">
    <meta property="og:title" content="Awo Dufie - Activist & Researcher">
    <meta property="og:description"
        content="Explore Awo Dufie's projects, services, and research portfolio. Dedicated to advocating for justice, equality, and freedom worldwide.">
    <meta property="og:image" content="img/awo-dufie.jpg">
    <meta property="og:url" content="https://awodufie.com">
    <meta property="og:type" content="website">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <title>Awo Dufie - Writings</title>
    <style>
        /* General Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f9f9f9;
            color: #333333;
        }

        /* Header Styling */
        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #003366;
            color: #ffffff;
            padding: 1rem 2rem;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .logo h1 {
            font-size: 1.5rem;
        }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 1.5rem;
        }

        .nav-links li a {
            color: #f0f0f0;
            text-decoration: none;
            font-size: 1rem;
            transition: color 0.3s;
        }

        .nav-links li a:hover {
            color: #6699cc;
        }

        .hamburger {
            display: none;
            flex-direction: column;
            gap: 5px;
            cursor: pointer;
        }

        .hamburger span {
            display: block;
            width: 25px;
            height: 3px;
            background-color: #ffffff;
        }

        /* Blog Section Styling */
        .blogs-section {
            padding: 2rem;
            background-color: #ffffff;
            color: #003366;
        }

        .blogs-section h2 {
            margin-bottom: 1.5rem;
            font-size: 2rem;
            text-align: center;
        }

        .blogs-container {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
        }

        .blog-card {
            display: flex;
            flex: 1 1 100%;
            background-color: #f0f8ff;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
            overflow: hidden;
            transition: transform 0.3s;
        }

        .blog-card:hover {
            transform: scale(1.02);
        }

        .blog-image {
            flex: 1 1 30%;
            max-width: 30%;
        }

        .blog-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .blog-details {
            flex: 1 1 70%;
            padding: 1rem;
        }

        .blog-details h3 {
            margin-bottom: 0.5rem;
            font-size: 1.25rem;
        }

        .blog-details p {
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }

        .blog-details .meta {
            font-size: 0.8rem;
            color: #666666;
            margin-bottom: 0.5rem;
        }

        .blog-details a {
            color: #003366;
            text-decoration: none;
            font-weight: bold;
        }

        @media (max-width: 768px) {
            .nav-links {
                display: none;
                flex-direction: column;
                position: absolute;
                top: 100%;
                left: 0;
                text-align: center;
                background-color: #003366;
                width: 100%;
                padding: 1rem 0;
            }

            .nav-links.active {
                display: flex;
            }

            .hamburger {
                display: flex;
            }

            .blog-card {
                flex-direction: column;
            }

            .blog-image {
                flex: 1 1 100%;
                max-width: 100%;
            }

            .blog-details {
                flex: 1 1 100%;
            }

        }
    </style>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</head>

<body>
    <!-- Header -->
    <header>
        <div class="logo">
            <a href="index.html" style="text-decoration: none; color: white;">
                <h1>Awo Dufie</h1>
            </a>
        </div>
        <nav>
            <ul id="nav-links" class="nav-links">
                <li><a href="index.html#about">About</a></li>
                <li><a href="index.html#projects">Projects</a></li>
                <li><a href="index.html#research">Research</a></li>
                <li><a href="curation.html#curation">Curation</a></li>
                <li><a href="assets/resume.pdf" target="_blank">CV</a></li>
                <li><a href="index.html#contact">Contact</a></li>
            </ul>
            <div class="hamburger" id="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </nav>
    </header>

    <!-- Blogs Section -->
    <section id="blogs" class="blogs-section">

        <div class="blogs-container">
            <!-- Blog Card 1 -->
            <?php

            include 'includes/db.php';
            $stmt = $conn->query("SELECT * FROM posts ORDER BY created_at DESC");
            while ($post = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="blog-card">';
                echo "<div class='blog-image'>";
                if (!empty($post['image_url'])) {
                    echo "<img src='" . htmlspecialchars($post[' image_url']) . "' alt='" .
                        htmlspecialchars($post['title']) . ">";
                }
                echo '</div>';
                echo "<div class='blog-details'>";
                echo "<h3><a href='single-post.php?id=" . $post[' id'] . "'>" . htmlspecialchars($post['title'])
                    . "</a></h3>";
                echo "<p>" . htmlspecialchars(substr($post['content'], 0, 500))
                    . "...</p>";
                echo "<div class='meta'>Published on " . htmlspecialchars($post['created_at']) . " by " . $post['author'] . "</div>";

                echo '</div>';
            }
            ?>
        </div>


    </section>

    <!-- Footer -->
    <footer style="background-color: #003366; color: #ffffff; text-align: center; padding: 1rem 0; margin-top: 2rem;">
        <p>&copy; 2024 Awo Dufie. All rights reserved. | Designed by: GenieDev +233592725542</p>
    </footer>

    <script>
        const hamburger = document.getElementById('hamburger');
        const navLinks = document.getElementById('nav-links');
        const links = navLinks.querySelectorAll('li a'); // Select all navigation links

        hamburger.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });

        // Close the hamburger menu when a nav link is clicked
        links.forEach(link => {
            link.addEventListener('click', () => {
                navLinks.classList.remove('active'); // Remove the active class to close the menu
            });
        });
    </script>
</body>

</html>