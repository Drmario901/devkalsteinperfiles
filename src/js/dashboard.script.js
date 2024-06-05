jQuery(document).ready(function ($) {
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

  function checkMembership() {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/checkMembershipStatus.php",

      type: "GET",

      data: {},
    }).done(function (respuesta) {
      console.log(respuesta);
    });
  }

  checkMembership();
  loadTranslations(cookieLng);

  /* //function sstranslateAlert(type, msg, lng) {
        $.ajax({
            url: plugin_dir + '/php/translations.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                
                const translation = response[lng][msg];
                iziToast[type]({
                    message: translation
                });

            },
            error: function(xhr, status, error) {
                console.error(error);
            }
        });
    }  */

  function getParameterByName(name, url) {
    if (!url) url = window.location.href;
    name = name.replace(/[\[\]]/g, "\\$&");
    var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
      results = regex.exec(url);
    if (!results) return null;
    if (!results[2]) return "";
    return decodeURIComponent(results[2].replace(/\+/g, " "));
  }

  $("#inputShippingCost-subject").focus();

  dataForDonutsChartjsAccount();
  dataForLineChartjsQuote();
  searchDataUserDashboard();
  searchCountry();
  searchRecentProductsQuoted();
  searchDataProductTbl("", "0");
  tblSearches();
  tblAccess();
  tblUpdates();
  tblDeletes();
  showDataQuoteRecent();
  showDataSearchesRecent();
  searchInfoToQUote();
  dataForLineChartjsSales();
  dataForBarChartjsQuote();
  keepSessionAlive();

  $(".vce-row-content").attr("id", "vce-row-content");

  $(document).on("click", "#btn-logout", function () {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/logout.php",
      type: "POST",
      success: function (response) {
        window.location.replace(`${main_domain}`);
      },
      error: function (xhr, status, error) {
        console.error(error);
      },
    });
  });

  $(document).on("click", "#btn-logo", function (event) {
    window.scrollTo(0, 0);
    resetNavLinks("#btnDashboardPr01");
    $("#c-panel01").css({ display: "block" });
    $("#c-panel02").css({ display: "none" });
    $("#c-panel03").css({ display: "none" });
    $("#c-panel04").css({ display: "none" });
    $("#c-panel05").css({ display: "none" });
    $("#c-panel06").css({ display: "none" });
    $("#c-panel07").css({ display: "none" });
    $("#c-panel08").css({ display: "none" });
    showDataQuoteRecent();
    showDataSearchesRecent();
    dataForDonutsChartjsAccount();
    event.preventDefault();
  });

  /*$(document).on('click', 'a', function(e){

        e.preventDefault()

    })*/

  /*function getUnseenMessages(){



        $.ajax({

            url: plugin_dir + '/php/getUnseenMessages.php'

        })

        .done(function (response){

            console.log(parseInt(response));

            let count = parseInt(response);



            if (count > 0){

                $('#messagesBaloon').removeAttr('hidden');

                $('#messagesCant').html(count <= 99 ? ''+count : '+99');

            }

            else {

                $('#messagesBaloon').attr('hidden', '');

            }

        })

        .fail(function(){

            $('#messagesBaloon').attr('hidden', '');

        });

    }*/

  function resetNavLinks(exception) {
    let links = [
      "#btnDashboardPr01",
      "#btnQuotePr01",
      "#btnRecentActivityPr01",
      "#btnEditProfilePr01",
      "#btnReportPr01",
      "#btnBlogPr01",
      "#btnGuidePr01",
      "#btnCatalogs",
      "#btnMail",
    ];

    for (let elem of links) {
      $(elem).removeClass("active");
    }

    $(exception).addClass("active");
  }

  $(document).on("click", "#btnDashboardPr01", function () {
    window.scrollTo(0, 0);
    resetNavLinks("#btnDashboardPr01");
    $("#c-panel01").css({ display: "block" });
    $("#c-panel02").css({ display: "none" });
    $("#c-panel03").css({ display: "none" });
    $("#c-panel04").css({ display: "none" });
    $("#c-panel05").css({ display: "none" });
    $("#c-panel06").css({ display: "none" });
    $("#c-panel07").css({ display: "none" });
    $("#c-panel08").css({ display: "none" });
    $("#c-panel09").css({ display: "none" });
    $("#c-panel15").css({ display: "none" });
    $("#c-panel16").css({ display: "none" });
    $("#c-panel17").css({ display: "none" });
    showDataQuoteRecent();
    showDataSearchesRecent();
    dataForDonutsChartjsAccount();

    var myGet = getParameterByName("userToConsultPriceShipping");
    if (myGet) {
      window.location.href = domain + "/dashboard/#dashboard";
    } else {
      location.hash = "#dashboard";
    }
  });

  $(document).on("click", "#btnDiagnosisApp", function () {
    window.scrollTo(0, 0);
    resetNavLinks("#btnDiagnosisApp");
    $("#c-panel01").css({ display: "none" });
    $("#c-panel02").css({ display: "none" });
    $("#c-panel03").css({ display: "none" });
    $("#c-panel04").css({ display: "none" });
    $("#c-panel05").css({ display: "none" });
    $("#c-panel06").css({ display: "none" });
    $("#c-panel07").css({ display: "none" });
    $("#c-panel08").css({ display: "none" });
    $("#c-panel09").css({ display: "none" });
    $("#c-panel15").css({ display: "none" });
    $("#c-panel16").css({ display: "none" });
    $("#c-panel17").css({ display: "none" });
    $("#c-panel10").css({ display: "block" });
    $("#under01").addClass("underline");
    $("#under02").removeClass("underline");
    $("#btnDiagnosisApp").addClass("active");
    $("#btnDiagnosisApp").removeClass("active");
    searchRecentProductsQuoted();
    searchDataProductTbl();
    dataForBarChartjsQuote();

    var myGet = getParameterByName("userToConsultPriceShipping");
    if (myGet) {
      window.location.href = domain + "/dashboard/#diagnosis-app";
    } else {
      location.hash = "#diagnosis-app";
    }
  });

  $(document).on("click", "#btnQuotePr01", function () {
    window.scrollTo(0, 0);
    resetNavLinks("#btnQuotePr01");
    $("#c-panel01").css({ display: "none" });
    $("#c-panel02").css({ display: "block" });
    $("#c-panel03").css({ display: "none" });
    $("#c-panel04").css({ display: "none" });
    $("#c-panel05").css({ display: "none" });
    $("#c-panel06").css({ display: "none" });
    $("#c-panel07").css({ display: "none" });
    $("#c-panel08").css({ display: "none" });
    $("#c-panel09").css({ display: "none" });
    $("#c-panel15").css({ display: "none" });
    $("#c-panel16").css({ display: "none" });
    $("#c-panel17").css({ display: "none" });
    $("#under01").addClass("underline");
    $("#under02").removeClass("underline");
    $("#c-historyQuote").css({ display: "block" });
    $("#c-settingsQuote").css({ display: "none" });
    $("#btnHistoryQuotePR01").addClass("active");
    $("#btnSettingQuotePR01").removeClass("active");
    searchRecentProductsQuoted();
    searchDataProductTbl();
    dataForBarChartjsQuote();

    var myGet = getParameterByName("userToConsultPriceShipping");
    if (myGet) {
      window.location.href = domain + "/dashboard/#quotes";
    } else {
      location.hash = "#quotes";
    }
  });

  $(document).on("click", "#btnRecentActivityPr01", function () {
    window.scrollTo(0, 0);
    $("#btnSearches").click();
    resetNavLinks("#btnRecentActivityPr01");
    $("#c-panel01").css({ display: "none" });
    $("#c-panel02").css({ display: "none" });
    $("#c-panel03").css({ display: "block" });
    $("#c-panel04").css({ display: "none" });
    $("#c-panel05").css({ display: "none" });
    $("#c-panel06").css({ display: "none" });
    $("#c-panel07").css({ display: "none" });
    $("#c-panel08").css({ display: "none" });
    $("#c-panel09").css({ display: "none" });
    $("#c-panel15").css({ display: "none" });
    $("#c-panel16").css({ display: "none" });
    $("#c-panel17").css({ display: "none" });
    tblAccess();
    tblDeletes();
    tblSearches();
    tblUpdates();

    var myGet = getParameterByName("userToConsultPriceShipping");
    if (myGet) {
      window.location.href = domain + "/dashboard/#activity";
    } else {
      location.hash = "#activity";
    }
  });

  $(document).on("click", "#btnReportPr01", function () {
    window.scrollTo(0, 0);
    $("#btnSearches").click();
    resetNavLinks("#btnReportPr01");
    $("#c-panel01").css({ display: "none" });
    $("#c-panel02").css({ display: "none" });
    $("#c-panel03").css({ display: "none" });
    $("#c-panel04").css({ display: "none" });
    $("#c-panel05").css({ display: "block" });
    $("#c-panel06").css({ display: "none" });
    $("#c-panel07").css({ display: "none" });
    $("#c-panel08").css({ display: "none" });
    $("#c-panel09").css({ display: "none" });
    $("#c-panel15").css({ display: "none" });
    $("#c-panel16").css({ display: "none" });
    $("#c-panel17").css({ display: "none" });
    $("#c-historySupportPR01").css({ display: "block" });
    $("#c-quoteSupportPR01").css({ display: "none" });
    $("#c-rental-equipments").css({ display: "none" });
    $("#c-orderSupportPR01").css({ display: "none" });
    $("#btnHistorySupportPR01").addClass("active");
    $("#btnQuoteSupportPR01").removeClass("active");
    $("#btnOrderSupportPR01").removeClass("active");
    $("#btnRentalEquipments").removeClass("active");
    searchListServices();
    tblReportsTickets();
  });


  $(document).on("click", "#btnBlogPr01", function () {
    window.scrollTo(0, 0);
    resetNavLinks("#btnBlogPr01");
    $("#c-panel01").css({ display: "none" });
    $("#c-panel02").css({ display: "none" });
    $("#c-panel03").css({ display: "none" });
    $("#c-panel04").css({ display: "none" });
    $("#c-panel05").css({ display: "none" });
    $("#c-panel06").css({ display: "none" });
    $("#c-panel07").css({ display: "none" });
    $("#c-panel08").css({ display: "none" });
    $("#c-panel09").css({ display: "none" });
    $("#c-panel15").css({ display: "none" });
    $("#c-panel16").css({ display: "block" });
    $("#c-panel17").css({ display: "none" });
  });

  
  $(document).on("click", "#btnGuidePr01", function () {
    window.scrollTo(0, 0);
    $("#btnSearches").click();
    resetNavLinks("#btnGuidePr01");
    $("#c-panel01").css({ display: "none" });
    $("#c-panel02").css({ display: "none" });
    $("#c-panel03").css({ display: "none" });
    $("#c-panel04").css({ display: "none" });
    $("#c-panel05").css({ display: "none" });
    $("#c-panel06").css({ display: "none" });
    $("#c-panel07").css({ display: "none" });
    $("#c-panel08").css({ display: "none" });
    $("#c-panel09").css({ display: "none" });
    $("#c-panel15").css({ display: "none" });
    $("#c-panel16").css({ display: "none" });
    $("#c-panel17").css({ display: "block" });
    $("#btnHistorySupportPR01").addClass("active");
    $("#btnQuoteSupportPR01").removeClass("active");
    $("#btnOrderSupportPR01").removeClass("active");
    $("#btnRentalEquipments").removeClass("active");
    searchListServices();
    tblReportsTickets();
  });

  $(document).on("click", "#btnEditProfilePr01", function () {
    window.scrollTo(0, 0);
    resetNavLinks("#btnEditProfilePr01");
    $("#c-panel01").css({ display: "none" });
    $("#c-panel02").css({ display: "none" });
    $("#c-panel03").css({ display: "none" });
    $("#c-panel04").css({ display: "block" });
    $("#c-panel05").css({ display: "none" });
    $("#c-panel06").css({ display: "none" });
    $("#c-panel07").css({ display: "none" });
    $("#c-panel08").css({ display: "none" });
    $("#c-panel15").css({ display: "none" });
    $("#c-panel16").css({ display: "none" });
    $("#c-panel17").css({ display: "none" });
    $("#c-profile").css({ display: "block" });
    $("#c-security").css({ display: "none" });
    $("#btnProfilePR01").addClass("active");
    $("#btnSecurityPR01").removeClass("active");
    $("#btnIdentityVerifyPR01").removeClass("active");
    infoAccount();
    $(".img-account-profile").attr("src", $(".profile-avatar img").attr("src"));
    $("#i-uploadImagePerfil").val("");

    var myGet = getParameterByName("userToConsultPriceShipping");
    if (myGet) {
      window.location.href = domain + "/dashboard/#settings";
    } else {
      location.hash = "#settings";
    }
  });

  $(document).on("click", "#btnGenQuote", function () {
    window.scrollTo(0, 0);
    resetNavLinks("#btnGenQuote");
    $("#c-panel01").css({ display: "none" });
    $("#c-panel02").css({ display: "none" });
    $("#c-panel03").css({ display: "none" });
    $("#c-panel04").css({ display: "none" });
    $("#c-panel05").css({ display: "none" });
    $("#c-panel06").css({ display: "block" });
    $("#c-panel07").css({ display: "none" });
    $("#c-panel08").css({ display: "none" });
    $("#c-panel09").css({ display: "none" });
    $("#c-panel15").css({ display: "none" });
    $("#c-panel16").css({ display: "none" });
    $("#c-panel17").css({ display: "none" });

    var myGet = getParameterByName("userToConsultPriceShipping");
    if (myGet) {
      window.location.href = domain + "/dashboard/#generate-quote";
    } else {
      location.hash = "#generate-quote";
    }
  });

  $(document).on("click", "#btnShippingCost", function () {
    location.hash = "#shipping-cost";
    window.scrollTo(0, 0);
    resetNavLinks("");
    $("#c-panel01").css({ display: "none" });
    $("#c-panel02").css({ display: "none" });
    $("#c-panel03").css({ display: "none" });
    $("#c-panel04").css({ display: "none" });
    $("#c-panel05").css({ display: "none" });
    $("#c-panel06").css({ display: "none" });
    $("#c-panel07").css({ display: "none" });
    $("#c-panel08").css({ display: "none" });
    $("#c-panel09").css({ display: "block" });
  });

  $(document).on("click", "#btnBirthdayCPR", function () {
    window.scrollTo(0, 0);

    resetNavLinks("#btnEditProfilePr01");

    $("#c-panel01").css({ display: "none" });

    $("#c-panel02").css({ display: "none" });

    $("#c-panel03").css({ display: "none" });

    $("#c-panel04").css({ display: "block" });

    $("#c-panel05").css({ display: "none" });

    $("#c-profile").css({ display: "block" });

    $("#c-security").css({ display: "none" });

    $("#btnProfilePR01").addClass("active");

    $("#btnSecurityPR01").removeClass("active");

    infoAccount();

    $(".img-account-profile").attr("src", $(".profile-avatar img").attr("src"));

    $("#i-uploadImagePerfil").val("");
  });

  $(document).on("click", "#btnNameCompanyCPR", function () {
    window.scrollTo(0, 0);

    resetNavLinks("#btnEditProfilePr01");

    $("#c-panel01").css({ display: "none" });

    $("#c-panel02").css({ display: "none" });

    $("#c-panel03").css({ display: "none" });

    $("#c-panel04").css({ display: "block" });

    $("#c-panel05").css({ display: "none" });

    $("#c-profile").css({ display: "block" });

    $("#c-security").css({ display: "none" });

    $("#btnProfilePR01").addClass("active");

    $("#btnSecurityPR01").removeClass("active");

    $("#btnIdentityVerifyPR01").removeClass("active");

    infoAccount();

    $(".img-account-profile").attr("src", $(".profile-avatar img").attr("src"));

    $("#i-uploadImagePerfil").val("");
  });

  $(document).on("click", "#btnImgDocumentCPR", function () {
    window.scrollTo(0, 0);

    resetNavLinks("#btnEditProfilePr01");

    $("#c-panel01").css({ display: "none" });

    $("#c-panel02").css({ display: "none" });

    $("#c-panel03").css({ display: "none" });

    $("#c-panel04").css({ display: "block" });

    $("#c-panel05").css({ display: "none" });

    $("#c-profile").css({ display: "none" });

    $("#c-security").css({ display: "none" });

    $("#btnProfilePR01").removeClass("active");

    $("#btnSecurityPR01").removeClass("active");

    $("#btnIdentityVerifyPR01").addClass("active");

    $("#c-identities").css({ display: "block" });

    infoAccount();

    $(".img-account-profile").attr("src", $(".profile-avatar img").attr("src"));

    $("#i-uploadImagePerfil").val("");
  });

  $(document).on("click", "#btnIdDocCPR", function () {
    window.scrollTo(0, 0);

    resetNavLinks("#btnEditProfilePr01");

    $("#c-panel01").css({ display: "none" });

    $("#c-panel02").css({ display: "none" });

    $("#c-panel03").css({ display: "none" });

    $("#c-panel04").css({ display: "block" });

    $("#c-panel05").css({ display: "none" });

    $("#c-profile").css({ display: "none" });

    $("#c-security").css({ display: "none" });

    $("#btnProfilePR01").removeClass("active");

    $("#btnSecurityPR01").removeClass("active");

    $("#btnIdentityVerifyPR01").addClass("active");

    $("#c-identities").css({ display: "block" });

    infoAccount();

    $(".img-account-profile").attr("src", $(".profile-avatar img").attr("src"));

    $("#i-uploadImagePerfil").val("");
  });

  $(document).on("click", "#btnImgDocBussinessCPR", function () {
    window.scrollTo(0, 0);

    resetNavLinks("#btnEditProfilePr01");

    $("#c-panel01").css({ display: "none" });

    $("#c-panel02").css({ display: "none" });

    $("#c-panel03").css({ display: "none" });

    $("#c-panel04").css({ display: "block" });

    $("#c-panel05").css({ display: "none" });

    $("#c-profile").css({ display: "none" });

    $("#c-security").css({ display: "none" });

    $("#btnProfilePR01").removeClass("active");

    $("#btnSecurityPR01").removeClass("active");

    $("#btnIdentityVerifyPR01").addClass("active");

    $("#c-identities").css({ display: "block" });

    infoAccount();

    $(".img-account-profile").attr("src", $(".profile-avatar img").attr("src"));

    $("#i-uploadImagePerfil").val("");
  });

  $(document).on("click", "#btnRifBussinessCPR", function () {
    window.scrollTo(0, 0);

    resetNavLinks("#btnEditProfilePr01");

    $("#c-panel01").css({ display: "none" });

    $("#c-panel02").css({ display: "none" });

    $("#c-panel03").css({ display: "none" });

    $("#c-panel04").css({ display: "block" });

    $("#c-panel05").css({ display: "none" });

    $("#c-profile").css({ display: "none" });

    $("#c-security").css({ display: "none" });

    $("#btnProfilePR01").removeClass("active");

    $("#btnSecurityPR01").removeClass("active");

    $("#btnIdentityVerifyPR01").addClass("active");

    $("#c-identities").css({ display: "block" });

    infoAccount();

    $(".img-account-profile").attr("src", $(".profile-avatar img").attr("src"));

    $("#i-uploadImagePerfil").val("");
  });

  $(document).on("click", "#btnRoleCompanyCPR", function () {
    window.scrollTo(0, 0);

    resetNavLinks("#btnEditProfilePr01");

    $("#c-panel01").css({ display: "none" });

    $("#c-panel02").css({ display: "none" });

    $("#c-panel03").css({ display: "none" });

    $("#c-panel04").css({ display: "block" });

    $("#c-panel05").css({ display: "none" });

    $("#c-profile").css({ display: "block" });

    $("#c-security").css({ display: "none" });

    $("#btnProfilePR01").addClass("active");

    $("#btnSecurityPR01").removeClass("active");

    $("#btnIdentityVerifyPR01").removeClass("active");

    infoAccount();

    $(".img-account-profile").attr("src", $(".profile-avatar img").attr("src"));

    $("#i-uploadImagePerfil").val("");
  });

  $(document).on("click", "#btnAddressCompanyCPR", function () {
    window.scrollTo(0, 0);

    resetNavLinks("#btnEditProfilePr01");

    $("#c-panel01").css({ display: "none" });

    $("#c-panel02").css({ display: "none" });

    $("#c-panel03").css({ display: "none" });

    $("#c-panel04").css({ display: "block" });

    $("#c-panel05").css({ display: "none" });

    $("#c-profile").css({ display: "block" });

    $("#c-security").css({ display: "none" });

    $("#btnProfilePR01").addClass("active");

    $("#btnSecurityPR01").removeClass("active");

    $("#btnIdentityVerifyPR01").removeClass("active");

    infoAccount();

    $(".img-account-profile").attr("src", $(".profile-avatar img").attr("src"));

    $("#i-uploadImagePerfil").val("");
  });

  $(document).on("click", "#btnCountryCompanyCPR", function () {
    window.scrollTo(0, 0);

    resetNavLinks("#btnEditProfilePr01");

    $("#c-panel01").css({ display: "none" });

    $("#c-panel02").css({ display: "none" });

    $("#c-panel03").css({ display: "none" });

    $("#c-panel04").css({ display: "block" });

    $("#c-panel05").css({ display: "none" });

    $("#c-profile").css({ display: "block" });

    $("#c-security").css({ display: "none" });

    $("#btnProfilePR01").addClass("active");

    $("#btnSecurityPR01").removeClass("active");

    $("#btnIdentityVerifyPR01").removeClass("active");

    infoAccount();

    $(".img-account-profile").attr("src", $(".profile-avatar img").attr("src"));

    $("#i-uploadImagePerfil").val("");
  });

  $(document).on("click", "#btnCompanyStateCPR", function () {
    window.scrollTo(0, 0);

    resetNavLinks("#btnEditProfilePr01");

    $("#c-panel01").css({ display: "none" });

    $("#c-panel02").css({ display: "none" });

    $("#c-panel03").css({ display: "none" });

    $("#c-panel04").css({ display: "block" });

    $("#c-panel05").css({ display: "none" });

    $("#c-profile").css({ display: "block" });

    $("#c-security").css({ display: "none" });

    $("#btnProfilePR01").addClass("active");

    $("#btnSecurityPR01").removeClass("active");

    $("#btnIdentityVerifyPR01").removeClass("active");

    infoAccount();

    $(".img-account-profile").attr("src", $(".profile-avatar img").attr("src"));

    $("#i-uploadImagePerfil").val("");
  });

  $(document).on("click", "#btnZipcodeCompanyCPR", function () {
    window.scrollTo(0, 0);

    resetNavLinks("#btnEditProfilePr01");

    $("#c-panel01").css({ display: "none" });

    $("#c-panel02").css({ display: "none" });

    $("#c-panel03").css({ display: "none" });

    $("#c-panel04").css({ display: "block" });

    $("#c-panel05").css({ display: "none" });

    $("#c-profile").css({ display: "block" });

    $("#c-security").css({ display: "none" });

    $("#btnProfilePR01").addClass("active");

    $("#btnSecurityPR01").removeClass("active");

    $("#btnIdentityVerifyPR01").removeClass("active");

    infoAccount();

    $(".img-account-profile").attr("src", $(".profile-avatar img").attr("src"));

    $("#i-uploadImagePerfil").val("");
  });

  $(document).on("click", "#btnPhoneCompanyCPR", function () {
    window.scrollTo(0, 0);

    resetNavLinks("#btnEditProfilePr01");

    $("#c-panel01").css({ display: "none" });

    $("#c-panel02").css({ display: "none" });

    $("#c-panel03").css({ display: "none" });

    $("#c-panel04").css({ display: "block" });

    $("#c-panel05").css({ display: "none" });

    $("#c-profile").css({ display: "block" });

    $("#c-security").css({ display: "none" });

    $("#btnProfilePR01").addClass("active");

    $("#btnSecurityPR01").removeClass("active");

    $("#btnIdentityVerifyPR01").removeClass("active");

    infoAccount();

    $(".img-account-profile").attr("src", $(".profile-avatar img").attr("src"));

    $("#i-uploadImagePerfil").val("");
  });

  $(document).on("click", "#btnWebsiteCompanyCPR", function () {
    window.scrollTo(0, 0);

    resetNavLinks("#btnEditProfilePr01");

    $("#c-panel01").css({ display: "none" });

    $("#c-panel02").css({ display: "none" });

    $("#c-panel03").css({ display: "none" });

    $("#c-panel04").css({ display: "block" });

    $("#c-panel05").css({ display: "none" });

    $("#c-profile").css({ display: "block" });

    $("#c-security").css({ display: "none" });

    $("#btnProfilePR01").addClass("active");

    $("#btnSecurityPR01").removeClass("active");

    $("#btnIdentityVerifyPR01").removeClass("active");

    infoAccount();

    $(".img-account-profile").attr("src", $(".profile-avatar img").attr("src"));

    $("#i-uploadImagePerfil").val("");
  });

  $(document).on("click", "#btnProfileImageCPR", function () {
    window.scrollTo(0, 0);

    resetNavLinks("#btnEditProfilePr01");

    $("#c-panel01").css({ display: "none" });

    $("#c-panel02").css({ display: "none" });

    $("#c-panel03").css({ display: "none" });

    $("#c-panel04").css({ display: "block" });

    $("#c-panel05").css({ display: "none" });

    $("#c-profile").css({ display: "block" });

    $("#c-security").css({ display: "none" });

    $("#btnProfilePR01").addClass("active");

    $("#btnSecurityPR01").removeClass("active");

    $("#btnIdentityVerifyPR01").removeClass("active");

    infoAccount();

    $(".img-account-profile").attr("src", $(".profile-avatar img").attr("src"));

    $("#i-uploadImagePerfil").val("");
  });

  $(document).on("click", "#btnSearches", function () {
    $("#c-searches").css({ display: "block" });

    $("#c-access").css({ display: "none" });

    $("#c-updates").css({ display: "none" });

    $("#c-deletes").css({ display: "none" });

    $("#c-notifications").css({ display: "none" });

    $(this).addClass("active");

    $("#btnAccess").removeClass("active");

    $("#btnUpdates").removeClass("active");

    $("#btnDeletes").removeClass("active");

    $("#btnNotifications").removeClass("active");

    tblSearches();
  });

  $(document).on("click", "#btnAccess", function () {
    $("#c-searches").css({ display: "none" });

    $("#c-access").css({ display: "block" });

    $("#c-updates").css({ display: "none" });

    $("#c-deletes").css({ display: "none" });

    $("#c-btnNotifications").css({ display: "none" });

    $(this).addClass("active");

    $("#btnSearches").removeClass("active");

    $("#btnUpdates").removeClass("active");

    $("#btnDeletes").removeClass("active");

    $("#btnNotifications").removeClass("active");

    tblAccess();
  });

  $(document).on("click", "#btnUpdates", function () {
    $("#c-searches").css({ display: "none" });

    $("#c-access").css({ display: "none" });

    $("#c-updates").css({ display: "block" });

    $("#c-deletes").css({ display: "none" });

    $("#c-btnNotifications").css({ display: "none" });

    $(this).addClass("active");

    $("#btnSearches").removeClass("active");

    $("#btnAccess").removeClass("active");

    $("#btnDeletes").removeClass("active");

    $("#btnNotifications").removeClass("active");

    tblUpdates();
  });

  $(document).on("click", "#btnDeletes", function () {
    $("#c-searches").css({ display: "none" });

    $("#c-access").css({ display: "none" });

    $("#c-updates").css({ display: "none" });

    $("#c-deletes").css({ display: "block" });

    $("#c-btnNotifications").css({ display: "none" });

    $(this).addClass("active");

    $("#btnSearches").removeClass("active");

    $("#btnAccess").removeClass("active");

    $("#btnUpdates").removeClass("active");

    $("#btnNotifications").removeClass("active");

    tblDeletes();
  });

  $(document).on("click", "#btnCatalogs", function () {
    window.scrollTo(0, 0);
    $("#c-panel01").css({ display: "none" });
    $("#c-panel02").css({ display: "none" });
    $("#c-panel03").css({ display: "none" });
    $("#c-panel04").css({ display: "none" });
    $("#c-panel05").css({ display: "none" });
    $("#c-panel06").css({ display: "none" });
    $("#c-panel07").css({ display: "none" });
    $("#c-panel08").css({ display: "block" });
    resetNavLinks("#btnCatalogs");

    var myGet = getParameterByName("userToConsultPriceShipping");
    if (myGet) {
      window.location.href = domain + "/dashboard/#catalogs";
    } else {
      location.hash = "#catalogs";
    }
  });

  $(document).on("click", "#btnNotifications", function () {
    $("#c-searches").css({ display: "none" });

    $("#c-access").css({ display: "none" });

    $("#c-updates").css({ display: "none" });

    $("#c-deletes").css({ display: "none" });

    $("#c-btnNotifications").css({ display: "block" });

    $(this).addClass("active");

    $("#btnSearches").removeClass("active");

    $("#btnAccess").removeClass("active");

    $("#btnUpdates").removeClass("active");

    $("#btnDeletes").removeClass("active");
  });

  $(document).on("click", "#btnMail", function () {
    window.scrollTo(0, 0);
    $("#c-panel01").css({ display: "none" });
    $("#c-panel02").css({ display: "none" });
    $("#c-panel03").css({ display: "none" });
    $("#c-panel04").css({ display: "none" });
    $("#c-panel05").css({ display: "none" });
    $("#c-panel06").css({ display: "none" });
    $("#c-panel07").css({ display: "block" });
    $("#c-panel08").css({ display: "none" });
    $("#c-panel09").css({ display: "none" });
    $("#c-panel15").css({ display: "none" });
    $("#c-panel16").css({ display: "none" });
    $("#c-panel17").css({ display: "none" });
    resetNavLinks("#btnMail");

    var myGet = getParameterByName("userToConsultPriceShipping");
    if (myGet) {
      window.location.href = domain + "/dashboard/#inbox";
    } else {
      location.hash = "#inbox";
    }
  });

  $(document).on("click", "#btnSecurityPR01", function () {
    window.scrollTo(0, 0);

    $("#c-profile").css({ display: "none" });

    $("#c-security").css({ display: "block" });

    $("#c-identities").css({ display: "none" });

    $(this).addClass("active");

    $("#btnProfilePR01").removeClass("active");

    $("#btnIdentityVerifyPR01").removeClass("active");
  });

  $(document).on("click", "#btnProfilePR01", function () {
    window.scrollTo(0, 0);

    $("#c-profile").css({ display: "block" });

    $("#c-security").css({ display: "none" });

    $("#c-identities").css({ display: "none" });

    $(this).addClass("active");

    $("#btnSecurityPR01").removeClass("active");

    $("#btnIdentityVerifyPR01").removeClass("active");
  });

  $(document).on("click", "#btnIdentityVerifyPR01", function () {
    window.scrollTo(0, 0);

    $("#c-identities").css({ display: "block" });

    $("#c-security").css({ display: "none" });

    $("#c-profile").css({ display: "none" });

    $(this).addClass("active");

    $("#btnSecurityPR01").removeClass("active");

    $("#btnProfilePR01").removeClass("active");
  });

  $(document).on("click", "#btnHistorySupportPR01", function () {
    window.scrollTo(0, 0);

    $("#c-quoteSupportPR01").css({ display: "none" });

    $("#c-historySupportPR01").css({ display: "block" });

    $("#c-orderSupportPR01").css({ display: "none" });

    $("#c-rental-equipments").css({ display: "none" });

    $(this).addClass("active");

    $("#btnQuoteSupportPR01").removeClass("active");

    $("#btnOrderSupportPR01").removeClass("active");

    $("#btnRentalEquipments").removeClass("active");

    tblReportsTickets();
  });

  $(document).on("click", "#btnHistoryQuotePR01", function () {
    window.scrollTo(0, 0);

    $("#c-historyQuote").css({ display: "block" });

    $("#c-settingsQuote").css({ display: "none" });

    $(this).addClass("active");

    $("#btnSettingQuotePR01").removeClass("active");
  });

  $(document).on("click", "#btnQuoteSupportPR01", function () {
    window.scrollTo(0, 0);

    $("#c-quoteSupportPR01").css({ display: "block" });

    $("#c-historySupportPR01").css({ display: "none" });

    $("#c-rental-equipments").css({ display: "none" });

    $("#c-orderSupportPR01").css({ display: "none" });

    $(this).addClass("active");

    $("#btnHistorySupportPR01").removeClass("active");

    $("#btnOrderSupportPR01").removeClass("active");

    $("#btnRentalEquipments").removeClass("active");
  });

  $(document).on("click", "#btnSettingQuotePR01", function () {
    window.scrollTo(0, 0);

    $("#c-historyQuote").css({ display: "none" });

    $("#c-settingsQuote").css({ display: "block" });

    $(this).addClass("active");

    $("#btnHistoryQuotePR01").removeClass("active");
  });

  $(document).on("click", "#btnOrderSupportPR01", function () {
    window.scrollTo(0, 0);

    $("#c-quoteSupportPR01").css({ display: "none" });

    $("#c-historySupportPR01").css({ display: "none" });

    $("#c-rental-equipments").css({ display: "none" });

    $("#c-orderSupportPR01").css({ display: "block" });

    $(this).addClass("active");

    $("#btnHistorySupportPR01").removeClass("active");

    $("#btnQuoteSupportPR01").removeClass("active");

    $("#btnRentalEquipments").removeClass("active");
  });

  $(document).on("click", "#btnRentalEquipments", function () {
    window.scrollTo(0, 0);

    $("#c-quoteSupportPR01").css({ display: "none" });

    $("#c-historySupportPR01").css({ display: "none" });

    $("#c-rental-equipments").css({ display: "block" });

    $("#c-orderSupportPR01").css({ display: "none" });

    $(this).addClass("active");

    $("#btnHistorySupportPR01").removeClass("active");

    $("#btnQuoteSupportPR01").removeClass("active");

    $("#btnOrderSupportPR01").removeClass("active");
  });

  $(document).on("click", ".menu_acordion li:has(ul)", function () {
    if ($(this).hasClass("activado")) {
      $(".menu_acordion .activado .fa-chevron-down").css({ display: "block" });

      $(".menu_acordion .activado .fa-chevron-up").css({ display: "none" });

      $(this).removeClass("activado");

      $(this).children("a").removeClass("select");

      $(this).children("ul").addClass("select");

      $(this).children("ul").slideUp();

      $(this)
        .children("a")
        .children(".fa-chevron-down")
        .css({ display: "block" });

      $(this).children("a").children(".fa-chevron-up").css({ display: "none" });
    } else {
      $(".menu_acordion .activado .fa-chevron-down").css({ display: "block" });

      $(".menu_acordion .activado .fa-chevron-up").css({ display: "none" });

      $(".menu_acordion li ul").slideUp();

      $(".menu_acordion li").removeClass("activado");

      $(".menu_acordion a").removeClass("select");

      $(this).addClass("activado");

      $(this).children("a").addClass("select");

      $(this).children("ul").addClass("select");

      $(this).children("ul").slideDown();

      $(this)
        .children("a")
        .children(".fa-chevron-down")
        .css({ display: "none" });

      $(this)
        .children("a")
        .children(".fa-chevron-up")
        .css({ display: "block" });
    }
  });

  $(".btnHoverMenu").hover(
    function () {
      $(this).css({ "background-color": "#fff" });

      $(this).children("h2").children("button").css({ color: "#212380" });

      $(this).children("h2").children("button").css({ "font-weight": "bold" });
    },
    function () {
      $(this).css({ background: "none" });

      $(this).children("h2").children("button").css({ color: "#fff" });

      $(this).children("h2").children("button").css({ "font-weight": "500" });
    }
  );

  function searchDataUserDashboard(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/searchUserLoguer.php",

      type: "POST",

      data: { consulta },
    })

      .done(function (respuesta) {
        console.log(respuesta);

        let data = JSON.parse(respuesta);

        if (data.emailAcc === null) {
          $(location).attr("href", domain + "/login/");
        } else {
          $("#dropdown-perfil").text("Welcome, " + data.name);

          $("#h-emailUsers").val(data.emailAcc);
        }
      })

      .fail(function () {
        console.log("error");
      });
  }

  function dataForDonutsChartjsAccount(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/infoAccount.php",

      type: "POST",

      data: { consulta },
    })

      .done(function (respuesta) {
        let data = JSON.parse(respuesta);

        let complete = 0;

        let total = 100;

        if (data.imgPerfil != "") {
          complete = parseInt(complete) + parseInt(5);
        }

        if (data.name != "") {
          complete = parseInt(complete) + parseInt(5);
        }

        if (data.lastname != "") {
          complete = parseInt(complete) + parseInt(5);
        }

        if (data.countryAcc != "") {
          complete = parseInt(complete) + parseInt(5);
        }

        if (data.locationAcc != "") {
          complete = parseInt(complete) + parseInt(5);
        }

        if (data.addressAcc != "") {
          complete = parseInt(complete) + parseInt(5);
        }

        if (data.zipcodeAcc != "") {
          complete = parseInt(complete) + parseInt(5);
        }

        if (data.phoneAcc != "") {
          complete = parseInt(complete) + parseInt(5);
        }

        if (data.newBirthdayAcc != "") {
          if (data.newBirthdayAcc != "0000-00-00") {
            complete = parseInt(complete) + parseInt(5);
          }
        }

        if (data.idDocument != "") {
          complete = parseInt(complete) + parseInt(5);
        }

        if (data.imgDocument != "") {
          complete = parseInt(complete) + parseInt(5);
        }

        if (data.nameCompany != "") {
          complete = parseInt(complete) + parseInt(5);
        }

        if (data.roleCompany != "") {
          complete = parseInt(complete) + parseInt(5);
        }

        if (data.addressCompany != null) {
          if (data.addressCompany != "") {
            complete = parseInt(complete) + parseInt(5);
          }
        }

        if (data.stateCompany != null) {
          if (data.stateCompany != "") {
            complete = parseInt(complete) + parseInt(5);
          }
        }

        if (data.countryCompany != null) {
          if (data.countryCompany != "") {
            complete = parseInt(complete) + parseInt(5);
          }
        }

        if (data.phoneCompany != null) {
          if (data.phoneCompany != "") {
            complete = parseInt(complete) + parseInt(4);
          }
        }

        if (data.zipcodeCompany != null) {
          if (data.zipcodeCompany != 0) {
            if (data.zipcodeCompany != "") {
              complete = parseInt(complete) + parseInt(4);
            }
          }
        }

        if (data.websiteCompany != null) {
          if (data.websiteCompany != "") {
            complete = parseInt(complete) + parseInt(4);
          }
        }

        if (data.rifCompany != "") {
          complete = parseInt(complete) + parseInt(4);
        }

        if (data.imgRifCompany != "") {
          complete = parseInt(complete) + parseInt(4);
        }

        subtotal = parseInt(total) - parseInt(complete);

        if (complete == 100) {
          $(".containerD01").css({ display: "none" });

          $("#containerD04").css({ display: "block" });
        }

        var ctx = document.getElementById("myChart");

        var myChart = new Chart(ctx, {
          type: "doughnut",

          data: {
            labels: ["Complete", "Pending"],

            datasets: [
              {
                label: "Percentage",

                data: [complete, subtotal],

                backgroundColor: ["rgb(33, 35, 128)", "rgb(199, 199, 199)"],

                hoverOffset: 4,
              },
            ],
          },
        });
      })

      .fail(function () {
        console.log("error");
      });
  }

  $(document).on("click", "#btnUploadImagePerfil", function () {
    $("#i-uploadImagePerfil").click();
  });

  $(document).on("change", "#i-uploadImagePerfil", function () {
    let file = $(this)[0].files[0];

    objectUrl = URL.createObjectURL(file);

    $(".img-account-profile").attr("src", objectUrl);
  });

  function searchCountry(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/searchCountry.php",

      type: "POST",

      data: { consulta },
    })

      .done(function (respuesta) {
        $("#countryUserProfile").html(respuesta);

        $("#inputCountryOrg").html(respuesta);

        $("#inputDestination").html(respuesta);
      })

      .fail(function () {
        console.log("error");
      });
  }

  function infoAccount(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/infoAccount.php",

      type: "POST",

      data: { consulta },
    })

      .done(function (respuesta) {
        let data = JSON.parse(respuesta);

        $("#inputFirstName").val(data.name);

        $("#inputLastName").val(data.lastname);

        $("#countryUserProfile").val(data.countryAcc);

        $("#inputLocationProfile").val(data.locationAcc);

        $("#inputAddressProfile").val(data.addressAcc);

        $("#inputZipcodeProfile").val(data.zipcodeAcc);

        $("#inputPhone").val(data.phoneAcc);

        $("#inputBirthday").val(data.newBirthdayAcc);

        $("#inputOrgName").val(data.nameCompany);

        if (data.roleCompany.length === 0) {
          $("#jobRoleOrg").val(0);
        } else {
          $("#jobRoleOrg").val(data.roleCompany);
        }

        $("#inputAddressOrg").val(data.addressCompany);

        $("#inputStateOrg").val(data.stateCompany);

        $("#inputCountryOrg").val(data.countryCompany);

        $("#inputPhoneOrg").val(data.phoneCompany);

        if (data.zipcodeCompany == 0) {
          $("#inputZipcodeOrg").val("");
        } else {
          $("#inputZipcodeOrg").val(data.zipcodeCompany);
        }

        $("#inputUrlWebSiteOrg").val(data.websiteCompany);
      })

      .fail(function () {
        console.log("error");
      });
  }

  $(document).on("click", "#savedInfoIDCard", function () {
    let image = $("#i-uploadImageIDCard").val();

    let imageIDCard = $("#i-uploadImageIDCard")[0].files[0];

    let numberIDCard = $("#inputIDCard").val();

    if (numberIDCard === "") {
      $("#inputIDCard").focus();

      iziToast.info({
        title: "Info",

        message: alertsTranslations.enterIdNumber,

        position: "topRight",
      });
    } else {
      if (image == "") {
        $("#i-uploadImageIDCard").focus();

        iziToast.info({
          title: "Success",

          message: alertsTranslations.uploadIdentityImage,

          position: "topRight",
        });
      } else {
        savedUpdateIdentity(imageIDCard, numberIDCard);
      }
    }
  });

  function savedUpdateIdentity(imageIDCard, numberIDCard) {
    var formData = new FormData();

    formData.append("imageIDCard", imageIDCard);

    formData.append("numberIDCard", numberIDCard);

    $.ajax({
      contentType: "multipart/form-data",

      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/updateInfoID.php",

      type: "POST",

      data: formData,

      dataType: "text",

      processData: false,

      contentType: false,

      cache: false,
    })

      .done(function (respuesta) {
        let data = JSON.parse(respuesta);

        if (data.update === "correcto") {
          iziToast.success({
            title: "Success",

            message: alertsTranslations.dataSuccessfullySaved,

            position: "topRight",
          });

          location.reload();
        }
      })

      .fail(function () {
        console.log("error");
      });
  }

  $(document).on("click", "#savedInfoTaxCompany", function () {
    let image = $("#i-uploadImageTaxDocument").val();

    let imageTaxDocument = $("#i-uploadImageTaxDocument")[0].files[0];

    let numberTaxCompany = $("#i-rifCompany").val();

    if (numberTaxCompany === "") {
      $("#inputIDCard").focus();

      iziToast.info({
        title: "Info",

        message: alertsTranslations.enterIdNumber,

        position: "topRight",
      });
    } else {
      if (image == "") {
        $("#i-uploadImageIDCard").focus();

        iziToast.info({
          title: "Success",

          message: alertsTranslations.uploadIdentityImage,

          position: "topRight",
        });
      } else {
        savedUpdateTaxDocument(imageTaxDocument, numberTaxCompany);
      }
    }
  });

  function savedUpdateTaxDocument(imageTaxDocument, numberTaxCompany) {
    var formData = new FormData();

    formData.append("imageTaxDocument", imageTaxDocument);

    formData.append("numberTaxCompany", numberTaxCompany);

    $.ajax({
      contentType: "multipart/form-data",

      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/updateInfoTaxCompany.php",

      type: "POST",

      data: formData,

      dataType: "text",

      processData: false,

      contentType: false,

      cache: false,
    })

      .done(function (respuesta) {
        let data = JSON.parse(respuesta);

        if (data.update === "correcto") {
          iziToast.success({
            title: "Success",

            message: alertsTranslations.dataSuccessfullySaved,

            position: "topRight",
          });

          location.reload();
        }
      })

      .fail(function () {
        console.log("error");
      });
  }

  function savedUpdateInfoAcc(
    imageProfile,
    name,
    lastname,
    countryAcc,
    locationAcc,
    addressAcc,
    zipcodeAcc,
    phoneAcc,
    birthdayAcc,
    nameCompany,
    roleCompany,
    addressCompany,
    stateCompany,
    countryCompany,
    phoneCompany,
    zipcodeCompany,
    websiteCompany
  ) {
    var formData = new FormData();

    formData.append("imageProfile", imageProfile);

    formData.append("name", name);

    formData.append("lastname", lastname);

    formData.append("countryAcc", countryAcc);

    formData.append("locationAcc", locationAcc);

    formData.append("addressAcc", addressAcc);

    formData.append("zipcodeAcc", zipcodeAcc);

    formData.append("phoneAcc", phoneAcc);

    formData.append("birthdayAcc", birthdayAcc);

    formData.append("nameCompany", nameCompany);

    formData.append("roleCompany", roleCompany);

    formData.append("addressCompany", addressCompany);

    formData.append("stateCompany", stateCompany);

    formData.append("countryCompany", countryCompany);

    formData.append("phoneCompany", phoneCompany);

    formData.append("zipcodeCompany", zipcodeCompany);

    formData.append("websiteCompany", websiteCompany);

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

      .done(function (respuesta) {
        let data = JSON.parse(respuesta);

        if (data.update === "correcto") {
          iziToast.success({
            title: "Success",
            message: alertsTranslations.dataSuccessfullySaved,
            position: "center",
          });

          location.reload();
        }
      })

      .fail(function () {
        console.log("error");
      });
  }

  $(document).on("click", "#savedUpdateInfo", function () {
    let imageProfile = $("#i-uploadImagePerfil")[0].files[0];

    let name = $("#inputFirstName").val();

    let lastname = $("#inputLastName").val();

    let country = $("#countryUserProfile").val();

    let location = $("#inputLocationProfile").val();

    let address = $("#inputAddressProfile").val();

    let zipcode = $("#inputZipcodeProfile").val();

    let phone = $("#inputPhone").val();

    let birthday = $("#inputBirthday").val();

    let nameOrg = $("#inputOrgName").val();

    let roleOrg = $("#jobRoleOrg").val();

    let addressOrg = $("#inputAddressOrg").val();

    let stateOrg = $("#inputStateOrg").val();

    let countryOrg = $("#inputCountryOrg").val();

    let phoneOrg = $("#inputPhoneOrg").val();

    let zipcodeOrg = $("#inputZipcodeOrg").val();

    let websiteOrg = $("#inputUrlWebSiteOrg").val();

    if (nameOrg === "") {
      $("#inputOrgName").focus();
    } else {
      savedUpdateInfoAcc(
        imageProfile,
        name,
        lastname,
        country,
        location,
        address,
        zipcode,
        phone,
        birthday,
        nameOrg,
        roleOrg,
        addressOrg,
        stateOrg,
        countryOrg,
        phoneOrg,
        zipcodeOrg,
        websiteOrg
      );
    }
  });

  function savedNewPassword(currentPassword, confirmPassword) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/savedNewPassword.php",

      type: "POST",

      data: { currentPassword, confirmPassword },
    })

      .done(function (respuesta) {
        let data = JSON.parse(respuesta);

        if (data.update === "nocoinciden") {
          alert("Current password is not correct!");
        } else {
          if (data.update === "correcto") {
            iziToast.success({
              title: "Success",
              message: alertsTranslations.passwordSuccessfullyChanged,
              position: "topRight",
            });

            location = window.location;
          }
        }
      })

      .fail(function () {
        console.log("error");
      });
  }

  $(document).on("click", "#btnSavedNewPassword", function () {
    let currentPassword = $("#currentPassword").val();

    let newPassword = $("#newPassword").val();

    let confirmPassword = $("#confirmPassword").val();

    if (currentPassword === "") {
      $("#currentPassword").focus();
    } else {
      if (newPassword === "") {
        $("#newPassword").focus();
      } else {
        if (confirmPassword === "") {
          $("#confirmPassword").focus();
        } else {
          if (confirmPassword != newPassword) {
            alert("Passwords do not match.");
          } else {
            savedNewPassword(currentPassword, confirmPassword);
          }
        }
      }
    }
  });

  function deleteAccount(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/deleteAccount.php",

      type: "POST",

      data: { consulta },
    })

      .done(function (respuesta) {
        let data = JSON.parse(respuesta);
      })

      .fail(function () {
        console.log("error");
      });
  }

  /*$(document).on('click', '#btnDeleteAccount', function(){

        $.jAlert({

            type: 'confirm',

            confirmQuestion: 'Are you sure you want to delete your account?',

            onConfirm: function(e, btn){

            e.preventDefault();

            //do something here

            deleteAccount()

            location = window.location

            btn.parents('.jAlert').closeAlert();

            return false;

            },

            onDeny: function(e, btn){

            e.preventDefault();

            //do something here

            btn.parents('.jAlert').closeAlert();

            return false;

            }

        })        

    })*/

  $(document).on("click", "#btnDeleteAccount", function () {
    iziToast.question({
      drag: false,
      overlay: true,
      displayMode: "once",
      zindex: 999,
      title: "Confirmation",
      message: alertsTranslations.deleteReportConfirmation,
      position: "center",
      buttons: [
        [
          "<button><b>Yes</b></button>",
          function (instance, toast) {
            instance.hide({ transitionOut: "fadeOut" }, toast, "button");
            deleteAccount();
            location = window.location;
          },
          true,
        ],

        [
          "<button>No</button>",
          function (instance, toast) {
            instance.hide({ transitionOut: "fadeOut" }, toast, "button");
          },
        ],
      ],
    });
  });

  function savedConfigQuote(
    warehouse,
    currency,
    paymentM,
    shippingM,
    destination,
    zipcode
  ) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/infoConfigQuote.php",

      type: "POST",

      data: { warehouse, currency, paymentM, shippingM, destination, zipcode },
    })

      .done(function (respuesta) {
        let data = JSON.parse(respuesta);

        if (data.update === "correcto") {
          iziToast.success({
            title: "Success",
            message: alertsTranslations.dataSuccessfullySaved,
            position: "topRight",
          });

          location = window.location;
        }
      })

      .fail(function () {
        console.log("error");
      });
  }

  $(document).on("change", "#inputWarehouse", function () {
    if ($(this).val() === "EXW Kalstein Paris") {
      searchCountrySettingsEU();
      $("#inputShippingM").css({ display: "none" });
      $("#inputShippingMFR").css({ display: "block" });
      $("#inputDestination").css({ display: "none" });
      $("#inputDestinationEU").css({ display: "block" });
    } else {
      if ($(this).val() === "EXW Kalstein Shanghai") {
        $("#inputShippingM").css({ display: "block" });
        $("#inputShippingMFR").css({ display: "none" });
        $("#inputDestination").css({ display: "block" });
        $("#inputDestinationEU").css({ display: "none" });
      }
    }
  });

  $(document).on("click", "#savedInfoToQuotes", function () {
    let warehouse = $("#inputWarehouse").val();

    let currency = $("#inputCurrency").val();

    let paymentM = $("#inputPaymentM").val();

    let shippingM = $("#inputShippingM").val();

    let destination = $("#inputDestination").val();

    let zipcode = $("#inputZipcode").val();

    if (warehouse != 0) {
      savedConfigQuote(
        warehouse,
        currency,
        paymentM,
        shippingM,
        destination,
        zipcode
      );
    } else {
      $.jAlert({
        type: "Info",

        title: "Info",

        content:
          "You must provide at least one field of information such as the warehouse of your choice.",

        theme: "gray",
      });
    }
  });

  function searchInfoToQUote(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/searchInfoConfigQuote.php",

      type: "POST",

      data: { consulta },
    })

      .done(function (respuesta) {
        let data = JSON.parse(respuesta);

        $("#inputWarehouse").val(data.warehouse);

        $("#inputCurrency").val(data.currency);

        $("#inputPaymentM").val(data.paymentM);

        $("#inputShippingM").val(data.shippingM);

        searchCountrySettings(data.shippingM, data.destination);

        $("#inputZipcode").val(data.zipcode);

        if (
          data.warehouse == 0 ||
          data.currency == 0 ||
          data.paymentM == 0 ||
          data.shippingM == 0 ||
          data.destination == 0 ||
          data.zipcode == 0
        ) {
          if (
            data.warehouse == "" ||
            data.currency == "" ||
            data.paymentM == "" ||
            data.shippingM == "" ||
            data.destination == "" ||
            data.zipcode != ""
          ) {
            $(".containerD02").removeAttr("hidden");
          }
        }
      })

      .fail(function () {
        console.log("error");
      });
  }

  $(document).on("click", "#btnToConfigQuote", function () {
    searchInfoToQUote();

    $("#btnQuotePr01").click();

    $("#under01").addClass("underline");

    $("#under02").removeClass("underline");

    $("#c-historyQuote").css({ display: "none" });

    $("#c-settingsQuote").css({ display: "block" });

    $("#btnHistoryQuotePR01").removeClass("active");

    $("#btnSettingQuotePR01").addClass("active");
  });

  function dataForLineChartjsQuote(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/infoGraphicQuote.php",

      type: "POST",

      data: { consulta },
    })

      .done(function (respuesta) {
        let datos = JSON.parse(respuesta);

        var ctx2 = document.getElementById("lineChartQuote");

        var ctx3 = document.getElementById("widgetQuotes");

        const fecha = new Date();

        const mesActual = fecha.getMonth();

        var january = 0;

        var february = 0;

        var march = 0;

        var april = 0;

        var may = 0;

        var june = 0;

        var july = 0;

        var august = 0;

        var september = 0;

        var october = 0;

        var november = 0;

        var december = 0;

        $.each(datos, function (i, element) {
          if (element.date == 01) {
            january = parseInt(january) + parseInt(1);
          } else {
            if (element.date == 02) {
              february = parseInt(february) + parseInt(1);
            } else {
              if (element.date == 03) {
                march = parseInt(march) + parseInt(1);
              } else {
                if (element.date == 04) {
                  april = parseInt(april) + parseInt(1);
                } else {
                  if (element.date == 05) {
                    may = parseInt(may) + parseInt(1);
                  } else {
                    if (element.date == 06) {
                      june = parseInt(june) + parseInt(1);
                    } else {
                      if (element.date == 07) {
                        july = parseInt(july) + parseInt(1);
                      } else {
                        if (element.date == 08) {
                          august = parseInt(august) + parseInt(1);
                        } else {
                          if (element.date == 09) {
                            september = parseInt(september) + parseInt(1);
                          } else {
                            if (element.date == 10) {
                              october = parseInt(october) + parseInt(1);
                            } else {
                              if (element.date == 11) {
                                november = parseInt(november) + parseInt(1);
                              } else {
                                if (element.date == 12) {
                                  december = parseInt(december) + parseInt(1);
                                }
                              }
                            }
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        });

        let months = [];

        var dataQuote = "";

        if (mesActual == 0) {
          months = [
            "August",

            "September",

            "October",

            "November",

            "December",

            "January",
          ];

          dataQuote = [august, september, october, november, december, january];
        } else {
          if (mesActual == 1) {
            months = [
              "September",

              "October",

              "November",

              "December",

              "January",

              "February",
            ];

            dataQuote = [
              september,

              october,

              november,

              december,

              january,

              february,
            ];
          } else {
            if (mesActual == 2) {
              months = [
                "October",

                "November",

                "December",

                "January",

                "February",

                "March",
              ];

              dataQuote = [
                october,

                november,

                december,

                january,

                february,

                march,
              ];
            } else {
              if (mesActual == 3) {
                months = [
                  "November",

                  "December",

                  "January",

                  "February",

                  "March",

                  "April",
                ];

                dataQuote = [
                  november,

                  december,

                  january,

                  february,

                  march,

                  april,
                ];
              } else {
                if (mesActual == 4) {
                  months = [
                    "December",

                    "January",

                    "February",

                    "March",

                    "April",

                    "May",
                  ];

                  dataQuote = [december, january, february, march, april, may];
                } else {
                  if (mesActual == 5) {
                    months = [
                      "January",

                      "February",

                      "March",

                      "April",

                      "May",

                      "June",
                    ];

                    dataQuote = [january, february, march, april, may, june];
                  } else {
                    if (mesActual == 6) {
                      months = [
                        "February",

                        "March",

                        "April",

                        "May",

                        "June",

                        "July",
                      ];

                      dataQuote = [february, march, april, may, june, july];
                    } else {
                      if (mesActual == 7) {
                        months = [
                          "March",

                          "April",

                          "May",

                          "June",

                          "July",

                          "August",
                        ];

                        dataQuote = [march, april, may, june, july, august];
                      } else {
                        if (mesActual == 8) {
                          months = [
                            "April",

                            "May",

                            "June",

                            "July",

                            "August",

                            "September",
                          ];

                          dataQuote = [
                            april,

                            may,

                            june,

                            july,

                            august,

                            september,
                          ];
                        } else {
                          if (mesActual == 9) {
                            months = [
                              "May",

                              "June",

                              "July",

                              "August",

                              "September",

                              "October",
                            ];

                            dataQuote = [
                              may,

                              june,

                              july,

                              august,

                              september,

                              october,
                            ];
                          } else {
                            if (mesActual == 10) {
                              months = [
                                "June",

                                "July",

                                "August",

                                "September",

                                "October",

                                "November",
                              ];

                              dataQuote = [
                                june,

                                july,

                                august,

                                september,

                                october,

                                november,
                              ];
                            } else {
                              if (mesActual == 11) {
                                months = [
                                  "July",

                                  "August",

                                  "September",

                                  "October",

                                  "November",

                                  "December",
                                ];

                                dataQuote = [
                                  july,

                                  august,

                                  september,

                                  october,

                                  november,

                                  december,
                                ];
                              }
                            }
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }

        var myChart2 = new Chart(ctx2, {
          type: "line",

          data: {
            labels: months,

            datasets: [
              {
                label: "Generated quotes",

                data: dataQuote,

                fill: false,

                borderColor: "rgb(75, 192, 192)",

                tension: 0.1,
              },
            ],
          },
        });

        var myChart3 = new Chart(ctx3, {
          type: "line",

          data: {
            labels: months,

            datasets: [
              {
                label: "Generated quotes",

                data: dataQuote,

                fill: false,

                borderColor: "rgb(75, 192, 192)",

                tension: 0.1,
              },
            ],
          },
        });
      })

      .fail(function () {
        console.log("error");
      });
  }

  function dataForLineChartjsSales(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/infoGraphicQuote.php",

      type: "POST",

      data: { consulta },
    })

      .done(function (respuesta) {
        let datos = JSON.parse(respuesta);

        var ctx2 = document.getElementById("lineChartSales");

        const fecha = new Date();

        const mesActual = fecha.getMonth();

        var january = 0;

        var february = 0;

        var march = 0;

        var april = 0;

        var may = 0;

        var june = 0;

        var july = 0;

        var august = 0;

        var september = 0;

        var october = 0;

        var november = 0;

        var december = 0;

        $.each(datos, function (i, element) {
          if (element.date == 01) {
            january = parseInt(january) + parseInt(1);
          } else {
            if (element.date == 02) {
              february = parseInt(february) + parseInt(1);
            } else {
              if (element.date == 03) {
                march = parseInt(march) + parseInt(1);
              } else {
                if (element.date == 04) {
                  april = parseInt(april) + parseInt(1);
                } else {
                  if (element.date == 05) {
                    may = parseInt(may) + parseInt(1);
                  } else {
                    if (element.date == 06) {
                      june = parseInt(june) + parseInt(1);
                    } else {
                      if (element.date == 07) {
                        july = parseInt(july) + parseInt(1);
                      } else {
                        if (element.date == 08) {
                          august = parseInt(august) + parseInt(1);
                        } else {
                          if (element.date == 09) {
                            september = parseInt(september) + parseInt(1);
                          } else {
                            if (element.date == 10) {
                              october = parseInt(october) + parseInt(1);
                            } else {
                              if (element.date == 11) {
                                november = parseInt(november) + parseInt(1);
                              } else {
                                if (element.date == 12) {
                                  december = parseInt(december) + parseInt(1);
                                }
                              }
                            }
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        });

        let months = [];

        var dataQuote = "";

        if (mesActual == 0) {
          months = [
            "August",

            "September",

            "October",

            "November",

            "December",

            "January",
          ];

          dataQuote = [august, september, october, november, december, january];
        } else {
          if (mesActual == 1) {
            months = [
              "September",

              "October",

              "November",

              "December",

              "January",

              "February",
            ];

            dataQuote = [
              september,

              october,

              november,

              december,

              january,

              february,
            ];
          } else {
            if (mesActual == 2) {
              months = [
                "October",

                "November",

                "December",

                "January",

                "February",

                "March",
              ];

              dataQuote = [
                october,

                november,

                december,

                january,

                february,

                march,
              ];
            } else {
              if (mesActual == 3) {
                months = [
                  "November",

                  "December",

                  "January",

                  "February",

                  "March",

                  "April",
                ];

                dataQuote = [
                  november,

                  december,

                  january,

                  february,

                  march,

                  april,
                ];
              } else {
                if (mesActual == 4) {
                  months = [
                    "December",

                    "January",

                    "February",

                    "March",

                    "April",

                    "May",
                  ];

                  dataQuote = [december, january, february, march, april, may];
                } else {
                  if (mesActual == 5) {
                    months = [
                      "January",

                      "February",

                      "March",

                      "April",

                      "May",

                      "June",
                    ];

                    dataQuote = [january, february, march, april, may, june];
                  } else {
                    if (mesActual == 6) {
                      months = [
                        "February",

                        "March",

                        "April",

                        "May",

                        "June",

                        "July",
                      ];

                      dataQuote = [february, march, april, may, june, july];
                    } else {
                      if (mesActual == 7) {
                        months = [
                          "March",

                          "April",

                          "May",

                          "June",

                          "July",

                          "August",
                        ];

                        dataQuote = [march, april, may, june, july, august];
                      } else {
                        if (mesActual == 8) {
                          months = [
                            "April",

                            "May",

                            "June",

                            "July",

                            "August",

                            "September",
                          ];

                          dataQuote = [
                            april,

                            may,

                            june,

                            july,

                            august,

                            september,
                          ];
                        } else {
                          if (mesActual == 9) {
                            months = [
                              "May",

                              "June",

                              "July",

                              "August",

                              "September",

                              "October",
                            ];

                            dataQuote = [
                              may,

                              june,

                              july,

                              august,

                              september,

                              october,
                            ];
                          } else {
                            if (mesActual == 10) {
                              months = [
                                "June",

                                "July",

                                "August",

                                "September",

                                "October",

                                "November",
                              ];

                              dataQuote = [
                                june,

                                july,

                                august,

                                september,

                                october,

                                november,
                              ];
                            } else {
                              if (mesActual == 11) {
                                months = [
                                  "July",

                                  "August",

                                  "September",

                                  "October",

                                  "November",

                                  "December",
                                ];

                                dataQuote = [
                                  july,

                                  august,

                                  september,

                                  october,

                                  november,

                                  december,
                                ];
                              }
                            }
                          }
                        }
                      }
                    }
                  }
                }
              }
            }
          }
        }

        var myChart2 = new Chart(ctx2, {
          type: "line",

          data: {
            labels: months,

            datasets: [
              {
                label: "Generated quotes",

                data: dataQuote,

                fill: false,

                borderColor: "rgb(75, 192, 192)",

                tension: 0.1,
              },
            ],
          },
        });
      })

      .fail(function () {
        console.log("error");
      });
  }

  function dataForBarChartjsQuote(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/infoGraphicQuote.php",

      type: "POST",

      data: { consulta },
    })

      .done(function (respuesta) {
        let datos = JSON.parse(respuesta);

        var ctx2 = document.getElementById("barChartQuote2");

        var myChart2 = new Chart(ctx2, {
          type: "bar",

          data: {
            labels: ["January", "February", "March", "April", "May", "June"],

            datasets: [
              {
                label: "Generated quotes",

                data: [10, 23, 51, 21, 34, 6],

                fill: false,

                borderColor: "rgb(75, 192, 192)",

                tension: 0.1,
              },
            ],
          },
        });
      })

      .fail(function () {
        console.log("error");
      });
  }

  function searchRecentProductsQuoted(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/searchQuotedProducts.php",

      type: "POST",

      data: { consulta },
    })

      .done(function (respuesta) {
        $(".content-recentProduct").html(respuesta);
      })

      .fail(function () {
        console.log("error");
      });
  }

  function searchDataProductTbl(consulta, status, dateFrom, dateTo) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/searchQuoteTbl.php",

      type: "POST",

      data: { consulta, status, dateFrom, dateTo },
    })

      .done(function (respuesta) {
        $("#tblQuoteClient").html(respuesta);

        searchQuoteTblPagination(consulta, status, dateFrom, dateTo);
      })

      .fail(function () {
        console.log("error");
      });
  }

  function searchQuoteTblPagination(consulta, status, dateFrom, dateTo) {
    $(".pagination #form-next").submit(function (e) {
      e.preventDefault();

      var nextPage = $(this).find("input[name=u]").val();

      $.ajax({
        url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/searchQuoteTbl.php",

        type: "POST",

        data: { consulta, status, dateFrom, dateTo, u: nextPage },

        success: function (data) {
          var tableContent = $(data).find("#tblQuoteClientCuca").html();

          $("#tblQuoteClientCuca").html(tableContent);

          if (tableContent.trim() === "") {
            return;
          }

          var currentPage = nextPage;

          $("#currentPageIndicator").text("Page: " + currentPage);

          $(".pagination #form-next input[name=u]").val(
            parseInt(currentPage) + 1
          );

          let prev = parseInt(currentPage) > 1 ? parseInt(currentPage) - 1 : 1;

          $(".pagination #form-previous input[name=u]").val(prev);
        },

        error: function () {
          alert("Error charging quote data.");
        },
      });
    });

    $(".pagination #form-previous").submit(function (e) {
      e.preventDefault();

      var nextPage = $(this).find("input[name=u]").val();

      $.ajax({
        url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/searchQuoteTbl.php",

        type: "POST",

        data: { consulta, status, dateFrom, dateTo, u: nextPage },

        success: function (data) {
          var tableContent = $(data).find("#tblQuoteClientCuca").html();

          $("#tblQuoteClientCuca").html(tableContent);

          if (tableContent.trim() === "") {
            return;
          }

          var currentPage = nextPage;

          $("#currentPageIndicator").text("Page: " + currentPage);

          $(".pagination #form-next input[name=u]").val(
            parseInt(currentPage) + 1
          );

          let prev = parseInt(currentPage) > 1 ? parseInt(currentPage) - 1 : 1;

          $(".pagination #form-previous input[name=u]").val(prev);
        },

        error: function () {
          alert("Error charging quote data.");
        },
      });
    });
  }

  $(document).on("change", "#cmbStatus", function () {
    let status = $(this).val();

    let dateFrom = $("#dateFrom").val();

    let dateTo = $("#dateTO").val();

    let inputSearch = $("#inputSearchQuote").val();

    searchDataProductTbl(inputSearch, status, dateFrom, dateTo);
  });

  $(document).on("change", "#dateTO", function () {
    let dateTo = $(this).val();

    let dateFrom = $("#dateFrom").val();

    let status = $("#cmbStatus").val();

    let inputSearch = $("#inputSearchQuote").val();

    searchDataProductTbl(inputSearch, status, dateFrom, dateTo);
  });

  $(document).on("keyup", "#inputSearchQuote", function () {
    let inputSearch = $(this).val();

    let dateFrom = $("#dateFrom").val();

    let status = $("#cmbStatus").val();

    let dateTo = $("#dateTO").val();

    searchDataProductTbl(inputSearch, status, dateFrom, dateTo);
  });

  $(document).on("click", "#btnViewQuote", function () {
    let valor = $(this).val();

    window.open(
      "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/createPDF.php?idCotizacion=" +
        valor +
        "",
      "_blank"
    );
  });

  $(document).on("click", "#btnViewReport", function () {
    let valor = $(this).val();

    searchInfoReportSelect(valor);
  });

  /* $(document).on("click", "#btnChangeStatus", function () {
    let valor = $(this).text();

    const id = $(this).val();

    console.log(
      "valores:",
      valor,
      "id:",
      id,
      "translation:",
      alertsTranslations.pendiente
    );

    console.log('alerts', alertsTranslations.procesar, alertsTranslations.pendiente, alertsTranslations.cancelar);
    

    if (valor === alertsTranslations.pendiente) {
      console.log('valor = pendiente', valor, alertsTranslations.pendiente);
      // var options = "<option selected='' style='text-align: center;' value='0'>"+valor+`</option><option value="3">${alertsTranslations.procesar}</option><option value="2">${alertsTranslations.cancelar}</option>`;
      var options = `<option selected='' style='text-align: center;' value='0'>${valor}</option>${valor}<option value='1'>${alertsTranslations.procesar}</option><option value='2'>${alertsTranslations.cancelar}</option>`;
    } else {
      if (valor === alertsTranslations.procesar) {
        console.log('valor = procesar', valor, alertsTranslations.procesar);
        
        // var options = `</option><option value="3">${alertsTranslations.procesar}</option><option value="2">${alertsTranslations.cancelar}</option>`;
        var options = `<option selected='' style='text-align: center;' value='1'>${alertsTranslations.procesar}</option><option value='2'>${alertsTranslations.cancelar}</option>`;
      } else if (valor === alertsTranslations.cancelar) {
        console.log('valor = cancelar', valor, alertsTranslations.cancelar);
        var options = `</option><option value="2">${alertsTranslations.cancelar}</option><option value="0">${alertsTranslations.pendiente}</option>`;

        // var options = `<option selected='' style='text-align: center;' value='2'>${alertsTranslations.cancelar}</option><option value='0'>${alertsTranslations.pendiente}</option>`;
      }
    }

    if (valor === alertsTranslations.cancelado) {
    } else {
      if (valor === alertsTranslations.processed) {
      } else {
        $.jAlert({
          type: "confirm",
          confirmQuestion:
            "<h6>Change quote status</h6><select class='form-select' aria-label='Default select example' id='cmbChangeStatus' style='height: 3.2em; outline: 1px solid #213280; font-size: 0.9em;'>" +
            options +
            "</select>",
          confirmBtnText: "Accept",
          denyBtnText: "Cancel",
          onConfirm: function (e, btn) {
            e.preventDefault();
            let valor = $("#cmbChangeStatus").val();
            updateStatusQuote(valor, id);
            btn.parents(".jAlert").closeAlert();
            return false;
          },
          onDeny: function (e, btn) {
            e.preventDefault();
            btn.parents(".jAlert").closeAlert();
            return false;
          },
        });
      }
    }
  });
 */

  $(document).on("click", "#btnChangeStatus", function () {
    let valor = $(this).text();

    const id = $(this).val();

    if (valor === "Pendiente") {
      var options =
        "<option selected='' style='text-align: center;' value='0'>" +
        valor +
        "</option><option value='1'>Procesar</option>";
    } else {
      if (valor === "Cancelar") {
        var options =
          "<option selected='' style='text-align: center;' value='0'>" +
          valor +
          "</option><option value='1'>Procesar</option>";
      }
    }

    if (valor === "Procesado") {
    } else {
      $.jAlert({
        type: "confirm",
        confirmQuestion:
          "<h6>Cambiar estátus de cotización</h6><select class='form-select' aria-label='Default select example' id='cmbChangeStatus' style='height: 3.2em; outline: 1px solid #213280; font-size: 0.9em;'>" +
          options +
          "</select>",
        confirmBtnText: "Aceptar",
        denyBtnText: "Cancelar",
        onConfirm: function (e, btn) {
          e.preventDefault();
          let valor2 = $("#cmbChangeStatus").val();
          consultDataClientSaved(id);
          btn.parents(".jAlert").closeAlert();
          return false;
        },
        onDeny: function (e, btn) {
          e.preventDefault();
          btn.parents(".jAlert").closeAlert();
          return false;
        },
      });
    }
  });
  $(document).on("click", "#btnDeleteQuote", function () {
    let valor = $(this).val();

    $.jAlert({
      type: "confirm",

      confirmQuestion:
        "Are you sure you want to remove the " +
        valor +
        " quote from your account?",

      onConfirm: function (e, btn) {
        e.preventDefault();

        deleteQuoteClient(valor);

        $("#btnQuotePr01").click();

        btn.parents(".jAlert").closeAlert();

        return false;
      },

      onDeny: function (e, btn) {
        e.preventDefault();

        btn.parents(".jAlert").closeAlert();

        return false;
      },
    });
  });

  $(document).on("click", "#btnDeleteReport", function () {
    let valor = $(this).val();

    iziToast.question({
      title: "Confirmation",

      message: alertsTranslations.deleteReportConfirmation,

      position: "center",

      buttons: [
        [
          "<button><b>Yes</b></button>",
          function (instance, toast) {
            instance.hide({ transitionOut: "fadeOut" }, toast, "button");

            deleteReportClient(valor);
          },

          true,
        ],

        [
          "<button>No</button>",
          function (instance, toast) {
            instance.hide({ transitionOut: "fadeOut" }, toast, "button");
          },
        ],
      ],
    });
  });

  function deleteQuoteClient(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/deleteQuoteClient.php",

      type: "POST",

      data: { consulta },
    })

      .done(function (respuesta) {
        let data = JSON.parse(respuesta);

        if (data.delete === "correcto") {
          window.scrollTo(0, 0);

          showDataQuoteRecent();
        }
      })

      .fail(function () {
        console.log("error");
      });
  }

  function updateStatusQuote(consulta, consulta2) {
    console.log("cosnutlassss", consulta, consulta2);

    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/changeStatusQuote.php",

      type: "POST",

      data: { consulta, consulta2 },
    })

      .done(function (respuesta) {
        console.log(respuesta);
        let data = JSON.parse(respuesta);
        console.log("dataaaaa", data);

        if (data.update === "correcto") {
          searchDataProductTbl();
        }
      })

      .fail(function (error) {
        console.log("errorrrrr", error);
      });
  }

  function tblSearches(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/tblSearches.php",

      type: "POST",

      data: { consulta },
    })

      .done(function (respuesta) {
        $("#tblSearches").html(respuesta);

        tblSearchesPagination();
      })

      .fail(function () {
        console.log("error");
      });
  }

  function tblSearchesPagination() {
    function tableContent(nextPage) {
      $.ajax({
        url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/tblSearches.php",

        type: "GET",

        data: { o: nextPage },

        success: function (data) {
          var tableContent = $(data).find("#tblSearchPag").html();

          if (tableContent.trim() === "") {
            return;
          }

          var currentPage = nextPage;

          $("#currentPageIndicatorSearch").text("Page: " + currentPage);

          $("#tblSearchPag").html(tableContent);

          $(".pagination #form-next-search input[name=o]").val(
            parseInt(currentPage) + 1
          );

          let prev = parseInt(currentPage) > 1 ? parseInt(currentPage) - 1 : 1;

          $(".pagination #form-previous-search input[name=o]").val(prev);
        },

        error: function () {
          alert("Error charging quote data.");
        },
      });
    }

    $(".pagination #form-next-search").submit(function (e) {
      e.preventDefault();

      var nextPage = $(this).find("input[name=o]").val();

      console.log(nextPage);

      tableContent(nextPage);
    });

    $(".pagination #form-previous-search").submit(function (e) {
      e.preventDefault();

      var prevPage = $(this).find("input[name=o]").val();

      tableContent(prevPage);
    });
  }

  function tblAccess(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/tblAccess.php",

      type: "POST",

      data: { consulta },
    })

      .done(function (respuesta) {
        $("#tblAccess").html(respuesta);

        tblAccessPagination();
      })

      .fail(function () {
        console.log("error");
      });
  }

  function tblAccessPagination() {
    function tableContentAccess(nextPage) {
      $.ajax({
        url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/tblAccess.php",

        type: "GET",

        data: { e: nextPage },

        success: function (data) {
          var tableContent = $(data).find("#tblAccessPag").html();

          var currentPage = nextPage;

          $("#currentPageIndicatorAccess").text("Page: " + currentPage);

          $("#tblAccessPag").html(tableContent);

          if (tableContent.trim() === "") {
            return;
          }

          $(".pagination #form-next-access input[name=e]").val(
            parseInt(currentPage) + 1
          );

          let prev = parseInt(currentPage) > 1 ? parseInt(currentPage) - 1 : 1;

          $(".pagination #form-previous-access input[name=e]").val(prev);
        },

        error: function () {
          alert("Error charging quote data.");
        },
      });
    }

    $(".pagination #form-next-access").submit(function (e) {
      e.preventDefault();

      var nextPage = $(this).find("input[name=e]").val();

      console.log(nextPage);

      tableContentAccess(nextPage);
    });

    $(".pagination #form-previous-access").submit(function (e) {
      e.preventDefault();

      var prevPage = $(this).find("input[name=e]").val();

      tableContentAccess(prevPage);
    });
  }

  function tblUpdates(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/tblUpdates.php",

      type: "POST",

      data: { consulta },
    })

      .done(function (respuesta) {
        $("#tblUpdates").html(respuesta);

        tblUpdatesPagination();
      })

      .fail(function () {
        console.log("error");
      });
  }

  function tblUpdatesPagination() {
    function tableContentUpdates(nextPage) {
      $.ajax({
        url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/tblUpdates.php",

        type: "GET",

        data: { e: nextPage },

        success: function (data) {
          var tableContent = $(data).find("#tblUpdatesPag").html();

          if (tableContent.trim() === "") {
            return;
          }

          var currentPage = nextPage;

          $("#currentPageIndicatorUpdates").text("Page: " + currentPage);

          $("#tblUpdatesPag").html(tableContent);

          $(".pagination #form-next-updates input[name=e]").val(
            parseInt(currentPage) + 1
          );

          let prev = parseInt(currentPage) > 1 ? parseInt(currentPage) - 1 : 1;

          $(".pagination #form-previous-updates input[name=e]").val(prev);
        },

        error: function () {
          alert("Error charging quote data.");
        },
      });
    }

    $(".pagination #form-next-updates").submit(function (e) {
      e.preventDefault();

      var nextPage = $(this).find("input[name=e]").val();

      console.log(nextPage);

      tableContentUpdates(nextPage);
    });

    $(".pagination #form-previous-updates").submit(function (e) {
      e.preventDefault();

      var prevPage = $(this).find("input[name=e]").val();

      tableContentUpdates(prevPage);
    });
  }

  function tblDeletes(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/tblDeletes.php",

      type: "POST",

      data: { consulta },
    })

      .done(function (respuesta) {
        $("#tblDeletes").html(respuesta);

        tblDeletesPagination();
      })

      .fail(function () {
        console.log("error");
      });
  }

  function tblDeletesPagination() {
    function tableContentDeletes(nextPage) {
      $.ajax({
        url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/tblDeletes.php",

        type: "GET",

        data: { a: nextPage },

        success: function (data) {
          var tableContent = $(data).find("#tblDeletesPag").html();

          if (tableContent.trim() === "") {
            return;
          }

          var currentPage = nextPage;

          $("#currentPageIndicatorDeletes").text("Page: " + currentPage);

          $("#tblDeletesPag").html(tableContent);

          $(".pagination #form-next-deletes input[name=a]").val(
            parseInt(currentPage) + 1
          );

          let prev = parseInt(currentPage) > 1 ? parseInt(currentPage) - 1 : 1;

          $(".pagination #form-previous-deletes input[name=a]").val(prev);
        },

        error: function () {
          alert("Error charging quote data.");
        },
      });
    }

    $(".pagination #form-next-deletes").submit(function (e) {
      e.preventDefault();

      var nextPage = $(this).find("input[name=a]").val();

      console.log(nextPage);

      tableContentDeletes(nextPage);
    });

    $(".pagination #form-previous-deletes").submit(function (e) {
      e.preventDefault();

      var prevPage = $(this).find("input[name=a]").val();

      tableContentDeletes(prevPage);
    });
  }

  function showDataQuoteRecent(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/showDataQuoteRecent.php",

      type: "POST",

      data: { consulta },
    })

      .done(function (respuesta) {
        $("#c-recentQuotes").html(respuesta);
      })

      .fail(function () {
        console.log("error");
      });
  }

  function showDataSearchesRecent(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/showDataSearchRecent.php",

      type: "POST",

      data: { consulta },
    })

      .done(function (respuesta) {
        $("#c-recentSearch").html(respuesta);
      })

      .fail(function () {
        console.log("error");
      });
  }

  $(document).on("click", "#btnViewMoreRecentQuotes", function () {
    $("#btnQuotePr01").click();
  });

  $(document).on("click", "#btnViewMoreRecentSearches", function () {
    $("#btnRecentActivityPr01").click();
  });

  function mostrarDatos(consulta) {
    console.log("hice el pedidoooo");
    $.ajax({
      // Cambia mificherophp.php por el nombre de tu fichero

      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/productData.php",

      type: "POST",

      data: { consulta },
    })

      .done(function (respuesta) {
        console.log(respuesta);

        let data = JSON.parse(respuesta);

        // Coloca el nombre del input el cual mostrara los datos dependiendo de si es un id o una clase vas a hacer lo mismo con todos

        $("#nameEdithson").val(data.name);

        $("#descriptionEdithson").val(data.description);

        $("#categoryEdithson").val(data.category);

        $("#weightEdithson").val(data.weight);
      })

      .fail(function () {
        console.log("error");
      });
  }

  function searchListServices(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/searchListServices.php",

      type: "POST",

      data: { consulta },
    })

      .done(function (respuesta) {
        $("#c-listSupportServices").html(respuesta);

        console.log(respuesta);

        searchListServicesPagination();
      })

      .fail(function () {
        console.log("error");
      });
  }

  function searchListServicesPagination() {
    $(".pagination #form-next-services").submit(function (e) {
      e.preventDefault();

      var nextPage = $(this).find("input[name=b]").val();

      console.log(nextPage);

      contentServices(nextPage);
    });

    $(".pagination #form-previous-services").submit(function (e) {
      e.preventDefault();

      var prevPage = $(this).find("input[name=b]").val();

      contentServices(prevPage);
    });
  }

  function contentServices(nextPage) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/searchListServices.php",

      type: "POST",

      data: { nextPage },

      success: function (data) {
        var tableContent = $(data).find("#c-listSupportServices").html();

        console.log(tableContent);

        var currentPage = nextPage;

        $("#currentPageIndicatorServices").text("Page: " + currentPage);

        $("#c-listSupportServices").html(data);

        if (data.trim() === "") {
          return;
        }

        $(".pagination #form-next-services input[name=b]").val(
          parseInt(nextPage) + 1
        );

        let prev = parseInt(currentPage) > 1 ? parseInt(currentPage) - 1 : 1;

        $(".pagination #form-previous-services input[name=b]").val(prev);

        searchListServicesPagination();

        let numResults = $(data).find("#hiddenPage").length;

        if (currentPage == 1) {
          $("#previous").prop("disabled", true);
        } else {
          $("#previous").prop("disabled", false);
        }

        if (currentPage > 1) {
          $(".pagination #form-previous-services input[name=b]").val(
            parseInt(currentPage) - 1
          );
        } else {
          $(".pagination #form-previous-services input[name=b]").val(
            currentPage
          );
        }
      },

      error: function () {
        console.log("Error charging quote data.");
      },
    });
  }

  $(document).on("click", "#next", function () {
    var nextPage = $(this).val();

    console.log(nextPage);

    contentResultPage(nextPage);

    $(this).val(parseInt(nextPage) + parseInt(1));
  });

  // Evento on change

  $(document).on("change", "#cmbEdithson", function () {
    let valor = $(this).val();

    mostrarDatos(valor);
  });

  $(".circulatorDiv").hover(
    function () {
      $(this).css({ cursor: "pointer" });

      $(this).children(".div01").animate({ left: "-100%" }, "slow");

      $(this).children(".div02").animate({ right: "0" }, "slow");
    },
    function () {
      $(this).children(".div01").animate({ left: "0" }, "slow");

      $(this).children(".div02").animate({ right: "-100%" }, "slow");
    }
  );

  $(document).on("keyup", "#inputSearchServiceSupport", function () {
    let valor = $(this).val();

    searchListServices(valor);
  });

  $(document).on("click", "#add_report", function () {
    let valor = $(this).val();

    searchDataAgentSupport(valor);
  });

  function searchDataAgentSupport(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/infoAgentSupportSelect.php",

      type: "POST",

      data: { consulta },
    })

      .done(function (respuesta) {
        let data = JSON.parse(respuesta);

        $("#tltNameAgent").html(data.nameAgent);

        $("#tltServiceAgent").html(data.descriptionService);

        $("#tltCategorieService").html(data.categorieService);

        $("#Rproduct").html(data.categorie);
      })

      .fail(function () {
        console.log("error");
      });
  }

  //get the lang cookie
  //const cookie = getCookie('lang').split('=')[1]

  function registerTicketSupport(
    idServices,
    emailAgent,
    model,
    description,
    level
  ) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/savedTicketReport.php",

      type: "POST",

      data: { idServices, emailAgent, model, description, level },
    })

      .done(function (respuesta) {
        console.log(respuesta);

        let data = JSON.parse(respuesta);

        if (data.update === "correcto") {
          window.scrollTo(0, 0);

          $("#btnClosedModalTicket").click();

          $("#emailAgent").val("");

          $("#idServices").val("");

          $("#Rproduct").val("0");

          $("#RDescription").val("");

          $("#Rnivel").val("0");

          iziToast.success({
            title: "Success",
            message: alertsTranslations.supportTicketGerenerated,
            position: "topRight",
          });

          // translateAlert('success', 'supportTicketGerenerated', cookie)

          // createAlert(success, 'supportTicketGerenerated')
        } else {
          iziToast.error({
            title: "Error",

            message: alertsTranslations.ticketNotGenerated,

            position: "topRight",
          });
        }
      })

      .fail(function () {
        console.log("error");
      });
  }

  $(document).on("click", "#savedTicket", function () {
    let nameAgent = $("#emailAgent").val();

    let idServices = $("#idServices").val();

    let model = $("#Rproduct").val();

    if (model == "Other") {
      model = $("#otherModel").val();
    } else {
      model = $("#Rproduct").val();
    }

    let description = $("#RDescription").val();

    description = description.replace(/'/g, /\'/);

    description = description.replace(/\//g, "");

    let level = $("#Rnivel").val();

    if (model == "") {
      iziToast.warning({
        title: "Warning",

        message: alertsTranslations.selectProduct,

        position: "topRight",
      });

      return false;
    } else {
      if (description == "") {
        iziToast.warning({
          title: "Warning",

          message: alertsTranslations.enterDescription,

          position: "topRight",
        });

        return false;
      } else {
        if (level == "0") {
          iziToast.warning({
            title: "Warning",

            message: alertsTranslations.selectLevel,

            position: "topRight",
          });

          return false;
        } else {
          registerTicketSupport(
            idServices,
            nameAgent,
            model,
            description,
            level
          );
        }
      }
    }
  });

  function tblReportsTickets(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/searchTblTicketsClient.php",

      type: "POST",

      data: { consulta },
    })

      .done(function (respuesta) {
        $("#c-listSupportReports").html(respuesta);

        tblTicketsPagination();
      })

      .fail(function () {
        console.log("error");
      });
  }

  function tblTicketsPagination() {
    function tableContentTicket(nextPage) {
      $.ajax({
        url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/searchTblTicketsClient.php",

        type: "GET",

        data: { e: nextPage },

        success: function (data) {
          var tableContent = $(data).find("#tblTickets").html();

          var currentPage = nextPage;

          $("#currentPageIndicatorTickets").text("Page: " + currentPage);

          $("#tblTickets").html(tableContent);

          if (tableContent.trim() === "") {
            return;
          }

          $(".pagination form-next-tickets input[name=e]").val(
            parseInt(currentPage) + 1
          );

          let prev = parseInt(currentPage) > 1 ? parseInt(currentPage) - 1 : 1;

          $(".pagination #form-previous-tickets input[name=e]").val(prev);
        },

        error: function () {
          alert("Error charging quote data.");
        },
      });
    }

    $(".pagination #form-next-tickets").submit(function (e) {
      e.preventDefault();

      var nextPage = $(this).find("input[name=e]").val();

      console.log(nextPage);

      tableContentTicket(nextPage);
    });

    $(".pagination #form-previous-tickets").submit(function (e) {
      e.preventDefault();

      var prevPage = $(this).find("input[name=e]").val();

      tableContentTicket(prevPage);
    });
  }

  function deleteReportClient(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/deleteReport.php",

      type: "POST",

      data: { consulta },
    })

      .done(function (respuesta) {
        let data = JSON.parse(respuesta);

        if (data.delete === "correcto") {
          iziToast.success({
            title: "Success",

            message: alertsTranslations.reportDeleted,

            position: "topRight",
          });

          tblReportsTickets();
        }
      })

      .fail(function () {
        console.log("error");
      });
  }

  function searchInfoReportSelect(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/searchInfoReportSelect.php",

      type: "POST",

      data: { consulta },
    })

      .done(function (respuesta) {
        $("#c-reportSelect").html(respuesta);
      })

      .fail(function () {
        console.log("error");
      });
  }

  $(document).on("click", "#btnViewQuoteReportClient", function () {
    let id = $(this).val();

    window.open(
      "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/reportQUO.php?idCotizacion=" +
        id,
      "_blank"
    );
  });

  $(document).on("change", "#Rproduct", function () {
    let valor = $(this).val();

    if (valor == "Other") {
      $("#otherModel").css({ display: "block" });

      $("#otherModel").focus();
    } else {
      $("#otherModel").css({ display: "none" });
    }
  });

  function searchCountrySettings(consulta, val = "") {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/searchCountry.php",

      type: "POST",

      data: { consulta },
    })

      .done(function (respuesta) {
        $("#inputDestination").html(respuesta);

        if (val != "") {
          $("#inputDestination").val(val);

          $("#inputDestination").change();
        }
      })

      .fail(function () {
        console.log("error");
      });
  }

  function searchCountrySettingsEU(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/kalsteinCotizacion/classes/searchCountryEUsettings.php",
      type: "POST",
      data: { consulta },
    })
      .done(function (respuesta) {
        $("#inputDestinationEU").html(respuesta);
      })
      .fail(function () {
        console.log("error");
      });
  }

  $(document).on("change", "#inputShippingM", function () {
    searchCountrySettings(
      $("#inputShippingM").val(),
      $("#inputDestination").val()
    );
  });

  $(".intercon-button").on("click", (e) => {
    e.preventDefault();
  });

  $(document).on("click", "#btnShippingCost-send", function () {
    let userEncryt = $("#userShippingCost01").val();
    let address = $("#inputShippingCost-address").val();
    let subject = $("#inputShippingCost-subject").val();
    let zipcode = $("#inputShippingCost-zipcode").val();
    let infoadd = $("#inputShippingCost-textarea").val();

    if (address == "") {
      iziToast.info({
        title: "Info",
        message: alertsTranslations.addresRequired,
        position: "topRight",
      });
    } else {
      if (zipcode == "") {
        iziToast.info({
          title: "Info",
          message: alertsTranslations.zipCodeRequired,
          position: "topRight",
        });
      } else {
        registerConsultShippingCost(
          userEncryt,
          address,
          subject,
          zipcode,
          infoadd
        );
      }
    }
  });

  function registerConsultShippingCost(
    userEncryt,
    address,
    subject,
    zipcode,
    infoadd
  ) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/registerConsultShippingCost.php",
      type: "POST",
      data: { userEncryt, address, subject, zipcode, infoadd },
    })
      .done(function (respuesta) {
        let data = JSON.parse(respuesta);
        console.log(data.emailEncrypt);
        if (data.emailStatus === "noavaliable") {
          iziToast.info({
            title: "Info",
            message: alertsTranslations.quotationDontBelongToLoggedUser,
            position: "topRight",
          });
          location.href = domain + "/dashboard/#dashboard";
        } else {
          if (data.register === "correcto") {
            iziToast.success({
              title: "Success",
              message: alertsTranslations.priceRequestSentSuccessfully,
              position: "topRight",
            });
            location.href = domain + "/dashboard/#dashboard";
          } else {
            iziToast.info({
              title: "Success",
              message: alertsTranslations.errorHasOcurred,
              position: "topRight",
            });
          }
        }
      })
      .fail(function () {
        console.log("error");
      });
  }

  //USER_TAG SESSION
  function keepSessionAlive() {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/userTagSession.php",
      type: "GET",
      success: function (response) {
        var data = JSON.parse(response);
        console.log("user_tag: " + data.user_tag);
      },
      error: function () {
        console.log("Error getting user_tag");
      },
    });
  }

  function getPreviewProduct(id) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/src/templates-php/client/wooPreview.php",
      type: "POST",
      data: { id },
    })
      .done(function (response) {
        console.log(response);
        let data = JSON.parse(response);
        $("#preview-item").html(data);
      })
      .fail(function () {
        console.log("errorrr");
      });
  }

  $(document).on("click", "#productPreview", function () {
    // get the id from the attribute data-preview
    let id = $(this).attr("data-preview");
    getPreviewProduct(id);

    console.log(id, "Click previeww");
  });

  setInterval(keepSessionAlive, 300000);

  function consultDataClientSaved(consulta) {
    $.ajax({
      url: "https://dev.kalstein.plus/plataforma/wp-content/plugins/kalsteinPerfiles/php/consultDataClientSaved.php",
      type: "POST",
    })

      .done(function (respuesta) {
        let data = JSON.parse(respuesta);
        if (
          data.direccion == "" ||
          data.ciudad == "" ||
          data.pais == "" ||
          data.zipcode == ""
        ) {
          iziToast.info({
            title: "Información",
            message:
              "Es necesario que complete su perfil para poder realizar transacciones bancarias!",
            position: "center",
          });
          setInterval(function () {
            location.href = domain + "/dashboard#settings";
          }, 4000);
        } else {
          location.href = domain + "/pasarela?idCotizacion=" + consulta;
        }
      })

      .fail(function () {
        console.log("error");
      });
  }

  $(document).on('click', '#blog_articulos', function(){
    let id = $(this).val()
    renderArticulo(id)
    blog_views_plus(id)
    window.scrollTo(0, 0);
    $("#c-panel01").css({ display: "none" });
    $("#c-panel02").css({ display: "none" });
    $("#c-panel03").css({ display: "none" });
    $("#c-panel04").css({ display: "none" });
    $("#c-panel05").css({ display: "none" });
    $("#c-panel06").css({ display: "none" });
    $("#c-panel07").css({ display: "none" });
    $("#c-panel08").css({ display: "none" });
    $("#c-panel09").css({ display: "none" });
    $("#c-panel15").css({ display: "block" });
    $("#c-panel16").css({ display: "none" });
    $("#c-panel17").css({ display: "none" });
  })

  $(document).on('click', '#btn_view_art_destacado', function(){
    let id = $(this).attr('meta-id')
    renderArticulo(id)
    blog_views_plus(id)
    window.scrollTo(0, 0);
    $("#c-panel01").css({ display: "none" });
    $("#c-panel02").css({ display: "none" });
    $("#c-panel03").css({ display: "none" });
    $("#c-panel04").css({ display: "none" });
    $("#c-panel05").css({ display: "none" });
    $("#c-panel06").css({ display: "none" });
    $("#c-panel07").css({ display: "none" });
    $("#c-panel08").css({ display: "none" });
    $("#c-panel09").css({ display: "none" });
    $("#c-panel15").css({ display: "block" });
    $("#c-panel16").css({ display: "none" });
    $("#c-panel17").css({ display: "none" });
  })

  function renderArticulo(id){

    $.ajax({
      url: plugin_dir + '/php/blog_individual.php',
      type: "POST",
      data: { id },
    })
      .done(function (response) {
        $("#contenido_articulo").html(response);
    })
    .fail(function () {
      console.log("errorrr");
    });
  }

  function blog_views_plus(id){
    $.ajax({
      url: plugin_dir + '/php/viewCountBlog.php',
      type: "POST",
      data: { id },
    })
      .done(function (response) {

    })
    .fail(function () {
      console.log("errorrr");
    });
  }

  $(document).ready(function() {
    // Usar hover para cambiar las clases
    $('#catg1').hover(function() {
      $('#catg1-show').addClass('show').removeClass('elemento-vista-previa');
    }, function() {
      $('#catg1-show').addClass('elemento-vista-previa').removeClass('show');
    });
  });
});
