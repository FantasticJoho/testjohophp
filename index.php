<?php
if(isset($_POST['submit'])){
    $from = "jonathan@hawaii.fr"; // this is your Email address
    $to = $_POST['email']; // this is the sender's Email address
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $subject = "Form submission";
    $subject2 = "Copy of your form submission";
    $message = $first_name . " " . $last_name . " wrote the following:" . "\n\n" . $_POST['message'];
    $message2 = "Here is a copy of your message " . $first_name . "\n\n" . $_POST['message'];

    $headers = "From:" . $from;
    $headers2 = "From:" . $to;
   // mail($to,$subject,$message,$headers);
    //mail($from,$subject2,$message2,$headers2); // sends a copy of the message to the sender

    // You can also use header('Location: thank_you.php'); to redirect to another page.
	$url = 'https://api.sendgrid.com/';
	$user = 'azure_bfe240f93ba9c54cbfb70cceae4a5b1f@azure.com';
	$pass = 'Pas$word1';
	move_uploaded_file(file,newloc);
	$tmp_name=$first_name.$last_name.".pdf";
	move_uploaded_file($_FILES['filetoprocess']['tmp_name'], $tmp_name);
	$params = array(
		 'api_user' => $user,
		 'api_key' => $pass,
		 'to' => $to,
		 'subject' => $subject,
		 'html' => $message,
		 'text' => $message,
		 'from' => $from,
		 'files['.$_FILES['filetoprocess']['name'].']' => '@'.$tmp_name
	  );

	$request = $url.'api/mail.send.json';

	// Generate curl request
	$session = curl_init($request);

	// Tell curl to use HTTP POST
	curl_setopt ($session, CURLOPT_POST, true);

	// Tell curl that this is the body of the POST
	curl_setopt ($session, CURLOPT_POSTFIELDS, $params);

	// Tell curl not to return headers, but do return the response
	curl_setopt($session, CURLOPT_HEADER, false);
	curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

	// obtain response
	$response = curl_exec($session);
	curl_close($session);

	// print everything out
	print_r($response);
}
?>

<!DOCTYPE html>
<head>
<title>Form submission</title>
</head>
<html>
<body>

	<form action="" method="post" enctype="multipart/form-data">
		First Name:
		<input type="text" name="first_name" />
		<br />
		Last Name:
		<input type="text" name="last_name" />
		<br />
		Email:
		<input type="text" name="email" />
		<br />
		Message:
		<br />
		<textarea rows="5" name="message" cols="30"></textarea>
		<br />
		<input type="file" name="filetoprocess" />
		<input type="submit" name="submit" value="Submit" />
	</form>

</body>
</html>