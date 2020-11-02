<?php
	function ambil($url){
		$client = curl_init($url);
		curl_setopt($client,CURLOPT_RETURNTRANSFER,true);
		$response = curl_exec($client);
		$result = json_decode($response);

		return $result;
	}
	$Last_Update 		= date("l d F Y");
?>
<!doctype html>
<html lang="en">
  <head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<!-- Required meta tags -->
	
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<!-- Font Awesome -->
	<link href="css/all.css" rel="stylesheet">
	<link href="css/fontawesome.css" rel="stylesheet">
    <link href="css/brands.css" rel="stylesheet">
    <link href="css/solid.css" rel="stylesheet">
    <style>
        hr{
            margin: 0px 0px;
            padding: 0px 0px;
        }
    </style>
	<title>IT Papua Pantau COVID-19</title>
  </head>
  <body>
	<nav class="navbar navbar-expand-lg navbar-dark bg-primary fixed-top">
		<div class="container">
		  <a class="navbar-brand h1" href="https://itpapua.com/Pantau_Covid-19/">IT Papua Pantau COVID-19</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
    		  <li class="nav">
                <a class="nav-link">Live Data : <?= $Last_Update ?> </a>
              </li>
            </ul>
            <div class="btn-group btn-group-sm float-left">
                <button type="button" class="btn btn-light mode" onclick="setDarkMode(false)">Terang</button>
                <button type="button" class="btn btn-dark mode" onclick="setDarkMode(true)">Gelap</button>
              </div>
          </div>
		</div>
	</nav>
    
    <?php
        $indo = ambil("https://api.kawalcorona.com/indonesia/");
    	$Confirmed 			= $indo[0]->positif;
    	$Deaths 			= $indo[0]->meninggal;
    	$Recovered 			= $indo[0]->sembuh;
    	$kasus              = $Confirmed+$Deaths+$Recovered;
    
    	$prov = ambil("https://api.kawalcorona.com/indonesia/provinsi/");
    	
    	for($i=0; $i<=31; $i++){
    	    if($prov[$i]->attributes->Provinsi == 'Papua'){
    	        $a = $i;
    	    } elseif($prov[$i]->attributes->Provinsi == 'Papua Barat'){
    	        $b = $i;
    	    }
    	}
    	
    	$papua = $prov[$a]->attributes;
    	$barat = $prov[$b]->attributes;
    ?>
    <div class="py-2"><p class="h1"></p></div>
    
    
	<section id="bg1">
		<div class="container py-5">
			<div class="row justify-content-center1">
				<h3 class="col-md-12 text-center mb-2">Perkembangan Covid-19 di Indonesia dari Pantauan IT Papua</h3>
			</div>
			
			<div class="row justify-content-center my-3">
                <div class="col-lg-6 my-1">
                    <div class="card bg-light mb-3">
                      <p class="card-header text-dark">Data Kasus Covid-19 Seluruh Indonesia</p>
                      <div class="card-body text-center">
    			<h1 class="text-danger"><i class="fas fa-user-times fa-sm"></i> <?= $Deaths ?> <small>Orang Meninggal</small></h1>
                        <h1 class="text-warning"><i class="fas fa-user-cog fa-sm"></i> <?= $Confirmed ?> <small>Orang Positif</small></h1>
    			<h1 class="text-success"><i class="fas fa-user-check fa-sm"></i> <?= $Recovered ?> <small>Orang Sembuh</small></h1>
                      </div>
                    </div>
                </div>
			</div>
			
			<div class="row justify-content-center my-3">
				<div class="col-lg-4 my-1">
			    <div class="card text-white bg-info">
			      <div class="card-body">
			        <h1 class="card-title text-center"><?= $papua->Provinsi ?></h1>
			        <h3><i class="fas fa-user-cog fa-sm"></i> <?= $papua->Kasus_Posi ?> <small>Orang Positif</small></h3>
			        <h3><i class="fas fa-user-check fa-sm"></i> <?= $papua->Kasus_Semb ?> <small>Orang Sembuh</small></h3>
			        <h3><i class="fas fa-user-times fa-sm"></i> <?= $papua->Kasus_Meni ?> <small>Orang Meninggal</small></h3>
			      </div>
			    </div>
			  </div>
			  <div class="col-lg-4 my-1">
			    <div class="card text-white bg-info">
			      <div class="card-body">
			        <h1 class="card-title text-center"><?= $barat->Provinsi ?></h1>
			        <h3><i class="fas fa-user-cog fa-sm"></i> <?= $barat->Kasus_Posi ?> <small>Orang Positif</small></h3>
			        <h3><i class="fas fa-user-check fa-sm"></i> <?= $barat->Kasus_Semb ?> <small>Orang Sembuh</small></h3>
			        <h3><i class="fas fa-user-times fa-sm"></i> <?= $barat->Kasus_Meni ?> <small>Orang Meninggal</small></h3>
			      </div>
			    </div>
			  </div>
			</div>
		</div>
	</section>
	
	<hr>
	
	<section id="bg2">
		<div class="container py-5">
			<div class="justify-content-center">
				<h1 class="text-center mb-2">Data Provinsi Se-Indonesia</h1>
			</div>
			<div class="bg-white table-responsive table-hover">
			  <table class="table">
			    <thead>
				    <tr>
				      <th scope="col">Provinsi</th>
				      <th scope="col">Positif</th>
				      <th scope="col">Sembuh</th>
				      <th scope="col">Meninggal</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php for ($i=0; $i < 32; $i++) { ?>
					    <tr>
					      <td><?= $prov[$i]->attributes->Provinsi ?></td>
					      <td><?= $prov[$i]->attributes->Kasus_Posi ?></td>
					      <td><?= $prov[$i]->attributes->Kasus_Semb ?></td>
					      <td><?= $prov[$i]->attributes->Kasus_Meni ?></td>
					    </tr>
				  	<?php } ?>
				  </tbody>
			  </table>
			</div>
		</div>
	</section>
	
	<?php
	    $dunia = ambil("https://api.kawalcorona.com/");
	    $pos = ambil("https://api.kawalcorona.com/positif/");
	    $sem = ambil("https://api.kawalcorona.com/sembuh/");
	    $men = ambil("https://api.kawalcorona.com/meninggal/");
	?>
	
	<hr>
	
	<section id="bg3">
		<div class="container py-5">
			<div class="row justify-content-center1">
				<h3 class="col-md-12 text-center mb-2">Perkembangan Covid-19 Data Global dari Pantauan IT Papua</h3><br />
			</div>
			
			<div class="row justify-content-center my-3">
			  <div class="col-lg-4 my-1">
			    <div class="card text-white bg-danger">
			      <div class="card-body">
			        <h5 class="card-title text-center"><?= $men->name; ?></h5>
							<h2> <i class="fas fa-user-times fa-sm"></i> <?= $men->value; ?></h2>
			      </div>
			    </div>
			  </div>
			  <div class="col-lg-4 my-1">
			    <div class="card text-white bg-warning">
			      <div class="card-body">
			        <h5 class="card-title text-center"><?= $pos->name; ?></h5>
			        <h2> <i class="fas fa-user-cog fa-sm"></i> <?= $pos->value; ?></h2>
			      </div>
			    </div>
			  </div>
			  <div class="col-lg-4 my-1">
			    <div class="card text-white bg-success">
			      <div class="card-body">
			        <h5 class="card-title text-center"><?= $sem->name; ?></h5>
			        <h2> <i class="fas fa-user-check fa-sm"></i> <?= $sem->value; ?></h2>
			      </div>
			    </div>
			  </div>
			</div>
		  </div>
		</div>
	</section>

	<footer class="bg-secondary">
		<div class="container">
			<div class="row justify-content-center py-5">
				<p class="text-white text-center">Sumber Data 
				<a href="https://kawalcorona.com/api/">Kawal Corona API</a>. 
				<br>Live Data : <?= $Last_Update ?>
				<br>Powered by <a href="https://itpapua.com"><img src="assets/image/itpapua.png" height="50px"></a> 
				<br>Made with by <a href="https://api.whatsapp.com/send?phone=6281247721352&text=Hallo" target="_blank"><i class="fas fa-user"></i> Imanuel Nauw</a>
				</p>
			</div>
		</div>
	</footer>

	<!-- Optional JavaScript -->
	<script>
	    if(localStorage.getItem('theme') == 'dark'){
            setDarkMode(true);
	    }
        
	    function setDarkMode(isDark){
	            
	        if(isDark) {
	            document.getElementById("bg1").className = "bg-dark text-white";
	            document.getElementById("bg2").className = "bg-dark text-white";
	            document.getElementById("bg3").className = "bg-dark text-white";
	            localStorage.setItem('theme', 'dark');
	        } else {
	            document.getElementById("bg1").className = "";
	            document.getElementById("bg2").className = "";
	            document.getElementById("bg3").className = "";
	            localStorage.removeItem('theme');
	        }
	    }
	</script>
	<!-- jQuery first, then Popper.js, then Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
	<!-- Font Awesome -->
	<script defer src="js/brands.js"></script>
    <script defer src="js/solid.js"></script>
    <script defer src="js/fontawesome.js"></script>
  </body>
</html>
