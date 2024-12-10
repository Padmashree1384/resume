<?php
session_start();
include('includes/header.php');
?>

<div class="hero">
    <h1>Welcome to the Resume App</h1>
    <p>Your platform for building and showcasing resumes.</p>
    <div class="btn-container">
        <a href="register.php" class="btn">Register</a>
        <a href="login.php" class="btn">Login</a>
    </div>
</div>

<?php include('includes/footer.php'); ?>
