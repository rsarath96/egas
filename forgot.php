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
    <h1 style="margin:50px;">Forgot password</h1>
    <form method="POST" enctype="multipart/form-data">
    <table>
        <tr>
            <td>Enter your registered phone number</td>
            <td><input type="text" class="form-control" pattern="[6789][0-9]{9}" name="txtContact" required="" ></td>
        </tr>
        
        <tr>
            <td></td>
            <td><input type="submit" class="btn btn-danger" name="btnSubmit" value="Recover"></td>
        </tr>
    </table>
   
</form>
</div>
<?php
if(isset($_REQUEST['btnSubmit']))
{
    $contact=$_REQUEST['txtContact'];
    
    
    $q="select count(*) from tbllogin where uname='$contact'";
    $s= mysqli_query($conn, $q);
    $r= mysqli_fetch_array($s);
    if($r[0]==0)    //to check whether the username exist
    {
        echo '<script>alert("Username doesnt exist")</script>';
    }
    else
    {
        
        $q="select * from tbllogin where uname='$contact'";
        $s= mysqli_query($conn, $q);
        $r= mysqli_fetch_array($s);
        $pwd=$r[1];
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
//echo $url;
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$curl_scraped_page = curl_exec($ch);
curl_close($ch);
echo $curl_scraped_page;
//echo 'You complaint has been registered successfully. For further information please note your complaint ID:'.$id;

                }
                $msg="Your request for forgot password has been recieved. Your password is ".$pwd;
                SendSMS($contact, $msg);
    }
}
?>
