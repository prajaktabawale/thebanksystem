<?php
require 'connect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Info
        <?php $cust_name ?>
    </title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap');
    h1 {
      text-align: center;
      font-size: large;
    }
    table,
    th,
    td {
      margin: auto;
      border-collapse: collapse;
      padding: 8px 30px;
      text-align: center;
      border: 1px solid black;
    }
    #hrow {
      background-color: #3498db;
      color: white;
    }

    table {
      border: 1px solid black;
    }
  </style>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../style/customerinfo.css">
</head>

<body class="flex flex-col justify-center item-center">
  <div class="flex flex-col justify-center item-center ml-auto mr-auto">
<?php 
if ($_SERVER['REQUEST_METHOD'] == "POST" || isset($_GET['cust_id']) && isset($_GET['customer_name'])) {
    if($_SERVER['REQUEST_METHOD'] == "POST"){
        $customer_name = $_POST["customer_name"];
        $customer_id = $_POST["cust_id"];   
    }else{
        $customer_name = $_GET["customer_name"];;
        $customer_id = $_GET["cust_id"]; 
    }
        $sql1 = "SELECT * from customers where name = '$customer_name' and id = '$customer_id'";
        $sql2 = "SELECT * FROM transfers where id_payee = '$customer_id' and payee_name = '$customer_name'";
        $result = mysqli_query($conn, $sql1);
        $result2 = mysqli_query($conn, $sql2);
        $row = mysqli_fetch_assoc($result);
        if ($result->num_rows > 0) {
            echo "<div class='w-full ml-auto mr-auto flex justify-center mt-20 text-center font-extrabold text-green-500'>Customer Info: $customer_name </div>";
            
        echo "<table class='mt-4 '>";
        echo "<tr id='hrow' class='bg-[#3498db]'><th>ID</th><th>NAME</th><th>EMAIL</th><th>BALANCE</th></tr>";
        echo "<tr class='row'>";
        echo "<td>" . $row["id"] . "</td>";
        $id = $row["id"];
        echo "<td><a href='customerinfo.php?id = $id'>" . strtoupper($row["name"]) . "</a></td>";
        echo "<td>" . strtoupper($row["email"]) . "</td>";
        echo "<td>" . $row["current_bal"] . "</td>";
        echo "</tr>";
        echo "</table>";
        echo '<br><br>';
        if($result2->num_rows > 0){
        echo "<div class='w-full mt-5 text-center font-extrabold text-green-500'>Transfers Done By: $customer_name </div>";
        echo "<table class = 'text-center border-2 mt-4 border-black'>";
        echo "<tr id='hrow' class='bg-[#3498db]'><th>TRANSACTION ID</th><th>PAYEE NAME</th><th>BENFICIARY ID</th><th>BENFICIARY NAME</th><th>AMOUNT</th><th>DATE / TIME</th></tr>";
            
        while ($row2 = mysqli_fetch_assoc($result2)) {
          echo "<tr class='row'>";
          echo "<td>" . $row2["tr_id"] . "</td>";
          echo "<td>".strtoupper($row2["payee_name"]) ."</a></td>";
          echo "<td>".strtoupper($row2["id_benficiary"]) ."</a></td>";
          echo "<td>" . strtoupper($row2["benf_name"]) . "</td>";
          echo "<td>" . $row2["amt"] . "</td>";
          echo "<td>" . $row2["time"] . "</td>";
          echo "</tr>";
        }
        echo "</table>";
    }
    else{
        echo "<div class='w-full text-center font-extrabold text-red-500'>TRANSFERS DATA NOT FOUND FOR $customer_name !!</div>";
    }
    }
    else{
        echo "<div class='w-full mt-52 text-center font-extrabold text-red-500'>NO customer with name: $customer_name and id: $customer_id  !!</div>";
    }
}else{
    header("Location: show_customers.php");
    exit;
}
?>
</div>
</body>

</html>
