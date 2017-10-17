<div class="page-header">
  <h1>
    <i class="fa fa-angle-double-right"></i>
    Summary Report Chat<span id="cust_tipe_title"></span>
  </h1>
</div>

<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label class="col-md-4 control-label no-padding-right" for="form-field-1">Tanggal Awal</label>
      <div class="col-md-8">
        <?php  echo $this->Form->create('',array('type'=>'get','url'=>array('controller'=>'Adm', 'action'=>'reportchat'))); echo $this->Form->input('first_date', array('type'=>'text','id'=>'first_date','value'=>isset($this->request->query['first_date'])?$this->request->query['first_date']:'','div'=>false,'label'=>false,'class'=>'form-control','placeholder'=>__('yyyy-mm-dd')));?>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <label class="col-md-4 control-label no-padding-right" for="form-field-1">Tanggal Akhir</label>
    <div class="col-md-8">
      <?php echo $this->Form->input('last_date', array('type'=>'text','value'=>isset($this->request->query['last_date'])?$this->request->query['last_date']:'','id'=>'last_date','div'=>false,'label'=>false,'class'=>'form-control','placeholder'=>__('yyyy-mm-dd')));?>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <button type="submit" class="btn btn-sm btn-danger">Download</button>
    </div>
	</form>
  </div>
</div>
<div class="page-header">
  <h1>
    <i class="fa fa-angle-double-right"></i>
    Detail Report Chat<span id="cust_tipe_title"></span>
  </h1>
</div>


<div class="row">
  <div class="col-md-4">
    <div class="form-group">
      <label class="col-md-4 control-label no-padding-right" for="form-field-1">Tanggal Awal</label>
      <div class="col-md-8">
        <?php  echo $this->Form->create('',array('type'=>'get','url'=>array('controller'=>'Adm', 'action'=>'detailreportchat'))); echo $this->Form->input('first_date2', array('type'=>'text','id'=>'first_date2','value'=>isset($this->request->query['first_date2'])?$this->request->query['first_date2']:'','div'=>false,'label'=>false,'class'=>'form-control','placeholder'=>__('yyyy-mm-dd')));?>
      </div>
    </div>
  </div>
  <div class="col-md-4">
    <label class="col-md-4 control-label no-padding-right" for="form-field-1">Tanggal Akhir</label>
    <div class="col-md-8">
      <?php echo $this->Form->input('last_date2', array('type'=>'text','value'=>isset($this->request->query['last_date2'])?$this->request->query['last_date2']:'','id'=>'last_date2','div'=>false,'label'=>false,'class'=>'form-control','placeholder'=>__('yyyy-mm-dd')));?>
    </div>
  </div>
  <div class="col-md-4">
    <div class="form-group">
      <button type="submit" class="btn btn-sm btn-danger">Download</button>
    </div>
  </form>
  </div>


  
<script>
  $('#first_date').datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true,
    startView:3
  })
  
  $('#last_date').datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true,
    startView:3
  })

  $('#first_date2').datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true,
    startView:3
  })
  
  $('#last_date2').datepicker({
    format: 'yyyy-mm-dd',
    autoclose: true,
    startView:3
  })
</script>