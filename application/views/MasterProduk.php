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
                    <input type="text" name="Harga" class="form-control"/>
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
                    <input type="text" name="Stok" class="form-control"/>
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
                    <button type="submit" value="upload" class="btn btn-primary">Insert</button>
                </div>
            </div>
    </form>

</div>