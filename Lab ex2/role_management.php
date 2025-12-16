<?php
require 'config.php';
require 'check_permission.php';
requirePermission('delete_user');

function addPermissionToRole($role,$perm){
 global $conn;
 mysqli_query($conn,"INSERT INTO role_permissions VALUES($role,$perm)");
}
function removePermissionFromRole($role,$perm){
 global $conn;
 mysqli_query($conn,"DELETE FROM role_permissions WHERE role_id=$role AND permission_id=$perm");
}

if(isset($_POST['add'])) addPermissionToRole($_POST['role_id'],$_POST['permission_id']);
if(isset($_POST['remove'])) removePermissionFromRole($_POST['role_id'],$_POST['permission_id']);
?>

<form method="post">
Role ID <input name="role_id">
Permission ID <input name="permission_id">
<button name="add">Add</button>
<button name="remove">Remove</button>
</form>
