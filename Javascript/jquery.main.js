$(document).ready(function() {

    $(".post-carousel-twoCol").slick({
        dots: false,
        arrows : false,
        slidesToShow : 2,
        slidesToSCroll :1,
        responsive : [
            {
                breakpoint : 768,
                settings : {
                    slidesToShow : 2,
                    slidesToSCroll : 2,
                    dots : false,
                    arrows : false,
                }
            },
            {
                breakpoint : 576,
                settings : {
                    slidesToShow : 1,
                    slidesToSCroll : 1,
                    dots:false,
                    arrows : false,
                }
            }
        ]
    });

    $(".carousel-topNav-prev").click(function() {
        $(".post-carousel-twoCol").slick('slickPrev');
    });
    $(".carousel-topNav-next").click(function() {
        $(".post-carousel-twoCol").slick('slickNext');
    });

    $(".post-carousel-widget").slick({
        dots: false,
        arrows : false,
        slidesToShow : 1,
        slidesToSCroll :1,
        responsive : [
            {
                breakpoint : 991,
                settings : {
                    slidesToShow : 2,
                    slidesToSCroll : 1,
                }
            },
            {
                breakpoint : 576,
                settings : {
                    slidesToShow : 1,
                    slidesToSCroll : 1,
                    centerMode : true,
                }
            }
        ]
    });

    $(".carousel-botNav-prev").click(function() {
        $(".post-carousel-widget").slick('slickPrev');
    });
    $(".carousel-botNav-next").click(function() {
        $(".post-carousel-widget").slick('slickNext');
    });

});

$(function(){
    "use strict";

  // loader tab pane 
    $('button[data-bs-toggle="tab"]').on('click', function() {
        $(".tab-pane").addClass("loading");
        $(".lds-dual-ring").addClass("loading");
        setTimeout(function () {
            $(".tab-pane").removeClass("loading");
            $(".lds-dual-ring").removeClass("loading");
        }, 500);
    });

    var list = document.getElementsByClassName('spacer');
    for(var i = 0; i< list.length; i++){
        var size = list[i].getAttribute('data-height');
        list[i].style.height = "" + size + "px";
    }

    var list = document.getElementsByClassName('data-bg-image');

    for(var i =0; i< list.length; i++){
        var bgimg = list[i].getAttribute('data-bg-image');
        list[i].style.backgroundImage = "url('" + bgimg + "')";
    }


});

$(document).ready(function(){
    $(".post-list").slice(0, 5).show();
    $("#loadMore").on("click", function(e){
      e.preventDefault();
      $(".post-list:hidden").slice(0, 4).slideDown();
      if($(".post-list:hidden").length == 0) {
        $("#loadMore").text("Đã hết tin").addClass("noContent");
      }
    });
    
  })