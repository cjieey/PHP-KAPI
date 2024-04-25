<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- ===== BOX ICONS ===== -->
        <link href='https://cdn.jsdelivr.net/npm/boxicons@2.0.5/css/boxicons.min.css' rel='stylesheet'>

        <!-- ===== CSS ===== -->
        <link rel="stylesheet" href="../css/order.css">

        <title>Kape Bai Order</title>
    </head>
    <body id="body-pd">
        <header class="header" id="header">
            <div class="header__toggle">
                <i class='bx bx-menu' id="header-toggle"></i>
            </div>

            <div class="header__img">
                <img src="../img/coffee.jpg" alt="">
            </div>
        </header>

        <div class="l-navbar" id="nav-bar">
            <nav class="nav">
                <div>
                    <a href="#" class="nav__logo">
                        <i class='bx bx-coffee-togo'></i>
                        <span class="nav__logo-name">KAPE BAI</span>
                    </a>

                    <div class="nav__list">
                        <a href="../pages/home.php" class="nav__link ">
                        <i class='bx bx-grid-alt nav__icon' ></i>
                            <span class="nav__name">Dashboard</span>
                        </a>

                        <a href="../pages/user.php" class="nav__link">
                            <i class='bx bx-user nav__icon' ></i>
                            <span class="nav__name">Users</span>
                        </a>
                        
                        <a href="../pages/menu.php" class="nav__link">
                            <i class='bx bx-food-menu nav__icon'></i>
                            <span class="nav__name">Menu</span>
                        </a>

                        <a href="../pages/order.php" class="nav__link active">
                            <i class='bx bxs-calendar-check nav__icon'></i>
                            <span class="nav__name">Orders</span>
                        </a>

                        <a href="../pages/history.php" class="nav__link">
                            <i class='bx bx-history nav__icon'></i>
                            <span class="nav__name">History</span>
                        </a>
                    </div>
                </div>

                <a href="../pages/index.php" class="nav__link">
                    <i class='bx bx-log-out nav__icon' ></i>
                    <span class="nav__name">Log Out</span>
                </a>
            </nav>
        </div>

        <!--===== MAIN JS =====-->
        <script src="../js/main.js"></script>
        <!-- Add Product Popup -->

        <style>
    /* Popup Styles */
    .popup {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.5);
    }

    .popup-content {
        background-color: #fefefe;
        margin: 10% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 60%;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: black;
        text-decoration: none;
        cursor: pointer;
    }

    /* Table Styles */
    table {
        width: 100%;
        border-collapse: collapse;
    }

    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #f2f2f2;
    }

    img {
        max-width: 100px;
        height: auto;
    }
</style>

<div id="addProductPopup" class="popup">
    <div class="popup-content">
        <span class="close" onclick="closePopup()">&times;</span>
        <h2>Add Product</h2>
        <form id="addProductForm" method="post" enctype="multipart/form-data">
            <label for="productId">ID:</label>
            <input type="text" id="productId" name="productId" required>
            <label for="productName">Product Name:</label>
            <input type="text" id="productName" name="productName" required>
            <label for="productPrice">Price:</label>
            <input type="number" id="productPrice" name="productPrice" required>
            <label for="productQuantity">Quantity:</label>
            <input type="number" id="productQuantity" name="productQuantity" required>
            <label for="productCategory">Category:</label>
            <select id="productCategory" name="productCategory">
                <option value="HOT COFFEE">HOT COFFEE</option>
                <option value="ICED COFFEE">ICED COFFEE</option>
                <option value="PASTRIES">PASTRIES</option>
            </select>
            <label for="productImage">Product Image:</label>
            <input type="file" id="productImage" name="productImage" accept="image/*" required>
            <input type="submit" value="Add Product">
        </form>
    </div>
</div>

<div id="editProductPopup" class="popup">
    <div class="popup-content">
        <span class="close" onclick="closePopup()">&times;</span>
        <h2>Edit Product</h2>
        <form id="editProductForm" method="post" enctype="multipart/form-data">
            <input type="hidden" id="editProductId" name="editProductId">
            <label for="editProductName">Product Name:</label>
            <input type="text" id="editProductName" name="editProductName" required>
            <label for="editProductPrice">Price:</label>
            <input type="number" id="editProductPrice" name="editProductPrice" required>
            <label for="editProductQuantity">Quantity:</label>
            <input type="number" id="editProductQuantity" name="editProductQuantity" required>
            <label for="editProductCategory">Category:</label>
            <select id="editProductCategory" name="editProductCategory">
                <option value="HOT COFFEE">HOT COFFEE</option>
                <option value="ICED COFFEE">ICED COFFEE</option>
                <option value="PASTRIES">PASTRIES</option>
            </select>
            <label for="editProductImage">Product Image:</label>
            <input type="file" id="editProductImage" name="editProductImage" accept="image/*">
            <input type="hidden" id="editProductImageExisting" name="editProductImageExisting">
            <input type="submit" value="Save Changes">
        </form>
    </div>
</div>

