$(document).ready(function() {
    $('.resetButton').on('click', function() {
        $(this).closest('form').find('input').val(' ');
    } );
});