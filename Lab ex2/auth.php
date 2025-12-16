<?php
session_start();
require 'data.php';

function hasPermission($user_id,$permission){
 global $users,$roles;
 return isset($users[$user_id]) &&
        in_array($permission,$roles[$users[$user_id]['role']]);
}

if(!isset($_SESSION['user_role'])) $_SESSION['user_role']='admin';

function checkAccess($permission){
 global $roles;
 $role=$_SESSION['user_role']??'guest';
 return in_array($permission,$roles[$role]);
}
?>