<?php
if ($_SESSION['UserPrivilege']=='Admin') {
    
}  else {
    header("Location: ../controller/logout.php");
    exit();
}

