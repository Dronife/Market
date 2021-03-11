$(document).ready(function () {
    //Check all/Uncheck all
    $('.selectAll').click(function () {
        var atLeastOneIsChecked = $('input[name="checkToDelete[]"]:checked').length > 0;
        if (!atLeastOneIsChecked)
            $('input:checkbox').prop('checked', true);
        else
            $('input:checkbox').prop('checked', false);
    })
});