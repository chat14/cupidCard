<?php
session_start();
// สำหรับใช้ในตัวอย่างการกำหนด session user_id
if(isset($_POST['set_user1'])){
    $_SESSION['ses_user_id']=$_POST['userID'];
}
if(isset($_POST['set_user2'])){
    $_SESSION['ses_user_id2']=$_POST['userID'];
}
?>
