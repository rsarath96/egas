<?php
session_start(); //to start the session
include 'header.php';
include '../connection.php';
$email=$_SESSION['email'];
$q="select consumerno,cContact from tblcustomer where cContact='$email' ";
//echo $q;
    $s= mysqli_query($conn, $q);
    $r= mysqli_fetch_array($s);
    $cno=$r[0];
    $contact=$r[1];
$q="select count(*) from tblbooking where cContact='$email' and (status='approved' || status='booked')";
    $s= mysqli_query($conn, $q);
    $r= mysqli_fetch_array($s);
    if($r[0]>0)    //to check whether the username exist
    {
        echo '<script>alert("You already have a booking in progress")</script>';
        echo '<script>location.href="bookings.php"</script>';
    }
?>
<style>
    td,th{
        padding: 10px;
    }
    
</style>
<div style="margin-top: 50px; margin-left: 150px; ">
    <h1 style="margin:50px;">Cylinder Booking</h1>
    <form method="POST" enctype="multipart/form-data">
    <table>
        <tr>
            <td>Consumer number</td>
            <td><input type="text" class="form-control" name="txtCno" value="<?php echo $cno; ?>" readonly="" ></td>
        </tr>
       <tr>
            <td>Date</td>
            <td><input type="text" class="form-control" name="txtDate" value="<?php echo date('d-m-Y') ?>"  readonly=""></td>
        </tr>
        
        <tr>
            <td>Number of cylinder</td>
            <td><input type="text" class="form-control" name="txtNo" value="1" readonly="" ></td>
        </tr>
        <tr>
            <td>Payment type</td>
                    <td><select class="form-control" name="type" >
                            <option>Cash on delivery</option>
                            <option>Online payment</option>
                </select></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" class="btn btn-danger" name="btnSubmit" value="Book now"></td>
        </tr>
    </table>
   
</form>
</div>
<?php
if(isset($_REQUEST['btnSubmit']))
{
    $date=$_REQUEST['txtDate'];
    $no=$_REQUEST['txtNo'];
    $type=$_REQUEST['type'];
    
      
        $q="insert into tblbooking (cContact,bdate,nocyl,ptype,status) values('$email',(select sysdate()),'1','$type','booked')";
        $s= mysqli_query($conn, $q);
        if($s)  
        {
//            if($type=="Cash on delivery")
//            {  
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
$msg="Thank you for booking for the refil cylinder for the consumer no:".$cno.". Please wait for the approval.";
SendSMS($contact, $msg);
                echo '<script>alert("Booking successful")</script>';
                echo '<script>location.href="bookings.php"</script>';
//            }
//            else if($type=="Online payment") {
//                $q="select cType from tblcustomer where cContact='$email'";
//                $s= mysqli_query($conn, $q);
//                $r= mysqli_fetch_array($s);
//                $amt=0;
//                if($r[0]=="Domestic")
//                {
//                    $amt=750;
//                }
//                else 
//                    { $amt=900;  }
//                echo '<script>alert("Booking successful")</script>';
//                echo '<script>location.href="payment.php?amt='.$amt.'"</script>';
//            }
        }
        else
        {
            echo '<script>alert("Booking failed")</script>';
        }
    
}
?>
