<?php
require 'auth.php';
if(checkAccess('view_user')) echo "<a>View</a><br>";
if(checkAccess('edit_user')) echo "<a>Edit</a><br>";
if(checkAccess('delete_user')) echo "<a>Delete</a><br>";
?>