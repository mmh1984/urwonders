<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Cards </h5>
    </div>
    <div class="card-body">
    <div class="row">
        <div class="col"><p class='text-right'>Select category or search to display</p></div>
    </div>
    <div class="row" style="margin-bottom:5px">
        <div class="col-md-4 col-lg-4 col-xl-4 col-xm-12">
        <button class="btn btn-primary" type="button" onclick="load_page('views/cardform.html')">Add New</button>
        </div>
        <div class="col-md-4 col-lg-4 col-xl-4 col-xm-12">
        
        <select id="category" class="form-control"></select>
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
                        <th>Name</th>
                        <th>Category</th>
                        <th>Description</th>
                        <th>Tag</th>
                    </tr>
                </thead>
                <tbody id="cardtable" >
                    
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
                <img class='img img-thumbnail'src="" id="cardimg" style="width:50%;height:auto;margin:10px auto;display:block"/>
                <div class="form-group">
                    <p>Change Image</p>
                <input type="file" id="cardimage" accept="image/*" class="form-control"/>
                <input type="hidden" id="imageid" />
                <br/>
                <button class="btn btn-primary" onclick="upload_image()">Upload</button>
                </div>
            </div>
            <div class="modal-footer"><button class="btn btn-light" type="button" data-dismiss="modal" onclick="load_cards()">Close</button></div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function(){
        category_list();
        load_cards();
        
    })
    
    function category_list(){
      $.ajax({
          url:"controls/category.php",
          type:"POST",
          data:{
              action:"categorylist"
          },
          success:function(response){
             
             $("#category").append(response);

          }
      })
  }
function load_cards(){
    $.ajax({
          url:"controls/cards.php",
          type:"POST",
          data:{
              action:"load",
              keyword:$("#search").val()
          },
          success:function(response){
            
             $("#cardtable").html(response);

          }
      })
}
  $("#search").keyup(function(){
    $.ajax({
          url:"controls/cards.php",
          type:"POST",
          data:{
              action:"search",
              keyword:$("#search").val()
          },
          success:function(response){
             $("#cardtable").html(response);

          }
      })
  })
$("#category").change(function(){
    $.ajax({
          url:"controls/cards.php",
          type:"POST",
          data:{
              action:"filter",
              category:$(this).val()
          },
          success:function(response){
             $("#cardtable").html(response);

          }
      })
  })

function load_image(id,src){
    
$("#cardimg").attr("src","controls/cards/" + src)

$("#imageid").val(id);
}

function upload_image(){
    image=$("#cardimage")[0].files[0];
    if(image==null){
        alert("No image selected")
    }
    else{
        fdata=new FormData();
        fdata.append("cardimage",image)
        fdata.append("id",$("#imageid").val())
        $.ajax({
            type:"POST",
            url:"controls/upload2.php",
            cache: false,
            contentType: false,
            processData: false,
            enctype:"multiform/form-data",
            data:fdata,
            success:function(response){
                alert(response);
                load_cards();
            }
        })
    }
}

function edit_card(id){

load_page(id)
}
</script>

