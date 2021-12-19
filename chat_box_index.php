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
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>chat box</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">   
</head>
 
<body>
 
<style type="text/css">
div#messagesDiv{
    display: block;
    height: 280px;
    overflow: auto;
    background-color: #FDFDE0;
    width: 700px;
    margin: 5px 0px;
    border: 1px solid #CCC;
}
.left_box_chat{
    border: 1px solid #CCC;
    border-radius: 25px;
    margin: 5px;
    padding: 0px 10px;
    display:inline-block;
    float:left;
    clear:both;
    text-align:left;
    background-color:#FFF;  
}
.right_box_chat{
    border: 1px solid #CCC;
    border-radius: 25px;
    margin: 5px;
    padding: 0px 10px;
    display:inline-block;
    float:right;
    clear:both;
    text-align:right;
    background-color:#9F6;
}
</style>
 
<br>
<div id="messagesDiv">
<!--<div class="left_box_chat">1</div>
<div class="right_box_chat">2</div>-->
</div>
<div class="bg-info" style="width:700px;padding:5px 0px;">
<div class="row">
  <div class="col-xs-4">
    <input type="text" class="form-control" name="userID1" id="userID1" value="<?=(isset($_SESSION['ses_user_id']))?$_SESSION['ses_user_id']:''?>" placeholder="UserID 1">
    <input type="text" class="form-control" name="userID2" id="userID2" value="<?=(isset($_SESSION['ses_user_id2']))?$_SESSION['ses_user_id2']:''?>" placeholder="UserID 2">    
  </div>
  <div class="col-xs-5">
<!--  input hidden สำหรับ เก็บ chat_id ล่าสุดที่แสดง-->
  <input name="h_maxID" type="hidden" id="h_maxID" value="0">
  <input type="text" class="form-control" name="msg" id="msg" placeholder="Message">
  </div>
</div>
</div>
<br>
การใช้งาน<br>
1. ทดสอบโดยเปิดบราวเซอร์ 2 อันเช่น chrome กับ firefox แล้วรันไฟล์ทดสอบนี้<br>
2. ที่ chrome <br>
    2.1 ให้เลือก user 1 แล้วกดปุ่ม Set user 1<br>
    2.2 ให้เลือก user 2 แล้วกดปุ่ม Set user 2<br>    
3. ที่ firefox  <br>
    3.1 ให้เลือก user 2 แล้วกดปุ่ม Set user 1<br>
    3.2 ให้เลือก user 1 แล้วกดปุ่ม Set user 2<br>    
4. เร่ิมการสนทนา
<br>
<form name="form1" method="post" action="">
  <select name="userID" id="userID">
    <option value="1">User 1</option>
    <option value="2">User 2</option>    
  </select>
  <input type="submit" name="set_user1" value="Set User 1">
    <input type="submit" name="set_user2" value="Set User 2">
</form>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>      
<script type="text/javascript">
var load_chat; // กำหนดตัวแปร สำหรับเป็นฟังก์ชั่นเรียกข้อมูลมาแสดง
var first_load=1; // กำหนดตัวแปรสำหรับโหลดข้อมูลครั้งแรกให้เท่ากับ 1
load_chat = function(userID){
    var maxID = $("#h_maxID").val(); // chat_id ล่าสุดที่แสดง
    $.post("ajax_chat.php",{
        viewData:first_load,
        userID:userID,
        maxID:maxID
    },function(data){
        if(first_load==1){ // ถ้าเป็นการโหลดครั้งแรก ให้ดึงข้อมูลทั้งหมดที่เคยบันทึกมาแสดง
            for(var k=0;k<data.length;k++){ // วนลูปแสดงข้อความ chat ที่เคยบันทึกไว้ทั้งหมด
                if(parseInt(data[0].max_id)>parseInt(maxID)){ // เทียบว่าข้อมูล chat_id .ใหม่กว่าที่แสดงหรือไม่
                    $("#h_maxID").val(data[k].max_id); // เก็บ chat_id เป็น ค่าล่าสุด
                    // แสดงข้อความการ chat มีการประยุกต์ใช้ ตำแหน่งข้อความ เพื่อจัด css class ของข้อความที่แสดง
                    $("#messagesDiv").append("<div class=""+data[k].data_align+"_box_chat">"+data[k].data_msg+"</div>"); 
                    $("#messagesDiv")[0].scrollTop = $("#messagesDiv")[0].scrollHeight; // เลือน scroll ไปข้อความล่าสุด     
                }
            };
        }else{ // ถ้าเป็นข้อมูลที่เพิ่งส่งไปล่าสุด
            if(parseInt(data[0].max_id)>parseInt(maxID)){ // เทียบว่าข้อมูล chat_id .ใหม่กว่าที่แสดงหรือไม่
                $("#h_maxID").val(data[0].max_id); // เก็บ chat_id เป็น ค่าล่าสุด
                // แสดงข้อความการ chat มีการประยุกต์ใช้ ตำแหน่งข้อความ เพื่อจัด css class ของข้อความที่แสดง
                $("#messagesDiv").append("<div class=""+data[0].data_align+"_box_chat">"+data[0].data_msg+"</div>"); 
                $("#messagesDiv")[0].scrollTop = $("#messagesDiv")[0].scrollHeight;   // เลือน scroll ไปข้อความล่าสุด
            }
        }
        first_load++;// บวกค่า first_load
    });     
}
// กำหนดให้ทำงานทกๆ 2.5 วินาทีเพิ่มแสดงข้อมูลคู่สนทนา
setInterval(function(){
    var userID = $("#userID2").val(); // id user ของผู้รับ
    load_chat(userID); // เรียกใช้งานฟังก์ช่นแสดงข้อความล่าสุด
},2500);    
$(function(){
     
 
 /// เมื่อพิมพ์ข้อความ แล้วกดส่ง
  $("#msg").keypress(function (e) { // เมื่อกดที่ ช่องข้อความ  
    if (e.keyCode == 13) { // ถ้ากดปุ่ม enter  
      var user1 = $("#userID1").val(); // เก็บ id user  ผู้ใช้ที่ส่ง
      var user2 = $("#userID2").val(); // เก็บ id user  ผู้ใช้ที่รับ
      var msg = $("#msg").val();  // เก็บค่าข้อความ  
      $.post("ajax_chat.php",{
          user1:user1,
          user2:user2,
          msg:msg
      },function(data){
            load_chat(user2);// เรียกใช้งานฟังก์ช่นแสดงข้อความล่าสุด
            $("#msg").val(""); // ล้างค่าช่องข้อความ ให้พร้อมป้อนข้อความใหม่          
      });
 
    }  
  });  
   
});
 
</script>
</body>
</html>
