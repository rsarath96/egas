<?php //
session_start();
include '../connection.php';
include 'header.php';
$email=$_SESSION['email'];
$qry="select * from tbluser where cContact='$email'";
$res=mysql_query($qry);
$r=mysql_fetch_array($res);
?>
<style>
    td,th{
        padding: 10px;
    }
</style>
<form style="margin-left: 350px; width:550px;" method="POST" enctype="multipart/form-data">
    
     
    <table style="margin: 50px 10px 10px 170px;" align="center" >
            <br><br><h2  align="center" > <b>Profile</b></h2>
            <tr>
                <td><b>Name :</b></td>
                <td><input type="text" name="txtName" value="<?php echo $r['cName']; ?>" required="" pattern="[a-zA-Z ]+" class="form-control"/></td>
            </tr>
            <tr>
                <td><b>Address :</b></td>
                <td><textarea name="txtAddress" required="" class="form-control"><?php echo $r['cAddress']; ?></textarea></td>
            </tr>
            <tr>
                <td><b>Contact :</b></td>
                <td><input type="text" name="txtContact" required="" pattern="[6789][0-9]{9}" value="<?php echo $r['cContact']; ?>" class="form-control"/></td>
            </tr>
            <tr>
                <td><b>Email :</b></td>
                <td><input type="email" name="txtEmail" required="" value="<?php echo $r['cEmail']; ?>" class="form-control"/></td>
            </tr>
            
           
            
    </table>
    
            </form>
