$(document).ready(function() {
    //active tooltip
    $('[data-toggle="tooltip"]').tooltip();

    //for message
    $('.message-bar').on('click', function() {
        const messageWrapper = $('#message-wrapper');
        const messages = $("#message-wrapper .messages");
        const closeMessageBox = $(messageWrapper.find('.close')[0]);

        const toUserId = $(this).data('touserid');

        messageWrapper.addClass('active');

        closeMessageBox.on('click', function(){
            messageWrapper.removeClass('active');
        });

        $("#message-form").on('submit', function(e) {
            //get input element
            const $input = $(this).find('input[type=text]')[0];

            e.preventDefault();

            if($input.value.trim() === '') {
                return false;
            }

            $.ajax({
                type: 'get',
                url: './async/send-message.php',
                data: `touserid=${toUserId}&content=${$input.value}`,
                success: function(res) {
                    const data = JSON.parse(res);
                    if(data.success === true) {
                        messages.append(`<p class="message message-right">
                                            <span class="content">${$input.value}</span>
                                        </p>`);

                        //reset input
                        $input.value = '';
                        $input.focus();

                        //scroll to the last message
                        messages.find('.message:last-child')[0].scrollIntoView();
                    }
                }
            });
        });

        $.ajax({
            type: 'get',
            url: './async/fetch-conversation.php',
            data: `touserid=${toUserId}`,
            success: function(res) {
                const data = JSON.parse(res);
                const messagesResult = data.map(message => {
                    return `<p class="message message-${+message.type === 0 ? 'right' : 'left'}">
                                <span class="content">${message.content}</span>
                            </p>`
                });

                messages.html(messagesResult);

                //scroll to the last message
                messages.find('.message:last-child')[0].scrollIntoView();
            }
        });
    });

    
});