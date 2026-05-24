<?php
// ============================================
// Save User Feedback
// ============================================

include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name    = trim($_POST['name']);
    $email   = trim($_POST['email']);
    $rating  = (int)$_POST['rating'];
    $message = trim($_POST['message']);

    // ----- Validate -----
    if (empty($name) || empty($email) || empty($message) || $rating < 1 || $rating > 5) {
        echo "<h2>❌ Missing or Invalid Information</h2>";
        echo "<p>Please fill in all required fields.</p>";
        echo "<a href='../feedback.html'>← Go back</a>";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<h2>❌ Invalid Email</h2>";
        echo "<a href='../feedback.html'>← Go back</a>";
        exit;
    }

    if (strlen($message) < 10) {
        echo "<h2>❌ Message Too Short</h2>";
        echo "<p>Feedback must be at least 10 characters.</p>";
        echo "<a href='../feedback.html'>← Go back</a>";
        exit;
    }

    // ----- Insert into database -----
    $stmt = $conn->prepare(
        "INSERT INTO feedback (name, email, rating, message)
         VALUES (?, ?, ?, ?)"
    );
    $stmt->bind_param("ssis", $name, $email, $rating, $message);

    if ($stmt->execute()) {
        echo "<h2>✅ Thank You for Your Feedback!</h2>";
        echo "<p>Your feedback has been submitted successfully.</p>";
        echo "<p><a href='../feedback.html'>← View all feedback</a></p>";
    } else {
        echo "<h2>❌ Submission Failed</h2>";
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $conn->close();
}
?>
