<script>
    $(document).ready(function(){
        createTable(<?php echo $produk?>);
        function createTable(duata)
			{
				$('#list1').DataTable({
					data:duata,
					columns:[
					{title : "ID PRODUK"},
					{title : "NAMA PRODUK"},
					{title : "HARGA JUAL"},
					{title: "MEREK PRODUK"},
					{title:"STOK"},
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