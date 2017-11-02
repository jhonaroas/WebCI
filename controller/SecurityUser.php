<?php
if (!$_SESSION['UserPrivilege']=='') {
    
}  else {
    header("Location: controller/logout.php");
    exit();
}
