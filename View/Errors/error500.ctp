
<h2 style="margin-top:70px">Terjadi kesalahan error </h2>
<br>
<p>Silahkan kembali ke <a href="<?php echo $this->Html->url("/"); ?>">Home</a> </p>

<?php
if (Configure::read('debug') > 0):
	echo $this->element('exception_stack_trace');
endif;
?>
