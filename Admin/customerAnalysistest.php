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
    </head>
    <style>
        .chart {
            width: 300px;
            height: 300px;
            border-radius: 50%;
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
            <div class="container mt-5 overflow-y-scroll" style='height:28rem'>
                <center>
                    <h3> Customers Datas </h3>
                </center><br>
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
                            let jsonData = [];
                            let clustersData = [];
                            let datas = [];
                            let clusters;
                            let customers=[];

              
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
                                
                                jsonData.push({
                                    "Total Purchase in Rupees": <?php echo ($purchase_amount) ?>,
                                    "purchase_frequency": <?php echo ($purchase_countt) ?>
                                })
                            </script>

                            <tr>
                                <th scope="row"><?php echo ($count); ?></th>

                                <td><?php echo ($customer_name); ?></td>
                                <td><?php echo ($purchase_countt); ?></td>
                                <td><?php echo ("Rs." . " " . $purchase_amount); ?></td>

                             
                            </tr>
                        <?php
                        } ?>

                    </tbody>
                </table>

                <script>
                    //fetch api use garera api call gareko
                    // Your JSON data
                    //console.log(jsonData)

                    // Set up options for the fetch request
                    let options = {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json' // Set content type to JSON
                        },
                        body: JSON.stringify(jsonData) // Convert JSON data to a string and set it as the request body
                    };
                    // api call garne function fetch 
                    fetch('http://localhost:5000/cluster', options)
                        .then(response => response.json()) // response ma utta api bata aako response set hunca
                        .then(data => { // yesma j son format ma aako main data basxa
                            clustersData.push(data.clusters); // Store the clusters data
                            let count0 = 0;
                            let count1 = 0;
                            let scatterData = [];
                            let clusterArray=[];
                            
                            for (clusters of clustersData) {
                                console.log(clusters)
                                for (let cluster of clusters) {
                                    clusterArray.push(cluster)
                                    if (cluster == 1) {
                                        count1++;
                                        
                                    } else {
                                        count0++;
                                        
                                    }

                                  
                                }
                            }
                            
                            
                            

                           // console.log(count0)
                           partition(clusterArray);
                            drawPie(count1, count0);
                            drawScatterChart(scatterData)

                        })

                    function partition(clusterArray){
                            customers.push(clusterArray)
                         
                         return customers   
                           
                    }
                    function drawPie(count1, count0) {
                        const ctx = document.getElementById('myPieChart').getContext('2d');
                        const myPieChart = new Chart(ctx, {
                            type: 'pie',
                            data: {
                                labels: ['Irregular or Low Payaing Customers', ' Regular or High Paying Customers '],
                                datasets: [{
                                    data: [count1, count0],
                                    backgroundColor: ['#36A2EB', '#FF6384'],
                                }]
                            },
                            options: {
                                responsive: false,
                                maintainAspectRatio: false,
                            }
                        });
                    }
                    // Function to draw Scatter Chart with Two Datasets
                    // function drawScatterChart(scatterData) {
                    //     const ctx = document.getElementById('myScatterChart').getContext('2d');
                    //     const myScatterChart = new Chart(ctx, {
                    //         type: 'scatter',
                    //         data: {
                    //             datasets: [{
                    //                     label: 'Dataset 1: Clusters Scatter Plot',
                    //                     data: scatterData, // The scatter data generated
                    //                     backgroundColor: 'rgba(75, 192, 192, 1)', // Color of the points
                    //                     borderColor: 'rgba(75, 192, 192, 1)',
                    //                     pointRadius: 5
                    //                 }
                    //             ]
                    //         },
                    //         options: {
                    //             responsive: true, // Make the chart responsive
                    //             maintainAspectRatio: false, // Adjust the chart size to fit
                    //             scales: {
                    //                 x: {
                    //                     type: 'linear',
                    //                     position: 'bottom',
                    //                     title: {
                    //                         display: true,
                    //                         text: 'X Axis'
                    //                     }
                    //                 },
                    //                 y: {
                    //                     title: {
                    //                         display: true,
                    //                         text: 'Cluster Value (0 or 1)'
                    //                     }
                    //                 }
                    //             },
                    //             plugins: {
                    //                 title: {
                    //                     display: true,
                    //                     text: 'Scatter Chart for Clusters Data with Two Datasets'
                    //                 }
                    //             }
                    //         }
                    //     });
                    // }
                </script>
                <center><canvas id="myPieChart" width="350" height="350">

                <div>
                    <?php
                     while ($row = mysqli_fetch_assoc($query_result)) {
                        $count = $count + 1;
                        $customer_name = $row['customer_name'];
                        $purchase_countt = $row['purchase_count'];
                        $purchase_amount = $row['total_purchase_amount'];
                       
                    ?>
                    <script>
                        console.log(customers)
                    </script>
                    <?php
                     }
                    ?>
                </div>
                </canvas>
          
            </center>
                <!-- <canvas id="myScatterChart" width="350" height="350"></canvas> -->




            </div>
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