<?php
session_start();
include '../connection.php';
include 'header.php';
$email=$_SESSION['email'];
?>
<style>
    td,th{
        padding: 10px;
    }
</style>
<div style="margin: 50px 150px 50px 250px;">
    <h1 style="margin: 30px;">Bookings</h1>
    <table border="1">
         <tr>
                
                <th>BOOKING DATE</th>
                <th>NUMBER OF CYLINDER</th>
                <th>PAYMENT TYPE</th>
                <th colspan="2">STATUS</th>
            </tr>
            <?php
            $q="select * from tblbooking where tblbooking.cContact='$email'";
            $s= mysqli_query($conn, $q);
            while($r= mysqli_fetch_array($s))
            {
                echo '<tr>';
                echo '<td>'.$r['bdate'].'</td>';
                echo '<td>'.$r['nocyl'].'</td>';
                echo '<td>'.$r['ptype'].'</td>';
                echo '<td>'.$r['status'].'</td>';
                if($r['status']=="approved")
                {
                    if($r['ptype']=='Online payment')
                        echo '<td><a href="payment.php?id='.$r['bookingid'].'">Pay now</a></td>';
                }
                echo '</tr>';
            }
            ?>
    </table>
</div>