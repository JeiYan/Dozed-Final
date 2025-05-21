<?php
session_start(); // Ensure session is started
?>
<?php
require_once '../config.php';
include '../inc/dashHeader.php'; 


$bill_id = $_GET['bill_id'] ?? null;
$search = $_POST['search'] ?? '';
$category = $_GET['category'] ?? '';
$table_id = $_GET['table_id'] ?? null;

function createNewBillRecord($table_id) {
    global $link; // Assuming $link is your database connection
    
    $bill_time = date('Y-m-d H:i:s');
    
    $insert_query = "INSERT INTO Bills (table_id, bill_time) VALUES ('$table_id', '$bill_time')";
    if ($link->query($insert_query) === TRUE) {
        return $link->insert_id; // Return the newly inserted bill_id
    } else {
        return false;
    }
}


?>
<!DOCTYPE html>
<html>
<head>
    <link href="../css/pos.css" rel="stylesheet" />
    <style>
  


        </style>
</head>


<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 order-md-1 m-1" id="item-select-section ">
                <div class="container-fluid pt-4 pl-500 row" style=" margin-left: 10rem;width: 81% ;">
                    <div class="mt-5 mb-2">

                    <?php 
                    $table_id = $_GET['table_id'] ?? null; 
                    if ($table_id): ?>
                        <div style="font-size: 32px; font-weight: bold; margin-bottom: 10px;">
                            Table #<?php echo htmlspecialchars($table_id); ?>
                        </div>
                    <?php endif; ?>
                    
                    <h3 class="pull-left">Food & Drinks</h3>
                        
                    </div>
                    <div class="mb-3">
                        <form method="POST" action="#">
                            <div class="row">
                                <div class="col-md-6">
                                    <input type="text" id="search" name="search" class="form-control" placeholder="Search Food & Drinks">
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-dark">Search</button>
                                </div>
                                <div class="col" style="text-align: right;" >
                                    <a href="orderItem.php?bill_id=<?php echo $bill_id; ?>&table_id=<?php echo $table_id; ?>" class="btn btn-light">Show All</a>
                                </div>
                                <div class="mb-3">
                                
                            </div>

                            </div>
                        </form>
                    </div>
                    <div style="max-height: 45rem;overflow-y: auto;">
    <?php
    // Include config file
    require_once "../config.php";

    $bill_id = $_GET['bill_id'] ?? null;
    $search = $_POST['search'] ?? '';
    $category = $_GET['category'] ?? '';
    $table_id = $_GET['table_id'] ?? null;

    if (!empty($search)) {
        $query = "SELECT * FROM Menu WHERE 
            item_type LIKE '%$search%' OR 
            item_category LIKE '%$search%' OR 
            item_name LIKE '%$search%' OR 
            item_id LIKE '%$search%' 
            ORDER BY item_id;";
    } elseif (!empty($category)) {
        $query = "SELECT * FROM Menu WHERE item_category = '$category' ORDER BY item_id;";
    } else {
        $query = "SELECT * FROM Menu ORDER BY item_id;";
    }

    $result = mysqli_query($link, $query);
    ?>
    
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Item Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Add</th>
            </tr>
        </thead>
        <tbody class="search-results">
            <?php
            if ($result && mysqli_num_rows($result) > 0):
                while ($row = mysqli_fetch_assoc($result)):
                    $item_id = htmlspecialchars($row['item_id']);
                    $item_name = htmlspecialchars($row['item_name']);
                    $item_category = htmlspecialchars($row['item_category']);
                    $item_type = htmlspecialchars($row['item_type']);
            ?>
                <tr class="search-item" 
                    data-id="<?= $item_id ?>" 
                    data-name="<?= strtolower($item_name) ?>" 
                    data-category="<?= strtolower($item_category) ?>" 
                    data-type="<?= strtolower($item_type) ?>">
                    <td><?= $item_id ?></td>
                    <td><?= $item_name ?></td>
                    <td><?= $item_category ?></td>
                    <td><?= number_format($row['item_price'], 2) ?></td>
                    <td>
                        <?php
                        // Check if bill has been paid
                        $payment_time_query = "SELECT payment_time FROM Bills WHERE bill_id = '$bill_id'";
                        $payment_time_result = mysqli_query($link, $payment_time_query);
                        $has_payment_time = false;
                        if ($payment_time_result && mysqli_num_rows($payment_time_result) > 0) {
                            $payment_row = mysqli_fetch_assoc($payment_time_result);
                            if (!empty($payment_row['payment_time'])) {
                                $has_payment_time = true;
                            }
                        }

                        if (!$has_payment_time): ?>
                            <form method="get" action="addItem.php">
                                <input type="hidden" name="table_id" value="<?= $table_id ?>">
                                <input type="hidden" name="item_id" value="<?= $item_id ?>">
                                <input type="hidden" name="bill_id" value="<?= $bill_id ?>">
                                <div class="d-flex align-items-stretch gap-2">
                                    <input type="number" name="quantity" class="form-control" style="width: 120px; min-height: 38px;" placeholder="1 to 20" required min="1" value="1" max="20">
                                    <input type="hidden" name="addToCart" value="1">
                                    <button type="submit" class="btn btn-primary" style="min-height: 38px;">Add to Cart</button>
                                </div>
                            </form>
                        <?php else: ?>
                            Bill Paid
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">No menu items were found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

                </div>
            </div>
            <div class="col-md-4 order-md-2 m-1" id="cart-section" >
                <div class="container-fluid pt-5 pl-600 pr-6 row mt-3" style="max-width: 200%; width:150%;">
                    <div class="cart-section" >
                        <h3>Cart</h3>
                        <table class="table table-bordered">
                            <thead>
                            <tr>
                                <th>Item ID</th>
                                <th>Item Name</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            
                            <div style="max-height: 40rem;overflow-y: auto;">
                                <tbody>
                                <?php
                                // Query to fetch cart items for the given bill_id
                                $cart_query = "SELECT bi.*, m.item_name, m.item_price FROM bill_items bi
                                               JOIN Menu m ON bi.item_id = m.item_id
                                               WHERE bi.bill_id = '$bill_id'";
                                $cart_result = mysqli_query($link, $cart_query);
                                $cart_total = 0;//cart total
                                $tax = 0.1; // 10% tax rate

                                if ($cart_result && mysqli_num_rows($cart_result) > 0) {
                                    while ($cart_row = mysqli_fetch_assoc($cart_result)) {
                                        $item_id = $cart_row['item_id'];
                                        $item_name = $cart_row['item_name'];
                                        $item_price = $cart_row['item_price'];
                                        $quantity = $cart_row['quantity'];
                                        $total = $item_price * $quantity;
                                        $bill_item_id = $cart_row['bill_item_id'];
                                        $cart_total += $total;
                                        echo '<tr>';
                                        echo '<td>' . $item_id . '</td>';
                                        echo '<td>' . $item_name . '</td>';
                                        echo '<td>₱ ' . number_format($item_price,2) . '</td>';
                                        echo '<td>' . $quantity . '</td>';
                                        echo '<td>₱ ' . number_format($total,2) . '</td>';
                                        // Check if the bill has been paid
                                        $payment_time_query = "SELECT payment_time FROM Bills WHERE bill_id = '$bill_id'";
                                        $payment_time_result = mysqli_query($link, $payment_time_query);
                                        $has_payment_time = false;

                                        if ($payment_time_result && mysqli_num_rows($payment_time_result) > 0) {
                                            $payment_time_row = mysqli_fetch_assoc($payment_time_result);
                                            if (!empty($payment_time_row['payment_time'])) {
                                                $has_payment_time = true;
                                            }
                                        }

                                        // Display the "Delete" button if the bill hasn't been paid
                                        if (!$has_payment_time) {
                                            echo '<td><a class="btn btn-dark" href="deleteItem.php?bill_id=' . $bill_id . '&table_id=' . $table_id . '&bill_item_id=' . $bill_item_id . '&item_id=' . $item_id .'">Delete</a></td>';
                                        } else {
                                            echo '<td>Bill Paid</td>';
                                        }
                                        echo '</tr>';
                                    }
                                } else {
                                    echo '<tr><td colspan="6">No Items in Cart.</td></tr>';
                                }
                                ?>

                                </tbody>
                            </div>
                        </table>
                        <hr>
                        <div class="table-responsive">
    <table class="table table-bordered ">
        <tbody>
            
            <tr>
                <td><strong>Cart Total</strong></td>
                <td>₱ <?php echo number_format($cart_total, 2); ?></td>
            </tr>
            <tr>
                <td><strong>Cart Taxed</strong></td>
                <td>₱ <?php echo number_format($cart_total * $tax, 2); ?></td>
            </tr>
            
            <tr>
                <td><strong>Grand Total</strong></td>
                <td>₱ <?php echo number_format(($tax * $cart_total) + $cart_total, 2); ?></td>
            </tr>
        </tbody>
    </table>
