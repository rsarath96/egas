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
    <h1 style="margin:50px;">Customer Registration</h1>
    <form method="POST" enctype="multipart/form-data">
    <table>
       <tr>
            <td>Name</td>
            <td><input type="text" class="form-control" name="txtName" pattern="[a-zA-Z ]+" required="" ></td>
        </tr>
        <tr>
            <td>Address</td>
            <td><textarea  name="txtAddress" class="form-control" required="" ></textarea></td>
        </tr>
        <tr>
            <td>Contact</td>
            <td><input type="text" class="form-control" name="txtContact" pattern="[6789][0-9]{9}" required="" ></td>
        </tr>
        <tr>
            <td>Email</td>
            <td><input type="email" class="form-control" name="txtEmail" required="" ></td>
        </tr>
        <tr>
            <td>Aadhar no</td>
            <td><input type="text" class="form-control" name="txtAadhar" pattern="[0-9]{12}" required="" ></td>
        </tr>
        <tr>
            <td>Ration card no</td>
            <td><input type="text" class="form-control" name="txtRation" pattern="[0-9]{10}"  required="" ></td>
        </tr>
        <tr>
            <td>Password</td>
            <td><input type="password" class="form-control" name="txtPwd" pattern="^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$" required="" ></td>
        </tr>
        <tr>
            <td>Cylinder type</td>
                    <td><select class="form-control" name="type" >
                            <option>Domestic</option>
                            <option>Commercial</option>
                </select></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" class="btn btn-danger" name="btnSubmit" value="Register"></td>
        </tr>
    </table>
   
</form>
</div>
<?php
if(isset($_REQUEST['btnSubmit']))
{
    function SendSMS($mob,$msg)
		{
				$request =""; //initialise the request variable
				$param['method']= "sendMessage";
				$param['send_to'] = "91".$mob;
				$param['msg'] = $msg;
				$param['userid'] = "2000022557";
				$param['password'] = "54321@lcc";
				$param['v'] = "1.1";
				$param['msg_type'] = "TEXT"; //Can be "FLASH?/"UNICODE_TEXT"
				$param['auth_scheme'] = "PLAIN";
				//Have to URL encode the values
				foreach($param as $key=>$val) {
						$request.= $key."=".urlencode($val);
							//we have to urlencode the values
						$request.= "&";

				}
				$request = substr($request, 0, strlen($request)-1);
//remove final (&) sign from the request
			$url =
				"http://sms.mdsmedia.in/http-api.php?username=7000183&password=LCCCOK123&senderid=LCCCOK&route=23&number=".urlencode($mob)."&message=".urlencode($msg);
echo $url;
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$curl_scraped_page = curl_exec($ch);
curl_close($ch);
echo $curl_scraped_page;
//echo 'You complaint has been registered successfully. For further information please note your complaint ID:'.$id;

                }

    $name=$_REQUEST['txtName'];
    $address=$_REQUEST['txtAddress'];
    $contact=$_REQUEST['txtContact'];
    $email=$_REQUEST['txtEmail'];
    $aadhar=$_REQUEST['txtAadhar'];
    $ration=$_REQUEST['txtRation'];
    $pwd=$_REQUEST['txtPwd'];
    $type=$_REQUEST['type'];
    
    $q="select count(*) from tbllogin where uname='$contact'";
    $s= mysqli_query($conn, $q);
    $r= mysqli_fetch_array($s);
    if($r[0]>0)    //to check whether the username exist
    {
        echo '<script>alert("Username already exist")</script>';
    }
    else
    {
        
        $q="insert into tblcustomer (cName,cAddress,cContact,cEmail,cAadhar,cRation,cType) values('$name','$address','$contact','$email','$aadhar','$ration','$type')";
        $s= mysqli_query($conn, $q);
        if($s)  
        {
            $q="insert into tbllogin(uname,pwd,utype,status) values('$contact','$pwd','customer','0')";
            $s= mysqli_query($conn, $q);
            if($s)
            {
                $msg="Thank you for registration. Please wait for approval";
                SendSMS($contact, $msg);
                echo '<script>alert("Registration successful")</script>';
                echo '<script>location.href="registration.php"</script>';
            }
            else
            {
                echo '<script>alert("Sorry some error occured")</script>';
            }
        }
        else
        {
            echo '<script>alert("Registration failed")</script>';
        }
    }
}
?>