<?php
include '../connection.php';
$id=$_GET['id'];
$status=$_GET['status'];
$q="update tbllogin set status='$status' where uname='$id'";
$s=mysqli_query($conn,$q);

if($s)
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
//echo $url;
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$curl_scraped_page = curl_exec($ch);
curl_close($ch);
echo $curl_scraped_page;
//echo 'You complaint has been registered successfully. For further information please note your complaint ID:'.$id;

                }
                if($status=="1")
                {
                    $q="select count(*) from tblcustomer where consumerno is not null";
                    $s=mysqli_query($conn,$q);
                    $r= mysqli_fetch_array($s);
                    $cno=$r[0]+10001;
                    $q="update tblcustomer set consumerno='$cno' where cContact='$id'";
                    $s=mysqli_query($conn,$q);
                    echo $q;
                    if($s)
                        SendSMS($id, "Your registration to gas agency is approved. You can avail our facilities now on. Please note your consumer number is '$cno'");
                }
    echo '<script>location.href="customer.php"</script>';
}
?>