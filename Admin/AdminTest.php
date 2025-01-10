<?php
session_start();
if (isset($_SESSION['admin_username'])) {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link rel="stylesheet" href="../Assets/style.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <link rel="stylesheet" href=//cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    </head>
    </head>

    <style>
        body {
            background-color: #dddddd;
        }

        .main {
            width: 90%;
            margin: 0 auto;
            overflow: hidden;
            padding-top: 2rem;
        }

        .section1 {
            display: flex;
            justify-content: space-around;

        }

        .card {
            width: 22%;
            height: 15rem;
            background-color: white;
            text-align: center;
            border-radius: 5px;

        }

        .section2 {
            display: flex;
            justify-content: space-around;
            padding-top: 1rem;

        }

        .cardss {
            width: 45%;
            height: 25rem;
            background-color: white;
            text-align: center;
            border-radius: 5px;

        }

        .cus {
            margin-top: 2rem;
            color: grey;
            font-size: 20px;
        }

        .cos {
            margin-top: 2rem;
            color: grey;
            font-size: 20px;

        }

        .skn {
            margin-top: 2rem;
            color: grey;
            font-size: 20px;
        }

        .orders {
            margin-top: 2rem;
            color: grey;
            font-size: 20px;
        }

        .coss {
            width: 15%;
            height: 30px;
        }

        .skinn {
            width: 15%;
            height: 30px;
        }

        .cuss {
            width: 15%;
            height: 30px;
        }

        .ord {
            width: 15%;
            height: 30px;
        }

        /* .chart{
    width: 300px;
    height:300px;
    border-radius:50%;
    background: conic-gradient(
        #659ec7 0% 20%,   
        #99c68e 20% 60%,  
        #023e8a 60% 100% 
      );
    margin-top:30px;
    margin-left:30px;
    
} */
        /* .bar-chart {
            display: flex;
            justify-content: space-around;
            align-items: flex-end;
            width: 250px;
            height: 250px;
            border-left: 2px solid grey;
            border-bottom: 2px solid grey;
            margin-top: 30px;
            margin-left: 40px;
        }

        .bar {
            width: 50px;
            background-color: steelblue;
            text-align: center;
            color: white;
            margin-right: 10px;
        }

        .bar span {
            position: relative;
            bottom: 20px;
        }

        .bar-1 {
            height: 40px;

            background-color: blue;
        }

        .bar-2 {
            height: 120px;
        }

        .bar-3 {
            height: 200px;
            background-color: blue;
        }

        .bar-4 {
            height: 80px;
        } */
    </style>

    <body>
        <?php
        include '../components/AdminNav.php';
        include '../backend/showdata.php';
        include "../config/db.php";
        $query = "SELECT customer_details.customer_name,COUNT(order_details.order_id) AS purchase_count,SUM(product_details.product_price * order_details.qty) AS total_purchase_amount FROM customer_details JOIN order_details ON customer_details.customer_id = order_details.customer_id JOIN product_details ON order_details.product_id = product_details.product_id GROUP BY customer_details.customer_name;";

        $result = mysqli_query($conn, $query);


        $count = 0;
        $purchase_freq = 0;
        $purchase_amt = 0;



        ?>
        <div class="main">
            <div class="section1">
                <div class="card">
                    <center>
                        <h3 class="cus">Customer</h3><br>
                        <img src="../assets/images/cusicon.png" class="cuss">
                        <p><?php echo ($total_customer)  ?></p>
                    </center>
                </div>
                <div class="card">

                    <center>
                        <h3 class="cos">Cosmetics</h3><br>
                        <img src="../assets/images/cosicon.png" class="coss">
                        <p><?php echo ($total_cosmetics) ?></p>
                    </center>
                </div>

                <div class="card">

                    <center>
                        <h3 class="skn">Skin Products</h3>
                        <br>
                        <img src="../assets/images/skinlogo.png" class="skinn">
                        <p><?php echo ($total_skin) ?></p>
                    </center>
                </div>
                <div class="card">
                    <center>
                        <h3 class="orders">Orders</h3>
                        <br>
                        <img src="../assets/images/ordericon.png" class="ord">
                        <p><?php echo ($total_orders) ?></p>
                    </center>
                </div>


            </div>
            <div class="section2">

                <div class="cardss">
                
                    <!-- <div class="chart">
</div> -->
                    <script>
                        let jsonData = [];
                        let clustersData = [];
                        let datas = [];
                        let clusters;
                    </script>

                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        $count = $count + 1;
                        $customer_name = $row['customer_name'];
                        $purchase_countt = $row['purchase_count'];
                        $purchase_amount = $row['total_purchase_amount'];

                    ?>
                        <script>
                            jsonData.push({
                                "Total Purchase in Rupees": <?php echo ($purchase_amount) ?>,
                                "purchase_frequency": <?php echo ($purchase_countt) ?>
                            })
                        </script>
                    <?php
                    } ?>



                    <script>
                        // Your JSON data
                        console.log(jsonData)

                        // Set up options for the fetch request
                        let options = {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json' // Set content type to JSON
                            },
                            body: JSON.stringify(jsonData) // Convert JSON data to a string and set it as the request body
                        };

                        fetch('http://localhost:5000/cluster', options)
                            .then(response => response.json())
                            .then(data => {
                                clustersData.push(data.clusters); // Store the clusters data
                                let count0 = 0;
                                let count1 = 0;
                                for (clusters of clustersData) {
                                    console.log(clusters)
                                    for (let cluster of clusters) {
                                        if (cluster == 1) {
                                            count1++;
                                        } else {
                                            count0++;
                                        }
                                    }
                                }
                                console.log(count0)
                                drawPie(count1, count0);
                                drawBar(count1, count0);

                            })


                        function drawPie(count1, count0) {
                            const ctx = document.getElementById('myPieChart').getContext('2d');
                            const myPieChart = new Chart(ctx, {
                                type: 'pie',
                                data: {
                                    labels: ['Irregular or Low Paying Customers', 'Regular or High Paying Customers'],
                                    datasets: [{
                                        data: [count1, count0],
                                        backgroundColor: ['#36A2EB', '#123456'],
                                    }]
                                },
                                options: {
                                    responsive: false,
                                    maintainAspectRatio: false,
                                    plugins: {
                                        title: {
                                            display: true,
                                            text: 'Pie Chart Showing Clusters'
                                        }
                                    }
                                }
                            });
                        }

                        function drawBar(count1, count0) {
                            const ctx = document.getElementById('barChart').getContext('2d');
                            const myPieChart = new Chart(ctx, {
                                type: 'bar',
                                data: {
                                    labels: ['Irregular or Low Paying', 'Regular or High Paying'],
                                    datasets: [{
                                        label: " ",
                                        data: [count1, count0],
                                        backgroundColor: ['#ADD8E6', '#36A2EB'],
                                    }]
                                },
                                options: {
                                    responsive:false, // Make the chart responsive
                                    maintainAspectRatio: true,
                                    scales: {
                                        y: {
                                            beginAtZero: true,
                                            title: {
                                                display: true,
                                                text: 'Count'
                                            }
                                        },
                                        x: {
                                            title: {
                                                display: true,
                                                text: 'Clusters'
                                            }
                                        }
                                    },
                                    plugins: {
                                        title: {
                                            display: true,
                                            text: 'Bar Chart showing clusters'
                                        }
                                    }
                                }



                            });
                        }
                        const myScatterChart = new Chart(ctxScatter, {
                            type: 'scatter',
                            data: {
                                datasets: [{
                                    label: 'Scatter Dataset',
                                    data: scatterData,
                                    backgroundColor: '#FF6384',
                                }]
                            },
                            options: {
                                responsive: true,
                                maintainAspectRatio: false,
                                scales: {
                                    x: {
                                        title: {
                                            display: true,
                                            text: 'Index'
                                        }
                                    },
                                    y: {
                                        title: {
                                            display: true,
                                            text: 'Value'
                                        },
                                        beginAtZero: true
                                    }
                                }
                            }
                        });
                    </script><br>
                    <center><canvas id="myPieChart" width="300" height="300"></canvas></center>

                </div>
                <div class="cardss">
                    <!-- <div class="bar-chart">
                        <div class="bar bar-1"><span>20</span></div>
                        <div class="bar bar-2"><span>60</span></div>
                        <div class="bar bar-3"><span>100</span></div>
                        <div class="bar bar-4"><span>40</span></div>
                    </div> -->
