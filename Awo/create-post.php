<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Create a new post with title, description, images, and full text.">
    <meta name="keywords" content="create post, blog, content creation">
    <meta name="author" content="Your Name">
    <title>Create Post</title>
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
            color: #333;
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

        /* Create Post Form */
        .post {
            text-align: center;
            margin: 20px 0;
            color: #003366;
        }

        .create-post-form {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
            color: #003366;
        }

        .form-group input[type="text"],
        .form-group textarea,
        .form-group input[type="file"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .form-group textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-group input[type="file"] {
            padding: 5px;
        }

        .form-group .file-hint {
            font-size: 14px;
            color: #666;
            margin-top: 5px;
        }

        .post-button {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #003366;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .post-button:hover {
            background-color: #002244;
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
        }
    </style>
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

    <h1 class="post">Create a New Post</h1>
    <form class="create-post-form">
        <!-- Title -->
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" placeholder="Enter post title" required>
        </div>

        <!-- Short Description -->
        <div class="form-group">
            <label for="short-description">Short Description (Max 500 characters)</label>
            <textarea id="short-description" name="short-description" maxlength="500"
                placeholder="Enter a short description" required></textarea>
        </div>

        <!-- Cover Image -->
        <div class="form-group">
            <label for="cover-image">Cover Image (200x200)</label>
            <input type="file" id="cover-image" name="cover-image" accept="image/*" required>
            <p class="file-hint">Upload a square image with dimensions 200x200 pixels.</p>
        </div>

        <!-- Main Image -->
        <div class="form-group">
            <label for="main-image">Main Image</label>
            <input type="file" id="main-image" name="main-image" accept="image/*" required>
        </div>

        <!-- Full Text -->
        <div class="form-group">
            <label for="full-text">Full Text</label>
            <textarea id="full-text" name="full-text" placeholder="Write your full post here" required></textarea>
        </div>

        <!-- Post Button -->
        <button type="submit" class="post-button">Post</button>
    </form>

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