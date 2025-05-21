<?php
$bill_total = $_POST['bill_total'] ?? 0; // Get the total from the hidden field

if ($bill_total) {
    if (isset($_POST['num_seniors']) && is_numeric($_POST['num_seniors'])) {
        $num_seniors = intval($_POST['num_seniors']);
        $discount = 0.30; // 30% discount

        // Calculate total discount based on the number of seniors
        $total_discount = $bill_total * $discount * $num_seniors;

        // Calculate new total after discount
        $new_total = $bill_total - $total_discount;

        echo "Total Discount for $num_seniors senior(s): $" . number_format($total_discount, 2) . "<br>";
        echo "New Bill Total: $" . number_format($new_total, 2);
    } else {
        echo "Please enter a valid number of seniors.";
    }
} else {
    echo "Bill total is missing.";
}
?>