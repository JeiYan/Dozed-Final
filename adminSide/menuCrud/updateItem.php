<?php
session_start(); // Ensure session is started
?>
<?php
// Include config file
require_once "../config.php";

// Initialize variables for form validation and item data
$item_id = $item_name = $item_type = $item_category = $item_price = $item_description = "";
$item_id_err = "";

// Check if item_id is provided in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $item_id = $_GET['id'];

    // Retrieve item details based on item_id
    $sql = "SELECT * FROM Menu WHERE item_id = ?";
    
    if ($stmt = mysqli_prepare($link, $sql)) {
        mysqli_stmt_bind_param($stmt, "s", $param_item_id);
        $param_item_id = $item_id;
        
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $item_name = $row['item_name'];
                $item_type = $row['item_type'];
                $item_category = $row['item_category'];
                $item_price = $row['item_price'];
                $item_description = $row['item_description'];
            } else {
                echo "Item not found.";
                exit();
            }
        } else {
            echo "Error retrieving item details.";
            exit();
        }
     
    }
}

// Process form submission when the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
   // echo "Received POST data: <pre>";
//print_r($_POST);
//echo "</pre>";
    // Validate and sanitize input
    $item_name = trim($_POST["item_name"]);
    $item_type = trim($_POST["item_type"]);
    $item_category = trim($_POST["item_category"]);
    $item_price = floatval($_POST["item_price"]); // Convert to float
    $item_description = $_POST["item_description"];

    // Update the item in the database
    $update_sql = "UPDATE Menu SET item_name='$item_name', item_type='$item_type', item_category='$item_category', item_price='$item_price', item_description='$item_description' WHERE item_id='$item_id'";
    $resultItems = mysqli_query($link, $update_sql);
    
        if ($resultItems) {
            // Item updated successfully
          
           header("Location: ../panel/menu-panel.php");
           echo 'success';
            exit();
        } else {
            echo "Error updating item: ";
        }

       
    }
    
    /*
     $result_tables = mysqli_query($link, $select_query_tables);
                                $resultCheckTables = mysqli_num_rows($result_tables);
                                if ($resultCheckTables > 0) {
                                    while ($row = mysqli_fetch_assoc($result_tables)) {
                                        echo '<option value="' . $row['table_id'] . '">For ' . $row['capacity'] . ' people. (Table Id: ' . $row['table_id'] . ')</option>';
                                    }
                                }  else {
                                    echo '<option disabled>No tables available, please choose another time.</option>';
                                    echo '<script>alert("No reservation tables found for the selected time. Please choose another time.");</script>';
                                }
     */

    // Close the database connection
    

?>

<!-- Create your HTML form for updating the item details -->
<<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">  
    <title>Update Item</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #4e342e;
            background-image: linear-gradient(rgba(78, 52, 46, 0.85), rgba(78, 52, 46, 0.85)),
            url('/dozed/adminSide/image/loginBackground.jpg');  
            background-size: cover;
            background-position: center;
            color: #3e2723;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .login-container {
            width: 100%;
            max-width: 500px;
            padding: 40px;
            background-color: rgba(255, 255, 255, 0.95);
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            color: #5D4037;
            font-weight: bold;
        }

        h5 {
            text-align: center;
            color: #795548;
            margin-bottom: 25px;
        }

        .form-group label {
            font-weight: 600;
        }

        .form-control {
            border: 1px solid #D7CCC8;
            border-radius: 5px;
        }

        .form-control:focus {
            border-color: #8D6E63;
            box-shadow: 0 0 0 0.2rem rgba(141, 110, 99, 0.25);
        }

        .btn-coffee {
            background-color: #4CAF50;  /* Green color */
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: 0.3s;
        }

        .btn-coffee:hover {
            background-color: #D84315;
            transform: translateY(-2px);
        }

        .btn-cancel {
            background-color: #8D6E63;
            color: white;
        }

        .btn-cancel:hover {
            background-color: #A1887F;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Update Item</h2>
        <h5>Admin Credentials needed to Edit Item</h5>
        <form action="" method="post">
            <div class="form-group">
                <label for="item_name" class="form-label">Item Name:</label>
                <input type="text" name="item_name" id="item_name" class="form-control" placeholder="Spaghetti" value="<?php echo htmlspecialchars($item_name); ?>" required>
            </div>
            <div class="form-group">
                <label for="item_type" class="form-label">Item Type:</label>
                <input type="text" name="item_type" id="item_type" class="form-control" placeholder="Beer, Cocktail, etc.." value="<?php echo htmlspecialchars($item_type); ?>" required>
            </div>
            <div class="form-group">
                <label for="item_category" class="form-label">Item Category:</label>
                <input type="text" name="item_category" id="item_category" class="form-control" placeholder="Main Dish/ Side Dish/ Drinks" value="<?php echo htmlspecialchars($item_category); ?>" required>
            </div>
            <div class="form-group">
                <label for="item_price" class="form-label">Item Price:</label>
                <input type="number" min="0.01" step="0.01" name="item_price" id="item_price" class="form-control" placeholder="Enter Item Price" value="<?php echo htmlspecialchars($item_price); ?>" required>
            </div>
            <div class="form-group">
                <label for="item_description" class="form-label">Item Description:</label>
                <textarea name="item_description" id="item_description" class="form-control" placeholder="The dish..." required><?php echo htmlspecialchars($item_description); ?></textarea>
            </div>
            <br>
            <div class="form-actions">
                <button class="btn btn-coffee" type="submit" name="submit" value="submit">Update</button>
                <a class="btn btn-cancel" href="../panel/menu-panel.php">Cancel</a>
            </div>
        </form>
    </div>
</body>
</html>