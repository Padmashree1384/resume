<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume App</title>
    <link rel="stylesheet" href="/resume_app/assets/css/style.css">
</head>
<body>
    <header class="header">
        <div class="container">
            <div class="logo">
                <a href="/resume_app/index.php">Resume App</a>
            </div>
            <nav class="nav-links">
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a href="/resume_app/resume.php">View Resume</a>
                    <a href="/resume_app/logout.php">Logout</a>
                <?php else: ?>
                    <a href="/resume_app/login.php">Login</a>
                    <a href="/resume_app/register.php">Register</a>
                <?php endif; ?>
            </nav>
        </div>
    </header>
