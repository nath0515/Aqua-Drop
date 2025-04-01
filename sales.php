<?php 
	require ('session.php');
	require ('db.php');

    if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
        $start_date = $_GET['start_date'];
        $end_date = $_GET['end_date'];

        if (validateDate($start_date) && validateDate($end_date)) {
            $start_datetime = $start_date . ' 00:00:00';
            $end_datetime = $end_date . ' 23:59:59';

            $sql = "SELECT order_id, name, contact_number, address, date, quantity, t.price, (o.quantity * t.price) AS total_price,  rider, o.status_id, status_name, type_name FROM orders o
            JOIN status s ON o.status_id = s.status_id
            JOIN type t ON o.type_id = t.type_id WHERE date BETWEEN :start_date AND :end_date AND o.status_id = 4";

            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':start_date', $start_datetime, PDO::PARAM_STR);
            $stmt->bindParam(':end_date', $end_datetime, PDO::PARAM_STR);
            $stmt->execute();

            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $sql_total_payment = "SELECT SUM(o.quantity * t.price) AS total_payment FROM orders o
            JOIN type t ON o.type_id = t.type_id
             WHERE date BETWEEN :start_date AND :end_date AND status_id = 4";
            $stmt_total_payment = $conn->prepare($sql_total_payment);
            $stmt_total_payment->bindParam(':start_date', $start_datetime, PDO::PARAM_STR);
            $stmt_total_payment->bindParam(':end_date', $end_datetime, PDO::PARAM_STR);
            $stmt_total_payment->execute();
            $total_payment = $stmt_total_payment->fetch(PDO::FETCH_ASSOC)['total_payment'];
        }
    }
    else{
        $sql = "SELECT order_id, name, contact_number, address, date, quantity,price, (o.quantity * t.price) AS total_price, rider, o.status_id, status_name, type_name FROM orders o
        JOIN status s ON o.status_id = s.status_id
        JOIN type t ON o.type_id = t.type_id
        WHERE o.status_id = 4";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $sql_total_payment = "SELECT SUM(o.quantity * t.price) AS total_payment FROM orders o
        JOIN type t ON o.type_id = t.type_id
        WHERE status_id=4";
        $stmt_total_payment = $conn->prepare($sql_total_payment);
        $stmt_total_payment->execute();
        $total_payment = $stmt_total_payment->fetch(PDO::FETCH_ASSOC)['total_payment'];
    }
	
    function validateDate($date) {
        $d = DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') === $date;
    }
    

