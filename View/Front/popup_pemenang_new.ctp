<script src="<?php echo $this->Html->url("/");?>linequiz-assets/js/jquery.js"></script>
<style>
    /*http://www.w3schools.com/howto/howto_css_modals.asp*/
    #mask {
  position:absolute;
  left:0;
  top:0;
  z-index:9000;
  background-color:#000;
  display:none;
}  
#boxes .window {
  position:absolute;
  left:0;
  top:0;
  width:440px;
  height:200px;
  display:none;
  z-index:9999;
  padding:20px;
  border-radius: 15px;
  text-align: center;
}
#boxes #dialog {
    width:450px; 
    height:auto;
    padding:10px;
    background-color:#ffffff;
    font-family: 'Segoe UI Light', sans-serif;
    font-size: 15pt;
}
.maintext{
	text-align: center;
  font-family: "Segoe UI", sans-serif;
  text-decoration: none;
}
body{
  background: url('bg.jpg');
}
#lorem{
	font-family: "Segoe UI", sans-serif;
	font-size: 12pt;
  text-align: left;
}
#popupfoot{
	font-family: "Segoe UI", sans-serif;
	font-size: 16pt;
  padding: 10px 20px;
}
#popupfoot a{
	text-decoration: none;
}

.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    
}



/* Modal Content */
.modal-content {
    background-color: #fefefe;
    margin: auto;
    padding: 20px;
    border: 1px solid #888;
    /*width: 80%;*/
    width: 350px;
}

/* The Close Button */
.close {
    color: #aaaaaa;
    float: right;
    font-size: px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}
</style>
<script type="text/javascript">
    $(document).ready(function() {	

		var id = '#dialog';
	
		//Get the screen height and width
		var maskHeight = $(document).height();
		var maskWidth = $(window).width();
	
		//Set heigth and width to mask to fill up the whole screen
		$('#mask').css({'width':maskWidth,'height':maskHeight});
		
		//transition effect		
		$('#mask').fadeIn(500);	
		$('#mask').fadeTo("slow",0.9);	
	
		//Get the window height and width
		var winH = $(window).height();
		var winW = $(window).width();
              
		//Set the popup window to center
		$(id).css('top',  winH/2-$(id).height()/2);
		$(id).css('left', winW/2-$(id).width()/2);
	
		//transition effect
		$(id).fadeIn(2000); 	
	
	//if close button is clicked
	$('.window .close').click(function (e) {
		//Cancel the link behavior
                //alert("Voucher akan dikirim");
		e.preventDefault();
		
		$('#mask').hide();
		$('.window').hide();
                
	});		
	
	//if mask is clicked
	$('#mask').click(function () {
		$(this).hide();
		$('.window').hide();
                //alert("voucher anda akan dikirim ke alamat rumah dalam waktu 30hari");
	//modal voucher anda akan dikirim ke alamat rumah dalam waktu 30hari
var modal = document.getElementById('myModal');

// Get the button that opens the modal
//var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 

$('#myModal').fadeIn(500);	
$('#myModal').fadeTo("slow",100);	

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
	});
/*
	//modal voucher anda akan dikirim ke alamat rumah dalam waktu 30hari
var modal = document.getElementById('myModal');

// Get the button that opens the modal
//var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 

$('#myModal').fadeIn(500);	
$('#myModal').fadeTo("slow",0.20);	

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
*/
	
	
});
</script>
<!-- The Modal -->
<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content" >
        <span class="close">×</span>
        <p>voucher anda akan dikirim ke alamat rumah dalam waktu 30hari</p>
    </div>

</div>
<div id="boxes">
    <div id="dialog" class="window">
        <div id="popupfoot"><img src="<?php echo $this->Html->url('/')?>img/popup_hasil_rawat_inap_jalan/pop_up_pemenang.jpg" width="400px" height="400px"onclick="$('#myModal').modal('show');"/></div>
    </div>
    <div id="mask"></div>
</div>

