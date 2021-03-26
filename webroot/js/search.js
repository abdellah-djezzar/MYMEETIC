$(document).ready(function () {
    var checkcities = false;
    var hideCity =  $('#hide-city');
    var addCity =  $('#add-city');
    var city2 =  $('#city2');
    var city3 =  $('#city3');

    if (checkcities === false) {
        $(city2).hide();
        $(city3).hide();
    }
    $(hideCity).hide();
    $(addCity).on('click', function () {
        $(city2).fadeIn(1000);
        $(city3).fadeIn(1000);
        $(addCity).hide();
        $(hideCity).show();
    });
    $(hideCity).on('click', function () {
        $(city2).fadeOut(1000);
        $(city3).fadeOut(1000);
        $(hideCity).hide();
        $(addCity).show();
    });

    $('#myDropdown').myDropdown({
        howMuchLong : 2,
        data : ["Consulter le profil", "Supprimer le profil"]
    });

    $('#ul_carousel').myCarousel({
        speed : 1000,
        pause : 2000
    });

    $('#search-form').submit(function () {
        checkcities = true;
    });
});
