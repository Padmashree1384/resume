<?php
session_start();
include('includes/header.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$conn = new mysqli('localhost', 'root', '', 'resume_db');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id = $user_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "<div class='container'><p>No resume found!</p></div>";
    include('includes/footer.php');
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resume</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        /* General Styles */
        body {
            font-family: 'Helvetica Neue', sans-serif;
            background-color: #e0e6ed;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1200px;
            margin: 40px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            padding: 40px;
        }

        /* Header */
        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            font-size: 36px;
            color: #2c3e50;
        }

        .header p {
            font-size: 18px;
            color: #7f8c8d;
            margin: 10px 0;
        }

        /* Profile Section */
        .profile-section {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
        }

        .profile-info {
            flex: 2;
            margin-right: 20px;
        }

        .profile-info h2 {
            font-size: 28px;
            color: #3498db;
            margin-bottom: 15px;
        }

        .profile-info p {
            font-size: 16px;
            color: #7f8c8d;
        }

        .contact-info {
            flex: 1;
            background: #ecf0f1;
            padding: 20px;
            border-radius: 8px;
        }

        .contact-info p {
            margin-bottom: 10px;
        }

        .contact-info strong {
            color: #3498db;
        }

        /* Sections */
        .section {
            margin-bottom: 40px;
        }

        .section h3 {
            font-size: 24px;
            color: #3498db;
            margin-bottom: 15px;
            border-bottom: 2px solid #3498db;
            padding-bottom: 5px;
        }

        .section ul {
            list-style-type: none;
            padding: 0;
        }

        .section ul li {
            margin-bottom: 10px;
            font-size: 16px;
            color: #34495e;
        }

        /* Footer */
        .footer {
            text-align: center;
            margin-top: 50px;
            font-size: 14px;
            color: #7f8c8d;
        }

        /* Responsive Design */
        @media screen and (max-width: 768px) {
            .profile-section {
                flex-direction: column;
                align-items: center;
            }

            .profile-info {
                margin-right: 0;
                margin-bottom: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <h1><?= htmlspecialchars($user['name']) ?></h1>
            <p><?= htmlspecialchars($user['email']) ?> | <?= htmlspecialchars($user['phone']) ?></p>
        </div>

        <!-- Profile Section -->
        <div class="profile-section">
            <div class="profile-info">
                <h2>Personal Information</h2>
                <p><strong>Address:</strong> <?= htmlspecialchars($user['address']) ?></p>
            </div>
            <div class="contact-info">
                <h3>Contact Details</h3>
                <p><strong>Email:</strong> <?= htmlspecialchars($user['email']) ?></p>
                <p><strong>Phone:</strong> <?= htmlspecialchars($user['phone']) ?></p>
            </div>
        </div>

        <!-- Education Section -->
        <div class="section">
            <h3>Education</h3>
            <p><?= nl2br(htmlspecialchars($user['education'])) ?></p>
        </div>

        <!-- Experience Section -->
        <div class="section">
            <h3>Experience</h3>
            <ul>
                <?php
                $experience = explode("\n", $user['experience']);
                foreach ($experience as $exp) {
                    echo "<li>" . htmlspecialchars(trim($exp)) . "</li>";
                }
                ?>
            </ul>
        </div>

        <!-- Skills Section -->
        <div class="section">
            <h3>Skills</h3>
            <ul>
                <?php
                $skills = explode(",", $user['skills']);
                foreach ($skills as $skill) {
                    echo "<li>" . htmlspecialchars(trim($skill)) . "</li>";
                }
                ?>
            </ul>
        </div>

        <!-- Additional Info Section -->
        <div class="section">
            <h3>Additional Information</h3>
            <p>Include any other details such as certifications, awards, hobbies, or personal projects.</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>&copy; 2024 Resume App. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
