<?php
session_start();
if(!isset($_SESSION["usertype"])){
    header("location: ../index.php");
}
?>

<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h5 class="mb-0">User Profile</h5>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div id="message"></div>
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>Fullname</td>
                                <td><input type="text" id="name" class="form-control" /></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><input type="text" id="email" class="form-control" /></td>
                            </tr>
                            <tr>
                                <td>Username</td>
                                <td><input type="text" id="username" class="form-control" /></td>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td><input type="password" id="password" class="form-control" /></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <div role="group" class="btn-group"><button class="btn btn-primary" type="button" onclick="update_user()">Update</button><button class="btn btn-warning" type="button" onclick="load_page('views/categorylist.php')">Back</button></div>
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
$(document).ready(function(){
    load_profile()
})
function load_profile(){
    $.ajax({
        url:"controls/user.php",
        type:"POST",
        data:{
            action:"load",
            user:"admin"
        },
    success:function(result){
        
    data=$.parseJSON(result);
    $("#name").val(data[0]["fullname"]);
    $("#email").val(data[0]["email"]);
    $("#username").val(data[0]["username"]);
    $("#password").val(data[0]["password"]);
    }

});
}

function update_user() {
    name=$("#name").val();
    email=$("#email").val();
    username=$("#username").val();
    password=$("#password").val();
    if(name.length==0){
        $("#message").html("<p class='alert alert-danger'>Name cannot be empty</p>");
    }
    else if(email.length==0){
        $("#message").html("<p class='alert alert-danger'>Name cannot be empty</p>");
    }
    else if(username.length< 5){
        $("#message").html("<p class='alert alert-danger'>username cannot be less than 5 characters</p>");
    }
    else if(password.length==0){
        $("#message").html("<p class='alert alert-danger'>password cannot be less than 5 characters</p>");
    }
    else{
        $.ajax({
            url:"controls/user.php",
            type:"POST",
            data:{
                action:"update",
                name:name,
                email:email,
                username:username,
                password:password
            },
            success:function(result){
                if(result=="OK"){
                    $("#message").html("<p class='alert alert-success'>Update Successfull</p>");
                    setTimeout(function(){
                        load_page("views/categorylist.php")
                    },
                    2000)
                }
            }

        })
    }
}
</script>