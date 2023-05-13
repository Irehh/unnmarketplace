Sure, here is an example of how to use a prepared statement in a procedural style in PHP:

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
In this example, you can see that the prepared statement is created using the mysqli_prepare() function, the parameters are bound using the mysqli_stmt_bind_param() function, the statement is executed using the mysqli_stmt_execute() function, the result is retrieved using the mysqli_stmt_get_result() function and the statement is closed using the mysqli_stmt_close() function.
As you can see, the usage of the prepared statement in procedural programming is similar to the usage in object-oriented programming, but you need to call the mysqli functions instead of the object methods.
It's also important to check the return value of each function to check if the function call succeeded or not.