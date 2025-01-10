<?php
session_start();
if (isset($_SESSION['admin_username'])) {
    include "../config/db.php";

    // Set default values for date range (current month by default)
    $from_date = $_POST['start_date'] ?? date('Y-m-01');
    $to_date = $_POST['end_date'] ?? date('Y-m-t');

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("
        SELECT customer_details.customer_name, 
               COUNT(order_details.order_id) AS purchase_count, 
               SUM(product_details.product_price * order_details.qty) AS total_purchase_amount
        FROM customer_details 
        JOIN order_details ON customer_details.customer_id = order_details.customer_id 
        JOIN product_details ON order_details.product_id = product_details.product_id 
        WHERE order_details.ordered_date BETWEEN ? AND ? 
        GROUP BY customer_details.customer_name
    ");
    $stmt->bind_param("ss", $from_date, $to_date);
    $stmt->execute();
    $result = $stmt->get_result();

    $customers = [];
    while ($row = $result->fetch_assoc()) {
        $customers[] = $row;
    }
    $stmt->close();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Artisans Alley</title>
    <link rel="stylesheet" href="../Assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<style>
    .chart {
        width: 300px;
        height: 300px;
        border-radius: 10%;
        margin-top: 30px;
        margin-left: 30px;
    }
</style>
<body>
    <?php include '../components/AdminNav.php'; ?>
    <div class="main-container">
        <div class="container mt-5">
            <center><h3>Customers Data</h3></center>

            <!-- Date Filter Form -->
            <form method="POST" action="">
                <br><br>
                <div class="row" style="margin-left:170px">
                    <div class="col-md-4">
                        <label for="start_date" style="margin-left:20px">From Date</label>
                        <input type="date" id="start_date" name="start_date" value="<?php echo htmlspecialchars($from_date); ?>" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="end_date" style="margin-left:20px"></label>To Date</label>
                        <input type="date" id="end_date" name="end_date" value="<?php echo htmlspecialchars($to_date); ?>" class="form-control">
                    </div>
                    <div class="col-md-4 mt-4">
                        <button type="submit" class="btn btn-primary mt-2">Generate Report</button>
                    </div>
                </div>
            </form>

            <div class="container mt-5 overflow-y-scroll" style="height:34rem">
                <center>
                    <div class="chart">
                        <canvas id="clusterChart" class="chart"></canvas>
                    </div>
                </center>
                <table class="table table-striped" id="cart_tbl">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Customer Name</th>
                            <th scope="col">Total Purchase Frequency</th>
                            <th scope="col">Total Purchase Amount</th>
                            <th scope="col">Clustered Category</th>
                        </tr>
                    </thead>
                    <tbody class="tbod">
                        <?php
                        $regularCount = 0;
                        $irregularCount = 0;

                        foreach ($customers as $index => $customer) {
                            $customer_name = htmlspecialchars($customer['customer_name']);
                            $purchase_count = $customer['purchase_count'];
                            $purchase_amount = $customer['total_purchase_amount'];

                            echo "<tr>
                                <th scope='row'>" . ($index + 1) . "</th>
                                <td>$customer_name</td>
                                <td>$purchase_count</td>
                                <td>Rs. " . number_format($purchase_amount, 2) . "</td>
                                <td class='cluster-cell' data-purchase-amount='$purchase_amount' data-purchase-frequency='$purchase_count'></td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>

            <script>
                $(document).ready(function() {
                    let regularCount = 0;
                    let irregularCount = 0;
                    let requests = []; // To hold AJAX requests

                    $('.cluster-cell').each(function() {
                        const purchaseAmount = $(this).data('purchase-amount');
                        const purchaseFrequency = $(this).data('purchase-frequency');

                        const request = $.ajax({
                            url: 'http://localhost:5000/cluster',
                            type: 'POST',
                            contentType: 'application/json',
                            data: JSON.stringify([{
                                'Total Purchase in Rupees': purchaseAmount,
                                'purchase_frequency': purchaseFrequency
                            }]),
                            success: function(data) {
                                const clusterName = data.clusters[0] == 0 ? 'Regular' : 'Irregular';
                                $(this).text(clusterName);
                                if (clusterName === 'Regular') {
                                    regularCount++;
                                } else {
                                    irregularCount++;
                                }
                            }.bind(this) // Bind 'this' to access the correct cell context
                        });

                        requests.push(request); // Store the AJAX promise
                    });

                    // Wait for all AJAX calls to complete
                    $.when.apply($, requests).done(function() {
                        const ctx = document.getElementById('clusterChart').getContext('2d');
                        const clusterChart = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: ['Regular or High Paying', 'Irregular or Low Paying'],
                                datasets: [{
                                    label: 'Customer Clusters',
                                    data: [regularCount, irregularCount],
                                    backgroundColor: ['#36A2EB', '#FF6384'],
                                    hoverOffset: 4
                                }]
                            },
                            options: {
                                responsive: true,
                                plugins: {
                                    legend: {
                                        position: 'top'
                                    },
                                    tooltip: {
                                        callbacks: {
                                            label: function(tooltipItem) {
                                                return tooltipItem.label + ': ' + tooltipItem.raw;
                                            }
                                        }
                                    }
                                }
                            }
                        });
                    });
                });
            </script>
        </div>
    </div>
</body>
</html>

<?php
} else {
    header('location:Adminlogin.php');
}
?>
