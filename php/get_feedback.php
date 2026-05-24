<?php
// ============================================
// Display All Feedback
// (Include this in feedback.html when using PHP rendering)
// ============================================

include 'db_connect.php';

$result = $conn->query("SELECT name, rating, message, created_at FROM feedback ORDER BY created_at DESC");

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $stars = str_repeat("⭐", $row['rating']);
        $name  = htmlspecialchars($row['name']);
        $msg   = htmlspecialchars($row['message']);
        $date  = date('Y-m-d', strtotime($row['created_at']));

        echo "<div class='feedback-item'>";
        echo "<div class='stars'>$stars</div>";
        echo "<p>\"$msg\"</p>";
        echo "<p><span class='author'>— $name</span> <span class='date'>| $date</span></p>";
        echo "</div>";
    }
} else {
    echo "<p>No feedback yet. Be the first to share your experience!</p>";
}

$conn->close();
?>
