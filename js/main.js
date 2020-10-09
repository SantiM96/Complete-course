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
    $('.guest-info').colorbox({inline:true, width:"50%"});

});


(function() {
    'use strict';
   
    document.addEventListener('DOMContentLoaded', function () {
   

        if (document.getElementById('all-day-pass')) {
                
            // user dates -34.905572, -56.185498 GdlWebCamp
            const nameUser = document.getElementById('name'),
                surnameUser = document.getElementById('surname'),
                emailUser = document.getElementById('email');
            
            //Check content dates camps
            let camp1Complete = true,
                camp2Complete = true,
                camp3Complete = true;

            // order pass
            let dayPass = document.getElementById('day-pass'),
                allDayPass = document.getElementById('all-day-pass'),
                twoDayPass = document.getElementById('two-days-pass');
                
            let shirt = document.getElementById('shirts-event'),
                labels = document.getElementById('labels.event');
                
            let numberDayPass = dayPass.value,
                numberAllDayPass = allDayPass.value,
                numberTwoDayPass = twoDayPass.value,
                numberShirt = shirt.value,
                numberLabels = labels.value;
                
            let totalAmountTickets = 0,
                productList = [],
                showDays = [];

            // buttons and divs
            let calculate = document.getElementById('calculate'),
                gift = document.getElementById('gift'),
                errorP = document.getElementById('error'),
                errorPMail = document.getElementById('errorMail'),
                buttonRegister = document.getElementById('btnregister'),
                totalSend = document.getElementById('total_amount'),
                total = document.getElementById('total-sum'),
                result = document.getElementById('lista-productos');
                

            
            

            
            
                
            calculate.addEventListener('click', calculateAmount);

            dayPass.addEventListener('blur', showCheckbox);
            allDayPass.addEventListener('blur', showCheckbox);
            twoDayPass.addEventListener('blur', showCheckbox);


            nameUser.addEventListener('blur', emptyCamp);
            surnameUser.addEventListener('blur', emptyCamp);
            emailUser.addEventListener('blur', emptyCamp);
            emailUser.addEventListener('blur', checkMail);



            function calculateAmount(event) {
                event.preventDefault();
                if (gift.value === '') {
                    alert('Debes elegir un regalo');
                    gift.focus();
                }
                else {
                    dayPass = document.getElementById('day-pass');
                    allDayPass = document.getElementById('all-day-pass');
                    twoDayPass = document.getElementById('two-days-pass');

                    shirt = document.getElementById('shirts-event');
                    labels = document.getElementById('labels.event');

                    numberDayPass = dayPass.value;
                    numberAllDayPass = allDayPass.value;
                    numberTwoDayPass = twoDayPass.value;
                    numberShirt = shirt.value;
                    numberLabels = labels.value;

                        

                    totalAmountTickets = 0;

                    totalAmountTickets = numberDayPass * 30 + numberAllDayPass * 50
                        + numberTwoDayPass * 45 + numberShirt * 10 * 0.93
                        + numberLabels * 2;
                        
                    productList = [];
                    // Add products to Array
                    if (numberDayPass == 1) {
                        productList.push(numberDayPass + ' Pase por Día');
                    }
                    else if (numberDayPass > 1) {
                        productList.push(numberDayPass + ' Pases por Día');
                    }

                    if (numberAllDayPass == 1) {
                        productList.push(numberAllDayPass + ' Pase Completo');
                    }
                    else if (numberAllDayPass > 1) {
                        productList.push(numberAllDayPass + ' Pases Completos');
                    }

                    if (numberTwoDayPass == 1) {
                        productList.push(numberTwoDayPass + ' Pase por 2 Días');
                    }
                    else if (numberTwoDayPass > 1) {
                        productList.push(numberTwoDayPass + ' Pases por 2 Días');
                    }

                    if (numberShirt == 1) {
                        productList.push(numberShirt + ' Camisa');
                    }
                    else if (numberShirt > 1) {
                        productList.push(numberShirt + ' Camisas');
                    }

                    if (numberLabels == 1) {
                        productList.push(numberLabels + ' Paquete de Etiquetas');
                    }
                    else if (numberLabels > 1) {
                        productList.push(numberLabels + ' Paquetes de Etiquetas');
                    }

                    productList.push('Más la ' + gift.value + ' de Regalo');
                        

                    result.innerHTML = '';
                    for (let i = 0; i < productList.length; i++) {
                        result.innerHTML += productList[i];
                        result.innerHTML += '</br>';
                    }

                    total.innerHTML = totalAmountTickets;

                    totalSend.value = total.innerText;
                }
            }

            function showCheckbox() {

                showDays = [];
                if (dayPass.value > 0) {
                    showDays = ['viernes'];
                }
                else {
                    document.getElementById('viernes').style.display = 'none';
                }

                if (twoDayPass.value > 0) {
                    showDays = ['viernes', 'sabado'];
                }
                else {
                    document.getElementById('sabado').style.display = 'none';
                }

                if (allDayPass.value > 0) {
                    showDays = ['viernes', 'sabado', 'domingo'];
                }
                else {
                    document.getElementById('domingo').style.display = 'none';
                }

                for (let i = 0; i < showDays.length; i++) {
                    document.getElementById(showDays[i]).style.display = 'block';
                }
            }

            function emptyCamp() {
                if (this.value == '') {
                    errorP.style.display = 'block';
                    errorP.innerHTML = 'Este Campo es Obligatorio';
                    this.style.border = '2px solid red'
                    if (this == nameUser) camp1Complete = false;
                    if (this == surnameUser) camp2Complete = false;
                    if (this == emailUser) camp3Complete = false;
                }
                else {
                    this.style.border = '1.75px solid #929292';

                    if (this == nameUser) camp1Complete = true;
                    if (this == surnameUser) camp2Complete = true;
                    if (this == emailUser) camp3Complete = true;
                        
                    if (camp1Complete && camp2Complete && camp3Complete) errorP.style.display = 'none';
                };
            };

            function checkMail() {
                if (this.value.indexOf('@') < 0 && camp3Complete) {
                    errorPMail.style.display = 'block';
                    errorPMail.innerHTML = 'Ingrese un email Válido';
                    this.style.border = '2px solid red'
                }
                else {
                    errorPMail.style.display = 'none';
                    this.style.border = '1.75px solid #929292';
                }
            }
        }
    });
})();
