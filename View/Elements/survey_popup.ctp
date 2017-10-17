<style type="text/css">
  
.close {
  float: right;
  font-size: 21px;
  font-weight: bold;
  line-height: 1;
  color: #000000;
  text-shadow: 0 1px 0 #ffffff;
  position: relative;
    bottom: 20px;
    right: -5px;
    opacity: 1;
}

button.close {
  padding: 0;
  cursor: pointer;
  background: transparent;
  border: 0;
  -webkit-appearance: none;
}

.modal-open {
  overflow: hidden;
}

.modal {
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  z-index: 1040;
  display: none;
  overflow: auto;
  overflow-y: scroll;
}

.modal.fade .modal-dialog {
  -webkit-transform: translate(0, -25%);
      -ms-transform: translate(0, -25%);
          transform: translate(0, -25%);
  -webkit-transition: -webkit-transform 0.3s ease-out;
     -moz-transition: -moz-transform 0.3s ease-out;
       -o-transition: -o-transform 0.3s ease-out;
          transition: transform 0.3s ease-out;
}

.modal.in .modal-dialog {
  -webkit-transform: translate(0, 0);
      -ms-transform: translate(0, 0);
          transform: translate(0, 0);
}


.modal-content {
  position: relative;
  background-color: #ffffff;
  /*border: 1px solid #999999;
  border: 1px solid rgba(0, 0, 0, 0.2);*/
  border-radius: 0px;
  outline: none;
  -webkit-box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
          box-shadow: 0 3px 9px rgba(0, 0, 0, 0.5);
  background-clip: padding-box;
    border-top: 10px solid #ee3a43;
}

.modal-backdrop {
  position: fixed;
  top: 0;
  right: 0;
  bottom: 0;
  left: 0;
  z-index: 1030;
  background-color: #000000;
}

.modal-backdrop.fade {
  opacity: 0;
  filter: alpha(opacity=0);
}

.modal-backdrop.in {
  opacity: 0.5;
  filter: alpha(opacity=50);
}

.modal-header {
  min-height: 16.428571429px;
  padding: 15px;
}

.modal-header .close {
  margin-top: -2px;
}

.modal-title {
  margin: 0;
  line-height: 1.428571429;
}

.modal-body-survey {
  position: relative;
  padding: 0px 20px 10px;
  margin-top: 25px;
}

.modal-footer {
  padding: 19px 20px 20px;
  margin-top: 15px;
  text-align: right;
}

.modal-footer:before,
.modal-footer:after {
  display: table;
  content: " ";
}

.modal-footer:after {
  clear: both;
}

.modal-footer:before,
.modal-footer:after {
  display: table;
  content: " ";
}

.modal-footer:after {
  clear: both;
}

.modal-footer .btn + .btn {
  margin-bottom: 0;
  margin-left: 5px;
}

.modal-footer .btn-group .btn + .btn {
  margin-left: -1px;
}

.modal-footer .btn-block + .btn-block {
  margin-left: 0;
}

@media screen and (min-width: 768px) {
  .modal-dialog-survey {
    width: 642px;
    padding-top: 30px;
    /*padding-bottom: 30px;*/
  }
  .modal-content {
    -webkit-box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
  }
}
</style>

  <div id="surveyPopup" class="modal fade" style="padding-top:7%;">
    <div class="modal-dialog modal-dialog-survey">
      <div class="modal-content">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><img src="/img/close-btn.png"></button>
        <div class="modal-body modal-body-survey">
          <!--<script>(function(e,t,n,s){var c,o,i;e.SMCX=e.SMCX||[],t.getElementById(s)||(c=t.getElementsByTagName(n),o=c[c.length-1],i=t.createElement(n),i.type="text/javascript",i.async=!0,i.id=s,i.src=["https:"===location.protocol?"https://":"http://","widget.surveymonkey.com/collect/website/js/m9uxUxFs4UI4P_2FcXWLi_2FE_2Bxwjhm9gODng7H6NJVLq9t2k1SeXefKy5H8G_2Fppe1Oz.js"].join(""),o.parentNode.insertBefore(i,o))})(window,document,"script","smcx-sdk");</script><a style="font: 12px Helvetica, sans-serif; color: #999; text-decoration: none;" href=https://www.surveymonkey.com/mp/customer-satisfaction-surveys/> Create your own user feedback survey </a>-->
          <!-- <iframe style="height:400px; width:100%;" src="https://www.surveymonkey.com/r/7MXGLKK"></iframe> -->
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->

<script>
//jQuery.noConflict();
  //function show_popup() {
    //jQuery('#surveyPopup').modal({ show: true });
  //}
</script>