?>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Orders</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">

        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand ps-3" href="adminindex.php">    
                <img src="icons/transparentlogo.png" style="width: 200px; height: 150px;">

            </a>
            <!-- Sidebar Toggle-->
            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button> 
            <!-- Navbar Search-->
           
            <!-- Navbar-->
            <ul class="navbar-nav ms-auto  me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#!">Settings</a></li>
                        <li><a class="dropdown-item" href="#!">Activity Log</a></li>
                        <li><hr class="dropdown-divider" /></li>
                        <li><a class="dropdown-item" href="login.php">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav align-items-center">
                         
                            <a class="nav-link" href="adminindex.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Home
                            </a>
                           
                            <a class="nav-link" href="orders.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-card-checklist"></i></div>
                                Orders
                            </a>

                            <a class="nav-link" href="stocks.php">
                                <div class="sb-nav-link-icon"><i class="bi bi-box-seam-fill"></i></div>
                                Stock
                            </a>

                            <a class="nav-link" href="sales.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Sales
                            </a>

                             <a class="nav-link" href="expenses.php ">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Expenses
                            </a>
                            
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="layout-static.html">Static Navigation</a>
                                    <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                                </nav>
                            </div>
                            
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                                        Authentication
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="login.html">Login</a>
                                            <a class="nav-link" href="register.html">Register</a>
                                            <a class="nav-link" href="password.html">Forgot Password</a>
                                        </nav>
                                    </div>
                                    <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                                        Error
                                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                    </a>
                                    <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                                        <nav class="sb-sidenav-menu-nested nav">
                                            <a class="nav-link" href="401.html">401 Page</a>
                                            <a class="nav-link" href="404.html">404 Page</a>
                                            <a class="nav-link" href="500.html">500 Page</a>
                                        </nav>
                                    </div>
                                </nav>
                            </div>
                           
                            
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        <?php echo $_SESSION['username']?>
                    </div>
                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <div>
                            <div class="row">
                                <div class="col-10" >
                                    <h1 class="mt-4">Sales : ₱ <?php echo number_format($total_payment, 2); ?></h1>
                                </div>
                                <div class="col-2 d-flex align-items-center">
                                <button class="btn btn-outline-secondary mt-3 ms-5" data-bs-toggle="modal" data-bs-target="#addsales"><i class="bi bi-plus-circle"></i>
                                    Add Sales
                                </button>
                            </div>   
                            </div>
                        </div>                   
                        <ul class="navbar-nav ms-auto me-3 me-lg-4 d-flex align-items-">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-filter-circle-fill fs-2"></i> Filter by Date Range
                                </a>
                                <div class="dropdown-menu p-4" aria-labelledby="navbarDropdown">
                                    <form action="sales.php" method="GET">
                                        <div class="mb-3">
                                            <label for="start_date" class="form-label">Start Date</label>
                                            <input type="date" id="start_date" name="start_date" class="form-control" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="end_date" class="form-label">End Date</label>
                                            <input type="date" id="end_date" name="end_date" class="form-control" required>
                                        </div>
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                    </form>
                                </div>
                            </li>
                        </ul>                       
                        <div class="card mb-4">
                           
                            <div class="card-body">
                                <table id="datatablesSimple">
                                <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Contact #</th>
                                            <th>Address</th>
                                            <th>Date</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Payment</th>
                                            <th>Type</th>
                                             <th>Status</th>
                                             <th>Rider</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Name</th>
                                            <th>Contact #</th>
                                            <th>Address</th>
                                            <th>Date</th>
                                            <th>Quantity</th>
                                            <th>Price</th>
                                            <th>Payment</th>
                                            <th>Type</th>
                                            <th>Status</th>
                                            <th>Rider</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php foreach($data as $row): ?>
                                        <tr>
                                            <td><?php echo $row['name']?></td>
                                            <td><?php echo $row['contact_number']?></td>
                                            <td><?php echo $row['address']?></td>
                                            <td><?php echo $row['date']?></td>
                                            <td><?php echo $row['quantity']?></td>
                                            <td><?php echo $row['price']?></td>
                                            <td>₱ <?php echo $row['total_price']?></td>
                                            <td><?php echo $row['type_name']?></td>
                                            <td><?php echo $row['status_name']?></td>
                                            <td><?php echo $row['rider']?></td>
                                        </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>

            </div>
        </div>
        <div class="modal fade" id="addsales" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                
                <!-- Modal Header -->
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><i class="bi bi-plus-circle"></i>Add Expenses</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                
                <form action="process_addsale.php" method="POST">
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div class="mb-3">
                            <div class="input-group">
                                <?php 
                                    $sql = "SELECT * FROM type";
                                    $stmt = $conn->prepare($sql);
                                    $stmt->execute();
                                    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                
                                ?>
                                <select class="form-select" name="type_id" id="type_id" required>
                                    <option value="">Select Product</option>
                                    <?php foreach($data as $row):?>
                                    <option value="<?php echo $row['type_id']?>"><?php echo $row['type_name']?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text pe-3"><i class="bi bi-plus-slash-minus"></i></span>
                                <input type="number" id="quantity" name="quantity" class="form-control" placeholder="Quantity" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <div class="input-group">
                                <span class="input-group-text pe-3">₱</span>
                                <input type="number" step="0.01" id="amount" class="form-control" placeholder="Amount" required readonly>
                            </div>
                        </div>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success">Add Sale</button>
                    </div>

                </form>

            </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
        <?php if (isset($_GET['status'])): ?>
            <script>
                <?php if ($_GET['status'] == 'success'): ?>
                    Swal.fire({
                        icon: 'success',
                        title: 'Sales Added!',
                        text: 'The sales has been successfully added.',
                    }).then((result) => {
                    });
                <?php elseif ($_GET['status'] == 'error'): ?>
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Something went wrong while adding the sales.',
                    });
                <?php endif; ?>
            </script>
        <?php endif; ?>

        <script>
            $(document).ready(function() {
                var table = $('#datatablesSimple').DataTable();

                $("#start_date, #end_date").datepicker({
                    dateFormat: "yy-mm-dd"
                });

                // Date range filter
                $('#start_date, #end_date').change(function() {
                    var startDate = $('#start_date').val();
                    var endDate = $('#end_date').val();

                    table.rows().every(function() {
                        var date = $(this.node()).find('td').eq(2).text(); // Get the date from the 3rd column (index 2)

                        if (startDate && endDate) {
                            if (new Date(date) >= new Date(startDate) && new Date(date) <= new Date(endDate)) {
                                $(this.node()).show();
                            } else {
                                $(this.node()).hide();
                            }
                        } else if (startDate && new Date(date) >= new Date(startDate)) {
                            $(this.node()).show();
                        } else if (endDate && new Date(date) <= new Date(endDate)) {
                            $(this.node()).show();
                        } else {
                            $(this.node()).show();
                        }
                    });
                });
            });
        </script>
        <script>
            let amount = 0.00;

            document.getElementById('type_id').addEventListener('change', function() {
                let type_id = this.value;

                fetch('process_autopopulatesales.php', {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                    body: 'type_id=' + type_id
                })
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        Swal.fire({
                            icon: 'error',
                            title: 'Error',
                            text: data.error
                        });
                        console.log(data);
                        document.getElementById('quantity').value = '';
                        document.getElementById('amount').value = '';

                    } else {
                        console.log(data);
                        document.getElementById('quantity').value = 1;
                        document.getElementById('amount').value = data.price;
                        amount = data.price;

                    }
                })
                .catch(error => console.error('Error:', error));
            });

            document.getElementById('quantity').addEventListener('change', function() {
                let quantity = this.value;
                let newAmount = amount * quantity;
                document.getElementById('amount').value = newAmount.toFixed(2);
                if(quantity < 1){
                    this.value = 0;
                    document.getElementById('amount').value = (0).toFixed(2);
                    
                }
            });
        </script>
    </body>
</html>