$(document).ready(function() {

    $('.message .close').click(function() {
        $(this)
            .closest('.message')
            .transition('fade')
        ;
    });
});
