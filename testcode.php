<div class="dsp container">
  <form action="method" name="upload-file" id="multiple-files-upload" enctype="multipart/form-data">
    <div class="row">              
      <div class="col-lg-12 pakainfo">                    
                <div class="input-group">
                  <input type="file" name="products_uploaded[]" id="products_uploaded" class="form-control" value="Upload" multiple="multiple"> 
                  <span class="input-group-btn">
                    <button type="submit" name="submit" id="submit" class="btn btn-primary dsp" type="button">Upload!</button>
                  </span>
                </div>
            </div>
      <div class="col-lg-12 text-center" id="display_product_list"><ul></ul></div>
    </div>
  </form>
</div>

<script>
    $(function () {
    var input_file = document.getElementById('products_uploaded');
    var remove_products_ids = [];
    var product_dynamic_id = 0;
    $("#products_uploaded").change(function (event) {
        var len = input_file.files.length;
        $('#display_product_list ul').html("");
        
        for(var j=0; j<len; j++) {
            var src = "";
            var name = event.target.files[j].name;
            var mime_type = event.target.files[j].type.split("/");
            if(mime_type[0] == "image") {
              src = URL.createObjectURL(event.target.files[j]);
            } else if(mime_type[0] == "video") {
              src = 'icons/video.png';
            } else {
              src = 'icons/file.png';
            }
            $('#display_product_list ul').append("<li id='" + product_dynamic_id + "'><div class='ic-sing-file'><img id='" + product_dynamic_id + "' src='"+src+"' title='"+name+"'><p class='close' id='" + product_dynamic_id + "'>X</p></div></li>");
            product_dynamic_id++;
        }
    });
    $(document).on('click','p.close', function() {
        var id = $(this).attr('id');
        remove_products_ids.push(id);
        $('li#'+id).remove();
        if(("li").length == 0) document.getElementById('products_uploaded').value="";
    });
    $("form#multiple-files-upload").submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        formData.append("remove_products_ids", remove_products_ids);
        $.ajax({
              url: 'upload.php',
              type: 'POST',
              data: formData,
              processData: false, 
              contentType: false,
              
              success: function(data) {
                 $('#display_product_list ul').html("<li class='text-success'>Files uploaded successfully!</li>");
                 $('#products_uploaded').val("");
              },
              error: function(e) {
                  $('#display_product_list ul').html("<li class='text-danger'>Something wrong! Please try again.</li>");                    
              }    
        });
    });
});
</script>

<?php
if(isset($_FILES) && !empty($_FILES)) {
  $remove_products_ids = array();
  if(isset($_POST['remove_products_ids']) && !empty($_POST['remove_products_ids'])) {
    $remove_products_ids = explode(",", $_POST['remove_products_ids']);
  }
  for($i=0; $i<sizeof($_FILES['products_uploaded']['name']); $i++) {
    if(!in_array($i, $remove_products_ids)) {
      if($_FILES['products_uploaded']['name'][$i] != "") {
        $path = "uploaded-contents/".$_FILES['products_uploaded']['name'][$i];
        copy($_FILES['products_uploaded']['tmp_name'][$i], $path); 
      }
    }
  }
}
?>