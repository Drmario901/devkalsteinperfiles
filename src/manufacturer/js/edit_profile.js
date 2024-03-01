jQuery(document).ready(function($){



    function infoAccount(){

        $.ajax({

            url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/infoAccount.php',

            type: 'POST',

            data: {},

        })

        .done(function(respuesta){

            console.log(respuesta);



            $.ajax({

                url: 'https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/searchCountry.php',

                type: 'POST',

                data: {},

            })

            .done(function(respuesta2){

                $('#countryUserProfile').html(respuesta2)

                $('#inputCountryOrg').html(respuesta2)

                $('#inputDestination').html(respuesta2)



                let data = JSON.parse(respuesta)

                $('#inputFirstName').val(data.name)

                $('#inputLastName').val(data.lastname)

                $('#countryUserProfile').val(data.countryAcc)

                $('#inputLocationProfile').val(data.locationAcc)

                $('#inputAddressProfile').val(data.addressAcc)

                $('#inputZipcodeProfile').val(data.zipcodeAcc)

                $('#inputPhone').val(data.phoneAcc)

                $('#inputBirthday').val(data.newBirthdayAcc)

                $('#inputOrgName').val(data.nameCompany)

                if (data.roleCompany.length === 0){

                    $('#jobRoleOrg').val(0)

                }else{

                    $('#jobRoleOrg').val(data.roleCompany)

                }

                $('#inputAddressOrg').val(data.addressCompany)

                $('#inputStateOrg').val(data.stateCompany)

                $('#inputCountryOrg').val(data.countryCompany)

                $('#inputPhoneOrg').val(data.phoneCompany)

                if (data.zipcodeCompany == 0){

                    $('#inputZipcodeOrg').val('')

                }else{

                    $('#inputZipcodeOrg').val(data.zipcodeCompany)

                }

                $('#inputUrlWebSiteOrg').val(data.websiteCompany)

            })

            .fail(function(){

                console.log("error");

            });

        })

        .fail(function(){

            console.log("error");

        })

    }



    infoAccount();



    // cambio de pestañas



    $(document).on('click', '#btnProfilePR01', function (){

        $('#c-profile').css({'display' : 'block'});

        $('#c-security').css({'display' : 'none'});

        $('#c-identities').css({'display' : 'none'});



        $(this).addClass('active');

        $('#btnSecurityPR01').removeClass('active');

        $('#btnIdentityVerifyPR01').removeClass('active');

    });

    

    $(document).on('click', '#btnIdentityVerifyPR01', function(){

        $('#c-identities').css({'display' : 'block'});

        $('#c-security').css({'display' : 'none'});

        $('#c-profile').css({'display' : 'none'});

        

        $(this).addClass('active')

        $('#btnSecurityPR01').removeClass('active')

        $('#btnProfilePR01').removeClass('active')

    })

    

    $(document).on('click', '#btnSecurityPR01', function (){

        $('#c-profile').css({'display' : 'none'});

        $('#c-security').css({'display' : 'block'});

        $('#c-identities').css({'display' : 'none'});

        

        $(this).addClass('active');

        $('#btnProfilePR01').removeClass('active');

        $('#btnIdentityVerifyPR01').removeClass('active');

    });



    // UPDATE ACCOUNT DATA



    $(document).on('click', '#savedUpdateInfo', function(){

        let imageProfile = $('#i-uploadImagePerfil')[0].files[0]

        let name = $('#inputFirstName').val()

        let lastname = $('#inputLastName').val()

        let country = $('#countryUserProfile').val()

        let location = $('#inputLocationProfile').val()

        let address = $('#inputAddressProfile').val()

        let zipcode = $('#inputZipcodeProfile').val()

        let phone = $('#inputPhone').val()

        let birthday = $('#inputBirthday').val()

        let nameOrg = $('#inputOrgName').val()

        let roleOrg = $('#jobRoleOrg').val()

        let addressOrg = $('#inputAddressOrg').val()

        let stateOrg = $('#inputStateOrg').val()

        let countryOrg = $('#inputCountryOrg').val()

        let phoneOrg = $('#inputPhoneOrg').val()

        let zipcodeOrg = $('#inputZipcodeOrg').val()

        let websiteOrg = $('#inputUrlWebSiteOrg').val()



        if (nameOrg === ''){

            $('#inputOrgName').focus()

        }else{

            savedUpdateInfoAcc(imageProfile, name, lastname, country, location, address, zipcode, phone, birthday, nameOrg, roleOrg, addressOrg, stateOrg, countryOrg, phoneOrg, zipcodeOrg, websiteOrg)

        }

    })



    function savedUpdateInfoAcc(imageProfile, name, lastname, countryAcc, locationAcc, addressAcc, zipcodeAcc, phoneAcc, birthdayAcc, nameCompany, roleCompany, addressCompany, stateCompany, countryCompany, phoneCompany, zipcodeCompany, websiteCompany){

        var formData = new FormData() 

        formData.append('imageProfile', imageProfile)

        formData.append('name', name)

        formData.append('lastname', lastname)

        formData.append('countryAcc', countryAcc)

        formData.append('locationAcc', locationAcc)

        formData.append('addressAcc', addressAcc)

        formData.append('zipcodeAcc', zipcodeAcc)

        formData.append('phoneAcc', phoneAcc)

        formData.append('birthdayAcc', birthdayAcc)

        formData.append('nameCompany', nameCompany)

        formData.append('roleCompany', roleCompany)

        formData.append('addressCompany', addressCompany)

        formData.append('stateCompany', stateCompany)

        formData.append('countryCompany', countryCompany)

        formData.append('phoneCompany', phoneCompany)

        formData.append('zipcodeCompany', zipcodeCompany)

        formData.append('websiteCompany', websiteCompany)



        $.ajax({

            contentType: "multipart/form-data",

			url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/updateInfoAccount.php",

			type: "POST",

			data: formData,

			dataType: "text",

			processData: false,

			contentType: false,

			cache: false,

        })

        .done(function(respuesta){

            console.log(respuesta);

            let data = JSON.parse(respuesta)

            if (data.update === 'correcto'){

                iziToast.success({

                    title : 'Success',

                    message : 'The data were saved successfully!',

                    position: 'center'

                });

            }

        })

        .fail(function(){

            console.log("error");

        })

    }



    $(document).on('click', '#btnUploadImagePerfil', function(){

        $('#i-uploadImagePerfil').click()

    })



    $(document).on('change', '#i-uploadImagePerfil', function(){

        let file = $(this)[0].files[0]

        objectUrl = URL.createObjectURL(file)

        $('.img-account-profile').attr('src', objectUrl)

    })



    // Cambio de contraseña



    $(document).on('click', '#btnSavedNewPassword', function(){

        let currentPassword = $('#currentPassword').val()

        let newPassword = $('#newPassword').val()

        let confirmPassword = $('#confirmPassword').val()



        if (currentPassword === ''){

            $('#currentPassword').focus()

        }else{

            if (newPassword === ''){

                $('#newPassword').focus()

            }else{

                if (confirmPassword === ''){

                    $('#confirmPassword').focus()

                }else{

                    if (confirmPassword != newPassword){

                        alert('Passwords do not match.')

                    }else{

                        savedNewPassword(currentPassword, confirmPassword)

                    }

                }

            }

        }

    })



    function savedNewPassword(currentPassword, confirmPassword){

        $.ajax({

			url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/savedNewPassword.php",

			type: "POST",

			data: {currentPassword, confirmPassword},

        })

        .done(function(respuesta){

            let data = JSON.parse(respuesta)

            if (data.update === 'nocoinciden'){

                alert('Current password is not correct!')

            }else{

                if (data.update === 'correcto'){

                    iziToast.success({

                        title : 'Success',

                        message : 'Password was successfully updated',

                        position: 'center'

                    });

                    

                }

            }

        })

        .fail(function(){

            console.log("error");

        })

    }



    // Eliminar cuetnta



    $(document).on('click', '#btnDeleteAccount', function(){

        $.jAlert({

            type: 'confirm',

            confirmQuestion: 'Are you sure you want to delete your account?',

            onConfirm: function(e, btn){

                e.preventDefault();

                deleteAccount();

                location = window.location

                btn.parents('.jAlert').closeAlert();

                return false;

            },

            onDeny: function(e, btn){

                e.preventDefault();

                btn.parents('.jAlert').closeAlert();

            return false;

            }

        })        

    })



    function deleteAccount(){



        $.ajax({

			url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/deleteAccount.php",

			type: "POST",

			data: {},

        })

        .done(function(respuesta){

            let data = JSON.parse(respuesta)

            window.location.href = 'https://dev.kalstein.plus/plataforma/index.php/login/';

        })

        .fail(function(){

            console.log("error");

        })

    } 

    
});

