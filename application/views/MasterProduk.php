<script>
$(document).ready(function(){
    function readURL(input,target) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $(target).attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    $(".img1").change(function(){      
       var target = $(this).parent().children(".imgres");
       readURL(this,target);
    })
	var jenisEdit;
	var kategoriEdit;
	$("#jenis").keydown(function(e){
		if(!jenisEdit)
		{e.preventDefault();}
		else
		{return;}
		
	})
	
	$("#kategori").keydown(function(e){
		if(!kategoriEdit)
		{e.preventDefault();}
		else
		{return;}
		
	})
	
	$(".liSel1").click(function(){
		var nilai = $(this).attr('jns');
		
		if(nilai != "")
		{
			$("#jenis").val(nilai);
			jenisEdit = false;
		}
		else
		{
			$("#jenis").val("");
			jenisEdit = true;
		}
		
	})
	$(".liSel2").click(function(){
		var nilai = $(this).attr('jns');
		if(nilai != "")
		{
			$("#kategori").val(nilai);
			kategoriEdit = false;
		}
		else
		{
			$("#kategori").val("");
			kategoriEdit = true;
		}
		
	})
	
})
</script>
<div class="container">
    <?php echo form_open_multipart('Master/do_upload',Array("class"=>"form-horizontal"))?>
    <?php
        if(!is_null($msg))
        {
            foreach($msg as $row)
            {?>
                <div class="alert alert-success">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <strong><?php $msgHead?></strong> <?php echo $row?>
                </div>
            <?php
            }
        }?>
            <div class="form-group">
                <legend>Input Data Produk</legend>
            </div> 

            <div class="form-group">
                <label class="control-label col-sm-2">ID Produk: </label>
                <div class="col-sm-4">
                    <input type="text" name="Id" value="<?php echo $Autogen?>" class="form-control" disabled/>
                </div>         
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">Nama Produk: </label>
                <div class="col-sm-4">
                    <input type="text" name="Nama" class="form-control"/>
                </div>         
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">Harga Produk: </label>
                <div class="col-sm-4">
                    <input type="text" name="Harga"  pattern="[0-9.]+" class="form-control"/>
                </div>         
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">Merek Produk: </label>
                <div class="col-sm-4">
                    <input type="text" name="Merek" class="form-control"/>
                </div>         
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">Stok Produk: </label>
                <div class="col-sm-4">
                    <input type="text" name="Stok"  pattern="[0-9.]+" class="form-control"/>
                </div>         
            </div>
			
			<div class="form-group">
                <label class="control-label col-sm-2">Jenis Produk: </label>
                <div class="col-sm-2">
                    <div class="dropdown">
						<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Pilih Jenis Produk
						<span class="caret"></span></button>
						<ul class="dropdown-menu">
						  <?php foreach($JenisProduk as $r){?>
						  <li class="liSel1" jns="<?php echo $r->jenis_produk?>"><a href="#"><?php echo $r->jenis_produk?></a></li>
						  <?php }?>
						  
						  <li class="divider"></li>
						  <li class="liSel1" jns=""><a href="#"><b>Add New Jenis</b></a></li>
						</ul>
					</div>
                </div>    

				<div class="col-sm-2">
                    <input type="text" name="jenis" id="jenis" class="form-control"  required  />
                </div>       
            </div>
			
			<div class="form-group">
                <label class="control-label col-sm-2">Kategori Produk: </label>
                <div class="col-sm-2">
                    <div class="dropdown">
						<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Pilih Kategori
						<span class="caret"></span></button>
						<ul class="dropdown-menu">
						  <?php foreach($KategoriProduk as $r){?>
						  <li class="liSel2" jns="<?php echo $r->KATEGORI_PRODUK?>"><a href="#"><?php echo $r->KATEGORI_PRODUK?></a></li>
						  <?php }?>
						  <li class="divider"></li>
						  <li class="liSel2" jns=""><a href="#"><b>Add New Kategori</b></a></li>
						</ul>
					</div>
                </div>
				<div class="col-sm-2">
                    <input type="text" name="kategori" id="kategori" class="form-control" required />
                </div>      
            </div>
			
            <div class="form-group">
                <label class="control-label col-sm-2">Deskripsi Produk: </label>
                <div class="col-sm-4">
                    <textarea   name="Detail" class="form-control"></textarea>
                </div>         
            </div>

            <div class="form-group">
                <label class="control-label col-sm-2">Pilih Gambar Produk</label>
            <div class="col-sm-2">
                <img class="imgres" src="" style="width:100px;height:100px;">
                <input class="img1" type="file" name="userfile" size="20" class="form-control" />
            </div>    

             <div class="col-sm-2">
                <img class="imgres" src="" style="width:100px;height:100px;">
                <input class="img1" type="file" name="userfile1" size="20" class="form-control" />
            </div>     

             <div class="col-sm-2">
                <img class="imgres" src="" style="width:100px;height:100px;">
                <input class="img1" type="file" name="userfile2" size="20" class="form-control" />
            </div>            
                
            </div>
            <input type="hidden" value="<?php echo $Autogen?>" name="Idh">
            <div class="form-group">
                <div class="col-sm-3 col-sm-offset-2">
                    <button type="submit" value="upload" id="submitBtn" class="btn btn-primary">Insert</button>
                </div>
            </div>
    </form>

</div>