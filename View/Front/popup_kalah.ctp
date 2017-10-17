<script src="<?php echo $this->Html->url("/"); ?>linequiz-assets/js/jquery.js"></script>
<style>
    #maskKalah {
        position:absolute;
        left:0;
        top:0;
        z-index:9000;
        background-color:#000;
        display:none;
    }

    #boxesKalah .windowKalah{
        position:absolute;
  left:0;
  top:0;
  width:440px;
  height:200px;
  display:none;
  z-index:9999;
  padding:0px;
  border-radius: 15px;
  text-align: center;
    }

    #boxesKalah #dialogKalah {
        width:350px; 
    height:500px;
    padding:0px;
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
        /*  background: url('bg.jpg');*/
    }
    #lorem{
        font-family: "Segoe UI", sans-serif;
	font-size: 12pt;
  text-align: left;
    }
    #popupfootKalah {
        font-family: "Segoe UI", sans-serif;
        font-size: 16pt;
        padding: 10px 20px;
    }
    #popupfootKalah a{
        text-decoration: none;
    }

</style>
<script type="text/javascript">
    $(document).ready(function() {	

        var id = '#dialogKalah';
	
        //Get the screen height and width
        var maskHeight = $(document).height();
        var maskWidth = $(window).width();
	
        //Set heigth and width to mask to fill up the whole screen
        $('#maskKalah').css({'width':maskWidth,'height':maskHeight});

        //transition effect
        $('#maskKalah').fadeIn(500);	
        $('#maskKalah').fadeTo("slow",0.9);	
	
        //Get the window height and width
        var winH = $(window).height();
        var winW = $(window).width();
              
        //Set the popup window to center
        $(id).css('top',  winH/2-$(id).height()/2);
        $(id).css('left', winW/2-$(id).width()/2);
	
        //transition effect
        $(id).fadeIn(2000); 	
	
        //if close button is clicked
        $('.windowKalah .close').click(function (e) {
            //Cancel the link behavior
            e.preventDefault();

            $('#maskKalah').hide();
            $('.windowKalah').hide();
        });

        //if mask is clicked
        $('#maskKalah').click(function () {
            $(this).hide();
            $('.windowKalah').hide();
        })
    });
    function confirmClose(){
        $('#boxesKalah').modal('hide');
    }
</script>
<!--<div id="myModal" class="modal">

     Modal content 
    <div class="modal-content" >
    </div>

</div>-->
<div id="boxesKalah">
    <div id="dialogKalah" class="windowKalah">
<!--        <span class="close-control">×</span>-->
        <button type="button" class="close" onclick="confirmClose()" aria-label="Close"><img src="<?php echo $this->Html->url('/') ?>img/close-btn.png"></button>
        <div id="popupfootKalah"><img src="<?php echo $this->Html->url('/') ?>img/popup_hasil_rawat_inap_jalan/pop_up_kalah.jpg" width="300px" height="440px"/></div>
    </div>
    <div id="maskKalah"></div>
</div>