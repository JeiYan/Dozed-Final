<?php 
session_start();
if(isset($_SESSION['logged_account_id'])) {
    header("Location: ../panel/pos-panel.php");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" type="image/x-icon" href="../image/logo.png">
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500&family=Montserrat:wght@400;600&display=swap');

    body {
        font-family: 'Montserrat', sans-serif;
        background-color:rgb(48, 30, 13); /* light cream */
        color: #4E342E; /* deep brown text */
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        background-image: url('../image/bg_2.jpg');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }

    .login-container {
        width: 100%;
        max-width: 420px;
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .wrapper {
        width: 100%;
        padding: 30px;
        background-color: #fff3e0; /* warm latte */
        border-radius: 12px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        border: 1px solid #e0cfc1;
    }

    .logo-container {
        margin-bottom: 30px;
        text-align: center;
        width: 100%;
    }

    .logo {
        font-family: 'Copperplate', serif;
        font-size: 32px;
        color: #4E342E;
        text-shadow: 2px 2px 4px rgba(0,0,0,0.2);
        border: 2px solid #D7CCC8;
        padding: 15px 40px;
        border-radius: 8px;
        background-color: #EFEBE9;
        display: inline-block;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        margin-bottom: 20px;
    }

    h2 {
        text-align: center;
        font-family: 'Playfair Display', serif;
        color: #6B4F32;
        font-size: 24px;
        margin-bottom: 20px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .btn-light {
        background-color: #8D6E63;
        color: white;
        width: 100%;
        padding: 10px;
        border: none;
    }

    .btn-light:hover {
        background-color: #6D4C41;
        color: white;
    }
</style>
</head>
<body>
    <div class="login-container">
        <div class="logo-container">
            <a class="nav-link" href="../../customerSide/home/home.php">
                <div class="logo">DOZED'S</div>
            </a>
        </div>
        
        <div class="wrapper">
            <?php 
            if(!empty($login_err)){
                echo '<div class="alert alert-danger">' . $login_err . '</div>';
            }        
            ?>

            <form action="login_process.php" method="post">
                <h2>Staff Login</h2>
                <div class="form-group">
                    <label for="account_id">Staff Account ID</label>
                    <input type="number" id="account_id" name="account_id" placeholder="Enter Account ID" required class="form-control <?php echo (!empty($account_id)) ? 'is-invalid' : ''; ?>" value="<?php echo $account_id; ?>">
                    <span class="invalid-feedback"><?php echo $account_id; ?></span>
                </div>
                
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" placeholder="Enter Password" required class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>">
                </div>
                
                <div class="form-group">
                    <button class="btn btn-light" type="submit" name="submit" value="Login">Login</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>