<script>
    function openAddPopup() {
        document.getElementById("addProductPopup").style.display = "block";
    }

    function openEditPopup(id, name, price, quantity, category, image) {
        document.getElementById("editProductId").value = id;
        document.getElementById("editProductName").value = name;
        document.getElementById("editProductPrice").value = price;
        document.getElementById("editProductQuantity").value = quantity;
        document.getElementById("editProductCategory").value = category;
        document.getElementById("editProductImageExisting").value = image; // Keep the existing image filename
        document.getElementById("editProductPopup").style.display = "block";
    }

    function closePopup() {
        document.getElementById("addProductPopup").style.display = "none";
        document.getElementById("editProductPopup").style.display = "none";
    }

    function deleteProduct(id) {
        if (confirm("Are you sure you want to delete this product?")) {
            window.location.href = 'order.php?delete_id=' + id;
        }
    }
</script>

<?php
// Database connection
$connection = mysqli_connect("localhost", "root", "", "kapebai_db");
if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}

// Handle form submission to add product
if(isset($_POST['productId']) && isset($_POST['productName']) && isset($_POST['productPrice']) && isset($_POST['productQuantity']) && isset($_FILES['productImage'])) {
    $productId = $_POST['productId'];
    $productName = $_POST['productName'];
    $productPrice = $_POST['productPrice'];
    $productQuantity = $_POST['productQuantity'];
    $productCategory = $_POST['productCategory'];
    $productImage = $_FILES['productImage']['name'];
    $targetDir = __DIR__ . "/uploads/"; // Absolute path to uploads directory
    $targetFile = $targetDir . basename($_FILES["productImage"]["name"]);

    // Create the uploads directory if it doesn't exist
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0777, true);
    }

    // Upload the image
    if(move_uploaded_file($_FILES["productImage"]["tmp_name"], $targetFile)) {
        // Image uploaded successfully, now insert product into database
        $insertSql = "INSERT INTO products (id, product_name, price, quantity, category, image) VALUES ('$productId', '$productName', $productPrice, $productQuantity, '$productCategory', '$productImage')";
        if(mysqli_query($connection, $insertSql)) {
            echo "<script>alert('Product added successfully.');</script>";
        } else {
            echo "<script>alert('Error adding product: " . mysqli_error($connection) . "');</script>";
        }
    } else {
        echo "<script>alert('Error uploading image.');</script>";
    }
}

// Handle form submission to edit product
if(isset($_POST['editProductId']) && isset($_POST['editProductName']) && isset($_POST['editProductPrice']) && isset($_POST['editProductQuantity'])) {
    $editProductId = $_POST['editProductId'];
    $editProductName = $_POST['editProductName'];
    $editProductPrice = $_POST['editProductPrice'];
    $editProductQuantity = $_POST['editProductQuantity'];
    $editProductCategory = $_POST['editProductCategory'];

    // Handle image upload if a new image is provided
    if ($_FILES['editProductImage']['name']) {
        $editProductImage = $_FILES['editProductImage']['name'];
        $targetDir = __DIR__ . "/uploads/";
        $targetFile = $targetDir . basename($_FILES["editProductImage"]["name"]);
        if(move_uploaded_file($_FILES["editProductImage"]["tmp_name"], $targetFile)) {
            // Image uploaded successfully
        } else {
            echo "<script>alert('Error uploading image.');</script>";
        }
    } else {
        // If no new image provided, keep the existing image filename
        $editProductImage = $_POST['editProductImageExisting'];
    }

    $updateSql = "UPDATE products SET product_name='$editProductName', price=$editProductPrice, quantity=$editProductQuantity, category='$editProductCategory', image='$editProductImage' WHERE id='$editProductId'";
    if(mysqli_query($connection, $updateSql)) {
        echo "<script>alert('Product updated successfully.');</script>";
    } else {
        echo "<script>alert('Error updating product: " . mysqli_error($connection) . "');</script>";
    }
}

// Handle product deletion
if(isset($_GET['delete_id'])) {
    $delete_id = $_GET['delete_id'];
    $deleteSql = "DELETE FROM products WHERE id='$delete_id'";
    if(mysqli_query($connection, $deleteSql)) {
        echo "<script>alert('Product deleted successfully.');</script>";
    } else {
        echo "<script>alert('Error deleting product: " . mysqli_error($connection) . "');</script>";
    }
}

mysqli_close($connection);
?>

<!-- Button to open Add Product Popup -->
<button onclick="openAddPopup()">Add Product</button>

<!-- Display Products Table -->
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Category</th>
            <th>Image</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Retrieve products from the database
        $connection = mysqli_connect("localhost", "root", "", "kapebai_db");
        if($connection) {
            $selectSql = "SELECT * FROM products";
            $result = mysqli_query($connection, $selectSql);
            if(mysqli_num_rows($result) > 0) {
                while($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>".$row['id']."</td>";
                    echo "<td>".$row['product_name']."</td>";
                    echo "<td>".$row['price']."</td>";
                    echo "<td>".$row['quantity']."</td>";
                    echo "<td>".$row['category']."</td>";
                    echo "<td><img src='uploads/".$row['image']."' style='width: 100px; height: auto;'></td>";
                    echo "<td>";
                    echo "<button onclick=\"openEditPopup('".$row['id']."','".$row['product_name']."','".$row['price']."','".$row['quantity']."','".$row['category']."','".$row['image']."')\">Edit</button>";
                    echo "<button onclick=\"deleteProduct('".$row['id']."')\">Delete</button>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No products found.</td></tr>";
            }
            mysqli_close($connection);
        } else {
            echo "<tr><td colspan='7'>Failed to connect to database.</td></tr>";
        }
        ?>
    </tbody>
</table>
    </tbody>
</table>
    </body>
</html>