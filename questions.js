var userinfo;
function authGoogle(){
  var provider = new firebase.auth.GoogleAuthProvider();
  firebase.auth().signInWithPopup(provider).then(function(result) {
    // This gives you a Google Access Token. You can use it to access the Google API.
    var token = result.credential.accessToken;
    // The signed-in user info.
    userinfo = result.user;
    var udata={
      displayName : userinfo.displayName,
      photoURL : userinfo.photoURL,
      uid : userinfo.uid
    };
    firebase.database().ref('/users/').child(userinfo.uid).set(udata);
  }).catch(function(error) {
    var errorMessage = error.message;
    Materialize.toast(errorMessage,10000);
  });
}
function onload(){
  // Initialize Firebase
  var config = {
      apiKey: "AIzaSyB-y41dwVST1lc1LcC7BpIprci2XLn5aqg",
      authDomain: "html-demo-a768b.firebaseapp.com",
      databaseURL: "https://html-demo-a768b.firebaseio.com",
      projectId: "html-demo-a768b",
      storageBucket: "html-demo-a768b.appspot.com",
      messagingSenderId: "30004107941"
  };
  firebase.initializeApp(config);firebase.auth().onAuthStateChanged(function(user) {
    if (user) {
      userinfo = user;
      var udata={
        displayName : userinfo.displayName,
        photoURL : userinfo.photoURL,
        uid : userinfo.uid
      };
      firebase.database().ref('/users/').child(userinfo.uid).set(udata);
      console.log(userinfo);
      Materialize.toast( user.displayName +" logged in",4000);
      load();
    } else {
      Materialize.toast( "login to traverse the website ",4000);
      authGoogle();
    }
  });
}
function load(){
  var quesref = firebase.database().ref('/questions/');
  quesref.once("value",function(snap){
    if(snap == null){

    }else{
      var size = Object.keys(snap.val()).length;
      var data=[];
      snap.forEach(function(snapshot){
        val=snapshot.val();
        console.log(val);
        data[--size] = '<div class="row"><div class="col s12 m12"><a href="answers.php?ques='+val.id+'"><h5>'+val.title+'</h5></a></div><div class="col s12 m12">';
        if(val.tags != undefined){
          for (x in val.tags){
            data[size] += '<div class="chip">'+val.tags[x].tag+'</div>';
          }
        }
        data[size] += '</div><div class="col s12 m12"><span>By '+val.by+'</span><span class="right">'+(new Date(val.date)).toDateString()+'</span></div></div><div class="divider"></div>';
      });
      console.log(data);
      document.getElementById("questions").innerHTML = data.join('');
      document.getElementById('data-container').style='';
      document.getElementById('loader').style='display:none';
    }
  });
  CKEDITOR.replace('editor');
  CKEDITOR.instances.editor.on('change', function() {
    document.getElementById('editor-test').innerHTML = CKEDITOR.instances.editor.getData();
  });
  (function($) {
      $.fn.goTo = function() {
          var ele = $(this);
          $('html, body').animate({
              scrollTop: ele.offset().top-100 + 'px'
          }, 'fast');
          ele.animate({opacity:"0.1"});
      }
  })(jQuery);
}
function question(){
  var firebaseRef = firebase.database().ref('/questions/'),
      qkey=firebaseRef.push().key,
      que=CKEDITOR.instances.editor.getData(),
      qtitle=editor_name.question_title.value,
      chip=$('.chips-placeholder').material_chip('data') ? $('.chips-placeholder').material_chip('data') :'';
      console.log($('.chips-placeholder').material_chip('data'));
      console.log(chip);
  if( qtitle == '' || que == ''){
    Materialize.toast("Title and question is needed",3000);
  }else{
    if(confirm('Do you want to insert your question\n'+qtitle)){
      var obj={
            title : qtitle,
            question : que,
            by : userinfo.displayName,
            date : firebase.database.ServerValue.TIMESTAMP,
            id : qkey,
            votes : 0,
            tags : chip,
            uid : userinfo.uid
          };
      firebaseRef.child(qkey).set(obj);
      Materialize.toast("your question is updated, Thank you",3000);
      window.location="answers.php?ques="+qkey;
    }else{
      Materialize.toast("your question is not updated",3000);
    }
  }
}
