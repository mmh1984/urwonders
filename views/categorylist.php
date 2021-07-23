<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Categories</h5>
    </div>
    <div class="card-body">
    <div class="row" style="margin-bottom:5px">
        <div class="col-md-8 col-lg-8 col-xl-8 col-xm-12">
        <button class="btn btn-primary" type="button" onclick="load_page('views/categoryform.html')">Add new category</button>
        </div>
        <div class="col-md-4 col-lg-4 col-xl-4 col-xm-12">
        <input type="text" placeholder="search" id="search" class="form-control"/>
        </div>
    </div>    
    
        <div class="table-responsive table-condensed" style="height:400px;overflow-y:auto;">
            <table class="table">
                <thead>
                    <tr>
                        <th>Image (Click to view)</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Option</th>
                    </tr>
                </thead>
                <tbody id="categorytable" >
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
<div role="dialog" tabindex="-1" class="modal fade" id="imagemodal">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Image</h4><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button></div>
            <div class="modal-body">
                <img class='img img-thumbnail'src="" id="catimg" style="width:50%;height:auto;margin:10px auto;display:block"/>
                <div class="form-group">
                    <p>Change Image</p>
                <input type="file" id="catimage" accept="image/*" class="form-control"/>
                <input type="hidden" id="imageid" />
                <br/>
                <button class="btn btn-primary" onclick="upload_image()">Upload</button>
                </div>
            </div>
            <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal" onclick="load_categories()">Close</button></div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        load_categories();
    })
    function load_categories(){
      $.ajax({
          url:"controls/category.php",
          type:"POST",
          data:{
              action:"load"
          },
          success:function(response){
             
             $("#categorytable").html(response);

          }
      })
  }

  $("#search").keyup(function(){
    $.ajax({
          url:"controls/category.php",
          type:"POST",
          data:{
              action:"search",
              keyword:$("#search").val()
          },
          success:function(response){
             $("#categorytable").html(response);

          }
      })
  })

function load_image(id,src){
$("#catimg").attr("src","controls/category/" + src)
$("#imageid").val(id);
}

function upload_image(){
    image=$("#catimage")[0].files[0];
    if(image==null){
        alert("No image selected")
    }
    else{
        fdata=new FormData();
        fdata.append("catimage",image)
        fdata.append("id",$("#imageid").val())
        $.ajax({
            type:"POST",
            url:"controls/upload.php",
            cache: false,
            contentType: false,
            processData: false,
            enctype:"multiform/form-data",
            data:fdata,
            success:function(response){
                alert(response);
                load_categories();
            }
        })
    }
}

function edit_category(id){
    
load_page(id)
}
</script>

