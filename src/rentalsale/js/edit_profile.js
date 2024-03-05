const cookieLng = document.cookie
.split("; ")
.find((row) => row.startsWith("language="))
.split("=")[1];
let alertsTranslations = {};

// cargar json de traducciones
const loadTranslations = (lng) => {
    return fetch(
    `https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/locales/${lng}/alert.json`
    )
    .then((response) => response.json())
    .then((translation) => {
        // save in a global variable
        alertsTranslations = translation;
    });
};

loadTranslations(cookieLng);
console.log('holas')



jQuery(document).ready(function($){

    function infoAccount(){
        $.ajax({
            url: 'https://dev.kalstein.plus/wp-content/plugins/kalsteinPerfiles/php/infoAccount.php',
            type: 'POST',
            data: {},
        })
        .done(function(respuesta){
            console.log(respuesta);
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
        })
    }

    infoAccount();

    // cambio de pestañas

    $(document).on('click', '#btnProfilePR01', function (){
        $('#c-profile').css({'display' : 'block'});
        $('#c-security').css({'display' : 'none'});

        document.querySelector('#btnProfilePR01').classList.add('active');
        document.querySelector('#btnSecurityPR01').classList.remove('active');
    });
    $(document).on('click', '#btnSecurityPR01', function (){
        $('#c-profile').css({'display' : 'none'});
        $('#c-security').css({'display' : 'block'});
        
        document.querySelector('#btnSecurityPR01').classList.add('active');
        document.querySelector('#btnProfilePR01').classList.remove('active');
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
			url: "https://dev.kalstein.plus/wp-content/plugins/kalsteinPerfiles/php/updateInfoAccount.php",
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
                    title : alertsTranslations.exito,
                    message : alertsTranslations.datosCargados,
                    position: 'center'
                  });
                location = window.location
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
});
