(function ($) {
    $.fn.myDropdown = function (options) {
        var defaults = {
            howMuchLong : 2,
            data : ["Consulter le profil", "Supprimer le profil"],
            link : ["views/profile.php", "views/deleteProfile.php"]
        },
        options = $.extend(defaults, options);

        $("#myDropdown").hover(
            function () {
                let i;
                let count = 1;
                for (i = 0; i <= options.howMuchLong -1; i++) {
                    $(this).append($('<li class="drop-content drop-content' + count + ' drop-content-btn btn btn-warning">' +
                        '<a href="' + options.link[i] + '">' + options.data[i] + '</a></li>'));
                    $($(this).children("li").hasClass("drop-content" + count)).css('padding-top', '30px');
                    count++;
                }
            },
            function () {
                $(this).find(".drop-content").remove();
            }
        );
    }
}(jQuery));
