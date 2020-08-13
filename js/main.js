(function () {
    'use strict';

    
    document.addEventListener('DOMContentLoaded', function () {     
        
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
        
        let shirt = document.getElementById('camisa-evento'),
            labels = document.getElementById('etiquetas');
        
        let numberDayPass = dayPass.value,
            numberAllDayPass = allDayPass.value,
            numberTwoDayPass = twoDayPass.value,
            numberShirt = shirt.value,
            numberLabels = labels.value;
        
        let totalAmountTickets = 0,
            productList = [],
            showDays = [];

        // buttons and divs
        let calculate = document.getElementById('calcular'),
            gift = document.getElementById('regalo'),
            errorP = document.getElementById('error'),
            errorPMail = document.getElementById('errorMail'),
            buttonRegister = document.getElementById('btnregistro'),
            total = document.getElementById('suma-total'),
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

                shirt = document.getElementById('camisa-evento');
                labels = document.getElementById('etiquetas');

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

    });
})();