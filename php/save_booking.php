<?php
// ============================================
// Save Tour Booking
// (only available for signed-in users)
// ============================================

session_start();
include 'db_connect.php';

// ----- Check if user is signed in -----
if (!isset($_SESSION['user_id'])) {
    echo "<h2>❌ Sign In Required</h2>";
    echo "<p>You must be <a href='../login.html'>signed in</a> to book a tour.</p>";
    echo "<p>Don't have an account? <a href='../register.html'>Register here</a>.</p>";
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $user_id          = $_SESSION['user_id'];
    $place            = $_POST['place'];
    $date             = $_POST['date'];
    $time             = $_POST['time'];
    $guests           = (int)$_POST['guests'];
    $special_requests = trim($_POST['special_requests'] ?? '');

    // ----- Validate -----
    if (empty($place) || empty($date) || empty($time) || $guests < 1) {
        echo "<h2>❌ Missing Information</h2>";
        echo "<p>Please fill in all required fields.</p>";
        echo "<a href='../booking.html'>← Go back</a>";
        exit;
    }

    // ----- Insert into database -----
    $stmt = $conn->prepare(
        "INSERT INTO bookings (user_id, place, date, time, guests, special_requests)
         VALUES (?, ?, ?, ?, ?, ?)"
    );
    $stmt->bind_param("isssis", $user_id, $place, $date, $time, $guests, $special_requests);

    if ($stmt->execute()) {
        echo "<h2>✅ Booking Confirmed!</h2>";
        echo "<p>Your tour to <strong>$place</strong> on <strong>$date at $time</strong> is confirmed.</p>";
        echo "<p>Guests: $guests</p>";
        echo "<p><a href='../index.html'>Home</a> | <a href='../booking.html'>Book another tour</a></p>";
    } else {
        echo "<h2>❌ Booking Failed</h2>";
        echo "<p>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $conn->close();
}
?>
