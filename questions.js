var userinfo,loading=0;
function authGoogle(){
  var provider = new firebase.auth.GoogleAuthProvider();
  firebase.auth().signInWithRedirect(provider);
  firebase.auth().getRedirectResult().then(function(result) {
    if (result.credential) {
      // This gives you a Google Access Token. You can use it to access the Google API.
      var token = result.credential.accessToken;
      userinfo = result.user;
      var udata={
        displayName : userinfo.displayName,
        photoURL : userinfo.photoURL,
        uid : userinfo.uid
      };
      firebase.database().ref('/users/').child(userinfo.uid).set(udata);
      document.getElementById('user-dp').innerHTML = '<img src="'+userinfo.photoURL+'" class="circle resposive-img" alt="'+userinfo.displayName.split('')[0]+'" width="40px" height="40px">';
      document.getElementById('user-dropdown').innerHTML += '<ul id="user-dp-dropdown" class="dropdown-content"><li><a href="#!" onclick="logout()">logout</a></li</ul>';
    }
  // The signed-in user info.
    var user = result.user;
  }).catch(function(error) {
    // Handle Errors here.
    var errorCode = error.code;
    var errorMessage = error.message;
    Materialize.toast(errorMessage,10000);
    // The email of the user's account used.
    var email = error.email;
    // The firebase.auth.AuthCredential type that was used.
    var credential = error.credential;
    // ...
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
  firebase.initializeApp(config);
  firebase.auth().onAuthStateChanged(function(user) {
    if (user) {
      userinfo = user;
      var udata={
        displayName : userinfo.displayName,
        photoURL : userinfo.photoURL,
        uid : userinfo.uid
      };
      document.getElementById('user-dp').innerHTML = '<img src="'+userinfo.photoURL+'" class="circle resposive-img" alt="'+userinfo.displayName.split('')[0]+'" width="40px" height="40px">';
      document.getElementById('user-dropdown').innerHTML += '<ul id="user-dp-dropdown" class="dropdown-content"><li><a href="#!" onclick="logout()">logout</a></li</ul>';
      firebase.database().ref('/users/').child(userinfo.uid).set(udata);
      console.log(userinfo);
      Materialize.toast( user.displayName +" logged in",4000);
      load(1);
    } else {
      if(confirm("Login is Required:\nDo you want to continue..")){
        authGoogle();
      }else{
        window.location = "index.php";
      }
    }
  },function(error){
    console.log(error);
    error();
  });
}
function load(sort_id){
  var conatiner_title='';
  switch (sort_id) {
    case 1:container_title = 'New Questions';

      break;
    case 2:container_title = 'Older Questions';

      break;
    case 3:container_title = 'Most voted questions';

      break;
    default:container_title = 'Questions';
  }
  document.getElementById('container_title').innerHTML = container_title;
  document.getElementById('qdata-container').style='display:none';
  document.getElementById('loader').style='';
  var quesref = firebase.database().ref('/questions/');
  if(sort_id == 3)
    var quesref = firebase.database().ref('/questions/').orderByChild('votes');
  quesref.once("value",function(snap){
    if(snap == null){
      document.getElementById("questions").innerHTML = 'Be the first to question';
    }else{
      var size = Object.keys(snap.val()).length;
      var data=[];
      if(sort_id == 1 || sort_id == 3){
        snap.forEach(function(snapshot){
          val=snapshot.val();
          data[--size] = '<div class="row"><div class="col s12 m12"><a href="answers.php?ques='+val.id+'"><h5>'+val.title+'</h5></a></div><div class="col s12 m12">';
          if(val.tags != undefined){
            for (x in val.tags){
              data[size] += '<div class="chip">'+val.tags[x].tag+'</div>';
            }
          }
          data[size] += '</div><div class="col s12 m12"><span>By '+val.by+'</span><span class="right">'+(new Date(val.date)).toDateString()+'</span></div></div><div class="divider"></div>';
        });
      }
      else{
        size=-1;
        snap.forEach(function(snapshot){
          val=snapshot.val();
          data[++size] = '<div class="row"><div class="col s12 m12"><a href="answers.php?ques='+val.id+'"><h5>'+val.title+'</h5></a></div><div class="col s12 m12">';
          if(val.tags != undefined){
            for (x in val.tags){
              data[size] += '<div class="chip">'+val.tags[x].tag+'</div>';
            }
          }
          data[size] += '</div><div class="col s12 m12"><span>By '+val.by+'</span><span class="right">'+(new Date(val.date)).toDateString()+'</span></div></div><div class="divider"></div>';
        });
      }
      document.getElementById("questions").innerHTML = data.join('');
      document.getElementById('qdata-container').style='';
      document.getElementById('loader').style='display:none';
      $('#qdata-container').goTo();
    }
  },function(error){
    console.log(error);
    loading++;
    if(loading >= 3){
      error();
    }
    load(1);
    return;
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
          ele.animate({opacity:"1"});
      }
  })(jQuery);
  $('#user-dp').dropdown({
    inDuration: 300,
    outDuration: 225,
    constrainWidth: false, // Does not change width of dropdown to that of the activator
    hover: true, // Activate on hover
    gutter: 0, // Spacing from edge
    belowOrigin: false, // Displays dropdown below the button
    alignment: 'left', // Displays dropdown with edge aligned to the left of button
    stopPropagation: false // Stops event propagation
  });
}
function question(){
  var firebaseRef = firebase.database().ref('/questions/'),
      qkey=firebaseRef.push().key,
      que=CKEDITOR.instances.editor.getData(),
      qtitle=editor_name.question_title.value,
      chip=$('.chips-placeholder').material_chip('data') ? $('.chips-placeholder').material_chip('data') :'';
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
function logout(){
  firebase.auth().signOut().then(function() {
    Materialize.toast("You have successfully logged out",4000);
  }).catch(function(error) {
    Materialize.toast("error",4000);
  });
}
function error(){
  Materialize.toast("Something went wrong, reloading the page");
  location.reload();
}
