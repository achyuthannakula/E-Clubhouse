<?php require('nav.html'); ?>
<script src="questions.js"></script>
<script src="ckeditor/ckeditor.js"></script>
<script>
  document.getElementById("forum").className = 'bold active blue';
  document.getElementById("page").innerHTML = 'Forum';
</script>
<script>
  $(document).ready(function(){
    onload();
  });
</script>
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
  <div id='data-container' style='display:none'>
    <div class="container"><h4 style="color:grey;">New Questions</h4></div>
    <div class="container divider"></div>
    <div class="container" id="questions">
    </div>
    <div class="container" id='editor-container'>
      <form  name="editor_name">
        <h4 style="color:grey;">Your Question</h4>
        <div class="input-field">
        <input type="text" id="question-title" name="question_title">
        <label for="question-title">Question Title*</label></div>
        <div class="chips chips-placeholder"></div>
        <textarea name='editor' id='editor'></textarea>
        <div class='divider' style="margin:1ex 0"></div>
        <div id='editor-test'></div>
        <div class='divider' style="margin:1ex 0"></div>
      </form>
      <button class="btn waves-effect waves-light right" name='question' style="margin:1ex 0ex" onclick="question()">Submit<i class='material-icons right'>send</i></button>
    </div>
  </div>
</main>
<?php
require('footer.html');
?>
