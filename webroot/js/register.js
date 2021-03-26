$(function () {
    $('#register-form').submit(function (e) {
        e.preventDefault();
        $('.comments').empty();
        $('.thank-you').empty();
        let postdata = $('#register-form').serialize();
        $.ajax({
            type: 'POST',
            url: 'controller/register.php',
            data: postdata,
            success: function (data) {
                if (data.length > 0) {
                    data = JSON.parse(data);
                }
                if (data.isSuccess) {
                    $('#register-form').prepend('<p class="thank-you alert-success">Votre inscription a bien été prise en compte.' +
                        ' Merci de vous connecter dès à présent.</p>');
                    $('#register-form')[0].reset();
                } else {
                    $('#firstname + .comments').html(data.firstname_error);
                    $('#name + .comments').html(data.name_error);
                    $('#birth_date + .comments').html(data.birth_date_error);
                    $('#sexe + .comments').html(data.sexe_error);
                    $('#email + .comments').html(data.email_error);
                    $('#email_check + .comments').html(data.email_check_error);
                    $('#password + .comments').html(data.password_error);
                    $('#password_check + .comments').html(data.password_check_error);
                    $('#city + .comments').html(data.city_error);
                    $('#pseudo + .comments').html(data.pseudo_error);
                }
            }
        });
    });
});

$(function () {

    $('#connexion-form').submit(function (e) {
        e.preventDefault();
        $('.comments').empty();
        let postdata = $('#connexion-form').serialize();
        $.ajax({
            type: 'POST',
            url: 'controller/registerConnexion.php',
            data: postdata,
            success: function (data) {
                if (data.length > 0) {
                    data = JSON.parse(data);
                }
                if (data.isSuccessConnexion) {
                    window.location.replace("views/members.php");
                    $('#connexion-form')[0].reset();
                } else {
                    $('#email_connexion + .comments').html(data.email_connexion_error);
                    $('#password_connexion + .comments').html(data.password_connexion_error);
                }
            }
        });
    });
});

$(document).ready(function () {
    $modal = $("#modalConnexion");
    $("#btn-modalConnexion").on("click", function () {
        $modal.css("display", "block");
    });
    $(".popin-dismiss").on("click", function () {
        $modal.css("display", "none");
    });
    $(window).mouseup(function (event) {
        modalContent = $("#modalContent");
        if (event.target.id !== modalContent.attr('id') && !$modal.has(event.target).length) {
            $modal.fadeOut();
        }
    });
    $(document).keyup(function (e) {
        if (e.keyCode === 27) {
            $modal.fadeOut();
        }
    });
    $(".logout_btn").on("click", function () {
        window.location.replace("views/index.php");
    });
});

$('nav li').hover(function () {
    $('ul', this).stop().slideDown(200);
}, function () {
    $('ul', this).stop().slideUp(200);
});
