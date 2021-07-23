<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">Cards</h5>
            </div>
            <div class="card-body">
                <div id="message"></div>
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td>
                                    <input id="cardid" type="hidden" value='<?php echo $_GET["id"]; ?>'/>
                                    <input type="text" id="name" class="form-control" placeholder="Card Name" value='<?php echo $_GET["name"]; ?>' /></td>
                            </tr>
                            <tr>
                                <td>Category</td>
                                <td>
                                    <select id="category" class="form-control"></select>
                                </td>
                            </tr>
                            <tr>
                                <td>Description</td>
                                <td><textarea id="description" class="form-control" rows="5" placeholder="Card Description"><?php echo $_GET['desc'];?></textarea></td>
                            </tr>

                            <tr>
                                <td>Tag(s)</td>
                                <td><input type="text" id="tag" class="form-control" placeholder="Card Tags (e.g animals,toys,nature,etc)" value='<?php echo $_GET["tag"]; ?>' /></td>
                            </tr>

                            <tr>
                                <td></td>
                                <td>
                                    <div role="group" class="btn-group">
                                        <button class="btn btn-primary" type="button" onclick="update_cards()">Update</button>
                                        <button class="btn btn-danger" type="button" onclick="delete_cards()">Delete</button>
                                        <button class="btn btn-warning" type="button" onclick="load_page('views/cardlist.php')">Back</button></div>
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
    $(document).ready(function() {
        category_list();
    })

    function category_list() {
        $.ajax({
            url: "controls/category.php",
            type: "POST",
            data: {
                action: "categorylist"
            },
            success: function(response) {

                $("#category").append(response);

            }
        })
    }

    function update_cards() {
        var name = $("#name").val();
        var description = $("#description").val();
        var tag = $("#tag").val();
        if (name.length == 0) {
            $("#message").html("<p class='alert alert-warning'>Enter the name</p>");
        } else if (description.length == 0) {
            $("#message").html("<p class='alert alert-warning'>Enter description</p>");
        } else if (tag.length == 0) {
            $("#message").html("<p class='alert alert-warning'>Enter tags</p>");

        } else {


            $.ajax({
                type: "POST",
                url: "controls/cards.php",
                data: {
                    action: "update",
                    id:$("#cardid").val(),
                    name: name,
                    category: $("#category").val(),
                    description: description,
                    tag: tag

                },
                success: function(response) {

                    if (response == "OK") {
                        $("#message").html("<p class='alert alert-success'>Cards Updated</p>");
                        setTimeout(function() {
                            load_page('views/cardlist.php')
                        }, 1000);
                    } else {
                        $("#message").html("<p class='alert alert-danger'>" + response + "</p>");
                    }
                }
            });
        }

    }

    function delete_cards() {
        
        var id=$("#cardid").val();
      
            var r=confirm("Confirm delete?");
            if(r==true){

            $.ajax({
                type: "POST",
                url: "controls/cards.php",
                data: {
                    action: "delete",
                    cardid:id,
                   
                },
                success: function(response) {
                   
                    if (response == "OK") {
                        $("#message").html("<p class='alert alert-success'>Card Deleted</p>");
                        setTimeout(function() {
                            load_page('views/cardlist.php')
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