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
                <a href="https://scontent.fmaa1-1.fna.fbcdn.net/v/t31.0-8/13662143_1742394349375839_1796454283459354755_o.jpg?oh=756a0416077c3535ac75ebbba326abfc&oe=5A55895D " title="first title"><img class="responsive-img"  src="https://scontent.fmaa1-1.fna.fbcdn.net/v/t31.0-8/13662143_1742394349375839_1796454283459354755_o.jpg?oh=756a0416077c3535ac75ebbba326abfc&oe=5A55895D">
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
                  <a href="t2.jpg"><img class="responsive-img "  src="https://scontent.fmaa1-1.fna.fbcdn.net/v/t31.0-8/13913635_1742394396042501_6504299966365486440_o.jpg?oh=89899bdc683e86ae197a9ea887f80027&oe=5A3C1F10">
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
                    <a  href="t3.jpg"><img class="responsive-img "  src="https://scontent.fmaa1-1.fna.fbcdn.net/v/t31.0-8/13662143_1742394349375839_1796454283459354755_o.jpg?oh=756a0416077c3535ac75ebbba326abfc&oe=5A55895D">
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
                      <div class="card-image gallary" >
                        <a href="t1.jpg" title="first title"><img class="responsive-img"  src="https://scontent.fmaa1-1.fna.fbcdn.net/v/t31.0-8/13662143_1742394349375839_1796454283459354755_o.jpg?oh=756a0416077c3535ac75ebbba326abfc&oe=5A55895D">
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
                          <a href="t2.jpg"><img class="responsive-img "  src="https://scontent.fmaa1-1.fna.fbcdn.net/v/t31.0-8/13913635_1742394396042501_6504299966365486440_o.jpg?oh=89899bdc683e86ae197a9ea887f80027&oe=5A3C1F10">
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
                            <a  href="t3.jpg"><img class="responsive-img "  src="https://scontent.fmaa1-1.fna.fbcdn.net/v/t31.0-8/13662143_1742394349375839_1796454283459354755_o.jpg?oh=756a0416077c3535ac75ebbba326abfc&oe=5A55895D">
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
