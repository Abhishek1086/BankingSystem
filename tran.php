<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="tran.css">
   </head>
<body>

    <header>
        <nav class="navbar">

            <ul>
                <a href="index-1.html" class="logo">City Bank</a>
                <li><a href="index-1.html">Home</a></li>
                <li><a href="customer.php">Our Customers</a></li>
                <li><a href="tran.php">Transaction</a></li>
                <li><a href="history.php">Transaction History</a></li>
                <form class="fsearch">
                    <input type="text" id="fsearch" name="fsearch" placeholder="Search">
                    <button class="sbutton">&#9906;</button>
                </form>


            </ul>
        </nav>


        <h1 class="pghead">Transaction Details</h1>



        </header>
<div class="bdyimg"></div>
        <?php // Using database connection file here

        if(isset($_POST['submit']))
        {
            $to = $_POST['to'];
            $from = $_POST['from'];
            $amount = $_POST['amount'];


            $con = mysqli_connect("localhost:3308","genie","bumb121","bankdatabase");
                if($con->connect_error){
                    die("connection failed:".$con->connect_error);
                }
            $sql = "select balance from customer where acc =".$from;
                $result = $con->query($sql);
                $checkbal=0;
                if($result-> num_rows>0){
                    while($row= $result->fetch_assoc()){
                        $checkbal = $checkbal + $row["balance"];
                    }
                }
                else{
                    echo "0";
                }

            if($to==$from) {
            echo '<script>alert("Sender And Reciever cannot be same.")</script>';
            }
            else if($amount>$checkbal)
            {
                        echo '<script>alert("insufficient balance")</script>';

            }
            else{
            $sql = "update customer set balance = balance + ".$amount." where acc = ".$to;
                    $result = $con->query($sql);
                    $sql = "update customer set balance = balance - ".$amount." where acc = ".$from;
                    $result = $con->query($sql);
                    $date = date("Y-m-d h:i:sa");
                     $sql = "insert into history values(null,".$from.",".$to.",".$amount.",'".$date."')";
                            $result = $con->query($sql);
                    echo '<script>alert("Transaction completed")</script>';

            }
        }
 // Close connection
        ?>


<div class="tranform">
<form method="POST">
<div class="container1">
<div class="container2">
        Enter Sender Account Number:<br> <input class="a"type="number"  name="from" Required><br>
</div>
<div class="container3">
       Enter Reciever Account Number:<br> <br><input class="a" type="number"  name="to" Required>
</div>
<div class="container4">
       Enter Amount:<br> <input class="a" type="number"  name="amount" Required><br><input class="b" type="submit"  name="submit" value="Submit">
</div>

 </div>
 </div>

       </body>
       </html>