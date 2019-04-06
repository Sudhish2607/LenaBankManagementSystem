<html>
<head>
<link rel="stylesheet" href="App/smc/styles/login.css">

<script type="text/javascript"
	src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>



</head>
<body>
	<div class="heading">
		<br> <br>
		<h1>LENA BANK</h1>
	</div>
	<div class="container">
		<form class="form" action="" method="POST">
			<table>
				<tbody>
					<tr>
						<td>Username: <input type="text" name="username">
						</td>
					</tr>
					<tr>
						<td>Password: <input type="text" name="password">
						</td>
					</tr>
					<tr>
						<td><input type="submit" name="submit" id="clickLog" value="Login">
						</td>
					</tr>
				</tbody>
			</table>
		</form>
	</div>

	<script type="text/javascript">

			$(document).ready(function() {

				  $("#clickLog").click(function() {
alert('hii');
				  }

				  </script>
  
  
  <?php
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password = hash('ripemd160', $password);
    
    $url = "http://localhost:8001/app/smc/security/main.php?command=login&user=" . $username . "&pass=" . $password;
    
    $client = curl_init($url);
    curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($client);
    
    $result = json_decode($response);
    // echo "hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh".$password;
}
?>
</body>
</html>

