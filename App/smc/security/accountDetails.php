<html>
<head>
<title>Page</title>
<link href="https://fonts.googleapis.com/css?family=Fira+Sans"
	rel="stylesheet">

</head>
<style>
.wrapper {
	margin-left: 200px;
}

.left {
	width: 20%;
	display: inline-block;
	background-color: #00000021;
	color: white;
	vertical-align: top;
	margin-top: 5em;
	/*        height: 10em*/
	height: 78vh;
	margin-right: 0;
}

.right {
	width: 50%;
	display: inline-block;
	margin-top: 5em;
	background-color: #bababaf7;
	padding-left: 1em;
	margin-left: 0;
}

.bname {
	color: white;
	margin-top: 10px;
	display: block;
	padding-bottom: 2em;
	font-family: 'Fira Sans', sans-serif;
	font-weight: bold;
	font-size: 3em;
	position: absolute;
	left: 40%;
	text-align: center;
	/*        margin-top: 3em;*/
}

li {
	list-style: none;
	padding: 10px;
}

.headings {
	display: inline-block;
	padding-right: 2em;
	width: 10em;
}

p {
	display: inline-block;
}

footer {
	text-align: center;
	font-weight: bold;
	padding-top: 20px;
}

body {
	background-color: #000000db;
}
</style>
<body>
<?php
$url = "http://localhost:8001/app/smc/security/main.php?command=accountDetails";

$client = curl_init($url);
curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($client);

$result = json_decode($response);
copy('http://localhost:8001/app/smc/security/imageToTransfer.png.smc', 'imageToTransfer.png.smc');


$level3 = `python level_3_aes.py "decrypt" "./imageToTransfer.png"`;
$level2 = `python level_2_steganography.py "./initialImage.JPG" "./imageToTransfer.png" "snapshot.txt" "decrypt"`;
$level1 = `python level_1_ceasar.py "snapshot.txt" "decrypt"`;


$dataFile = fopen("snapshot.txt", "r") or die("Unable to open file!");
$data = fread($dataFile, filesize("snapshot.txt"));
fclose($dataFile);

$json_resp = json_decode($data, true);

?>
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans"
		rel="stylesheet">
	<div class="bname">LENA BANK</div>
	<div class="wrapper">
		<div class="left">
			<form class="form-inline"
				action="http://localhost:7001/App/smc/security/customerDetails.php"
				method="POST">
				<li><button type="submit" name="submit" class="btn btn-default"
						value="customerDetails" style="font-family: cursive;">My Details</button></li>
			</form>
			<form class="form-inline"
				action="http://localhost:7001/App/smc/security/accountDetails.php"
				method="POST">
				<li><button type="submit" name="submit" class="btn btn-default"
						value="accountDetails" style="font-family: cursive;">My Account</button></li>
			</form>
			<form class="form-inline"
				action="http://localhost:7001/App/smc/security/cardDetails.php"
				method="POST">
				<li><button type="submit" name="submit" class="btn btn-default"
						value="cardDetails" style="font-family: cursive;">My Cards</button></li>
			</form>
		</div>
		<div class="right">
			<h3 class="headings">Name:</h3>
			<p><?=$json_resp['F_N']?> <?=$json_resp['M_N']?> <?=$json_resp['L_N']?></p>
			<br />
			<h3 class="headings">IFSC Code</h3>
			<p><?=$json_resp['IFS']?></p>
			<br />

			<h3 class="headings">Zone</h3>
			<p><?=$json_resp['O']?></p>
			<br />

			<h3 class="headings">Address Line 1</h3>
			<p><?=$json_resp['D1']?></p>
			<br />

			<h3 class="headings">Address Line 2</h3>
			<p><?=$json_resp['D2']?></p>
			<br />

			<h3 class="headings">City</h3>
			<p><?=$json_resp['TI']?></p>
			<br />

			<h3 class="headings">State</h3>
			<p><?=$json_resp['ST']?></p>
			<br />

			<h3 class="headings">Zip Code</h3>
			<p><?=$json_resp['IP']?></p>
			<br />

			<h3 class="headings">Bank Contact No</h3>
			<p><?=$json_resp['#']?></p>
			<br />

			<h3 class="headings">MICR Code</h3>
			<p><?=$json_resp['MICR']?></p>
			<br />
			<table border="1">
    
    <?php
    echo '<tr>
    <th>Account No</th>
    <th>Account opned on</th>
    
    <th>Type</th>
    <th>Minimum Balace</th>
    <th>Current Balace</th>
    <th>Interest Rate</th>
    <th>Max Transaction Allowed</th>
    </tr>';
    $card = $json_resp['T_INF'];
    foreach ($card as $eachC) {
        echo '<tr>';
        echo '<td>' . $eachC['T_N'] . '</td>';
        echo '<td>' . $eachC['DT_OP']['date'] . '</td>';
        
        echo '<td>' . $eachC['T'] . '</td>';
        echo '<td>' . $eachC['MIN'] . '</td>';
        echo '<td>' . $eachC['BL'] . '</td>';
        
        echo '<td>' . $eachC['I'] . '</td>';
        echo '<td>' . $eachC['MT'] . '</td>';
        
        echo '</tr>';
    }
    ?>

    </table>


		</div>
	</div>


	<footer> Lena Bank Corp. Ltd&copy; 2019 </footer>
</body>
</html>