var firebaseConfig = {
    apiKey: "AIzaSyDDIQqm2CAPm2s_deRIPdtfvUbSyXKGEX4",
    authDomain: "chatapp-c47c9.firebaseapp.com",
    databaseURL: "https://chatapp-c47c9.firebaseio.com",
    projectId: "chatapp-c47c9",
    storageBucket: "chatapp-c47c9.appspot.com",
    messagingSenderId: "62457490192",
    appId: "1:62457490192:web:bd239aa23bd3d554e7d395",
    measurementId
  }
  // Initialize Firebase
  firebase.initializeApp(firebaseConfig)
  firebase.analytics();

  var name = localStorage.getItem("name");

  function send()
      var msg = document.getElementById('msg_text').value;
      if(msg != ""){
        firebase.database().ref("messages").push({
            msg : msg,
            sender : name

        }).then(function(){
            document.getElementById('msg_text').value = "";
        })
      }
  }

  firebase.database().ref("messages").on("child_added" , function(snapshot){
      var username = snapshot.val().sender;
      var msg = snapshot.val().msg;
      var html = "";
      if(username == name){
          html += "<div class='message_me' align='right'><p class='user'>" +username + "</p><p class='msg_me'>"+ msg +"</p></div>";
          document.getElementById("box_messages").innerHTML += html;

      }else{
        html += "<div class='message_user' align='left'><p class='user'>" +username + "</p><p class='msg_user'>"+ msg +"</p></div>";
        document.getElementById("box_messages").innerHTML += html;
      }

      var div_obj = document.getElementById("box_messages");
      div_obj.scrollTop = div_obj.scrollHeight;
  });