</div>

                        <?php 
                        
                        //echo "Cart Total: PHP " . $cart_total;
                        //echo "<br>Cart Taxed: PHP " . $cart_total * $tax;
                        //echo "<br>Grand Total: PHP " . $tax * $cart_total + $cart_total;
                      
                        // Check if the payment time record exists for the bill
                        $payment_time_query = "SELECT payment_time FROM Bills WHERE bill_id = '$bill_id'";
                        $payment_time_result = mysqli_query($link, $payment_time_query);
                        $has_payment_time = false;

                        if ($payment_time_result && mysqli_num_rows($payment_time_result) > 0) {
                            $payment_time_row = mysqli_fetch_assoc($payment_time_result);
                            if (!empty($payment_time_row['payment_time'])) {
                                $has_payment_time = true;
                            }
                        }

                        // If payment time record exists, show the "Print Receipt" button
                        if ($has_payment_time) {
                            echo '<div>';
                            echo '<div class="alert alert-success" role="alert">
                                    Bill has already been paid.
                                  </div>';
                            echo '<br><a href="receipt.php?bill_id=' . $bill_id . '" class="btn btn-light">Print Receipt <span class="fa fa-receipt text-black"></span></a></div>';
                            

                            
                        } elseif(($tax * $cart_total + $cart_total) > 0) {
                            echo '<br><a href="idValidity.php?bill_id=' . $bill_id . '" class="btn btn-success">Pay Bill</a>';
                        } else {
                            echo '<br><h3>Add Item To Cart to Proceed</h3>';
                        }

                        
                        
                        ?>
                            
                    </div>
                    <?php 
                       echo '<form class="mt-3" action="newCustomer.php" method="get">'; // Add this form element
                        echo '<input type="hidden" name="table_id" value="' . $table_id . '">';
                        echo '<button type="submit" name="new_customer" value="true" class="btn btn-warning">New Customer</button>';
                        echo '</form>';

            



                    ?>
                </div>

            </div>
        </div>
    </div>

    <script>
document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search');
    const rows = document.querySelectorAll('.search-item');

    if (searchInput && rows.length > 0) {
        searchInput.addEventListener('input', function () {
            const query = searchInput.value.toLowerCase();

            rows.forEach(row => {
                const name = row.dataset.name?.toLowerCase() || '';
                const category = row.dataset.category?.toLowerCase() || '';
                const id = row.dataset.id?.toLowerCase() || '';
                const type = row.dataset.type?.toLowerCase() || '';

                if (
                    name.includes(query) ||
                    category.includes(query) ||
                    id.includes(query) ||
                    type.includes(query)
                ) {
                    row.style.display = ''; // Show row
                } else {
                    row.style.display = 'none'; // Hide row
                }
            });
        });
    }
});
</script>

<?php include '../inc/dashFooter.php'; ?>
