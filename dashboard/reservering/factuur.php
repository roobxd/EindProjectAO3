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

			.details{
				font-size:15px;
			}

		</style>
	</head>

	<body>
		<div id="factuur">
            <table>
                <tr>
                    <td>
						<img src="../../assets/img/logo.png" style="max-width: 50%; height: auto;">
						<p>La Rustique</p>
						<p class="details">63420 Ardes<br>
						Tel: 04-76372000<br>
						info@larustique.com</p>
					</td>
                </tr>
				<tr>
					<td colspan=100%>
						<p><?= $reservering->voornaam ?> <?= $reservering->tussenvoegsel ?> <?= $reservering->achternaam ?></p>
						<p class="details">Begin Datum: <?= $reservering->begin_datum ?><br>
						Eind Datum: <?= $reservering->eind_datum ?></p>
						<hr>
					</td>
				</tr>
				<tr>
					<td colspan=100%;>
						<h2>Factuur</h2>
						<p class="details">Factuurnummer: <?= rand(100000000,999999999)  ?><br>
						Factuurdatum: <?= date("Y/m/d H:m:s") ?></p>
						<hr>
					</td>
				</tr>
				<tr>
					<th>Beschrijving</th><th>Quantiteit</th><th style="float: right;">Prijs</th>
					<?php 
						foreach($reservering->return_factuur() as $r){
							echo "<tr><td>".$reservering->return_fancy_name($r)."</td><td>".($r == "")."</td><td>€".$reservering->calculate_price($r)."</td></tr>";
						}
						echo "<tr><td colspan='100%'><hr></td></tr>";
						echo "<tr><td>Totaal Prijs:</td><td></td><td>€".$reservering->calculate_price(NULL)."</td></tr>";
					?>
				</tr>
            </table>
		</div>
	</body>
</html>
