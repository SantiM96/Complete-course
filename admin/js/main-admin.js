(function() {
    'use strict';
    document.addEventListener('DOMContentLoaded', function () {

        //global
        if (document.getElementById('password-check')) { 
            let inputPass = document.querySelectorAll('.password'),
                colorPass = document.querySelectorAll('.colorPass'),
                messagePass = document.getElementById('password-result'),
                pass1 = document.getElementById('password'),
                pass2 = document.getElementById('password-check')
            
            inputPass[0].addEventListener('blur', leaveFirstPass)
                

            //start the validation after to leave the first input
            function leaveFirstPass() { 
                checkPass()
                inputPass[0].addEventListener('input', checkPass)
                inputPass[1].addEventListener('input', checkPass)
            }

            //validation
            function checkPass() {
                let conditionValid = false
                if (pass1.value !== "") {
                    if (pass1.value === pass2.value) {
                        //equals
                        messagePass.innerHTML = "Correcto"
                        conditionValid = true
                    }
                    else {
                        //different
                        messagePass.innerHTML = "Las contraseñas no son iguales"
                        conditionValid = false
                    }
                    //add the class is-valid and valid-feedback if conditionValid is true or remove if is false
                    colorPass[0].childNodes[3].classList.toggle("is-valid", conditionValid)
                    colorPass[1].childNodes[3].classList.toggle("is-valid", conditionValid)
                    colorPass[1].childNodes[5].classList.toggle("valid-feedback", conditionValid)
             
                    //deny the above to add is-invalid and invalid-feedback
                    colorPass[0].childNodes[3].classList.toggle("is-invalid", !conditionValid)
                    colorPass[1].childNodes[3].classList.toggle("is-invalid", !conditionValid)
                    colorPass[1].childNodes[5].classList.toggle("invalid-feedback", !conditionValid)
                }
            }
        }

        function disableSelect(selectToDisable) { 
            selectToDisable.addEventListener('change', function () { 
                if (this.value !== "") { 
                    this.childNodes[1].disabled = true
                }
            })
        }

        function formatGift(gift) { 
            if (gift.value === "Pulsera") return 1
            if (gift.value === "Etiqueta") return 2
            if (gift.value === "Pluma") return 3
        }

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


        //get the last value of the url
        let urlNumber = window.location.href.split("/").length
        let url = window.location.href.split("/", urlNumber)[urlNumber - 1].split("?")[0].split("#")[0]


        //code according to each page


        /* Section Admin */ 

        //login to join the admin panel
        if (url === "login.php") { 
            const createButton = document.getElementById('submit')
            createButton.addEventListener('click', (e) => {
                e.preventDefault()
                
                
                let user = document.getElementById('user').value,
                    password = document.getElementById('password').value


                if (user !== "" && password !== "") {

                    //call ajax
                    let xhr = new XMLHttpRequest()

                    //use FormData to send data
                    let data = new FormData()
                    data.append('user', user)
                    data.append('password', password)
                    data.append('action', 'login')

                    //open conection
                    xhr.open('POST', 'admin-backend.php', true)

                    //return data
                    xhr.onload = function() { 
                        if (this.status === 200) { 
                            let answer = JSON.parse(xhr.responseText)

                            if (answer.answer === "success") {
                                swal({
                                    type: 'success',
                                    title: 'Logeado',
                                    text: `Admin ${answer.name_admin} logeado correctamente`
                                }).catch(() => swal.close())
                                .then(result => {
                                    //redirect to the new URL
                                    if (result) window.location.href = 'admin-area.php';  
                                }).catch(() => swal.close())
                            }
                            else { 
                                swal({
                                    type: 'error',
                                    title: 'Error',
                                    text: 'Usuario o contraseña incorrecto'
                                }).catch(() => swal.close())
                            }
                        }
                    }

                    //send data
                    xhr.send(data)
                }
                else { 
                    swal({
                        type: 'error',
                        title: 'Error',
                        text: 'Todos los campos son obligatorios'
                    }).catch(() => swal.close())
                }
            })
        }

        //add admin
        if (url === "admin-add.php" && document.getElementById('user')) { 
            
            const addButton = document.querySelector('.card-footer button')
            addButton.addEventListener('click', function(e) { 
                e.preventDefault()
                
                let user = document.getElementById('user').value,
                    name = document.getElementById('name').value,
                    passwordElement = document.getElementById('password'),
                    password = passwordElement.value,
                    passwordCheckElement = document.getElementById('password-check'),
                    passwordCheck = passwordCheckElement.value,
                    permission = document.getElementById('permission').checked,
                    owner = false

                if (document.getElementById('owner')) {
                    owner = document.getElementById('owner').checked;
                }

                
                if (password === passwordCheck) {
                    if (user !== "" && name !== "" && password !== "") {

                        //call ajax
                        let xhr = new XMLHttpRequest()

                        //use FormData to send data
                        let data = new FormData()
                        data.append('user', user)
                        data.append('name', name)
                        data.append('password', password)
                        data.append('permission', permission)
                        if (owner) data.append('owner', owner)
                        data.append('action', 'create')

                        //open connection
                        xhr.open('POST', 'admin-backend.php', true)

                        //return data
                        xhr.onload = function () {
                            if (this.status === 200) {

                                console.log(JSON.parse(xhr.responseText))
                                
                                let answer = JSON.parse(xhr.responseText)

                                if (answer.answer === "success") {
                                    swal({
                                        type: 'success',
                                        title: 'Admin Creado',
                                        text: `El administrador ${answer.new_admin_user} se creó correctamente`
                                    }).catch(() => swal.close())
                                }
                                else {
                                    swal({
                                        type: 'error',
                                        title: 'Hubo un Problema',
                                        text: 'El admin no pudo ser creado'
                                    }).catch(() => swal.close())
                                }

                                document.getElementById('admin-create').reset()
                                passwordElement.classList.remove('is-valid')
                                passwordCheckElement.classList.remove('is-valid')
                            }
                        }

                        //send data
                        xhr.send(data)
                    }
                    else {
                        swal({
                            type: 'warning',
                            title: 'El admin no pudo ser creado',
                            text: 'Todos los campos son obligatorios'
                        }).catch(() => swal.close())
                    }
                }
                else { 
                    swal({
                        type: 'warning',
                        title: 'El admin no pudo ser creado',
                        text: 'Las contraseñas no coinciden'
                    }).catch(() => swal.close())
                }
                
            })

        }

        //edit admin
        if (url === "admin-edit.php" && document.getElementById('permission')) {

            //autocomplete check if you has already admin permission
            let permission = document.getElementById('permission'),
                permissionInt = parseInt(permission.value)
            if (permissionInt >= 1) {
                permission.checked = true
                permission = true
            }
            else permission = false
            
            //autocomplete check if you has already owner permission
            let permissionOwner = false
            if (document.getElementById('owner')) {
                permissionOwner = document.getElementById('owner')
                let permissionOwnerInt = parseInt(permissionOwner.value)
                if (permissionOwnerInt >= 2) {
                    permissionOwner.checked = true
                    permissionOwner = true
                }
                else permissionOwner = false
            }


            if (document.getElementById('owner')) { 
                //if owner permissions are clicked, admin permissions are filled in automatically
                document.getElementById('owner').addEventListener('click', function () {
                    if (this.checked) {
                        document.getElementById('permission').checked = true
                    }
                })
                //if admin permissions are unchecked, owner permissions are removed in automatically
                document.getElementById('permission').addEventListener('click', function () {
                    if (!this.checked) {
                        document.getElementById('owner').checked = false
                    }
                })
            }


            //after pressing the button
            const editButton = document.querySelector('.card-footer button')
            editButton.addEventListener('click', function (e) {
                e.preventDefault()
                    
                let id = document.getElementById('id-user').value,
                    user = document.getElementById('user').value,
                    name = document.getElementById('name').value,
                    passwordElement = document.getElementById('password'),
                    password = passwordElement.value,
                    passwordCheckElement = document.getElementById('password-check'),
                    passwordCheck = passwordCheckElement.value,
                    newPermission = document.getElementById('permission').checked,
                    newPermissionOwner = false

                if (document.getElementById('owner')) { 
                    newPermissionOwner = document.getElementById('owner').checked
                }

                //posibles changes for aplicate
                if (user !== "" || name !== "" || password !== "" || permission !== newPermission || permissionOwner !== newPermissionOwner) {                    
                    if (password === passwordCheck) {
                        //call ajax
                        let xhr = new XMLHttpRequest()

                        //use FormData to send data
                        let data = new FormData()
                        data.append('id', id)
                        data.append('user', user)
                        data.append('name', name)
                        data.append('password', password)
                        data.append('permission', newPermission)
                        if (newPermissionOwner) data.append('owner', owner)
                        data.append('action', 'edit')

                        //open connection
                        xhr.open('POST', 'admin-backend.php', true)

                        //return data
                        xhr.onload = function () {
                            if (this.status === 200) {
                                
                                console.log(JSON.parse(xhr.responseText))
                                
                                
                                let answer = JSON.parse(xhr.responseText)

                                if (answer.answer === "success") {
                                    swal({
                                        type: 'success',
                                        title: 'Admin Modificado',
                                        text: 'Los cambios se guardaron correctamente'
                                    }).catch(() => swal.close())

                                    if (answer.id === answer.id_currently_admin && answer.new_permission !== answer.level_currently_admin || answer.password) { 
                                        swal({
                                            type: 'success',
                                            title: 'Admin Modificado',
                                            text: 'Los cambios se guardaron correctamente. Debido a que ha modificado su usuario tendrá que relogear'
                                        }).catch(() => swal.close(window.location.href = "login.php?session_close=true")).then((result) => {
                                            if (result) {
                                                window.location.href = "login.php?session_close=true"
                                            }
                                        })
                                    }
                                }
                                else if (answer.answer === "no_changes") {
                                    swal({
                                        type: 'warning',
                                        title: 'No hay Cambios',
                                        text: 'Realice algún cambio para editar el administrador'
                                    }).catch(() => swal.close())
                                }
                                else if (answer.answer === "error" && answer.error === "insufficient_permissions") { 
                                    swal({
                                        type: 'error',
                                        title: 'Error',
                                        text: 'No tienes los permisos suficientes para esta acción'
                                    }).catch(() => swal.close())
                                }
                                else {
                                    swal({
                                        type: 'error',
                                        title: 'Hubo un Problema',
                                        text: 'Los cambios no se guardaron correctamente'
                                    }).catch(() => swal.close())
                                }

                                passwordElement.value = ""
                                passwordCheckElement.value = ""
                                passwordElement.classList.remove('is-valid')
                                passwordCheckElement.classList.remove('is-valid')
                            }
                        }
                        //send data
                        xhr.send(data)
                    }
                    else { 
                        swal({
                            type: 'error',
                            title: 'Error',
                            text: 'Las contraseñas no coinciden'
                        }).catch(() => swal.close())
                    }
                }
                else { 
                    swal({
                        type: 'error',
                        title: 'Error',
                        text: 'No hay cambios'
                    }).catch(() => swal.close())
                }
            })
        }

        //delete admin
        if (url === "admin-list.php" && document.querySelector('#registers')) { 

            const delegationToDelete = document.querySelector('#registers')
            delegationToDelete.addEventListener('click', function (e) {
                let id = e.target.id
                if (e.target.className === "fa fa-trash") id = e.target.parentNode.id

                if (id !== "" && id !== "registers") { 
                    e.preventDefault()

                    swal({
                        icon: 'warning',
                        title: '¿Estás seguro?',
                        text: "El administrador será borrado permanentemente", 
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Borrar',
                        cancelButtonText: 'Cancelar'
                    }).catch(() => swal.close()).then((result) => {
                        if (result) {
                            
                            //call ajax
                            let xhr = new XMLHttpRequest()

                            //send data by FormData
                            let data = new FormData()
                            data.append('id', id)
                            data.append('action', 'delete')

                            //open connection
                            xhr.open('POST', 'admin-backend.php', true)

                            //return data
                            xhr.onload = function () {
                                if (this.status === 200) {
                                    let answer = JSON.parse(xhr.responseText)

                                    if (answer.answer === "success") {
                                        swal(
                                            'Administrador Eliminado',
                                            'El administrador fue eliminado exitosamente',
                                            'success'
                                        ).then((result) => {
                                            if (result) {
                                                window.location.href = "admin-list.php"
                                            }
                                        }).catch(() => window.location.href = "admin-list.php")
                                    }
                                    else { 
                                        swal(
                                            'Error',
                                            'No tienes los permisos suficientes para esta acción',
                                            'error'
                                        ).catch(() => swal.close())
                                    }
                                }
                            }

                            //send data
                            xhr.send(data)
                        }
                    }).catch(() => swal.close())
                }
            })
        }
            

        /* Section Events */ 
        
        //add event
        if (url === "event-add.php") { 
            disableSelect(document.getElementById('create-event-category'))
            disableSelect(document.getElementById('create-event-guest'))
        
            let addEventButton = document.querySelector('.card-footer button')
            addEventButton.addEventListener('click', function (e) { 
                e.preventDefault()

                let eventName = document.getElementById('event-name').value,
                    eventDate = document.getElementById('date').value,
                    eventTime = document.getElementById('time').value,
                    eventCategory = document.getElementById('create-event-category').value,
                    eventGuest = document.getElementById('create-event-guest').value


                if (eventName === "" || eventDate === "" || eventTime === "" || eventCategory === "" || eventGuest === "") {
                    swal({
                        type: 'error',
                        title: 'Error',
                        text: 'Todos los campos son obligatorios'
                    }).catch(() => swal.close())
                }
                else { 
                    
                    //call ajax
                    let xhr = new XMLHttpRequest()

                    //send data with the FormData
                    let data = new FormData()
                    data.append('eventName', eventName)
                    data.append('eventDate', eventDate)
                    data.append('eventTime', eventTime)
                    data.append('eventCategory', eventCategory)
                    data.append('eventGuest', eventGuest)
                    data.append('action', 'create')

                    //open conection
                    xhr.open('POST', 'event-backend.php', true)

                    //return data
                    xhr.onload = function () { 
                        if (this.status === 200) { 
                            let answer = JSON.parse(xhr.responseText)

                            if (answer.answer === "success") {
                                swal({
                                    type: 'success',
                                    title: 'Evento Creado',
                                    text: 'El evento fue creado'
                                }).catch(() => window.location.href = "event-list.php")
                                    .then((result) => {
                                        if (result) {
                                            window.location.href = "event-list.php"
                                        }
                                    })
                            }
                            else { 
                                swal({
                                    type: 'error',
                                    title: 'Error',
                                    text: 'El evento no pudo ser creado'
                                }).catch(() => swal.close())
                            }
                        }
                    }

                    //send data
                    xhr.send(data)
                }  
            })  
        }

        //edit event
        if (url === "event-edit.php") { 

            let oldName = document.getElementById('event-name-edit').value,
                oldDate = document.getElementById('date').value,
                oldTime = document.getElementById('time').value,
                oldCategory = document.getElementById('edit-event-category').value,
                oldGuest = document.getElementById('edit-event-guest').value,
                editEventButton = document.querySelector('.card-footer button'),
                idEvent = editEventButton.value

            
            editEventButton.addEventListener('click', function (e) {
                e.preventDefault()

                let newName = document.getElementById('event-name-edit').value,
                    newDate = document.getElementById('date').value,
                    newTime = document.getElementById('time').value,
                    newCategory = document.getElementById('edit-event-category').value,
                    newGuest = document.getElementById('edit-event-guest').value


                
                if (newName === "" || newDate === "" || newTime === "" || newCategory === "" || newGuest === "") {
                    swal({
                        type: 'error',
                        title: 'Error',
                        text: 'Todos los campos son obligatorios'
                    }).catch(() => swal.close())
                }
                else { 
                    if (oldName === newName && oldDate === newDate && oldTime === newTime && oldCategory === newCategory && oldGuest === newGuest) {
                        swal({
                            type: 'warning',
                            title: 'Error',
                            text: 'No hay cambios'
                        }).catch(() => swal.close())
                    }
                    else { 
                        
                        //call ajax
                        let xhr = new XMLHttpRequest()

                        //send data through FormData
                        let data = new FormData()
                        data.append('idEvent', idEvent)
                        data.append('newName', newName)
                        data.append('newDate', newDate)
                        data.append('newTime', newTime)
                        data.append('newCategory', newCategory)
                        data.append('newGuest', newGuest)
                        data.append('action', 'edit')

                        //open conection
                        xhr.open('POST', 'event-backend.php', true)

                        //return data
                        xhr.onload = function () { 
                            if (this.status === 200) { 
                                let answer = JSON.parse(xhr.responseText)

                                if (answer.answer === "success") { 
                                    swal({
                                        type: 'success',
                                        title: 'Evento Modificado',
                                        text: 'Los cambios se guardaron correctamente'
                                    }).catch(() => window.location.href = "event-list.php")
                                        .then((result) => {
                                            if (result) {
                                                window.location.href = "event-list.php"
                                            }
                                        })
                                }
                                else { 
                                    swal({
                                        type: 'error',
                                        title: 'Error',
                                        text: 'Los cambios no pudieron ser guardados'
                                    }).catch(() => swal.close())
                                }
                            }
                        }

                        //send data
                        xhr.send(data)
                    }
                }
            })
        }

        //delete event
        if (url === "event-list.php") {
            const delegationToDelete = document.querySelector('#registers')
            delegationToDelete.addEventListener('click', function (e) {
                let id = e.target.id
                if (e.target.className === "fa fa-trash") id = e.target.parentNode.id

                if (id !== "" && id !== "registers") {
                    e.preventDefault()

                    swal({
                        icon: 'warning',
                        title: '¿Estás seguro?',
                        text: "El evento será borrado permanentemente", 
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Borrar',
                        cancelButtonText: 'Cancelar'
                    }).catch(() => swal.close()).then((result) => {
                        if (result) {
                            let eventName = document.getElementById(`${id}`).parentNode.parentNode.childNodes[1].textContent                            

                            //call ajax
                            let xhr = new XMLHttpRequest()

                            //send data through FormData
                            let data = new FormData()
                            data.append('idToDelete', id)
                            data.append('action', 'delete')

                            //open connection
                            xhr.open('POST', 'event-backend.php', true)

                            //return data
                            xhr.onload = function () { 
                                if (this.status === 200) { 
                                    let answer = JSON.parse(xhr.responseText)

                                    if (answer.answer === "success") { 
                                        swal({
                                            type: 'success',
                                            title: 'Evento Borrado',
                                            text: `El evento "${eventName}" se borró correctamente`
                                        }).catch(() => window.location.href = "event-list.php")
                                        .then((result) => {
                                            if (result) {
                                                window.location.href = "event-list.php"
                                            }
                                        })
                                    }
                                }
                            }

                            //send data
                            xhr.send(data)
                        }
                    }).catch(() => swal.close())


                }
            })
        }


        /* Section Category */
        
        //add category
        if (url === "category-add.php") { 

            let addCategoryButton = document.querySelector('.card-footer button')
            addCategoryButton.addEventListener('click', function (e) {
                e.preventDefault()
                
                let categoryName = document.getElementById('category-name').value,
                    categoryIcon = document.getElementById('icon').value

            
                if (categoryName !== "" && categoryIcon !== "") {
                    //call ajax
                    let xhr = new XMLHttpRequest()

                    //send data through FormData
                    let data = new FormData()
                    data.append('categoryName', categoryName)
                    data.append('categoryIcon', categoryIcon)
                    data.append('action', 'create')

                    //open connection
                    xhr.open('POST', 'category-backend.php', true)

                    //return data
                    xhr.onload = function () {
                        if (this.status === 200) {
                            console.log(JSON.parse(xhr.responseText))
                            let answer = JSON.parse(xhr.responseText)

                            if (answer.answer === 'success') {
                                swal({
                                    type: 'success',
                                    title: 'Categoría Creada',
                                    text: 'La categoría se creó correctamente'
                                }).catch(() => window.location.href = "category-list.php")
                                .then((result) => {
                                    if (result) {
                                        window.location.href = "category-list.php"
                                    }
                                })
                            }
                            else { 
                                swal({
                                    type: 'error',
                                    title: 'Error',
                                    text: 'La categoría no pudo ser creada'
                                }).catch(() => swal.close())
                            }
                        }
                    }

                    //send data
                    xhr.send(data)
                }
                else { 
                    swal({
                        type: 'error',
                        title: 'Error',
                        text: 'Ambos campos son obligatorios'
                    }).catch(() => swal.close())
                }

            })






        }

        //edit category
        if (url === "category-edit.php") { 
            let categoryId = document.querySelector('.card-footer button').value,
                oldName = document.getElementById('category-event').value,
                oldIcon = document.getElementById('icon').value,
                editcategoryButton = document.querySelector('.card-footer button')


            editcategoryButton.addEventListener('click', function (e) {
                e.preventDefault()
                
                let newName = document.getElementById('category-event').value,
                    newIcon = document.getElementById('icon').value



                if (newName === "" || newIcon === "") {
                    swal({
                        type: 'error',
                        title: 'Error',
                        text: 'Todos los campos son obligatorios'
                    }).catch(() => swal.close())
                }
                else { 
                    if (oldName === newName && oldIcon === newIcon) {
                        swal({
                            type: 'warning',
                            title: 'Error',
                            text: 'No hay cambios'
                        }).catch(() => swal.close())
                    }
                    else {
                        
                        
                         //call ajax
                        let xhr = new XMLHttpRequest()

                        //send data through FormData
                        let data = new FormData()
                        data.append('categoryId', categoryId)
                        data.append('categoryName', newName)
                        data.append('categoryIcon', newIcon)
                        data.append('action', 'edit')

                        //open connection
                        xhr.open('POST', 'category-backend.php', true)

                        //return data
                        xhr.onload = function () {
                            if (this.status === 200) {
                                let answer = JSON.parse(xhr.responseText)

                                if (answer.answer === 'success') {
                                    swal({
                                        type: 'success',
                                        title: 'Categoría Modificada',
                                        text: 'Los cambio se guardaron correctamente'
                                    }).catch(() => window.location.href = "category-list.php")
                                    .then((result) => {
                                        if (result) {
                                            window.location.href = "category-list.php"
                                        }
                                    })
                                }
                                else { 
                                    swal({
                                        type: 'error',
                                        title: 'Error',
                                        text: 'Los cambios no fueron guardados'
                                    }).catch(() => swal.close())
                                }
                            }
                        }

                        //send data
                        xhr.send(data)
                    }
                }

            })
        }

        //delete category
        if (url === "category-list.php") {
            const delegationToDelete = document.querySelector('#registers')
            delegationToDelete.addEventListener('click', function (e) {
                let id = e.target.id
                if (e.target.className === "fa fa-trash") id = e.target.parentNode.id

                if (id !== "" && id !== "registers") {
                    e.preventDefault()

                    swal({
                        icon: 'warning',
                        title: '¿Estás seguro?',
                        text: "La categoría será borrado permanentemente", 
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Borrar',
                        cancelButtonText: 'Cancelar'
                    }).catch(() => swal.close()).then((result) => {
                        if (result) {
                            let categoryName = document.getElementById(`${id}`).parentNode.parentNode.childNodes[1].textContent
                            
                            //call ajax
                            let xhr = new XMLHttpRequest()

                            //send data through FormData
                            let data = new FormData()
                            data.append('idToDelete', id)
                            data.append('action', 'delete')

                            //open connection
                            xhr.open('POST', 'category-backend.php', true)

                            //return data
                            xhr.onload = function () { 
                                if (this.status === 200) { 
                                    let answer = JSON.parse(xhr.responseText)
                                    console.log(JSON.parse(xhr.responseText))

                                    if (answer.answer === "success") {
                                        swal({
                                            type: 'success',
                                            title: 'Categoría Borrada',
                                            text: `La categoría "${categoryName}" se borró correctamente`
                                        }).catch(() => window.location.href = "category-list.php")
                                        .then((result) => {
                                            if (result) {
                                                window.location.href = "category-list.php"
                                            }
                                        })
                                    }
                                    else { 
                                        swal({
                                            type: 'error',
                                            title: 'Error',
                                            text: `La categoría "${categoryName}" no pudo ser borrada debido a que existen elementos con la misma`
                                        }).catch(() => swal.close())
                                    }
                                }
                            }

                            //send data
                            xhr.send(data)
                        }
                    }).catch(() => swal.close())


                }
            })
        }


        /* Section Guests */
        let sizeImageGlobal = 3000000,
            sizeImageGlobalMb = 3

        //add guests
        if (url === "guests-add.php") { 

            //change "Seleccionar archivo" to url
            let statusFile = document.getElementById('guest-file')
            statusFile.addEventListener('change', function () { 
                if (statusFile.value === "") document.querySelector('.custom-file .custom-file-label').textContent = "Seleccionar archivo"
                else document.querySelector('.custom-file .custom-file-label').textContent = statusFile.value
            })

            //send
            let addGuestButton = document.querySelector('.card-footer button')
            addGuestButton.addEventListener('click', function (e) {
                e.preventDefault()

                let guestName = document.getElementById('guests-name').value,
                    guestSurname = document.getElementById('guests-surname').value,
                    guestBiography = document.getElementById('biography').value,
                    guestImage = document.getElementById('guest-file').value,
                    formUpload = document.getElementById('guests-create')
     
                if (guestName === "" || guestSurname === "" || guestBiography === "" || guestImage === "") { 
                    swal({
                        type: 'error',
                        title: 'Error',
                        text: 'Todos los campos son obligatorios'
                    }).catch(() => swal.close())
                }
                else { 
                    if (guestBiography.length < 20) {
                        swal({
                            type: 'warning',
                            title: 'Error',
                            text: 'Intenta escribir un poco más acerca de ti'
                        }).catch(() => swal.close())
                    }
                    else { 
                        let path = guestImage,
                            path_splitted = path.split('.'),
                            extension = path_splitted.pop().toLowerCase()
                        
                        if (extension === "jpg" || extension === "jpeg" || extension === "png" || extension === "gif") {
                            //validate if the file is larger than 3mb
                            if (document.getElementById('guest-file').files[0].size > sizeImageGlobal) {
                                swal({
                                    type: 'error',
                                    title: 'Error',
                                    text: 'El archivo supera el límite permitido. (' + sizeImageGlobalMb + 'MB)'
                                }).catch(() => swal.close())
                            }
                            else { 
                                //call ajax
                                let xhr = new XMLHttpRequest()

                                //send data through FormData (send image too)
                                let data = new FormData(formUpload)
                                data.append('action', 'create')

                                //open connection
                                xhr.open('POST', 'guests-backend.php', true)

                                //return data
                                xhr.onload = function () { 
                                    if (this.status === 200) { 
                                        console.log(JSON.parse(xhr.responseText))
                                        let answer = JSON.parse(xhr.responseText)

                                        if (answer.answer == 'success') {
                                            swal({
                                                type: 'success',
                                                title: 'Invitado Creado',
                                                text: 'El invitado se ha creado correctamente'
                                            }).catch(() => window.location.href = "guests-list.php")
                                                .then((result) => {
                                                    if (result) {
                                                        window.location.href = "guests-list.php"
                                                    }
                                                })
                                        }
                                        else if (answer.answer == 'error' && answer.error == 'not_image') {
                                            swal({
                                                type: 'error',
                                                title: 'Error',
                                                text: 'No es una imagen'
                                            }).catch(() => swal.close())
                                        }
                                        else { 
                                            swal({
                                                type: 'error',
                                                title: 'Error',
                                                text: 'El invitado no pudo ser creado'
                                            }).catch(() => swal.close())
                                        }
                                    }
                                }

                                //send data
                                xhr.send(data)
                            }
                        }
                        else { 
                            swal({
                                type: 'error',
                                title: 'Error',
                                text: 'No es una imagen'
                            }).catch(() => swal.close())
                        }
                    }
                }
            })
        }

        //edit guests
        if (url === "guests-edit.php") { 

            //change "Seleccionar archivo" to url
            let statusFile = document.getElementById('guest-file')
            statusFile.addEventListener('change', function () { 
                if (statusFile.value === "") document.querySelector('.custom-file .custom-file-label').textContent = "Seleccionar archivo"
                else document.querySelector('.custom-file .custom-file-label').textContent = statusFile.value
            })

            //slideToggle to currently image
            let currentlyImageButton = document.querySelector('.currently-image-button')
            currentlyImageButton.addEventListener('click', function (e) {
                e.preventDefault()
                $('.currently-image').slideToggle(1000)
                if (document.querySelector('.currently-image-button button').textContent == "Ver Imagen Actual") {
                    document.querySelector('.currently-image-button button').textContent = "Ocultar Imagen Actual"
                }
                else { 
                    document.querySelector('.currently-image-button button').textContent = "Ver Imagen Actual"
                }
            })

            //send
            let addGuestButton = document.querySelector('.card-footer button')
            addGuestButton.addEventListener('click', function (e) {
                e.preventDefault()

                let idGuest = addGuestButton.value,
                    guestName = document.getElementById('guests-name').value,
                    guestSurname = document.getElementById('guests-surname').value,
                    guestBiography = document.getElementById('biography').value,
                    guestImage = document.getElementById('guest-file').value,
                    formUpload = document.getElementById('guests-create'),
                    guestImageContent
                if(guestImage === "") guestImageContent = true
                else guestImageContent = false

     
                if (guestName === "" || guestSurname === "" || guestBiography === "") { 
                    swal({
                        type: 'error',
                        title: 'Error',
                        text: 'Todos los campos son obligatorios'
                    }).catch(() => swal.close())
                }
                else { 
                    if (guestBiography.length < 20) {
                        swal({
                            type: 'warning',
                            title: 'Error',
                            text: 'Intenta escribir un poco más acerca de ti'
                        }).catch(() => swal.close())
                    }
                    else { 
                        let extension
                        if (guestImage !== "") {
                            let path = guestImage,
                                path_splitted = path.split('.')
                                extension = path_splitted.pop().toLowerCase()
                        }
                        if (extension === "jpg" || extension === "jpeg" || extension === "png" || extension === "gif" || guestImageContent) {
                            let fileSize
                            if (!guestImageContent) { 
                                //validate if the file is larger than 3mb
                                if (document.getElementById('guest-file').files[0].size > sizeImageGlobal) {
                                    fileSize = false
                                    swal({
                                        type: 'error',
                                        title: 'Error',
                                        text: 'El archivo supera el límite permitido. (' + sizeImageGlobalMb + 'MB)'
                                    }).catch(() => swal.close())
                                }
                                else {
                                    fileSize = true
                                }
                            }
                            else { 
                                fileSize = true
                            }
                            if (fileSize) {
                                
                                //call ajax
                                let xhr = new XMLHttpRequest()

                                //send data through FormData (send image too)
                                let data = new FormData(formUpload)
                                data.append('idGuest', idGuest)
                                data.append('action', 'edit')

                                //open connection
                                xhr.open('POST', 'guests-backend.php', true)

                                //return data
                                xhr.onload = function () { 
                                    if (this.status === 200) { 
                                        console.log(JSON.parse(xhr.responseText))
                                        let answer = JSON.parse(xhr.responseText)

                                        if (answer.answer == 'success') {
                                            swal({
                                                type: 'success',
                                                title: 'Invitado Modificado',
                                                text: 'El invitado se ha editado correctamente'
                                            }).catch(() => window.location.href = "guests-list.php")
                                            .then((result) => {
                                                if (result) {
                                                    window.location.href = "guests-list.php"
                                                }
                                            })
                                        }
                                        else if (answer.answer == 'error' && answer.error == 'not_image') {
                                            swal({
                                                type: 'error',
                                                title: 'Error',
                                                text: 'No es una imagen'
                                            }).catch(() => swal.close())
                                        }
                                        else { 
                                            swal({
                                                type: 'error',
                                                title: 'Error',
                                                text: 'El invitado no se fue modificado'
                                            }).catch(() => swal.close())
                                        }
                                    }
                                }

                                //send data
                                xhr.send(data)
                            }
                        }
                        else { 
                            swal({
                                type: 'error',
                                title: 'Error',
                                text: 'No es una imagen'
                            }).catch(() => swal.close())
                        }
                    }
                }
            })

        }

        //delete guests
        if (url === "guests-list.php") {
            const delegationToDelete = document.querySelector('#registers')
            delegationToDelete.addEventListener('click', function (e) {
                let id = e.target.id
                
                if (e.target.className === "fa fa-trash") id = e.target.parentNode.id
                if (id !== "" && id !== "registers") {
                    e.preventDefault()

                    swal({
                        icon: 'warning',
                        title: '¿Estás seguro?',
                        text: "El invitado será borrado permanentemente",
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Borrar',
                        cancelButtonText: 'Cancelar'
                    }).catch(() => swal.close()).then((result) => {
                        if (result) {
                            let guestName = document.getElementById(`${id}`).parentNode.parentNode.childNodes[1].textContent
                            
                            //call ajax
                            let xhr = new XMLHttpRequest()

                            //send data through FormData
                            let data = new FormData()
                            data.append('idToDelete', id)
                            data.append('action', 'delete')

                            //open connection
                            xhr.open('POST', 'guests-backend.php', true)

                            //return data
                            xhr.onload = function () { 
                                if (this.status === 200) { 
                                    let answer = JSON.parse(xhr.responseText)
                                    console.log(JSON.parse(xhr.responseText))

                                    if (answer.answer === "success") {
                                        swal({
                                            type: 'success',
                                            title: 'Invitado Borrada',
                                            text: `El invitado "${guestName}" se borró correctamente`
                                        }).catch(() => window.location.href = "guests-list.php")
                                        .then((result) => {
                                            if (result) {
                                                window.location.href = "guests-list.php"
                                            }
                                        })
                                    }
                                    else { 
                                        swal({
                                            type: 'error',
                                            title: 'Error',
                                            text: `El invitado "${guestName}" no pudo ser borrado debido a que existen eventos a su nombre`
                                        }).catch(() => swal.close())
                                    }
                                }
                            }

                            //send data
                            xhr.send(data)
                        }
                    }).catch(() => swal.close())
                }
            })
        }


        /* Section Register User */
        
        //add users
        if (url === "user-add.php") { 
            let addUserButton = document.querySelector('.card-footer button')
            addUserButton.addEventListener('click', function (e) {
                e.preventDefault()

                let name = document.getElementById('name'),
                    surname = document.getElementById('surname'),
                    email = document.getElementById('email'),
                    packs = document.querySelectorAll('.price-table'),
                    pack = "0"
                
                //take the selected pack
                packs.forEach((eachPack) => { 
                    if (eachPack.style.opacity === "1") { 
                        pack = eachPack.childNodes[7].childNodes[3].id
                        if (pack === "day-pass") pack = "one_day"
                        if (pack === "two-days-pass") pack = "two_days"
                        if (pack === "all-day-pass") pack = "complete_pass"
                    }
                })

                //add checkboxes selected to the array
                let eventsChecks = new Object()
                eventsChecks.events = []
                document.querySelectorAll(".checkbox").forEach(function (check) {
                    if (check.checked) {
                        eventsChecks['events'].push(check.id)
                    }
                })
                let eventsChecksJSON = JSON.stringify(eventsChecks)

                //take extras and total amount
                let shirts = document.getElementById('shirts-event'),
                    labels = document.getElementById('labels-event'),
                    gift = document.getElementById('gift'),
                    total = document.getElementById('total-sum').textContent

                if(gift.value == "pulsera") gift = 1
                if(gift.value == "etiqueta") gift = 2
                if(gift.value == "pluma") gift = 3



                //include pack and extras in one JSON
                let articles = new Object()
                if (pack != "0") articles[pack] = 1
                else articles['Ninguno'] = 0
                articles['shirts'] = parseInt(shirts.value)
                articles['labels'] = parseInt(labels.value)
                let articlesJSON = JSON.stringify(articles)


                //call ajax
                let xhr = new XMLHttpRequest()

                let data = new FormData()
                data.append("name_user", name.value)
                data.append("surname_user", surname.value)
                data.append("email_user", email.value)
                data.append("articles", articlesJSON)
                data.append("events", eventsChecksJSON)
                data.append("gift", gift)
                data.append("total", total)
                data.append("action", "create")

                //open connection
                xhr.open('POST', 'user-backend.php', true)
                
                //return data
                xhr.onload = function () { 
                    if (this.status === 200) { 
                        let answer = JSON.parse(xhr.responseText)

                        if (answer.answer == "success") { 
                            swal({
                                type: 'success',
                                title: 'Creado',
                                text: 'El usuario fue creado con éxito'
                            }).catch(() => swal.close(window.location.href = "user-list.php")).then((result) => {
                                if (result) {
                                    window.location.href = "user-list.php"
                                }
                            })
                        }
                        
                    }
                }

                //send data
                xhr.send(data)
            })
        }

        //edit users
        if (url === "user-edit.php") {

            let idUser = document.getElementById('id-user').value,
                nameUserOld = document.getElementById('name').value,
                surnameUserOld = document.getElementById('surname').value,
                emailUserOld = document.getElementById('email').value,
                allPassOld = document.querySelectorAll('.price-table'),
                passUserObjectOld = new Object(),
                passUserJsonOld = "",
                allEventsOld = document.querySelectorAll('.checkbox'),
                eventsUserArrayOld = [],
                eventsUserObjectOld = new Object(),
                eventsUserJsonOld = "",
                shirtsOld = document.getElementById('shirts-event'),
                labelsOld = document.getElementById('labels-event'),
                giftOld = formatGift(document.getElementById('gift')),
                markPayed = false,
                markUnpayed = false
            

            //get old price of the pass
            allPassOld.forEach(function (pass) { if (pass.style.opacity == 1) passUserObjectOld[pass.id.replace("-", "_")] = 1 })

            //get old subscribed events
            allEventsOld.forEach(function (checkbox) { if (checkbox.checked) eventsUserArrayOld.push(checkbox.id) })
            eventsUserObjectOld.events = eventsUserArrayOld;
            eventsUserJsonOld = JSON.stringify(eventsUserObjectOld)

            //add to passUserObject the old extras
            passUserObjectOld.shirts = parseInt(shirtsOld.value)
            passUserObjectOld.labels = parseInt(labelsOld.value)
            passUserJsonOld = JSON.stringify(passUserObjectOld)



            //send changes
            let calculateButton = document.getElementById('calculate'),
                registerButton = document.getElementById('btnregister')
           
            calculateButton.click()
            let priceOld = parseFloat(document.getElementById('total-sum').textContent)

            //can only be one checked at the same time
            if (document.getElementById('payed-mark')) {
                markPayed = document.getElementById('payed-mark')
                markUnpayed = document.getElementById('unpayed-mark')

                markPayed.addEventListener('click', function () { markUnpayed.childNodes[0].checked = false })
                markUnpayed.addEventListener('click', function () { markPayed.childNodes[0].checked = false })
            }



            registerButton.addEventListener('click', function(e) {
                e.preventDefault()
                calculateButton.click()

                let nameUser = document.getElementById('name').value,
                    surnameUser = document.getElementById('surname').value,
                    emailUser = document.getElementById('email').value,
                    allPass = document.querySelectorAll('.price-table'),
                    passUserObject = new Object(),
                    passUserJson = "",
                    allEvents = document.querySelectorAll('.checkbox'),
                    eventsUserArray = [],
                    eventsUserObject = new Object(),
                    eventsUserJson = "",
                    shirts = document.getElementById('shirts-event'),
                    labels = document.getElementById('labels-event'),
                    gift = formatGift(document.getElementById('gift')),
                    price = parseFloat(document.getElementById('total-sum').textContent)
                
                if (document.getElementById('payed-mark')) {
                    markPayed = document.getElementById('payed-mark').childNodes[0].checked
                    markUnpayed = document.getElementById('unpayed-mark').childNodes[0].checked
                }
 

                //get price of the pass
                allPass.forEach(function (pass) {
                    if (parseFloat(pass.style.opacity) == 1) {
                        if (pass.childNodes[7].childNodes[3].id == "day-pass") passUserObject['one_day'] = 1
                        if (pass.childNodes[7].childNodes[3].id == "two-days-pass") passUserObject['two_days'] = 1
                        if (pass.childNodes[7].childNodes[3].id == "all-day-pass") passUserObject['complete_pass'] = 1
                    }
                })

                //get subscribed events
                allEvents.forEach(function (checkbox) { if (checkbox.checked) eventsUserArray.push(checkbox.id) })
                eventsUserObject.events = eventsUserArray;
                eventsUserJson = JSON.stringify(eventsUserObject)

                //add to passUserObject the extras
                passUserObject.shirts = parseInt(shirts.value)
                passUserObject.labels = parseInt(labels.value)
                passUserJson = JSON.stringify(passUserObject)

                
                //validations
                if (nameUserOld === nameUser && surnameUserOld === surnameUser && emailUserOld === emailUser &&
                    passUserJsonOld === passUserJson && eventsUserJsonOld === eventsUserJson && giftOld === gift &&
                    !markPayed && !markUnpayed) { 
                    
                    console.log("No hay cambios")
                }
                else {
                    let difference = spliter(price - priceOld)

                    let data = new FormData()
                    data.append('idUser', idUser)
                    data.append('nameUser', nameUser)
                    data.append('surnameUser', surnameUser)
                    data.append('emailUser', emailUser)
                    data.append('passUserJson', passUserJson)
                    data.append('eventsUserJson', eventsUserJson)
                    data.append('gift', gift)
                    data.append('price', price)
                    data.append('difference', difference)
                    data.append('markPayed', markPayed)
                    data.append('markUnpayed', markUnpayed)
                    data.append('action', 'edit')


                    let xhr = new XMLHttpRequest()

                    xhr.open('POST','user-backend.php', true)

                    xhr.onload = function () { 
                        if (this.status === 200) { 
                            let answer = JSON.parse(xhr.responseText)

                            if (answer.answer == "success") { 
                                swal({
                                    type: 'success',
                                    title: 'Guardado',
                                    text: 'Todos los cambios se guardaron correctamente'
                                }).catch(() => swal.close(window.location.href = "user-list.php")).then((result) => {
                                    if (result) {
                                        window.location.href = "user-list.php"
                                    }
                                })
                            }

                        }
                    }
                    
                    xhr.send(data) 
                }

            })
          
        }

        //show events for each user and delete
        if (url === "user-list.php") { 
            //delegation to delete or show events
            const delegation = document.querySelector('#registers')
            delegation.addEventListener('click', function (e) {
                let id = e.target.id

                //show events
                if (e.target.className == "btn bg-green") {
                    e.preventDefault()
                    let events = e.target.value

                    swal({
                        title: 'Eventos del Usuario',
                        html: '<div class="align-left show-alert">' + events + '</div>'
                    }).catch(() => swal.close())

                }

                //delete user
                if (e.target.className === "fa fa-trash") id = e.target.parentNode.id
                if (id !== "" && id !== "registers") {
                    e.preventDefault()
                    let target = e.target
                    if(target.className == "fa fa-trash") target = target.parentNode


                    swal({
                        icon: 'warning',
                        title: '¿Estás seguro?',
                        text: "El usuario será borrado permanentemente",
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Borrar',
                        cancelButtonText: 'Cancelar'
                    }).catch(() => swal.close()).then((result) => {
                        if (result) {
                            let xhr = new XMLHttpRequest()

                            let data = new FormData()
                            data.append('id', id)
                            data.append('action', 'delete')

                            xhr.open('POST', 'user-backend.php', true)

                            xhr.onload = function () {
                                if (this.status === 200) {
                                    let answer = JSON.parse(xhr.responseText)

                                    if (answer.answer == "success") {
                                        swal({
                                            type: 'success',
                                            title: 'Usuario Eliminado',
                                            text: `El usuario "${answer.name}" fue eliminado correctamente`
                                        }).catch(() => window.location.href = "user-list.php").then((result) => {
                                            if (result) {
                                                window.location.href = "user-list.php"
                                            }
                                        })
                                    }
                                    if (answer.answer == "error") {
                                        if (answer.error == "something_paid") {
                                            swal({
                                                type: 'error',
                                                title: 'Error',
                                                text: 'El usuario ya ha realizado algún pago'
                                            }).catch(() => swal.close())
                                        }
                                        else {
                                            swal({
                                                type: 'error',
                                                title: 'Error',
                                            }).catch(() => swal.close())
                                        }
                                    }
                                
                                }
                            }

                            xhr.send(data)
                        }
                    }).catch(() => swal.close())
                }     
            })  
        }
    });
})();