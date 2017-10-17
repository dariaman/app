<style>
.orange-circle-button {
	box-shadow: 2px 4px 0 2px rgba(0,0,0,0.1);
	border: .5em solid #E84D0E;
	font-size: 1em;
	line-height: 1.1em;
	color: #ffffff;
	background-color: #e84d0e;
	margin: auto;
	border-radius: 50%;
	height: 7em;
	width: 7em;
	position: relative;
}
.orange-circle-button:hover {
	color:#ffffff;
    background-color: #e84d0e;
	text-decoration: none;
	border-color: #ff7536;
	
}
.orange-circle-button:visited {
	color:#ffffff;
    background-color: #e84d0e;
	text-decoration: none;
	
}
.orange-circle-link-greater-than {
    font-size: 1em;
}
</style>

<script>
var kunci_jawaban = ["Dikejar Agen","Barbell","Jagadiri","Sakit","Tidur","Kecelakaan","Rumah Sakit","Suntik","Catwalk","Photoshoot","Trendsetter","Nonton Gratis","Belanja Online","Credit Card","Merchant Discount","Majalah","Fotografer","Editor","Account Executive","Klien Gengges","Lipstick","Bedak","Mascara","Blush On","Eye shadow","Eye liner","Kalung","Mobil","Motor","Kereta","Pesawat","Rokok","Kacamata","Gigi","Alis","Bulu mata","Underwritting","Underwear","Catokan","Sisir","Creambath","Ambulance","Dokter","Suster","Opname","Infus","Wasir","Demam Berdarah","Ambil darah","Meninggal"];
var count=0;

function startTimer(duration, display, keyword) {
    var timer = duration, minutes, seconds;
	var random=Math.floor((Math.random() * 50) + 1);
	keyword = document.querySelector('#jawaban');
	keyword.textContent =  kunci_jawaban[random];
    setInterval(function () {
        minutes = parseInt(timer / 60, 10)
        seconds = parseInt(timer % 60, 10);

        minutes = minutes < 10 ? "0" + minutes : minutes;
        seconds = seconds < 10 ? "0" + seconds : seconds;

        display.textContent =  seconds;
	
	//button = document.querySelector('#play-game').textContent =  "BERHENTI";
	//button = document.querySelector('#play-game').disabled = true;

        if (--timer < 0) {

		if(count>=5){
	            timer = 00;
		keyword.textContent =  "Waktu Habis";

		//count=0;
		location.reload();
		//	button = document.querySelector('#play-game').style.visibility = 'visible'; 
		}else{


            timer = 45;
		var random=Math.floor((Math.random() * 20) + 0);
		keyword.textContent =  kunci_jawaban[random];

		count++;
		coba = document.querySelector('#try');
		coba.textContent =  count;


		}
	

        }
    }, 1000);

}


window.onload = function () {
    //var fiveMinutes = 60 * 5,
};
function mulai(){
//count=0;
	button = document.querySelector('#play-game').style.visibility = 'hidden'; 
	count++;
	coba = document.querySelector('#try');
	coba.textContent =  count;
	
	var timePlay = 45,
        display = document.querySelector('#time');
	keyword = document.querySelector('#jawaban');
    startTimer(timePlay, display, keyword);
	var random=Math.floor((Math.random() * 50) + 1);
	keyword.textContent =  kunci_jawaban[random];
}
</script>

<div class="row" >
	<div class="col-sm-12 col-xs-12" >
	<br>
	<center><span id="try">0</span>/5</center>
	<br>
	</div>
</div>



<div class="row" >
	<div class="col-sm-12 col-xs-12" >
	<center>Waktu : <span id="time">45</span> detik</center>
	<br>
	</div>
</div>

<div class="row" >
	<div class="col-sm-12 col-xs-12"  style="font-size:60px;font-weight:bold;">
		<center><span id="jawaban">TEBAK KATA</span></center>
	<br>
	</div>
	
</div>

<div class="row" >
	
	<div class="col-sm-12	" >

	<center><button class="btn btn-default orange-circle-button" id="play-game" onclick="mulai()" >Mulai<span class="orange-circle-greater-than"></span></button></center>
	</div>
	
</div>

