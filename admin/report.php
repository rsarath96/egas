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
    <h1 style="margin: 30px;">Report</h1>
     <form method="POST" enctype="multipart/form-data">
    <table>
        <tr>
            <td>Select date</td>
            <td><input type="date" class="form-control"  name="txtDate" required="" ></td>
        </tr>
        
        <tr>
            <td></td>
            <td><input type="submit" class="btn btn-danger" name="btnSubmit" value="Submit"></td>
        </tr>
    </table>
   
</form>
   
</div>
<?php
if(isset($_REQUEST['btnSubmit']))
{
    $date=$_REQUEST['txtDate'];
    $q="select tblcustomer.*,tblbooking.* from tblcustomer,tblbooking where tblcustomer.cContact=tblbooking.cContact and cast(tblbooking.bdate as date)=cast('$date' as date) and tblbooking.status='delivered'";
    $s= mysqli_query($conn, $q);
    $count= mysqli_num_rows($s);
    if($count==0)
        echo '<script>alert("No bookings")</script>';
    else {
        
    
    echo '<table border="1" style="margin:100px;">';
         echo '<tr>';
         echo '<th>NAME</th>';
         echo '<th>CONSUMER NO</th>';
                echo '<th>CYLINDER TYPE</th>';
                echo '<th>BOOKING DATE</th>';
                echo '<th>NUMBER OF CYLINDER</th>';
                echo '<th>STATUS</th>';
                echo '<th colspan="2">PAYMENT TYPE</th>';
            echo '</tr>';
           
            
            while($r= mysqli_fetch_array($s))
            {
                echo '<tr>';
                echo '<td>'.$r['cName'].'</td>';
                echo '<td>'.$r['consumerno'].'</td>';
                echo '<td>'.$r['cType'].'</td>';
                echo '<td>'.$r['bdate'].'</td>';
                echo '<td>'.$r['nocyl'].'</td>';
                echo '<td>'.$r['status'].'</td>';
                echo '<td>'.$r['ptype'].'</td>';
                
                echo '</tr>';
            }
           
    echo '</table>';
    }
}
?>