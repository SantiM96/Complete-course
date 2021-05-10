(function() {
    'use strict';
   
    document.addEventListener('DOMContentLoaded', function () {

        function spliter(number) {
            number += ""
            let total = ""
            if (number.split(".").length > 1) {
                let splited = number.split(".")
                let after = splited[1].substr(0, 2)
                if (after.length > 1) after = Math.round(after / 10)
                total = parseFloat(splited[0] + "." + after)
            }
            else { 
                total = parseInt(number)
            }
            return total
        }
        
        function autoScroll(classOfElement, changePx = 0, time = 750) {
            let position = $(`${classOfElement}`).offset().top
            position += changePx
            $("html, body").animate({
                scrollTop: position
            }, time)
        }
   

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
                labels = document.getElementById('labels-event');
                
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
                result = document.getElementById('lista-productos'),
                delegationToBuy = document.querySelector('.price-list'),
                threeCardsToBuy = document.querySelectorAll('.price-table'),
                oldElementClicked = ""
                
            disabledButton(buttonRegister);
            calculate.addEventListener('click', calculateAmount);


            nameUser.addEventListener('blur', emptyCamp);
            surnameUser.addEventListener('blur', emptyCamp);
            emailUser.addEventListener('blur', emptyCamp);
            emailUser.addEventListener('blur', checkMail);


            if (document.querySelector('.btn-admin-pay')) { 
                document.querySelector('.btn-admin-pay').type = "hidden"
            }

            delegationToBuy.addEventListener('click', function (e) { 
                e.preventDefault()
                
                if (e.target.className != "price-list container" && e.target.parentNode.className != "price-list container") {
                    
                    //get full card selected (div.price-table)
                    let elementClicked = e.target,
                        conditionWhile = true
                    while (conditionWhile) {
                        if (elementClicked.className == "price-table") {
                            conditionWhile = false
                        }
                        else {
                            elementClicked = elementClicked.parentNode
                        }
                    }

                    //remove opacity from those that were not selected and reset the value in 0
                    threeCardsToBuy.forEach(function (cardToBuy) {
                        cardToBuy.style.opacity = "0.5"
                        cardToBuy.childNodes[7].childNodes[3].value = 0
                    })
                    elementClicked.style.opacity = "1"
                    let inputValue = elementClicked.childNodes[7].childNodes[3]
                    inputValue.value = 1

                    //remove all ticks from the checkbox if you change pack
                    if (oldElementClicked != elementClicked) {
                        if (oldElementClicked != "") {
                            document.querySelectorAll(".contenido-dia").forEach(function () {
                                let pass = elementClicked.childNodes[7].childNodes[3].id
                                if (pass == "day-pass") quitCheckbox("sabado"); quitCheckbox("domingo")
                                if (pass == "two-days-pass") quitCheckbox("domingo")
                            })
                        }
                        oldElementClicked = elementClicked
                    }
                    showCheckbox()
                }
            });

            //auto select in edit-user.php
            let checkSelectAll = document.querySelectorAll(".price-table"),
                checkboxAll = document.querySelectorAll(".checkbox")
            checkSelectAll.forEach(function (pass) { if (pass.id != "") document.querySelector(`#${pass.id}`).click() })
            checkboxAll.forEach(function (checkbox) { if (checkbox.value == "checked") checkbox.click() })


            function calculateAmount(event) {
                event.preventDefault();
                if (gift.value === '') {
                    disabledButton(buttonRegister);
                    swal({
                        type: 'warning',
                        title: '¡Espera!',
                        text: 'Debes elegir un regalo'
                    }).catch(() => swal.close())
                    gift.focus();
                }
                else {
                    dayPass = document.getElementById('day-pass');
                    allDayPass = document.getElementById('all-day-pass');
                    twoDayPass = document.getElementById('two-days-pass');
        
                    shirt = document.getElementById('shirts-event');
                    labels = document.getElementById('labels-event');
        
                    numberDayPass = dayPass.value;
                    numberAllDayPass = allDayPass.value;
                    numberTwoDayPass = twoDayPass.value;
                    numberShirt = shirt.value;
                    numberLabels = labels.value;
        
                        
        
                    totalAmountTickets = 0;
        
                    totalAmountTickets = numberDayPass * 30 + numberAllDayPass * 50
                        + numberTwoDayPass * 45 + numberShirt * 10 * 0.93
                        + numberLabels * 2;
                    
                    
                    totalAmountTickets = spliter(totalAmountTickets)
                    
                        
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
        
                    if (totalAmountTickets > 0 && gift.value != "") {
                        if (nameUser.value != "" && surnameUser.value != "" && emailUser.value != "" && errorPMail.style.display == "none") {
                            enableButton(buttonRegister);
                        }
                        else { 
                            disabledButton(buttonRegister);
                            swal({
                                type: 'warning',
                                text: 'Faltan los datos del usuario'
                            }).catch(() => swal.close(autoScroll(".user-date", -100))).then((result) => {
                                if (result) autoScroll(".user-date", -100)
                            })
                        }
                    }
                    else { 
                        disabledButton(buttonRegister);
                    }
        
                }
            }
        
            function showCheckbox() {
                showDays = [];

                if (dayPass.value != "0")    showDays = ['viernes - 09/12/16'];
                else                         document.getElementById('viernes - 09/12/16').style.display = 'none';
                
                if (twoDayPass.value != "0") showDays = ['viernes - 09/12/16', 'sabado - 10/12/16'];
                else                         document.getElementById('sabado - 10/12/16').style.display = 'none';
        
                if (allDayPass.value != "0") showDays = ['viernes - 09/12/16', 'sabado - 10/12/16', 'domingo - 11/12/16'];
                else                         document.getElementById('domingo - 11/12/16').style.display = 'none';
        
                for (let i = 0; i < showDays.length; i++) {
                    document.getElementById(showDays[i]).style.display = 'block';
                }
            }

            function quitCheckbox(day) { 
                document.querySelectorAll(`.${day}check`).forEach(element => element.checked = false)
            }
        
            function emptyCamp() {
                if (this.value == '') {
                    errorP.style.display = 'block';
                    errorP.innerHTML = 'Este Campo es Obligatorio';
                    errorPMail.style.display = 'none';
                    this.style.border = '2px solid red';
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
                    checkMail();
                };
            }
        
            function checkMail() {
                if (camp3Complete && document.getElementById('error').style.display == "none") {
                    if (emailUser.value.indexOf('@') < 0) {
                        errorPMail.style.display = 'block';
                        errorPMail.innerHTML = 'Ingrese un email Válido';
                        emailUser.style.border = '2px solid red';
                    }
                    else {
                        errorPMail.style.display = 'none';
                        emailUser.style.border = '1.75px solid #929292';
                    }
                }
            }
        
            function disabledButton(button) { 
                button.style.backgroundColor = "gray"
                button.style.opacity = ".65"
                button.style.border = "none"
                button.disabled = true
            }
        
            function enableButton(button) { 
                button.style.backgroundColor = "#fe4118"
                if (document.querySelector('.btn-admin-pay')) button.style.backgroundColor = "#007bff"
                button.style.opacity = "1"
                button.style.border = "unset"
                button.disabled = false
            } 
            
        }
        
        
    });
})();


