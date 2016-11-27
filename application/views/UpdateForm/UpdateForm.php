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
})
</script>
<div class="container">
    <?php echo form_open_multipart('Master/UpdateProduk',Array("class"=>"form-horizontal"))?>
    <?php foreach($msg as $r)
    {
        if(strpos($r,"Berhasil")>0){?>

        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php echo $r?>
        </div>
        <?php }else{?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <?php echo $r?>
        </div>
    <?php }}?>
            <div class="form-group">
                <legend>Input Data Produk</legend>
            </div> 

            <div class="form-group">
                <label class="control-label col-sm-2">Nama Produk: </label>
                <div class="col-sm-4">
                    <input type="text" name="Nama" value="<?php echo $detail->NAMA_PRODUK?>" class="form-control"/>
                </div>         
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">Harga Produk: </label>
                <div class="col-sm-4">
                    <input type="text" value="<?php echo $detail->HARGA_JUAL?>" name="Harga" class="form-control"/>
                </div>         
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">Merek Produk: </label>
                <div class="col-sm-4">
                    <input type="text" value="<?php echo $detail->MEREK_PRODUK?>" name="Merek" class="form-control"/>
                </div>         
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">Stok Produk: </label>
                <div class="col-sm-4">
                    <input type="text" name="Stok" value="<?php echo $detail->STOK?>" class="form-control"/>
                </div>         
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">Penjelasan Produk: </label>
                <div class="col-sm-4">
                    <textarea  name="Detail"  class="form-control"><?php echo $detail->KETERANGAN?></textarea>
                </div>         
            </div>
            <div class="form-group">
                <label class="control-label col-sm-2">Pilih Gambar Produk</label>
                <?php for($i=0;$i<count($path);$i++)
                {?>
                    <div class="col-sm-2">
                      <img class="imgres" src="<?php echo base_url('produk/'.$path[$i]['NAMA_GAMBAR'])?>" style="width:100px;height:100px;">
                      <input class="img1" type="file" name="userfile<?php echo $i+1?>" size="20" class="form-control" />
                      <input type="hidden" name="Idg<?php echo $i?>" value="<?php echo $path[$i]["ID_GAMBAR"]?>" name="Idh">
                     </div>
                <?php }?>
            </div>
            <input type="hidden" value="<?php echo $detail->ID_PRODUK?>" name="Idh">
            <div class="form-group">
                <div class="col-sm-3 col-sm-offset-2">
                    <button type="submit" name="UpdateBtn" value="update" class="btn btn-primary">Update</button>
                </div>
            </div>
    </form>

</div>