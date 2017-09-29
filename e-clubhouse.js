var userinfo,gans = [],gqid,usersdata;
function loadUsers() {
  firebase.database().ref('/users/').once('value').then(function(snapshot) {
    usersData = snapshot.val();
  });
}
function authGoogle(){
  var provider = new firebase.auth.GoogleAuthProvider();
  firebase.auth().signInWithPopup(provider).then(function(result) {
    // This gives you a Google Access Token. You can use it to access the Google API.
    var token = result.credential.accessToken;
    // The signed-in user info.
    userinfo = result.user;
    loadUsers();
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
function setVotes(){
  var ref = firebase.database().ref('/votes/'+userinfo.uid+'/');
  ref.once('value',function(snap){
    if(snap.val() != null){
      snap.forEach(function(snapshot){
        if( gans.includes(snapshot.key) ){
          if(snapshot.val().value == 'positive'){
            document.getElementById('tu'+snapshot.key).setAttribute("style","color:#2196F3");
          }else{
            document.getElementById('td'+snapshot.key).setAttribute("style","color:#2196F3");
          }
        }
      });
    }
  });
  ref = firebase.database().ref('/qvotes/'+userinfo.uid+'/'+gqid+'/');
  ref.once('value',function(snap){
    if(snap.val() != null){
          if(snap.val().value == 'positive'){
            document.getElementById('qtu'+gqid).setAttribute("style","color:#2196F3");
          }else{
            document.getElementById('qtd'+gqid).setAttribute("style","color:#2196F3");
          }
    }
  });
}
function change(){
  setVotes();
  $("i").off('click');
  $("i").on('click',function(event) {
    var id = $(this).attr('id');
    if(id != null){
      var id1 = id.split('');
      if(id1[0] == 't'){
        var aid = id.slice(2);
        var ref = firebase.database().ref('/votes/'+userinfo.uid+'/'+aid);
          if(id1[1] == 'u'){
            vote(ref,'positive', aid);
            document.getElementById(id).setAttribute("style","color:#2196F3");
            document.getElementById("td"+aid).setAttribute("style","");
          }else if (id1[1] == 'd') {
            vote(ref,'negative', aid);
            document.getElementById(id).setAttribute("style","color:#2196F3");
            document.getElementById("tu"+aid).setAttribute("style","");
          }else{
            Materialize.toast('Something went wrong',4000);
          }
      }else if(id1[0] == 'q'){
        var ref = firebase.database().ref('/qvotes/'+userinfo.uid+'/'+gqid+'/');
          if(id1[2] == 'u'){
            qvote(ref,'positive');
            document.getElementById(id).setAttribute("style","color:#2196F3");
            document.getElementById("qtd"+gqid).setAttribute("style","");
          }else if (id1[2] == 'd') {
            qvote(ref,'negative');
            document.getElementById(id).setAttribute("style","color:#2196F3");
            document.getElementById("qtu"+gqid).setAttribute("style","");
          }else{
            Materialize.toast('Something went wrong',4000);
          }
      }
    }
  });
}
function qvote(voteRef, val){
  var votebvalue='';
  voteRef.once('value',function(snap){
    if(snap.val() == null){
      votebvalue = null;
    }else{
      votebvalue = snap.val().value;
    }
    var ansref = firebase.database().ref('/questions/'+gqid+'/').child('votes');
      ansref.transaction(function(votes){
        if(votes != null){
          if(val == 'positive'){
            if(votebvalue == null)
              return votes+1;
            else if(votebvalue == 'negative')
              return votes+2;
            else
              Materialize.toast('No Change',4000);
          }else if(val == 'negative'){
            if(votebvalue == null)
              return votes-1;
            else if(votebvalue == 'positive')
              return votes-2;
            else
              Materialize.toast('No Change',4000);
          }else{
            Materialize.toast('Something went wrong',4000);
            return;
          }
      }
      return votes;
    });
    voteRef.transaction(function(vote) {
      vote={value : val};
      return vote;
    });
  });
}
function vote(voteRef, val, aid) {
    var votebvalue='';
    voteRef.once('value',function(snap){
      if(snap.val() == null){
        votebvalue = null;
      }else{
        votebvalue = snap.val().value;
      }
      var ansref = firebase.database().ref('/answers/'+gqid+'/'+aid+'/').child('votes');
        ansref.transaction(function(votes){
          if(votes != null){
            if(val == 'positive'){
              if(votebvalue == null)
                return votes+1;
              else if(votebvalue == 'negative')
                return votes+2;
              else
                Materialize.toast('No Change',4000);
            }else if(val == 'negative'){
              if(votebvalue == null)
                return votes-1;
              else if(votebvalue == 'positive')
                return votes-2;
              else
                Materialize.toast('No Change',4000);
            }else{
              Materialize.toast('Something went wrong',4000);
              return;
            }
        }
        return votes;
      });
      voteRef.transaction(function(vote) {
        vote={value : val};
        return vote;
      });
    });
    /*var p = firebase.database().ref().child('value');
    p.transaction(function(temp){
      if(val != null)
        return temp+1;
      return temp;
    });*/
}
function answer(){
  var firebaseRef = firebase.database().ref('/answers/'+gqid+'/'),
      akey=firebaseRef.push().key,
      ans=CKEDITOR.instances.editor.getData(),
      obj={
        answer : ans,
        votes : 0,
        by : userinfo.displayName,
        date : firebase.database.ServerValue.TIMESTAMP,
        id : akey,
        uid : userinfo.uid
      };
  firebaseRef.child(akey).set(obj);
  Materialize.toast("Thankyou for answering",4000);
  //document.getElementById(akey).scrollIntoView(true);
  $('#'+akey).goTo();
  CKEDITOR.instances.editor.setData('');
  console.log(ans);
}
function comment(aid,name){
  var lcmt = document.getElementById("cmt-"+aid).value;
  if(lcmt.length <= 500){
    var con = confirm('Review your comment\n'+lcmt+'\ndo you want to comment');
    if(con == true){
      var firebaseRef = firebase.database().ref('/answers/'+gqid+'/'+aid+'/comments/'),
          ckey=firebaseRef.push().key,
          obj={
            comment : lcmt,
            by : name,
            date : firebase.database.ServerValue.TIMESTAMP,
            id : ckey
          };
      firebaseRef.child(ckey).set(obj);
      Materialize.toast('Your comment is updated, Thank you',3000);
    }else {
      Materialize.toast('Your comment is not updated',4000);
    }
  }else{
    Materialize.toast('Your comment size should be less than 500',4000);
  }
}
function qcomment(){
  var lcmt = document.getElementById("cmt-"+gqid).value;
  if(lcmt.length <= 500){
    var con = confirm('Review your comment\n'+lcmt+'\ndo you want to comment');
    if(con == true){
      var firebaseRef = firebase.database().ref('/questions/'+gqid+'/comments/'),
          ckey=firebaseRef.push().key,
          obj={
            comment : lcmt,
            by : userinfo.displayName,
            date : firebase.database.ServerValue.TIMESTAMP,
            id : ckey
          };
      firebaseRef.child(ckey).set(obj);
      document.getElementById("cmt-"+gqid).value = '';
      Materialize.toast('Your comment is updated, Thank you',3000);
    }else {
      Materialize.toast('Your comment is not updated',4000);
    }
  }else{
    Materialize.toast('Your comment size should be less than 500',4000);
  }
}
function onload(){
  gqid=document.getElementById("quesvalue").innerHTML;
  console.log(gqid);
  gqid=gqid.toString();
  console.log(gqid);
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
      loadUsers();
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
  var qtitle=document.getElementById('qtitle'),
      question=document.getElementById('question'),
      qname=document.getElementById('qname'),
      qdate=document.getElementById('qdate'),
      qvotes=document.getElementById('qvotes'),
      qchips=document.getElementById('ch'+gqid),
      firebaseRef = firebase.database().ref('/questions/'+gqid+'/');
  firebaseRef.off('value');
  firebaseRef.on('value',function(snap){
    if(snap.val() == null){
      Materialize.toast("Sorry somethingwent wrong, Please contact us");
      window.history.back();
      window.location.href = "/forum.php";
    }
    var val=snap.val();
    qtitle.innerHTML=val.title;
    question.innerHTML=val.question;
    qname.innerHTML='<img align="center" src="'+usersData[val.uid].photoURL+'" width="30" height="30">'+'By '+val.by;
    qdate.innerHTML=(new Date(val.date)).toDateString();
    qvotes.innerHTML=val.votes;
    if( val.tags != undefined){
      var qchipstemp='';
      for( x in val.tags){
        qchipstemp += '<div class="chip">'+val.tags[x].tag+'</div>';
      }
      qchips.innerHTML = qchipstemp;
    }
  });
  var firebaseRefCommt = firebase.database().ref('/questions/'+gqid+'/comments/');
  firebaseRefCommt.off('value');
  firebaseRefCommt.on('value',function(snapCommt){
    console.log(snapCommt);
    if(snapCommt.val() != undefined){
      var cmmtval = snapCommt.val();
      var carray = Object.keys(snapCommt.val());
      var csize = carray.length - 1,init=0;
      if(csize > 2)
        init = csize-2;
      var data= '';
      for (var i = init; i <= csize; i++){
        data += '<p class="comment">'+cmmtval[carray[i]].comment+' -<span style="color:grey">'+cmmtval[carray[i]].by+' '+(new Date(cmmtval[carray[i]].date)).toDateString()+'</span><p><div class="divider"></div>';
      }
      document.getElementById('qcommt').innerHTML = data;
    }
  });
  var firebaseRefAns = firebase.database().ref('/answers/'+gqid+'/').orderByChild('votes');
  firebaseRefAns.off('value');
  firebaseRefAns.on('value',function(snap){
    var val2 = snap.val();
    if(val2 == null){
      document.getElementById('ans-num').innerHTML = '0';
      document.getElementById('nothing').innerHTML = 'Be the first to Answer';
      document.getElementById('data-container').style='';
      document.getElementById('loader').style='display:none';
      change();
    }else{
      var val;
      var size=Object.keys(snap.val()).length;
      document.getElementById('ans-num').innerHTML = size;
      var data=[];
      snap.forEach(function(snapshot){
        val=snapshot.val();
        gans.push(val.id);
        //data[--size] = '<div class="col s10 m10 offset-s1 offset-m1 card horizontal teal accent-1" id="'+val.id+'"><div class="card-content center"><i class="medium material-icons vote" id="tu'+val.id+'">thumb_up</i><br>'+val.votes+'<br><i class="medium material-icons vote" id="td'+val.id+'">thumb_down</i></div><div class="card-stacked"><div class="card-content"><p>'+val.answer+'</p></div><div class="divider"></div><span class="right-align flow"><img src="'+val.photoURL+'" width=30 height=30>By '+val.by+'<br>'+(new Date(val.date)).toDateString()+'</span>';

        data[--size] = '<table id="'+val.id+'"><tr><td class="col m1 s2 center" style="padding-left:0;padding-top:1em;"><i class="medium material-icons vote" id="tu'+val.id+'">thumb_up</i><br>'+val.votes+'<br><i class="medium material-icons vote" id="td'+val.id+'">thumb_down</i><td class="col m11 s10"><p>'+val.answer+'</p><div class="right-align"><img align="center" src="'+usersData[val.uid].photoURL+'" width=30 height=30><span>By '+val.by+'</span><br><span>'+(new Date(val.date)).toDateString()+'</span></div><div class="divider"></div>';

        /* -----comments------ */
        if(val.comments != undefined){
          var carray = Object.keys(val.comments);
          var csize = carray.length - 1,init=0;
          if(csize > 2)
            init = csize-2;
          for (var i = init; i <= csize; i++){
            //data[size] += '<div class="divider green darken-4"></div><p>'+val.comments[carray[i]].comment+' -<span style="color:grey">'+val.comments[carray[i]].by+'-</span> <span style="color:grey">'+(new Date(val.comments[carray[i]].date)).toDateString()+'</span></p>';

            data[size] += '<p class="comment">'+val.comments[carray[i]].comment+' -<span style="color:grey">'+val.comments[carray[i]].by+' '+(new Date(val.comments[carray[i]].date)).toDateString()+'</span><p><div class="divider"></div>';
          }
        }
        //data[size] += "<div class='row' style='margin:0 0'><div class='input-field col s12 m9' style='margin:0 0;padding:0 0'><input id='cmt-"+val.id+"' type='text' placeholder='Comment' data-length='150' class='validate'></div><button class='btn waves-effect waves-light col s4 m2' type='submit' onclick='comment(&quot;"+val.id+"&quot;,&quot;"+userinfo.displayName+"&quot;)'><i class='material-icons'>send</i></button></div></div></div>";

        data[size] += '<div class="row" style="margin-top:10"><div class="input-field col m10 s12" style="margin:0 0;padding:0 0"><input  id="cmt-'+val.id+'" type="text" placeholder="Comment" data-length="500" class="validate"></div><button class="btn waves-effect waves-light col m2 s4" style="margin:0;" type="submit" onclick="comment(\''+val.id+'\',\''+userinfo.displayName+'\')"><i class="material-icons">send</i></button></div></tr></table><div class="divider"></div>';

      });
      data[size] += '</div>';
      document.getElementById('nothing').innerHTML = data.join('');
      $('input').characterCounter();
      document.getElementById('data-container').style='';
      document.getElementById('loader').style='display:none';
      change();
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
