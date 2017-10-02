<?php require('nav.html'); ?>
<script src="questions.js"></script>
<script>
  document.getElementById("forum").className = 'bold active blue';
  document.getElementById("page").innerHTML = 'Forum';
  $(document).ready(function(){
    onload();
  });
</script>
<script src="e-clubhouse.js"></script>
<script src="ckeditor/ckeditor.js"></script>
<main>
  <div class="preloader-wrapper big active" id='loader'>
      <div class="spinner-layer spinner-blue">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>

      <div class="spinner-layer spinner-red">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>

      <div class="spinner-layer spinner-yellow">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>

      <div class="spinner-layer spinner-green">
        <div class="circle-clipper left">
          <div class="circle"></div>
        </div><div class="gap-patch">
          <div class="circle"></div>
        </div><div class="circle-clipper right">
          <div class="circle"></div>
        </div>
      </div>
  </div>

  <div class="container" id="data-container" style="display:none"><h4 style="color:grey;"><strong id="qtitle">Here is the Tilte of the question</strong></h4>
    <div class="row">
      <div id="quesvalue" style="display:none;"><?php echo $_GET["ques"]?></div>

      <div class="col m12 s12">
        <table>
          <tr>
            <td class="col m1 s2 center" style="padding-left:0;padding-top:1em;"><i class="medium material-icons vote" id="qtu<?php echo $_GET["ques"]?>">thumb_up</i><br><span id="qvotes">21</span><br><i class="medium material-icons vote" id="qtd<?php echo $_GET["ques"]?>">thumb_down</i>
            </td>
            <td class="col m11 s10"><p id="question">QESTION HERE</p>
            <div id="ch<?php echo $_GET["ques"]?>"></div><br>
            <div class="right-align"><span id="qname">By Achyuth</span><br><span id="qdate">Fri Sep 01 2017</span></div>
            <div class="divider"></div>
            <div id='qcommt'>
              <!--<p class="comment"><span>COMMENT HERE<span> -<span style="color:grey">A Achyuth Fri Sep 01 2017</span><p>
            <div class="divider"></div>--></div>
            <div class='row' style='margin-top:10'>
              <div class='input-field col m10 s12' style='margin:0 0;padding:0 0'>
                <input  id="cmt-<?php echo $_GET["ques"]?>" type='text' placeholder='Comment' data-length='500' class='validate'>
              </div>
              <button class='btn waves-effect waves-light col m2 s4' style='margin:0;' type='submit'  onclick="qcomment()">
                <i class='material-icons'>send</i>
              </button>
            </div>
          </td>
          </tr>
        </table>
      </div>


      <h5 style="color:grey;"><span id='ans-num'>1</span> Answers</h5>
      <div class="divider col m12 s12"></div>

      <div id="nothing" ></div>

    </div>

  <div id='editor-container'>
    <h4 style="color:grey;">Your Answer</h4>
    <textarea name='editor' id='editor' style=""></textarea>
    <div class='divider' style="margin:1ex 0"></div>
    <div id='editor-test'></div>
    <div class='divider' style="margin:1ex 0"></div>
    <button class="btn waves-effect waves-light right" type='submit' name='answer' style="margin:1ex 0ex" onclick="answer()">Submit<i class='material-icons right'>send</i></button>
  </div>

  </div>

</main>
<?php require('footer.html'); ?>
