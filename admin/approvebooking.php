<?php
include '../connection.php';
$id=$_GET['id'];
$status=$_GET['status'];
$otp= rand(1000, 9999);
$q="update tblbooking set status='$status', otp='$otp' where bookingid='$id'";
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
                if($status=="approved")
                {
                $q="select cContact from tblbooking where bookingid='$id'";
                $s=mysqli_query($conn,$q);
                $r= mysqli_fetch_array($s);
                $phn=$r[0];
                $msg="Your booking for the booking id ".$id." has been approved. OTP for delivery is: ".$otp;
                
                    SendSMS($phn,$msg );
}
    echo '<script>location.href="bookings.php"</script>';
}
?>