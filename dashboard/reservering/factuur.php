<?php
	require_once(__DIR__."/reservering_php/reservering_sql.php");
	$reservering = selectReservering($_GET["reservering_id"]);
?>

<html>
	<head>
        <title>Factuur</title>
		<style>
			#factuur {
				max-width: 800px;
				margin: auto;
				padding: 30px;
				border: 1px solid #eee;
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				font-size: 16px;
				line-height: 24px;
				font-family: sans-serif;
				color: #555;
			}

			#factuur table {
				width: 100%;
				line-height: inherit;
				text-align: left;
			}


		</style>
	</head>

	<body>
		<div id="factuur">
            <table>
                <tr>
                    <td id="logo"><img src="../../assets/img/logo.png"/ style="max-width: 50%; height: auto;"></td>
                    <td>
						<p>La Rustique</p>
						<p>63420 Ardes</p>
						<p>04-76372000 | info@larustique.com</p>
					</td>
                </tr>
				<tr>
					<td>
						<p><?= $reservering->voornaam ?> <?= $reservering->tussenvoegsel ?> <?= $reservering->achternaam ?></p>
						<p>Begin Datum: <?= $reservering->begin_datum ?></p>
						<p>Eind Datum: <?= $reservering->eind_datum ?></p>
						<hr>
					</td>
				</tr>
				<tr>
					<td><h2>Factuur</h2>
						<p>Factuurnummer: <?= rand(100000000,999999999)  ?></p>
						<p>Factuurdatum: <?= date("Y/m/d") ?></p>
						<hr>
					</td>
				</tr>
				<tr>
					<th>Dingen</th><th>Quantiteit</th><th style="float: right;">Prijs</th>
					<?php 
						foreach($reservering->return_factuur() as $r){
							echo "<tr><td>".$reservering->return_fancy_name($r[0])."</td><td>".."</td></tr>"
						}
					?>
				</tr>
            </table>
		</div>
	</body>
</html>
