<?php
require_once "../config.php";

// Check if 'id' is set and not empty
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $table_id = intval($_GET['id']);
} else {
    header("Location: ../panel/table-panel.php");
    exit(); // Make sure to exit after redirect
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // User-provided input
    $provided_account_id = $_POST['admin_id']; // 99999
    $provided_password = $_POST['password']; // 12345
    $uniqueString = $provided_account_id . $provided_password;


    if ($uniqueString == "9999912345") {
        echo ' Correct';
        header("Location: ../tableCrud/deleteTable.php?id=".$table_id ."");
    } else {
        echo '<script>alert("Incorrect ID or Password!")</script>';
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link href="../css/verifyAdmin.css" rel="stylesheet" />
</head>
<body>
<div class="coffee-admin-container">
    <div class="coffee-admin-card">
        <div class="coffee-brand">
        </div>
        
        <div class="admin-verify-form">
            <h3><i class="fas fa-user-shield"></i> Admin Verification</h3>
            <p class="form-description">Elevated privileges required to proceed</p>
            
            <?php if(isset($error_message)): ?>
                <div class="alert alert-danger"><?php echo $error_message; ?></div>
            <?php endif; ?>

            <form action="" method="post">
                <div class="form-group">
                    <label><i class="fas fa-id-card"></i> Admin ID</label>
                    <input type="number" name="admin_id" class="form-control coffee-input" placeholder="Enter admin ID" required>
                </div>

                <div class="form-group">
                    <label><i class="fas fa-lock"></i> Password</label>
                    <input type="password" name="password" class="form-control coffee-input" placeholder="Enter admin password" required>
                </div>

                <div class="form-actions">
                    <button class="btn btn-coffee-danger" type="submit" name="submit">
                        <i class="fas fa-check-circle"></i> Confirm
                    </button>
                    <button type="button" class="btn btn-coffee-secondary" onclick="history.back()">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                </div>
            </form>
        </div>
        
        <div class="admin-footer">
            <p><i class="fas fa-exclamation-triangle"></i> Warning: This action cannot be undone</p>
        </div>
    </div>
</div>
</body>
</html>
