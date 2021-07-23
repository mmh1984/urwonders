<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Categories</h5>
            </div>
            <div class="card-body">
                <div id="message"></div>
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Title</td>
                                <td>
                                    <input id="catid" type="hidden" value="<?php echo $_GET["id"]?>"/>
                                    <input type="text" id="title" class="form-control" value="<?php echo $_GET["title"]?>"/></td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td><textarea id="description" class="form-control" rows="5"><?php echo $_GET["desc"]?></textarea></td>
                            </tr>

                            <tr>
                                <td></td>
                                <td>
                                    <div role="group" class="btn-group">
                                    <button class="btn btn-primary" type="button" onclick="update_category()">Update</button>
                                    <button class="btn btn-danger" type="button" onclick="delete_category()">Delete</button>
                                    <button class="btn btn-warning" type="button" onclick="load_page('views/categorylist.php')">Back</button></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function update_category() {
        var title = $("#title").val();
        var description = $("#description").val();
        var id=$("#catid").val();
        if (title.length == 0) {
            $("#message").html("<p class='alert alert-warning'>Enter the title</p>");
        } else if (description.length == 0) {
            $("#message").html("<p class='alert alert-warning'>Enter description</p>");

        } else {


            $.ajax({
                type: "POST",
                url: "controls/category.php",
                data: {
                    action: "update",
                    catid:id,
                    title: title,
                    description: description,

                },
                success: function(response) {
                   
                    if (response == "OK") {
                        $("#message").html("<p class='alert alert-success'>Category Updated</p>");
                        setTimeout(function() {
                            load_page('views/categorylist.php')
                        }, 2000);
                    }
                    else {
                        $("#message").html("<p class='alert alert-danger'>"+response+"</p>");
                    }
                }
            });
        }

    }

    function delete_category() {
        
        var id=$("#catid").val();
      
            var r=confirm("Confirm delete?");
            if(r==true){

            $.ajax({
                type: "POST",
                url: "controls/category.php",
                data: {
                    action: "delete",
                    catid:id,
                   
                },
                success: function(response) {
                   
                    if (response == "OK") {
                        $("#message").html("<p class='alert alert-success'>Category Deleted</p>");
                        setTimeout(function() {
                            load_page('views/categorylist.php')
                        }, 2000);
                    }
                    else {
                        $("#message").html("<p class='alert alert-danger'>"+response+"</p>");
                    }
                }
            });
        }
    }

    </script>