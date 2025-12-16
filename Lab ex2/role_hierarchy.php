<?php
require 'config.php';
function getRolePermissions($role_id,&$perms=[]){
 global $conn;
 $sql="SELECT p.permission_name FROM role_permissions rp
       JOIN permissions p ON rp.permission_id=p.permission_id
       WHERE rp.role_id=$role_id";
 $res=mysqli_query($conn,$sql);
 while($r=mysqli_fetch_assoc($res)) $perms[]=$r['permission_name'];

 $parent=mysqli_fetch_assoc(mysqli_query($conn,
   "SELECT role_inherit FROM roles WHERE role_id=$role_id"));
 if($parent && $parent['role_inherit'])
   getRolePermissions($parent['role_inherit'],$perms);

 return array_unique($perms);
}
?>