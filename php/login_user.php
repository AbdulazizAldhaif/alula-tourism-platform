<?php
// ============================================
// User Login
// ============================================

session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    // Validate input
    if (empty($email) || empty($password)) {
        echo "<h2>❌ Missing Information</h2>";
        echo "<p>Please enter both email and password.</p>";
        echo "<a href='../login.html'>← Go back</a>";
        exit;
    }

    // ----- Check if user exists -----
    $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows === 0) {
        echo "<h2>❌ User Not Found</h2>";
        echo "<p>This email is not registered. Please <a href='../register.html'>register first</a>.</p>";
        $stmt->close();
        $conn->close();
        exit;
    }

    // ----- Verify password -----
    $stmt->bind_result($id, $name, $hashed_password);
    $stmt->fetch();

    if (password_verify($password, $hashed_password)) {
        // Login success — store session
        $_SESSION['user_id']   = $id;
        $_SESSION['user_name'] = $name;
        $_SESSION['email']     = $email;

        echo "<h2>✅ Welcome back, $name!</h2>";
        echo "<p>You are now signed in.</p>";
        echo "<p><a href='../index.html'>Go to Home</a> | <a href='../booking.html'>Book a Tour</a></p>";
    } else {
        echo "<h2>❌ Wrong Password</h2>";
        echo "<p>The password you entered is incorrect.</p>";
        echo "<a href='../login.html'>← Try again</a>";
    }

    $stmt->close();
    $conn->close();
}
?>
