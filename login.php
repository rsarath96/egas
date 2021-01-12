<?php
session_start(); //to start the session
include 'header.php';
include 'connection.php';
?>
<style>
    td,th{
        padding: 10px;
    }
    
</style>
<div style="margin-top: 50px; margin-left: 150px; ">
    <h1 style="margin:50px;">Login</h1>
    <form method="POST" enctype="multipart/form-data">
    <table>
       
        <tr>
            <td>Username</td>
            <td><input type="text" class="form-control" name="txtEmail" required="" ></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" class="form-control" name="txtPwd" required="" ></td>
        </tr>
        
        <tr>
            <td><a href="forgot.php">Forgot password???</a></td>
            <td><input type="submit" class="btn btn-danger" name="btnSubmit" value="Login"></td>
        </tr>
    </table>
   
</form>
</div>
<?php
if(isset($_REQUEST['btnSubmit']))
{
    $email=$_REQUEST['txtEmail'];
    $pwd=$_REQUEST['txtPwd'];
    
    $q="select count(*) from tbllogin where uname='$email'";
    $s= mysqli_query($conn, $q);
    $r= mysqli_fetch_array($s);
    if($r[0]==0)    //to check whether the username exist
    {
        echo '<script>alert("Username doesnt exist")</script>';
    }
    else
    {
        $_SESSION['email']=$email;    //creating a session variable
        $q="select * from tbllogin where uname='$email'";
        $s= mysqli_query($conn, $q);
        $r= mysqli_fetch_array($s);
        if($r['pwd']==$pwd)  //to check the password entered by user with the password in database
        {
            if($r['status']=="1")  //to check the status of user
            {
                if($r['utype']=="admin")  //to check the usertye/role of the user
                {
                    echo '<script>location.href="admin/adminhome.php"</script>';
                }
                else if($r['utype']=="employee")
                {
                    echo '<script>location.href="employee/employeehome.php"</script>';
                }
                else if($r['utype']=="customer")
                {
                    echo '<script>location.href="customer/customerhome.php"</script>';
                }
            }
            else
            {
                echo '<script>alert("Your account is not valid")</script>';
            }
        }
        else
        {
            echo '<script>alert("Incorrect password")</script>';
        }
    }
}
?>
