$(document).ready(function() {
    $('.resetButton').on('click', function() {
        $(this).closest('form').find('input').val(' ');
    });
   /* $('select').on('change', function() {
        var selected = $(this).val();
        $(this).find('option').each(function() {
            if($(this) == selected) {
                $(this).remove();
            }
        });
    });*/

});