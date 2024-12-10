<?php
session_start();
include('includes/header.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = new mysqli('localhost', 'root', '', 'resume_db');
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $education = $_POST['education'];
    $experience = $_POST['experience'];
    $skills = $_POST['skills'];

    $sql = "INSERT INTO users (username, password, name, email, phone, address, education, experience, skills)
            VALUES ('$username', '$password', '$name', '$email', '$phone', '$address', '$education', '$experience', '$skills')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful! <a href='login.php'>Login here</a>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<form method="POST">
    <h2>Register</h2>
    <label>Username</label>
    <input type="text" name="username" required>
    <label>Password</label>
    <input type="password" name="password" required>
    <label>Name</label>
    <input type="text" name="name" required>
    <label>Email</label>
    <input type="email" name="email" required>
    <label>Phone</label>
    <input type="text" name="phone" required>
    <label>Address</label>
    <textarea name="address" required></textarea>
    <label>Education</label>
    <textarea name="education" required></textarea>
    <label>Experience</label>
    <textarea name="experience" required></textarea>
    <label>Skills</label>
    <textarea name="skills" required></textarea>
    <button type="submit">Register</button>
</form>

<?php include('includes/footer.php'); ?>
