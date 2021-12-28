const firebaseConfig = {
    apiKey: "AIzaSyCdzOztUwC9tyUqIlbmjoHqzIXXhnPSwpg",
    authDomain: "chat-4f7b7.firebaseapp.com",
    databaseURL: "https://chat-4f7b7-default-rtdb.firebaseio.com",
    projectId: "chat-4f7b7",
    storageBucket: "chat-4f7b7.appspot.com",
    messagingSenderId: "130067014590",
    appId: "1:130067014590:web:8c864d254ad888bce30fef",
    measurementId: "G-EW1555DRKH"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);
  const analytics = getAnalytics(app);

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
