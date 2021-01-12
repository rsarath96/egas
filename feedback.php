<?php
include 'header.php';
include 'connection.php';
?>
<style>
    td,th{
        padding: 10px;
    }
    
</style>
<div style="margin-top: 50px; margin-left: 150px; ">
    <h1 style="margin:50px;">Feedback</h1>
    <form method="POST" enctype="multipart/form-data">
    <table border="1">
         <tr>
                <th> CUSTOMER</th>
                <th> DATE</th>
                <th>FEEDBACK</th>
                
            </tr>
            <?php
            $q="select tblcustomer.*,tblfeedback.* from tblfeedback,tblcustomer where tblcustomer.cContact=tblfeedback.cContact";
            $s= mysqli_query($conn, $q);
            while($r= mysqli_fetch_array($s))
            {
                echo '<tr>';
                echo '<td>'.$r['cName'].'</td>';
                echo '<td>'.$r['fdate'].'</td>';
                echo '<td>'.$r['feedback'].'</td>';
                echo '</tr>';
            }
            ?>
    </table>
</form>
</div>
<?php
if(isset($_REQUEST['btnSubmit']))
{
    $feedback=$_REQUEST['txtFeedback'];
      
        $q="insert into tblfeedback (cContact,fdate,feedback) values('$email',(select sysdate()),'$feedback')";
        $s= mysqli_query($conn, $q);
        if($s)  
        {
                echo '<script>alert("Feedback added")</script>';
                echo '<script>location.href="feedback.php"</script>';
            
        }
        else
        {
            echo '<script>alert("Sorry some error occured")</script>';
        }
    
}
?>
