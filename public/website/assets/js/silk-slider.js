$('.general-slick-slider').slick({
    slidesToShow: 6, 
    autoplay: false, 
    rows:2,  
    centerMode: true, 
    centerPadding: '60px', 
    nextArrow:'<button type="button" title="nav" role="presentation" class="slick-next slick-arrow"><i class="icon-angle-right"></i></button>',
    prevArrow:'<button type="button" title="nav" role="presentation" class="slick-prev slick-arrow"><i class="icon-angle-left"></i></button>',
    responsive: [
      
      {
        breakpoint: 1400,
        settings: {
          slidesToShow: 10,
          slidesToScroll: 10
        }
      },
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 6,
          slidesToScroll: 6
        }
      },
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 5,
          slidesToScroll: 5
        }
      },
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 4
        }
      },
      {
        breakpoint: 425,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3
        }
      },
      {
        breakpoint: 375,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      },
      {
        breakpoint: 320,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      },
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
  
  });

 