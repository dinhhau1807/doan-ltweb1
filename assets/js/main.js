$(document).ready(function() {
    //active tooltip
    $('[data-toggle="tooltip"]').tooltip();

    $('.message-bar').on('click', function() {
        const userId = $(this).data('userid');
        const messageWrapper = $('#message-wrapper');
        const closeMessageBox = $(messageWrapper.find('.close')[0]);

        messageWrapper.addClass('active');

        closeMessageBox.on('click', function(){
            messageWrapper.removeClass('active');
        });
    });
});