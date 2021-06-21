<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="histor.css">
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
        </header>
<div class="img">
        <div class="tablebody">
                 <table class="tantable">
                             <tr>
                         <th>Sender</th>
                         <th>Receiver</th>
                         <th>Amount</th>
                         <th>Date</th>
                     </tr>

                     <?php
                     $cunn = mysqli_connect("localhost:3308","genie","bumb121","bankdatabase");
                         if($cunn->connect_error){
                           die("connection failed:".$cunn->connect_error);
                         }
                         $sqlq = "SELECT (select name from customer where acc=sen) as SENDERS, (select name from customer where acc=rec) as RECIEVERS, amount as AMOUNT, date as DATE, id as ID from history ORDER BY DATE DESC;";
                         $get = $cunn->query($sqlq);
                         if($get-> num_rows>0){
                     	    while($row= $get->fetch_assoc()){
                 	    echo "<tr><td>".$row["SENDERS"]."</td><td>".$row["RECIEVERS"]."</td><td>".$row["AMOUNT"]."</td><td>".$row["DATE"]."</td></tr>";
                         }
                     }
                     else{
                         echo "0";
                     }

                     $cunn-> close();

                     ?>

                     </table>
                 </div>
</div>




        </body>
               </html>