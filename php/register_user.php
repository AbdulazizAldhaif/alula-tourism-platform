<?php
// ============================================
// Register New User
// ============================================

include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Sanitize and collect input
    $name        = trim($_POST['name']);
    $user_id     = trim($_POST['user_id']);
    $dob         = $_POST['dob'];
    $nationality = $_POST['nationality'];
    $mobile      = trim($_POST['mobile']);
    $email       = trim($_POST['email']);
    $password    = $_POST['password'];

    // ----- Server-side validation -----
    $errors = [];

    if (empty($name) || strlen($name) < 3) {
        $errors[] = "Name is required and must be at least 3 characters.";
    }
    if (!preg_match('/^[0-9]{10}$/', $user_id)) {
        $errors[] = "ID must be exactly 10 digits.";
    }
    if (empty($dob)) {
        $errors[] = "Date of birth is required.";
    }
    if (empty($nationality)) {
        $errors[] = "Nationality is required.";
    }
    if (!preg_match('/^05[0-9]{8}$/', $mobile)) {
        $errors[] = "Mobile must start with 05 and be 10 digits.";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Email is not valid.";
    }
    if (strlen($password) < 6) {
        $errors[] = "Password must be at least 6 characters.";
    }

    // ----- Display errors if any -----
    if (!empty($errors)) {
        echo "<h2>Registration Errors</h2>";
        echo "<ul>";
        foreach ($errors as $error) {
            echo "<li>$error</li>";
        }
        echo "</ul>";
        echo "<a href='../register.html'>← Go back</a>";
        exit;
    }

    // ----- Check if email already exists -----
    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();
    if ($check->num_rows > 0) {
        echo "<h2>Email Already Registered</h2>";
        echo "<p>This email is already in use. Please <a href='../login.html'>sign in</a> instead.</p>";
        $check->close();
        $conn->close();
        exit;
    }
    $check->close();

    // ----- Hash password and insert user -----
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $stmt = $conn->prepare(
        "INSERT INTO users (name, user_id, dob, nationality, mobile, email, password)
         VALUES (?, ?, ?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("sssssss", $name, $user_id, $dob, $nationality, $mobile, $email, $hashed_password);

    if ($stmt->execute()) {
        echo "<h2>✅ Registration Successful!</h2>";
        echo "<p>Welcome, $name! You can now <a href='../login.html'>sign in</a>.</p>";
    } else {
        echo "<h2>❌ Registration Failed</h2>";
        echo "<p>Error: " . $stmt->error . "</p>";
        echo "<a href='../register.html'>← Try again</a>";
    }

    $stmt->close();
    $conn->close();
}
?>
