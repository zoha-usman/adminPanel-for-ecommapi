<?php
session_start();
include("header.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $response = array();

    // Process category form
    if (isset($_POST['cname'])) {
        // Process category form data and insert into the database

        // Assuming the category form data is processed successfully
        $response['success'] = true;
        $response['message'] = "Category added successfully";
    }

    // Process product form
    if (isset($_POST['pname'])) {
        // Process product form data and insert into the database

        // Assuming the product form data is processed successfully
        $response['success'] = true;
        $response['message'] = "Product added successfully";
    }

    echo json_encode($response);
    exit;
}
?>

<main>
    <!-- Rest of your HTML code -->
</main>

<?php
include("footer.php");
?>
