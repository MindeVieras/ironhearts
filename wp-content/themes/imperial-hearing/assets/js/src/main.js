(function ($) {

$(window).load(function() {	
	
	// Hamburger Button
	var mainNav = $('#site-main-menu');
	$('.hamburger').on('click', function () {
		console.log(this);
		$(this).toggleClass('is-active');
		mainNav.toggleClass('is-open');
		$('#page-wrapper').toggleClass('menu-is-open');
	});

	// Back to top
  $('#to-top').on('click', function (e) {
    e.preventDefault();
    $('html,body').animate({
      scrollTop: 0
    }, 700);
  });


  // Testimonials Slider
  $('.testimonials-slider-content').owlCarousel({
    items: 1,
    nav: true,
    loop: true,
    navText: ['<', '>']
  });
  // Truncate testimonial text
  $('.testimonial-truncate').dotdotdot({
    callback: function(isTruncated) {
      var endQoute = '<div class="qoute end">\
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9.92311 8.51083">\
                          <path d="M0,0H3.779a17.71636,17.71636,0,0,1,.49835,3.81957q0,4.693-4.23514,4.69126V6.68467q1.99172,0,1.99341-2.159V3.57124H0ZM5.64742,0H9.42476a17.61078,17.61078,0,0,1,.49835,3.81957q0,4.693-4.23514,4.69126V6.68467q1.99425,0,1.99341-2.159V3.57124H5.64742Z"/>\
                        </svg>\
                      </div>';
      $(this).append(endQoute);
    },
    truncate: 'word',
    watch: 'window'
  });

  // Testimonials Infinity load Page
  if ($('.testimonials-block').length) {
    var testimonialsBlock = $('.testimonials-block');
    var loadMore = testimonialsBlock.find('.load-more');
    var limit = 3;
    var initialPage = 0;
    
    callForTestimonials(initialPage, limit);

    loadMore.click(function(e){
      e.preventDefault();
      initialPage += limit;
      callForTestimonials(initialPage, limit);
    });

    function callForTestimonials(initialPage, limit) {
      return $.ajax({
              type: "GET",
              url: '/wp-json/api/get-testimonials/'+initialPage+'/'+limit,
              dataType: "json",
              success: function (res) {
                if (res.ack == 'ok') {
                  var content = testimonialsBlock.find('.testimonials-content');
                  res.data.forEach(function(row){
                    var text = '<div class="testimonial-item block">\
                                  <div class="qoute">\
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9.59771 8.51083">\
                                      <path d="M4.073,8.51083H.40712A23.70758,23.70758,0,0,1,0,4.20936Q0-.00184,4.1191,0V1.72059q-2.0835,0-2.0835,2.218V5.06966H4.073Zm5.47862,0H5.8839a23.87345,23.87345,0,0,1-.40712-4.30147Q5.47678-.00184,9.59771,0V1.72059q-2.0835,0-2.0835,2.218V5.06966H9.55166Z"/>\
                                    </svg>\
                                  </div>\
                                  <div class="block-text">\
                                    '+row.content+'\
                                    <div class="qoute end">\
                                      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9.92311 8.51083">\
                                        <path d="M0,0H3.779a17.71636,17.71636,0,0,1,.49835,3.81957q0,4.693-4.23514,4.69126V6.68467q1.99172,0,1.99341-2.159V3.57124H0ZM5.64742,0H9.42476a17.61078,17.61078,0,0,1,.49835,3.81957q0,4.693-4.23514,4.69126V6.68467q1.99425,0,1.99341-2.159V3.57124H5.64742Z"/>\
                                      </svg>\
                                    </div>\
                                  </div>\
                                  <div class="author">'+row.author+'</div>\
                                </div>';
                    content.append(text);
                  })
                }
                else {
                  loadMore.remove();
                }
              }
            });
    }
    
  }

  // Meet the team Read More
  if ($('#meet-team-block').length) {
    $('#meet-team-block .block').each(function(i) {
      var readMore = $(this).find('.read-more');
      var text = $(this).find('.text');
      readMore.click(function(e) {

        if (text.hasClass('closed')) {
          text.removeClass('closed');
          readMore.text('Read less');
        } else {
          text.addClass('closed');
          readMore.text('Read more');
        }
        
      });
    })
  }

  // Contact us form
  $('#contact_us_datetime').datetimepicker({
    format: 'Y-m-d H:i',
    step: 30
  });
  contactUs = function() {
  	var formData = {
      type: $('#contact_us_type').val(),
      name: $('#contact_us_name').val(),
      phone: $('#contact_us_phone').val(),
      email: $('#contact_us_email').val(),
      location: $('#contact_us_location').val(),
      datetime: $('#contact_us_datetime').val(),
      message: $('#contact_us_message').val(),
      marketing: $('#contact_us_marketing').prop('checked') ? 1 : 0
    };
    var redirectUrl = (formData.type === 'hearing-test') ? '/thank-you-hearing-test' : '/thank-you-consultation';
    $.ajax({
      type: "POST",
      data: formData,
      url: '/wp-json/api/contact-us',
      dataType: "json",
      success: function (res) {
        console.log(res);
        if (res.ack == 'ok') {
          window.location.replace(redirectUrl);
        }
        else {
        	// Set alert message to error
        	$('.contact-us-alert').removeClass('success').addClass('error').text(res.msg);
        }
      }
    });
  	return;
  }

  // Responsive videos on content
  $('.entry-content .content-wrapper iframe').each(function(){
    if ($(this).parent().hasClass('videoWrapper')) {
      return;
    } else {
      $(this).wrap('<div class="videoWrapper"></div>');
    }
  });


});


})(jQuery);
