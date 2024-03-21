<?php
require 'connect.php';
$sql = "SELECT * from transfers;";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>All Transfers</title>
  <script src="script.js"></script>
  <style>
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
  
  <link rel="stylesheet" href="../style/transfer_hist.css">
</head>

<body>
  <?php include("../comp/header.php"); ?>
  <h1 class="text-4xl font-semibold text-center">All Transfers</h1>
  <div class="flex flex-col">
    <button id="print"
      class="w-28 py-2 mx-auto px-3 my-5 bg-[#3498db] text-white"
      onclick="print()">Print Transactions</button>
    <?php
    echo "<table class='mb-20'>";
    echo "<tr id='hrow' style='background-color:#3498db'><th id='tr_id'>Transaction Id</th><th>Payee Id</th><th>Payee Name</th><th>Benificiary Id</th><th>Benificiary Name</th><th>Amount</th><th>Transfer Date/Time</th></tr>";

    while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>";
      echo "<td>" . $row["tr_id"] . "</td>";
      echo "<td>" . $row["id_payee"] . "</td>";
      echo "<td>" . $row["payee_name"] . "</td>";
      echo "<td>" . $row["id_benficiary"] . "</td>";
      echo "<td>" . $row["benf_name"] . "</td>";
      echo "<td>" . $row["amt"] . "</td>";
      echo "<td>" . $row["time"] . "</td>";
      echo "</tr>";
    }

    echo "</table>";
    ?>
  </div>

</body>
<script>
  let print = () => {
    let p = document.getElementById('print');
    p.style.display = "none";
    window.print();
    p.style.display = "block";

  }

</script>

</html>

<?php
mysqli_close($conn);
?>