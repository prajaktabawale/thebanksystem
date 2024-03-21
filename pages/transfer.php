<?php
require 'connect.php';
ini_set('display_errors','Off');
ini_set('error_reporting', E_ALL );
define('WP_DEBUG', false);
define('WP_DEBUG_DISPLAY', false);

$ok = 0;
if (isset($_POST["submit"])) {
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $amount = $_POST["amt"];
        $paycust = $_POST["payee"];
        $benfcust = $_POST["benf"];
        $payeeid = $_POST["payeeid"];
        $benfid = $_POST["benfid"];

        $balq = "select current_bal from customers where name = '$paycust' and id = '$payeeid'";
        $bal = mysqli_query($conn, $balq);

        $balance = mysqli_fetch_assoc($bal);

        if ($paycust != $benfcust) {
            if ($paycust != "null" and $benfcust != "null" and $amount != "0") {
                if ($balance['current_bal'] >= $amount) {
                    $transfer1 = "UPDATE customers SET current_bal = current_bal - $amount WHERE name = '$paycust' and id = '$payeeid'";
                    mysqli_query($conn, $transfer1);
                    $transfer2 = "UPDATE customers SET current_bal = current_bal + $amount WHERE name = '$benfcust' and id = '$benfid'";
                    mysqli_query($conn, $transfer2);
                    $insert_query = "INSERT INTO transfers(id_payee, payee_name, id_benficiary, benf_name,amt) VALUES ($payeeid, '$paycust', $benfid, '$benfcust',$amount)";
                    mysqli_query($conn, $insert_query);
                    require 'success.php';
                    $ok = 'success';
                } else {

                    $balance = mysqli_fetch_assoc($bal);
                    require 'success.php';
                    $ok = 'failed';
                }
            } else {
                echo '<script>alert("Payee And Benficiary cant be same")</script>';
            }
        } else {
            echo '<script type="text/javascript">
             window.onload = function () { alert("All fields are mandatory!!"); } 
                </script>';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transfer</title>
    <link rel="stylesheet" href="../style/transfer.css">

</head>

<body class="">

    <?php include("../comp/header.php"); ?>


    <div class="form-c flex justify-center text-[#3498db] items-center mt-10 ">
        <form
            class=" text-xl font-[#3498db] border-[2px] border-[#3498db] rounded-2xl p-10 "
            action="./transfer.php" method="post">
            <div class='mb-2'>
                <h2 class="text-3xl text-start font-semibold">Transfer Money</h2>
                <?php
                if ($ok == 'success') {
                    echo $_SESSION["success"];
                    session_unset();
                }
                if ($ok == 'failed') {
                    echo $_SESSION["insuf"];
                    session_unset();
                }
                ?>
            </div>
            <div class="payee">
                <label class="text-base font-bold" for="payee">Sender Info: </label>
                <br>
                <label for="benf" class="text-base">Enter Id No: </label>
                <br>
                <input
                    class="amt mt-[1.5px] text-base rounded-md w-[18rem] px-3 py-1 border-[1px] outline-none border-[#3498db] "
                    name="payeeid" required type="number">
                <br>
                <label for="benf" class="text-base">Enter Name: </label>
                <br>
                <input
                    class="amt mt-[1.5px] text-base rounded-md w-[18rem] px-3 py-1 border-[1px] outline-none border-[#3498db] "
                    name="payee" required type="text">
            </div>
            <div class="benfi mt-2  mb-2">
                <label for="benf" class="text-base font-bold">Receiver Info: </label>
                <br>
                <label for="benf" class="text-base">Enter Id No: </label>
                <br>
                <input
                    class="amt mt-[1.5px] text-base rounded-md w-[18rem] px-3 py-1 border-[1px] outline-none border-[#3498db] "
                    name="benfid" required type="number">
                <br>
                <label for="benf" class="text-base">Enter Name: </label>

                <br>
                <input
                    class="amt mt-[1.5px] text-base rounded-md w-[18rem] px-3 py-1 border-[1px] outline-none border-[#3498db] "
                    name="benf" required type="text">
            </div>
            <label for="amt" class="text-base">Amount to Transfer: </label>
            <br>
            <input
                class="amt mt-[1.5px] text-base rounded-md w-[18rem] px-3 py-1 border-[1px] outline-none border-[#3498db] "
                name="amt" required type="number">
            <br>
            <input type="submit" name="submit"
                class="mt-2 text-base text-white font-bold hoe p-1  rounded-md hover:bg-[#ff6aa3]  bg-[#735DA5] w-full text-white"
                value="Transfer">
        </form>

    </div>
</body>

</html>
