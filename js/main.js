$(function() {
    'use strict'


    //GdlWebCamp
    $('.hero-text h1').lettering();

    $(".hero-text h1 span").hover(
        function () {
            $(this).animate({ bottom: '7px' }, 150);
        },
        function () {
            $(this).animate({ bottom: "0px" }, 150);
        }
    );

    
    //Bar in the top part
    let windowsHeight = $(window).height();
    $(window).scroll(function() {
        let scroll = $(window).scrollTop();

        if (scroll > windowsHeight) {
            $('.bar').addClass('fixed');
            let barHeight = $('.bar').height();
            $('body').css({ 'margin-top': barHeight + 'px' });
        }
        else { 
            $('.bar').removeClass('fixed');
            $('body').css({ 'margin-top': '0px' });
        }
    });


    //Menu responsive
    $('.mobile-menu').on('click', function() {
        $('.main-nav').slideToggle();
    });


    //Menu marker
    $('body.conferencia .main-nav a:contains(Conferencia)').addClass('marker');
    $('body.calendario .main-nav a:contains(Calendario)').addClass('marker');
    $('body.invitados .main-nav a:contains(Invitados)').addClass('marker');
    $('body.registro .main-nav a:contains(Reservaciones)').addClass('marker-white');

    //Programa del Evento
    $('nav a').click(programEvent);

    $('.program-event nav a:first').css({ 'background-color': 'rgb(240, 240, 240)' });

    function programEvent() { 
        $('#talleres').css({ 'display': 'none' });
        $('#conferencias').css({ 'display': 'none' });
        $('#seminarios').css({ 'display': 'none' });

        $('.program-event nav a').css({ 'background-color': 'white' });

        if (this == $('.program-event nav a')[0]) {
            $('#talleres').animate({ 'opacity': 'show' }, 500);
            $(this).css({ 'background-color': 'rgb(240, 240, 240)' });
        }
    
        if (this == $('.program-event nav a')[1]) {
            $('#conferencias').animate({ 'opacity': 'show' }, 500);
            $(this).css({ 'background-color': 'rgb(240, 240, 240)' });
        }

        if (this == $('.program-event nav a')[2]) {
            $('#seminarios').animate({ 'opacity': 'show' }, 500);
            $(this).css({ 'background-color': 'rgb(240, 240, 240)' });
        }

    } 
    
    //Animate numbers accountant
    $('.summary-event li:nth-child(1) p').animateNumber({ number: 6 }, 1200);
    $('.summary-event li:nth-child(2) p').animateNumber({ number: 15 }, 1600);
    $('.summary-event li:nth-child(3) p').animateNumber({ number: 3 }, 1200);
    $('.summary-event li:nth-child(4) p').animateNumber({ number: 9 }, 1300);


    //Countdown
    $('.countdown').countdown('2021/9/11 12:00:00', function(event) { 
        $('#days').html(event.strftime('%D'));
        $('#hours').html(event.strftime('%H'));
        $('#minutes').html(event.strftime('%M'));
        $('#seconds').html(event.strftime('%S'));
    })


    //Colorbox
    if(document.querySelector('.guest-info')) $('.guest-info').colorbox({inline:true, width:"50%"});

});

//adjust guest images
(function() {
    'use strict';
   
    document.addEventListener('DOMContentLoaded', function () {
   

        if (document.querySelector(".guest")) {
            let firstImage = document.querySelector(".guest"),
                firstImageHeightPx = window.getComputedStyle(firstImage, 'height').height,
                firstImageHeightFloat = parseFloat(firstImageHeightPx.split(" px")),
                allImageDiv = document.querySelectorAll(".guest"),
                heightPx = "",
                heightFloat = 0.0,
                liHeight =  "",
                imgHeight = "",
                guestNameLen = document.querySelectorAll(".guest a p")
            

            function adjustImage() {
                //take the values ​​again after adjustment
                firstImage = document.querySelector(".guest")
                firstImageHeightPx = window.getComputedStyle(firstImage, 'height').height
                firstImageHeightFloat = parseFloat(firstImageHeightPx.split(" px"))
                allImageDiv = document.querySelectorAll(".guest")


                for (let i = 0; i < allImageDiv.length; i++) { 
                    heightPx = window.getComputedStyle(allImageDiv[i], 'height').height
                    heightFloat = parseFloat(heightPx.split(" px"))
    
                    //shrink large images
                    if (firstImageHeightFloat < heightFloat) {
                        allImageDiv[i].style.height = firstImageHeightPx
                    }
    
                    //enlarge small images
                    if (firstImageHeightFloat > heightFloat) {
                        allImageDiv[i].style.height = firstImageHeightPx
                    }
    
                    liHeight = parseFloat(window.getComputedStyle(allImageDiv[i].parentNode, 'height').height.split(" px"))
                    imgHeight = parseFloat(window.getComputedStyle(allImageDiv[i].childNodes[1].childNodes[1], 'height').height.split(" px"))
    
                    if (liHeight > imgHeight) { 
                        allImageDiv[i].childNodes[1].childNodes[1].style.height = parseFloat(window.getComputedStyle(allImageDiv[i], 'height').height.split(" px")) + "px"
                    }

                    //do not shrink the text shadow if there are more than 16 characters
                    if (guestNameLen[i].textContent.length > 16) { 
                        guestNameLen[i].parentNode.parentNode.addEventListener('mouseover', function () { 
                            guestNameLen[i].style.width = "100%"
                        })      
                    }



                }
            }
            adjustImage()
            window.onresize = adjustImage() 
        }
        
    });
})();
