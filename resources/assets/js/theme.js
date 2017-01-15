(function($) {
  "use strict";

  //Run function when document ready
  $(document).ready(function() {
    initAffix();
    initLightBox();
    initBtnFile();
    clickEvents();
  });



  function initAffix() {
    $('#affix-box').affix({
      offset: {
        top: function() {
          return (this.top = $('#affix-box').offset().top)
        },
        bottom: function() {
          return (this.bottom = $('.main-footer').outerHeight(true) + $('#map-area').outerHeight(true) + 120)
        }
      }
    });

  }


  //Lightbox (popup)
  function initLightBox() {
    $('.image-popup').magnificPopup({
      type: 'image',
      closeOnContentClick: true,
      closeBtnInside: false,
      fixedContentPos: true,
      mainClass: 'mfp-no-margins mfp-with-zoom', // class to remove default margin from left and right side
      image: {
        verticalFit: true
      },
      zoom: {
        enabled: true,
        duration: 300 // don't foget to change the duration also in CSS
      }
    });

    $('.galery-popup-area').magnificPopup({
      delegate: 'a.galery-popup',
      type: 'image',
      tLoading: 'Loading image #%curr%...',
      mainClass: 'mfp-img-mobile',
      gallery: {
        enabled: true,
        navigateByImgClick: true,
        preload: [0, 1] // Will preload 0 - before current, and 1 after the current image
      },
      image: {
        tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
        titleSrc: function(item) {
          return item.el.attr('title');
        }
      }
    });

    $('.popup-youtube, .popup-vimeo, .popup-gmaps').magnificPopup({
      disableOn: 700,
      type: 'iframe',
      mainClass: 'mfp-fade',
      removalDelay: 160,
      preloader: false,
      fixedContentPos: false
    });
  }


  //Tigger Custom Btn FIle
  function initBtnFile() {
    $(document).on('change', '.btn-file :file', function() {
      var input = $(this),
              numFiles = input.get(0).files ? input.get(0).files.length : 1,
              label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
      input.trigger('fileselect', [numFiles, label]);
    });

    $('.btn-file :file').on('fileselect', function(event, numFiles, label) {
      var input = $(this).parents('.input-group').find(':text'),
              log = numFiles > 1 ? numFiles + ' files selected' : label;
      if (input.length) {
        input.val(log);
      } else {
        if (log) {
          console.log(log);
        }
      }
    });
  }

  function clickEvents() {
    //smooth scroll
    $('.link-innerpage').click(function(e) {
      var target = this.hash, $target = $(target);
      $('html, body').stop().animate({
        'scrollTop': $target.offset().top
      }, 1500, 'easeInOutExpo', function() {
      });
      return false;
    });
    
    //toggle nav mobile 
    $('.btn-nav-toogle').click(function() {
      $('body, .mobile-nav-block').toggleClass('open-mobile-nav');
    });
  }


})(jQuery);









