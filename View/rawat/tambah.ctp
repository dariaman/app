<?php echo $this->Form->create('Employee'); ?>
<fieldset>
   <legend>Tambah Data</legend>
   <?php
       echo $this->Form->input('nip');
        echo $this->Form->input('nama');
       echo $this->Form->input('golongan');
       echo $this->Form->input('pangkat');  
  ?>
</fieldset>
<?php echo $this->Form->end('Tambah'); ?>

<?php echo $this->Html->link('Lihat Data', array('controller'=>'employees', 'action'=>'index