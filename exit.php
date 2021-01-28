<?php
setcookie('isAdmin',false,time() + 3600,"/");
header ('Location: index.php');