<script>
    FusionCharts.ready(function(){
      var revenueChart = new FusionCharts({
        "type": "column2d",
        "renderAt": "chartContainer",
        "width": "1000",
        "height": "500",
        "dataFormat": "json",
        "dataSource": {
          "chart": {
              "caption": "<?php echo $judul ?>",
              "subCaption": "Penjualan SuperMarket",
              "xAxisName": "<?php echo $waktu ?>",
              "yAxisName": "Total",
              "theme": "fint"
           },
          "data": [
              <?php for($i = 0; $i < count($labelnya); $i++)
					{
					  if($i+1 == count($labelnya))
					  {?>
						{"label": "<?php echo $labelnya[$i] ?>","value": "<?php echo $valuenya[$i] ?>"}
					  <?php } 
					  else
					  { ?>
						{"label": "<?php echo $labelnya[$i] ?>","value": "<?php echo $valuenya[$i] ?>"},
					  <?php } 
					}?>
           ]
        }
    });

    revenueChart.render();
})
</script>
<div class="container">
		<div class="form-group">
			<div class="col-sm-4">
			<?php echo form_open('Report/bulanan'); ?>
			<input type="submit" value="Per Bulan" class="btn btn-primary" style="width:100%;height:50px;"/>
			<?php echo form_close(); ?>
			</div class="col-sm-4">
			<div class="col-sm-4">
			<?php echo form_open('Report/tahunan'); ?>
			<input type="submit" value="Per Tahun" class="btn btn-primary" style="width:100%;height:50px;"/>
			<?php echo form_close(); ?>
			</div class="col-sm-4">
		</div>
        <div id="chartContainer">FusionCharts XT will load here!</div>
</div>