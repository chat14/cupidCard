
}

function login(){
    var name = document.getElementById("input_name").value;
    localStorage.setItem("name" , name);
    window.location.replace("chat.html");


}

setInterval(function(){
    var name = document.getElementById("input_name").value;
    if(name != ""){
        document.getElementById("btn_login").disabled = false;
    }else{
        document.getElementById("btn_login").disabled = true;
    }
},100)
