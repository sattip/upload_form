<html>
  <head>
		<title>Simple PHP Form Example</title>
	</head>
	<body>
	  <p>
		<form method="post" action="upload_form.php" enctype="multipart/form-data">
			First Name: <input type="text" name="first_name">
			<br/>Last Name: <input type="text" name="last_name">
			<br /> <input type="file" name="file">
			<br/><input type="submit" value="submit" name="submit">
		</form>
	  </p>
	</body>
</html>
