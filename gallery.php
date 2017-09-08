<!doctype html>
<?php
require('nav.html');
?>
<script>
document.getElementById("gallery").className = 'bold active blue';
document.getElementById("page").innerHTML = 'Gallery';
</script>
<main>
    <div class="container">
      <div class="row popup-gallery">
          <div class="col s12 m4 l4">
            <div class="card animated zoomIn hoverable">
              <div class="card-image gallary" >
                <a href="t1.jpg" title="first title"><img class="responsive-img"  src="https://scontent.fmaa1-1.fna.fbcdn.net/v/t1.0-9/17353213_1455255461161707_6448358661713811918_n.jpg?oh=f5725cf003ffd9414aecb8293ae223d3&oe=5963DFD3">
                  </a>
            </div>
              <div class="card-content">
                <p>Jan 21,2016</p>
                <span class="card-title grey-text text-darken-4">PHP Workshop Day-1</span>
              </div>
            </div>
          </div>
            <div class="col s12 m4 l4">
              <div class="card animated zoomIn hoverable">
                <div class="card-image gallery" >
                  <a href="t2.jpg"><img class="responsive-img "  src="https://scontent.fmaa1-1.fna.fbcdn.net/v/t1.0-9/17353213_1455255461161707_6448358661713811918_n.jpg?oh=f5725cf003ffd9414aecb8293ae223d3&oe=5963DFD3">
                  </a>
                </div>
                <div class="card-content">
                  <p>Jan 21,2016</p>
                  <span class="card-title grey-text text-darken-4">PHP Workshop Day-1</span>
                </div>
              </div>
            </div>
              <div class="col s12 m4 l4">
                <div class="card animated zoomIn hoverable">
                  <div class="card-image gallery" >
                    <a  href="t3.jpg"><img class="responsive-img "  src="https://scontent.fmaa1-1.fna.fbcdn.net/v/t1.0-9/17353213_1455255461161707_6448358661713811918_n.jpg?oh=f5725cf003ffd9414aecb8293ae223d3&oe=5963DFD3">
                    </a>
                </div>
                  <div class="card-content">
                    <p>Jan 21,2016</p>
                    <span class="card-title grey-text text-darken-4">PHP Workshop Day-1</span>
                  </div>
                </div>
              </div>
                <div class="col s12 m4 l4">
                  <div class="card animated zoomIn hoverable">
                    <div class="card-image gallery" >
                      <a  href="t4.jpg"><img class="responsive-img "  src="https://scontent-sit4-1.xx.fbcdn.net/v/t1.0-9/17361900_1456239634396623_7489794277610165927_n.jpg?oh=8215a06053da5d242f3a97d62e43cc21&oe=59553EDA">
                      </a>
                  </div>
                    <div class="card-content">
                      <p>Jan 21,2016</p>
                      <span class="card-title grey-text text-darken-4">PHP Workshop Day-1</span>
                    </div>
                  </div>
                </div>
                  <div class="col s12 m4 l4">
                    <div class="card animated zoomIn hoverable">
                      <div class="card-image gallery" >
                        <a  href="f1.jpg"><img class="responsive-img "  src="https://scontent.fmaa1-1.fna.fbcdn.net/v/t1.0-9/17353213_1455255461161707_6448358661713811918_n.jpg?oh=f5725cf003ffd9414aecb8293ae223d3&oe=5963DFD3">
                        </a>
                    </div>
                      <div class="card-content">
                        <p>Jan 21,2016</p>
                        <span class="card-title grey-text text-darken-4">PHP Workshop Day-1</span>
                      </div>
                    </div>
                  </div>
    </div>
  </div>
</main>
<?php
require('footer.html');
?>
<script>
$(document).ready(function(){
  $('.materialboxed').materialbox();
});
$('.popup-gallery').magnificPopup({
        delegate: 'a',
        type: 'image',
        closeOnContentClick: true,
        fixedContentPos: true,
        tLoading: 'Loading image #%curr%...',
        mainClass: 'mfp-img-mobile mfp-no-margins mfp-with-zoom',
        gallery: {
          enabled: true,
          navigateByImgClick: true,
          preload: [0,1]
        },
        image: {
          verticalFit: true,
          tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
          titleSrc: function(item) {
            return item.el.attr('title') + '<small>by E.C.A</small>';
          },
        zoom: {
          enabled: true,
          duration: 300
        }
        }
      });
</script>
