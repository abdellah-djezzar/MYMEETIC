$(document).ready(function () {
    $("#div_personnal_profile").hide();

    let hideFormData = $("#hide_form_data");
    let hideFormDataConnexion = $('#hide_form_data_connexion');
    $(hideFormData).hide();

    $("#show_form_data").on('click', (function () {
        $(this).hide();
        $("#hide_form_data").fadeIn();
        $("#div_personnal_profile").slideDown(1400);
    }));

    $(hideFormData).on('click', (function () {
        $(this).hide();
        $("#show_form_data").fadeIn();
        $("#div_personnal_profile").slideUp(1400);
    }));

    $('#div_connexion_profile').hide();
    $(hideFormDataConnexion).hide();

    $("#show_form_data_connexion").on('click', (function () {
        $(this).hide();
        $("#hide_form_data_connexion").fadeIn();
        $("#div_connexion_profile").slideDown(1400);
    }));

    $(hideFormDataConnexion).on('click', (function () {
        $(this).hide();
        $("#show_form_data_connexion").fadeIn();
        $("#div_connexion_profile").slideUp(1400);
    }));
});
