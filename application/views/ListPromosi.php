<script>
    $(document).ready(function(){
        createTable(<?php echo $promosi?>);
        function createTable(duata)
			{
				$('#list1').DataTable({
					data:duata,
					columns:[
					{title : "ID PROMOSI"},
					{title : "ID PRODUK"},
					{title : "NAMA PROMOSI"},
					{title : "TANGGAL MULAI"},
					{title: "TANGGAL AKHIR"},
					{title: "DISKON PROMOSI"},
					{title:"STATUS PROMOSI"},
					{title: "DESKRIPSI PROMOSI"},
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