<?php
session_start();
if (isset($_SESSION['admin_username'])) {
    // $user_id = $_SESSION['user_id'];
    include "../config/db.php";
    $query = "SELECT customer_details.customer_name,COUNT(order_details.order_id) AS purchase_count,SUM(product_details.product_price * order_details.qty) AS total_purchase_amount FROM customer_details JOIN order_details ON customer_details.customer_id = order_details.customer_id JOIN product_details ON order_details.product_id = product_details.product_id GROUP BY customer_details.customer_name;"



?>

    <!doctype html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Artisans Alley</title>
        <link rel="stylesheet" href="../Assets/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
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


        <?php
        include '../components/AdminNav.php';

        ?>

        <div class="main-container">
            <?php
            $count = 0;
            $purchase_freq = 0;
            $purchase_amt = 0;
            ?>
            <div class="container mt-5 overflow-y-scroll" style='height:34rem'>
                <center>
                    <h3> Customers Datas </h3>
                </center><br>
                <center>
                <div class="chart">
                    <canvas id="clusterChart" class="chart"></canvas>
                </div></center>
                <table class="table table-striped" id="cart_tbl">
                    <thead>
                        <tr>
                            <th scope="col">#</th>

                            <th scope="col">Customer Name</th>
                            <th scope="col">Purchase Frequency</th>
                            <th scope="col">Total Purchase</th>
                            <th scope="col">Clustered Category</th>


                        </tr>
                    </thead>


                    <tbody class="tbod">
                        <script>
                            let clusters;
                            let customers = [];
                            var regularCount = 0;
                            var irregularCount = 0;

                            
                            const ctx = document.getElementById('clusterChart').getContext('2d');
                            clusterChart = new Chart(ctx, {
                                type: 'pie',
                                data: {
                                    labels: ['Regular or High Paying', 'Irregular or Low Paying'],
                                    datasets: [{
                                        label: 'Customer Clusters',
                                        data: [irregularCount, regularCount],
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
                        </script>

                        <?php
                        // $customer_array = array();
                        $query_result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($query_result)) {
                            $count = $count + 1;
                            $customer_name = $row['customer_name'];
                            $purchase_countt = $row['purchase_count'];
                            $purchase_amount = $row['total_purchase_amount'];
                            // $customer_array.array_push($customer_array, $customer_name);


                        ?>



                            <script>
                                $.ajax({
                                    url: "http://localhost:5000/cluster",
                                    type: "POST",
                                    contentType: "application/json",
                                    data: JSON.stringify([{
                                        "Total Purchase in Rupees": <?php echo ($purchase_amount) ?>,
                                        "purchase_frequency": <?php echo ($purchase_countt) ?>
                                    }]),
                                    success: function(data, status) {
                                        console.log(status);
                                        console.log(data.clusters[0]);
                                        var cluster_name;
                                        if (data.clusters[0] == 0) {
                                            cluster_name = "Regular"
                                            regularCount++;
                                        } else {
                                            cluster_name = "Irregular"
                                            irregularCount++;
                                        }
                                        var tr_data = ' <tr><th scope="row"><?php echo ($count); ?></th><td><?php echo ($customer_name); ?></td> <td><?php echo ($purchase_countt); ?></td><td><?php echo ("Rs." . " " . $purchase_amount); ?></td><td>' + cluster_name + '</td></tr>'

                                        $('.tbod').append(tr_data);
                                        clusterChart.data.datasets[0].data = [regularCount, irregularCount];
                                        clusterChart.update();
                                    }
                                });
                            
                            </script>
                        <?php
                        } ?>

                    </tbody>

                </table>

                

                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

            </div>
            <?php
            //include "../components/footer.php";
            ?>
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>

    </html>
<?php
} else {
    header('location:Adminlogin.php');
}
?>