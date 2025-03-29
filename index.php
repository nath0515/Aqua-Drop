<?php
require('session.php');
require('db.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <title>Home - Aquadrop</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>

    <script>
        function placeOrder(product, price, type_id) {
            let quantity = parseInt(document.getElementById(`${product}-qty`).innerText);

            // Populate modal with order details
            document.getElementById('order-product').innerText = product.charAt(0).toUpperCase() + product.slice(1);
            document.getElementById('order-quantity').innerText = quantity;
            document.getElementById('order-total').innerText = (price * quantity).toFixed(2);
            document.getElementById('order-type-id').value = type_id;
            document.getElementById('order-quantity-input').value = quantity;
            document.getElementById('order-total-input').value = (price * quantity).toFixed(2);

            // Show the modal
            var orderModal = new bootstrap.Modal(document.getElementById('addorder'));
            orderModal.show();
        }

        function updateQuantity(type, change, price) {
            let qtyElement = document.getElementById(`${type}-qty`);
            let totalElement = document.getElementById(`${type}-total`);
            let qty = parseInt(qtyElement.innerText) + change;

            if (qty < 1) qty = 1;
            else if (qty > 15) qty = 15;

            qtyElement.innerText = qty;
            totalElement.innerText = (qty * price).toFixed(2);
        }
    </script>
</head>

<body class="sb-nav-fixed">
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="index.php">Aquadrop</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle">
            <i class="fas fa-bars"></i>
        </button>
        <ul class="navbar-nav ms-auto me-3 me-lg-4">
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fas fa-user fa-fw"></i>
                </a>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="profile.html">Settings</a></li>
                    <li><hr class="dropdown-divider" /></li>
                    <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                </ul>
            </li>
        </ul>
    </nav>


    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <a class="nav-link" href="index.php"><i class="fas fa-home sb-nav-link-icon"></i> Home</a>
                        <a class="nav-link" href="customer_orders.php"><i class="fas fa-shopping-cart sb-nav-link-icon"></i> Orders</a>
                        <a class="nav-link" href="usermaps.php"><i class="fas fa-map sb-nav-link-icon"></i> Map</a>
                    </div>
                </div>
            </nav>
        </div>

        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Home</h1>
                    <ol class="breadcrumb mb-4">
                        <li class="breadcrumb-item active">Welcome to Aquadrop Dashboard</li>
                    </ol>
                    <div class="container mt-4">
                        <h2 class="text-center mb-4">Water Products</h2>
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

                            <!-- Boiled Water Product -->
                            <div class="col">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <img src="icons/withfaucet.jpeg" alt="Boiled Water" class="img-fluid mb-1" style="max-width: 150px;">
                                        <h3 class="card-title">Boiled Water</h3>
                                        <p class="card-text">Price: 20 Php</p>
                                        <div class="d-flex justify-content-center align-items-center mb-1">
                                            <button class="btn btn-secondary" onclick="updateQuantity('boiled', -1, 20)">-</button>
                                            <span class="mx-3" id="boiled-qty">1</span>
                                            <button class="btn btn-secondary" onclick="updateQuantity('boiled', 1, 20)">+</button>
                                        </div>
                                        <p class="total-price mt-2">Total: <span id="boiled-total">20.00</span> Php</p>
                                        <button class="btn btn-primary" onclick="placeOrder('boiled', 20, 1)">Order</button>
                                    </div>
                                </div>
                            </div>

                            <!-- GG Water Product -->
                            <div class="col">
                                <div class="card h-100">
                                    <div class="card-body text-center">
                                        <img src="logo.png" alt="GG Water" class="img-fluid mb-1" style="max-width: 150px;">
                                        <h3 class="card-title">GG</h3>
                                        <p class="card-text">Price: 20 Php</p>
                                        <div class="d-flex justify-content-center align-items-center mb-1">
                                            <button class="btn btn-secondary" onclick="updateQuantity('gg', -1, 20)">-</button>
                                            <span class="mx-3" id="gg-qty">1</span>
                                            <button class="btn btn-secondary" onclick="updateQuantity('gg', 1, 20)">+</button>
                                        </div>
                                        <p class="total-price mt-2">Total: <span id="gg-total">21.00</span> Php</p>
                                        <button class="btn btn-primary" onclick="placeOrder('gg', 20, 2)">Order</button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <!-- Order Modal -->
    <div class="modal fade" id="addorder" tabindex="-1" aria-labelledby="orderModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderModalLabel">Order Summary</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="orderForm" method="POST" action="insert_order.php">
                        <div class="mb-3">
                            <strong>Product:</strong> <span id="order-product"></span>
                        </div>
                        <div class="mb-3">
                            <strong>Quantity:</strong> <span id="order-quantity"></span>
                        </div>
                        <div class="mb-3">
                            <strong>Total Price:</strong> <span id="order-total"></span> Php
                        </div>
                        <input type="hidden" name="type_id" id="order-type-id" />
                        <input type="hidden" name="quantity" id="order-quantity-input" />
                        <input type="hidden" name="total" id="order-total-input" />
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="document.getElementById('orderForm').submit();">Confirm Order</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="js/scripts.js"></script>
</body>

</html>
