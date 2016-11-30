<div class="container">
    <?php echo form_open_multipart('Master_Karyawan/UpdatePegawai',Array("class"=>"form-horizontal"))?>
            <div class="form-group">
                <legend>Input Data Pegawai</legend>
            </div> 

            <div class="form-group">
                <label class="control-label col-sm-2">Nama Pegawai: </label>
                <div class="col-sm-4">
                    <input type="text" name="Nama" value="<?php echo $detail->NAMA_PEGAWAI?>" class="form-control"/>
                </div>         
            </div>
			<div class="form-group">
                <label class="control-label col-sm-2">Password: </label>
                <div class="col-sm-4">
                    <input type="text" name="Password" value="<?php echo $detail->PASSWORD?>" class="form-control"></textarea>
                </div>         
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">Tanggal Lahir: </label>
				<div class="input-group date form_date col-sm-4" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="10" type="text" value="<?php echo $detail->TANGGAL_LAHIR?>" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
				<input type="hidden" id="dtp_input2" value="<?php echo $detail->TANGGAL_LAHIR?>" name="TglLahir"/><br/>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">Jenis Kelamin: </label>
                <div class="col-sm-4">
                    <input type="radio" name="gender" value="Laki"> Laki-laki<br>
					<input type="radio" name="gender" value="Perempuan"> Perempuan<br>
                </div>         
            </div>
			<div class="form-group">
                <label class="control-label col-sm-2">Privilage: </label>
                <div class="col-sm-4">
                    <input type="text" name="Privilage" value="<?php echo $detail->PRIVILAGE?>" class="form-control"></textarea>
                </div>         
            </div>
            <input type="hidden" value="<?php echo $detail->ID_PEGAWAI?>" name="Idh">
            <div class="form-group">
                <div class="col-sm-3 col-sm-offset-2">
                    <button type="submit" name="UpdateBtn" value="update" class="btn btn-primary">Update</button>
                </div>
            </div>
    </form>

</div>

<script type="text/javascript">
$('.form_date').datetimepicker({
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });	
</script>