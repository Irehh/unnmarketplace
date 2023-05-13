use prepared statement and  procedural programming style to fetch results as an assoc
Here is an example of how to use a prepared statement in procedural style with PHP to fetch results as an associative array:

Copy code
<?php
// Prepare the statement
$stmt = mysqli_prepare($connection, "SELECT * FROM products WHERE type = ? AND price <= ?");

// Bind the parameters
mysqli_stmt_bind_param($stmt, "si", $type, $price);

// Set the values for the parameters
$type = "Electronics";
$price = 100;

// Execute the statement
mysqli_stmt_execute($stmt);

// Get the result
$result = mysqli_stmt_get_result($stmt);

if(mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "Product Name: " . $row['product_name'] . "<br>";
        echo "Type: " . $row['type'] . "<br>";
        echo "Price: $" . $row['price'] . "<br>";
        echo "<hr>";
    }
} else {
    echo "No products found with the selected type and price.";
}

// Close the statement
mysqli_stmt_close($stmt);
?>
In this example, the prepared statement is created using the mysqli_prepare() function. The statement contains two placeholders, ?, for the type and price. The mysqli_stmt_bind_param() function is used to bind the actual values for the placeholders. The mysqli_stmt_execute() function runs the query, and the mysqli_stmt_get_result() function retrieves the result in the form of an associative array.
As in the previous example, it's important to close the statement after executing it, this can be done by using the mysqli_stmt_close() function.
You can use prepared statements for inserting, updating and deleting data using the same way, by replacing the SELECT statement with the desired statement and the related functions instead.