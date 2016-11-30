<html>
    <link rel="stylesheet" type="text/css" href="bs/css/bootstrap.css" />
    <script src="bs/JQ.js"></script>
    <script src="bs/js/bootstrap.js" > </script>
    <script>
        $(document).ready(function(){
            function numberWithCommas(x) 
            {
                var parts = x.toString().split(".");
                parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
                return parts.join(".");
            }
        })
    </script>
    <style>
    .biru_Sangar
    {
        background-color: #399bff;
    }
    .img-responsive
    {
        margin: 0 auto;
    }
    .gambar
    {
        margin: 0 auto;
    }
    img:hover
    {
        cursor: pointer;
    }
    .-center
    {
        margin:10 auto;
    }
        .-over
        {
            overflow:auto;
        }
    </style>
    <body>
        <div class="Container">
		<?php echo form_open_multipart('MasterPromosi/UpdatePromosi',Array("class"=>"form-horizontal"))?>    
            <div class="form-group">
            <legend>Input Data Promosi</legend>
            </div>
            <div class="col-sm-9">
                <div class="form-group">
                    <label class="control-label col-sm-3">ID Promosi: </label>
                    <div class="col-sm-7">
                        <input type="text" name="Id" value="<?php echo $detail->ID_PROMOSI?>" class="form-control" disabled/>
                    </div>         
                </div>
				<div class="form-group">
                    <label class="control-label col-sm-3">Nama Promosi: </label>
                    <div class="col-sm-7">
                        <input type="text" name="Nama" value="<?php echo $detail->NAMA_PROMOSI?>" class="form-control" />
                    </div>         
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Tanggal Mulai Promosi: </label>
                    <div class="col-sm-7">
                        <div class="input-group date form_date col-sm-12" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input1" data-link-format="yyyy-mm-dd">
							<input class="form-control" size="10" type="text" value="<?php echo $detail->TGL_MULAI_PROMOSI?>" readonly>
							<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
						</div>
						<input type="hidden" id="dtp_input1" value="<?php echo $detail->TGL_MULAI_PROMOSI?>" name="TglMulai"/><br/>
                    </div>         
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Tanggal Akhir Promosi: </label>
                    <div class="col-sm-7">
                        <div class="input-group date form_date col-sm-12" data-date="" data-date-format="yyyy-mm-dd" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
							<input class="form-control" size="10" type="text" value="<?php echo $detail->TGL_AKHIR_PROMOSI?>" readonly>
							<span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
							<span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
						</div>
						<input type="hidden" id="dtp_input2" value="<?php echo $detail->TGL_AKHIR_PROMOSI?>" name="TglAkhir"/><br/>
                    </div>         
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Nilai Diskon: </label>
                    <div class="col-sm-7">
                        <input type="text" name="Diskon" value="<?php echo $detail->DISKON_PROMOSI?>" class="form-control"/>
                    </div>         
                </div>
                <div class="form-group">
                    <label class="control-label col-sm-3">Deskripsi Promosi: </label>
                    <div class="col-sm-7">
                        <textarea   name="Deskrip" class="form-control"><?php echo $detail->DESKRIPSI_PROMOSI?></textarea>
                    </div>         
                </div>
                </div>
				
				<input type="hidden" value="<?php echo $detail->ID_PROMOSI?>" name="Idh">
                <div class="col-sm-3">
                    <input type="submit" value="Update Promo" class="btn btn-primary" style="width:100%;height:300px;"/>
                </div>     
			
            <h2 class="text-center">Promo Berlaku Hanya Yang Di centang:</h2>
            <div class="col-sm-12 -over">
                <div style="height:500px;">
                    <table class="table">
						<?php
						for($i = 0; $i < round(count($produkx)/5)-1; $i++)
						{ 
							?><tr><?php
							for($j = 0; $j < 5; $j++)
							{	
						?>
							<td class="centered">
								<img class="gambar img-thumbnail center-block" src="
									<?php echo $b_url ?>
									Image/
									<?php echo $hasil[$i][0][$j]?>" 
								nama="<?php echo $hasil[$i][1][$j] ?>""</img>
							</td>
						<?php
								if($j == 4)
								{
									?><tr><?php
									for($k = 0; $k < 5; $k++)
									{
									?>
										<td class="text-center"><label><input type="checkbox" style="width:18px;height:18px" name="Id_pro[]" value="<?php echo $hasil[$i][2][$k] ?>" 
										<?php foreach($potongID as $z)
											  { echo ($hasil[$i][2][$k] == $z ? 'checked' : '');
												}
										?> >
										</label><br><?php echo $hasil[$i][1][$k] ?></td>
									<?php } ?>
									</tr>
									<?php 
								}
							}
							?></tr>
							<?php
						}
						?>
                    </table>
                </div>
                

            </div>
			</form>
        </div>
    </body>
</html>

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