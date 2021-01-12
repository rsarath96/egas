<?php
include '../connection.php';
include 'header.php';
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
                <th>NAME</th>
                <th>CYLINDER TYPE</th>
                <th>BOOKING DATE</th>
                <th>NUMBER OF CYLINDER</th>
                <th>STATUS</th>
                <th colspan="2">PAYMENT TYPE</th>
            </tr>
            <?php
            $q="select tblcustomer.*,tblbooking.* from tblcustomer,tblbooking where tblcustomer.cContact=tblbooking.cContact";
            $s= mysqli_query($conn, $q);
            while($r= mysqli_fetch_array($s))
            {
                echo '<tr>';
                echo '<td>'.$r['cName'].'</td>';
                echo '<td>'.$r['cType'].'</td>';
                echo '<td>'.$r['bdate'].'</td>';
                echo '<td>'.$r['nocyl'].'</td>';
                echo '<td>'.$r['status'].'</td>';
                echo '<td>'.$r['ptype'].'</td>';
                if($r['status']=="booked")
                {
                    echo '<td><a href="approvebooking.php?id='.$r['bookingid'].'&status=approved">Approve</a></td>';
                  
                }
                if(($r['status']=="approved" && $r['ptype']=="Cash on delivery" )||$r['status']=='payment completed')
                {
                    
                    echo '<td><a href="approvebooking.php?id='.$r['bookingid'].'&status=delivered">Delivered</a></td>';
                }
                echo '</tr>';
            }
            ?>
    </table>
</div>