<br>
                    <center><canvas id="barChart" width="320" height="300"></canvas></center>

                </div>
                <!-- <div class="cardss"> -->
                    <!-- <script type="text/javascript">
  window.onload = function () {
    var chart = new CanvasJS.Chart("chartContainer",
    {
     title:{
      text: "Savings & Income distribution of 50 unmarried people in Texas"
    },
 
    data: [
    {
     type: "scatter",
     dataPoints: [
 
     { x: 10000, y: 1100 },
     { x: 11000, y: 1200 },
     { x: 13000, y: 1250 },
     { x: 15000, y: 1280 },
     { x: 18000, y: 1600 },
 
     { x: 20000, y: 2200 },
     { x: 20700, y: 2200 },
     { x: 21000, y: 2200 },
     { x: 24500, y: 2200 },
     { x: 26500, y: 2530 },
     { x: 28500, y: 3040 },
 
     { x: 30000, y: 4030 },
     { x: 30400, y: 3040 },
     { x: 30600, y: 4060 },
     { x: 31000, y: 4040 },
     { x: 31500, y: 5100 },
     { x: 31900, y: 4200 },
     { x: 34400, y: 3030 },
     { x: 37400, y: 3020 },
 
     { x: 40000, y: 8210 },
     { x: 40500, y: 8040 },
     { x: 40500, y: 9060 },
     { x: 42300, y: 8300 },
     { x: 44100, y: 9300 },
     { x: 45200, y: 6300 },
     { x: 45400, y: 9900 },
     { x: 46600, y: 4200 },
     { x: 48500, y: 8200 },
 
     { x: 50000, y: 9040 },
     { x: 50300, y: 9200 },
     { x: 50700, y: 7020 },
     { x: 53000, y: 9040 },
     { x: 53300, y: 9030 },
     { x: 56700, y: 10120 },
     { x: 58700, y: 4020 },
 
     { x: 60000, y: 10200 },
     { x: 60450, y: 10100 },
     { x: 60400, y: 10400 },
     { x: 60900, y: 9400 },
     { x: 61000, y: 9400 },
     { x: 64000, y: 9000 },
     { x: 64100, y: 10600 },
     { x: 64400, y: 10400 },
     { x: 66000, y: 12400 },
     { x: 66400, y: 13400 },
 
     { x: 70400, y: 10400 },
     { x: 73200, y: 10600 },
     { x: 76300, y: 11000 },
     { x: 78100, y: 12000 },
     { x: 78500, y: 13000 },
 
     { x: 80900, y: 10400 },
     { x: 90500, y: 13400 }
     ]
   }
   ]
 });
 
chart.render();
}
</script>
<script type="text/javascript" src="https://cdn.canvasjs.com/canvasjs.min.js"></script>
              -->

                <!-- </div> -->

            </div>
        </div>

        <?php
        include "../components/footer.php";
        ?>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>

    </html>
<?php
} else {
    header('location:AdminLogin.php');
}
?>