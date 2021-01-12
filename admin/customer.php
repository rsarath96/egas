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
    <h1 style="margin: 30px;">Customers</h1>
    <table border="1">
         <tr>
                <th>NAME</th>
                <th>ADDRESS</th>
                <th>CONTACT</th>
                <th>EMAIL</th>
                <th>AADHAR NO</th>
                <th colspan="3">RATION CARD NO</th>
            </tr>
            <?php
            $q="select * from tblcustomer where cContact in (select uname from tbllogin)";
            $s= mysqli_query($conn, $q);
            while($r= mysqli_fetch_array($s))
            {
                echo '<tr>';
                echo '<td>'.$r[0].'</td>';
                echo '<td>'.$r[1].'</td>';
                echo '<td>'.$r[2].'</td>';
                echo '<td>'.$r[3].'</td>';
                echo '<td>'.$r[4].'</td>';
                echo '<td>'.$r[5].'</td>';
                $q1="select status from tbllogin where uname='".$r[2]."'";
                $s1= mysqli_query($conn, $q1);
                $r1= mysqli_fetch_array($s1);
                if($r1[0]=="0")
                {
                    echo '<td><a href="approvecustomer.php?id='.$r[2].'&status=1">Approve</a></td>';
                    echo '<td><a href="approvecustomer.php?id='.$r[2].'&status=-1">Reject</a></td>';
                }
                echo '</tr>';
            }
            ?>
    </table>
</div>