<?php
include "config.php";
$conn = db();
$query = "SELECT * FROM product";
$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0) {
    $total_products = mysqli_num_rows($result);
    $products_per_page = ceil($total_products * 0.2);
    $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $start = ($current_page - 1) * $products_per_page;

    $query = "SELECT * FROM product LIMIT $start, $products_per_page";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="card">';
        echo '<img src="./images/' . $row['image'] . '" class="card-img-top" alt="' . $row['name'] . '">';
        echo '<div class="card-body">';
        echo '<h5 class="card-title">' . $row['name'] . '</h5>';
        echo '<p class="card-text">$' . $row['amount'] . '</p>';
        echo '</div>';
        echo '</div>';
    }

    $total_pages = ceil($total_products / $products_per_page);

    echo '<nav aria-label="Page navigation example">';
    echo '<ul class="pagination">';
    for ($i = 1; $i <= $total_pages; $i++) {
        echo '<li class="page-item ' . ($i == $current_page ? 'active' : '') . '"><a class="page-link" href="?page=' . $i . '">' . $i . '</a></li>';
    }
    echo '</ul>';
    echo '</nav>';
} else {
    echo "No products found.";
}
