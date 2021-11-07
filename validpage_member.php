<?hpp
ob_start();
if(!isset($_SESSION['user'])){
    session_start();
}
if(!isset($_SESSION['user'])){
    header("location:../404.php?level=member atau admin");
}else{
    $level = $_SESSION['level'];
    if(!($level=="admin" or $level=="user")){
        header("location:../404.php?level=member atau user");
    }
}

ob_flush();
?>