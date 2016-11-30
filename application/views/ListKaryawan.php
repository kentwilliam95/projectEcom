<script>
    $(document).ready(function(){
        createTable(<?php echo $karyawan?>);
        function createTable(duata)
			{
				$('#list1').DataTable({
					data:duata,
					columns:[
					{title : "ID PEGAWAI"},
					{title : "NAMA PEGAWAI"},
					{title : "PASSWORD"},
					{title : "TANGGAL LAHIR"},
					{title: "JENIS KELAMIN"},
					{title: "PRIVILAGE"},
                    {title:"ACTION"}
					],
					destroy:true
				});
			}
    })
</script>
<div class="container">
        <table class="table" id="list1"></table>
</div>