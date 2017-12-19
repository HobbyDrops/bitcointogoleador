<?php
	// Recuperiamo il valore del bitcoin dall'API
	  $url = "https://bitpay.com/api/rates";
	  $json = file_get_contents($url);
      $data = json_decode($json, TRUE);
      $rate = $data[2]["rate"];   
	
	// Separiamo il valore in Euro e centesimi di Euro
	  $euro = floor($rate);
	  $centesimi = round($rate - $euro,2);

	// Ricaviamo i multipli che ci servono per visualizzare le Goleador
	  
	  // Pacco da 200 Goleador che vale 20 €
	  $venti_euro = floor($euro/20);

	  // Fila da 100 Goleador che vale 10 €
	  $dieci_euro = floor(($euro-$venti_euro*20)/10);	

	  // Fila da 10 Goleador che vale 1 €
	  $un_euro  = floor(($euro-($venti_euro*20)-($dieci_euro*10)));	

	// Il totale delle Goledor ci serve per visualizzarlo all'inizio della pagina
	  $totale_goleador = ($venti_euro*200) + ($dieci_euro*100) + ($un_euro*10) + floor($centesimi*10);
?>


<!doctype html>
<html lang="it">

  <head>
	<title>Bitcoin to Goleador</title>

    <!-- JQuery CDN -> Ci farà comodo averlo--> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  	<!-- Bootstrap CDN -> Rende tutto più carino-->
  	<script async  src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
  	<link  rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" />
  </head>
	
  <body style="text-align: center">
      <div class="page-header col-sm-offset-1 col-sm-10 col-md-offset-3 col-md-6">
          <h1>Bitcoin in Goleador</h1>
          <p>Quante Goleador ci vogliono per fare un Bitcoin</p>
      </div>

      <section class="contatore col-sm-offset-1 col-sm-8 col-md-6 col-md-offset-3" style="text-align: center;">
		<h2 style=""><?php echo 'un Bitcoin adesso vale ben <b>' .number_format($totale_goleador).  ' Goleador:</b>'; ?></h2>
	 </section>
  </body>
	
</html>
<script>
	//visualizziamo i pacchetti da 200 Goleador
	for (var i = 0; i< <?php echo $venti_euro;?>;i++){
		$(".contatore").append('<img src="images/200-goleador.png" alt="200-goledor">');
	}
	//visualizziamo i gruppi da 100 Goleador
	for (var i = 0; i< <?php echo $dieci_euro;?>;i++){
		$(".contatore").append('<img src="images/100-goleador.png" alt="100-goledor">');
	}
	//visualizziamo i gruppi da 10 Goleador
	for (var i = 0; i< <?php echo $un_euro;?>;i++){
		$(".contatore").append('<img src="images/10-goleador.png" alt="10-goledor">');
	}
	//visualizziamo le singole Goleador
	for (var i = 0; i< <?php echo floor($centesimi*10);?>;i++){
		$(".contatore").append('<img src="images/goleador.png" alt="1-goledor">');
	}

</script>
