$(function () {
    $('#form_personnal_profile').submit(function (e) {
        e.preventDefault();
        $('.comments').empty();
        $('.updated').empty();
        let postdata = $('#form_personnal_profile').serialize();
        $.ajax({
            type: 'POST',
            url: 'controller/profilePersonnal.php',
            data: postdata,
            success: function (data) {
                if (data.length > 0) {
                    data = JSON.parse(data);
                }
                if (data.isSuccessPersonnal) {
                    var successRedirect = "views/profile.php?successRedirect=yes";
                    window.location.replace(successRedirect);
                    $('#form_personnal_profile')[0].reset();
                    $("#div_personnal_profile").hide();
                    $("#hide_form_data").hide();
                    $("#show_form_data").show();
                } else {
                    $('#firstname + .comments').html(data.firstname_error);
                    $('#name + .comments').html(data.name_error);
                    $('#birth_date + .comments').html(data.birth_date_error);
                    $('#sexe + .comments').html(data.sexe_error);
                    $('#pseudo + .comments').html(data.pseudo_error);
                    $('#city + .comments').html(data.city_error);
                }
            }
        });
    });
});

$(function () {
    $('#form_connexion_profile').submit(function (e) {
        e.preventDefault();
        $('.comments').empty();
        $('.thank-you').empty();
        let postdata = $('#form_connexion_profile').serialize();
        $.ajax({
            type: 'POST',
            url: 'controller/profileConnexion.php',
            data: postdata,
            success: function (data) {
                if (data.length > 0) {
                    data = JSON.parse(data);
                }
                if (data.isSuccessConnexion) {
                    var successRedirect = "views/profile.php?successRedirect=yes";
                    window.location.replace(successRedirect);
                    $('#form_connexion_profile')[0].reset();
                    $("#div_connexion_profile_profile").hide();
                    $("#hide_form_data_connexion").hide();
                    $("#show_form_data_connexion").show();
                } else {
                    $('#email + .comments').html(data.email_error);
                    $('#password_before + .comments').html(data.password_before_error);
                    $('#email_check + .comments').html(data.email_check_error);
                    $('#password + .comments').html(data.password_error);
                    $('#password_check + .comments').html(data.password_check_error);
                }
            }
        });
    });
});

$(document).ready(function () {
    $('#myDropdown').myDropdown({
        howMuchLong : 4,
        data : ["Consulter le profil", "Supprimer le profil", "Consulter le profil", "Supprimer le profil"]
    });

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
