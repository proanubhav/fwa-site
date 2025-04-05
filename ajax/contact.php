<?php
//require_once('../administrator/setting.php');
extract($_POST);

$showerror = true;
$error = array();
$displayError = array();

// foreach ($_POST as $key => $value) // for generic errors
// {
// 	//echo $key . ": ". $value . "\n";
// 	if ($value == '')
// 	$error[$key]= $key.' error';
// }
	
			if($name=='')
			$error['name_error']='Please enter your Name';
		
			if($email=='')
			$error['email_error']='Please enter your Email';
			if (!preg_match('/([\w\-]+\@[\w\-]+\.[\w\-]+)/', $email)) 
				$error['email_error']='Invalid Email';
				
			if($contact=='')
				$error['contact_error']='Please Enter your Contact Number';
			
			elseif(strlen($contact)!=10)
				$error['contact_error']='Please Enter 10 Digit Contact Number';
				
			if($message=='')
				$error['message_error']='Please Enter Your Message';
				
			if($error == null){
			
				$showerror=false;
				//echo 'mailed';
				//$date=date("Y-m-d");
			    
			//$fields=array('name','company','email','contact','intrested_service','query_details','date');
			//$data=array($name,$company,$email,$contact,$interested_in,$message,$date);
			//$lastid=$objComm->insertWithLastid($fields,$data,'tbl_contact_query');	
			
			$content =		
				"Hello "."Admin".": \n<br>".
				"Name :" .$name." \n<br>".
				//"Company :" .$company." \n<br>".
				"E-Mail :" .$email." \n<br>".
				"Contact Number :" .$contact." \n<br>".
				//"Interested In :" .$interested_in." \n<br>".
				"Message :" .$message." \n<br>".

				"Above Person Contacted You,\n<br>".
				$subject = "Contact Form";
				$sent_from = $email;
				$sent_to= "ya.yellowapricots@gmail.com, caffeinatednerds@gmail.com, kumartapas21194@gmail.com, proanubhav@gmail.com";

					$headers  = 'MIME-Version: 1.0' . "\r\n";
					$headers .= 'From:'.'<'.$email.'>' . "\r\n";
					$headers .= 'Reply-To:'.'<ya.yellowapricots@gmail.com>' . "\r\n";
					$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		
	        	 mail($sent_to,$subject,$content,$headers);	
			}


			$displayError['display_errors']=$error;
			$displayError['error']=$showerror;
			$myJSON = json_encode($displayError);

			echo $myJSON;	

?>
