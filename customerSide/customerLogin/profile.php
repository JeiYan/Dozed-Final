<?php
// Include your database connection code here
require_once '../config.php';

// Check if the user is logged in
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php'); // Redirect to the login page if not logged in
    exit;
}

// Fetch the user's profile information
$user_id = $_SESSION['account_id'];

$query = "SELECT m.member_name, m.points, a.email, a.phone_number, a.register_date
          FROM Memberships AS m
          INNER JOIN Accounts AS a ON m.account_id = a.account_id
          WHERE m.account_id = ?";

$stmt = $link->prepare($query);
$stmt->bind_param('i', $user_id);

if ($stmt->execute()) {
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
} else {
    echo 'Error: ' . $stmt->error;
    exit;
}

// Close the database connection
$stmt->close();
$link->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile - Dozed</title>
    <link rel="icon" type="image/x-icon" href="../image/logo.png">
    <style>
        /* Base Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f5f0e6; /* Warm off-white background */
            color: #3e2c23; /* Dark brown text */
            line-height: 1.6;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
        }

        .profile-container {
            background-color: #fffaf5; /* Very light cream */
            border-radius: 12px;
            max-width: 500px;
            width: 100%;
            padding: 30px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .profile-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .profile-header h2 {
            font-size: 2em;
            color: #6d4c41; /* Coffee brown */
            margin-bottom: 10px;
        }

        .profile-header p {
            font-size: 1em;
            color: #7a5c58;
        }

        .profile-info {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .profile-info div {
            padding: 10px 15px;
            background-color: #efebe9; /* Light coffee cream */
            border-left: 4px solid #a1887f; /* Accent color */
            border-radius: 6px;
        }

        .profile-info strong {
            color: #4e342e; /* Deep brown */
        }

        .logout-btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #6d4c41;
            color: #fff;
            text-decoration: none;
            border-radius: 6px;
            text-align: center;
            transition: background-color 0.3s ease;
        }

        .logout-btn:hover {
            background-color: #5d4037;
        }

        /* Cancel Button */
        .btn-cancel {
            display: inline-block;
            padding: 10px 20px;
            background-color: #a1887f; /* Light coffee brown */
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            transition: background-color 0.3s ease;
            margin-top: 20px;
        }

        .btn-cancel:hover {
            background-color: #9e7c71; /* Slightly darker hover state */
        }

        .button-container {
            display: flex;
            justify-content: space-between; /* Align buttons to left and right */
            margin-top: 20px;
        }

        /* Reset Password Button */
        .reset-btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #6d4c41; /* Coffee brown */
            color: white;
            text-decoration: none;
            border-radius: 6px;
            font-weight: bold;
            transition: background-color 0.3s ease;
            margin-top: 20px;
            width: 100%; /* Full width for mobile responsiveness */
        }

        .reset-btn:hover {
            background-color: #5d4037; /* Slightly darker hover state */
        }

    </style>
</head>
<body>

<div class="profile-container">
    <div class="profile-header">
        <h2>☕ Your Profile</h2>
        <p>Welcome back, <?php echo htmlspecialchars($row['member_name']); ?></p>
    </div>

    <div class="profile-info">
        <div><strong>Email:</strong> <?php echo htmlspecialchars($row['email']); ?></div>
        <div><strong>Phone:</strong> <?php echo htmlspecialchars($row['phone_number']); ?></div>
        <div><strong>Points:</strong> <?php echo htmlspecialchars($row['points']); ?></div>
        <div><strong>Member Since:</strong> <?php echo date("F j, Y", strtotime($row['register_date'])); ?></div>

        <!-- Reset Password Button -->
        <a href="/dozed/customerSide/customerLogin/reset-password.php" class="reset-btn">Reset Password</a>
    </div>

    <!-- Buttons Container -->
    <div class="button-container">
        <a href="logout.php" class="logout-btn">Logout</a>
        <a href="/dozed/customerSide/home/home.php" class="btn-cancel">Cancel</a>
    </div>
</div>

</body>
</html>