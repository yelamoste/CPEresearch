<?php
require "../php/functions.php";

$conn = db_connect();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ensure form fields are set
    if (!isset($_POST["token"]) || !isset($_POST["NewPass"]) || !isset($_POST["ConfirmPass"])) {
        echo "All fields are required.";
        exit;
    }

    $token = $_POST["token"];
    $newPassword = $_POST["NewPass"];
    $confirmPassword = $_POST["ConfirmPass"];

    // Validate token
    $token_hash = hash("sha256", $token);

    $sql = "SELECT * FROM student WHERE reset_token_hash = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $token_hash);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user === null) {
        echo "Token not found.";
        exit;
    }

    // Check token expiry
    if (strtotime($user["reset_token_expires_at"]) <= time()) {
        echo "Token has expired.";
        exit;
    }

    // Validate new password
    if (strlen($newPassword) < 8) {
        echo "Password must be at least 8 characters.";
        exit;
    }

    if (!preg_match("/[a-z]/i", $newPassword)) {
        echo "Password must contain at least one letter.";
        exit;
    }

    if (!preg_match("/[0-9]/", $newPassword)) {
        echo "Password must contain at least one number.";
        exit;
    }

    if ($newPassword !== $confirmPassword) {
        echo "Passwords must match.";
        exit;
    }

    // Hash the new password
    $password_hash = password_hash($newPassword, PASSWORD_DEFAULT);

    // Update the user's password in the database
    $sql = "UPDATE student SET password = ?, reset_token_hash = NULL, reset_token_expires_at = NULL WHERE studentid = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $password_hash, $user["studentid"]);
    $stmt->execute();

    if ($stmt->affected_rows === 1) {
        // echo "Password updated. You can now login.";
        // header("../index.php");
        echo "<script>alert('Password updated. You can now login.'); window.location.href='../index.php';</script>";
        exit;
    } else {
        echo "Failed to update password.";
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
