<div class="container">
    <?php echo form_open_multipart('Master_Karyawan/do_upload',Array("class"=>"form-horizontal"))?>
            <div class="form-group">
                <legend>Input Data Pegawai</legend>
            </div> 

            <div class="form-group">
                <label class="control-label col-sm-2">ID Pegawai: </label>
                <div class="col-sm-4">
                    <input type="text" name="Id" value="<?php echo $Autogen?>" class="form-control" disabled/>
                </div>         
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">Nama Pegawai: </label>
                <div class="col-sm-4">
                    <input type="text" name="Nama" class="form-control"/>
                </div>         
            </div>
			<div class="form-group">
                <label class="control-label col-sm-2">Password: </label>
                <div class="col-sm-4">
                    <input type="text" name="Password" class="form-control"></textarea>
                </div>         
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">Tanggal Lahir: </label>
				<div class="input-group date form_date col-sm-4" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input class="form-control" size="10" type="text" value="" readonly>
                    <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
					<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                </div>
				<input type="hidden" id="dtp_input2" value="" name="TglLahir"/><br/>       
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">Jenis Kelamin: </label>
                <div class="col-sm-4">
					<input type="radio" name="gender" value="Male"> Male<br>
					<input type="radio" name="gender" value="Female"> Female<br>
                </div>         
            </div>
			<div class="form-group">
                <label class="control-label col-sm-2">Privilage: </label>
                <div class="col-sm-4">
                    <input type="text" name="Privilage" class="form-control"></textarea>
                </div>         
            </div>
            <input type="hidden" value="<?php echo $Autogen?>" name="Idh">
            <div class="form-group">
                <div class="col-sm-3 col-sm-offset-2">
                    <button type="submit" value="upload" class="btn btn-primary">Insert</button>
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
