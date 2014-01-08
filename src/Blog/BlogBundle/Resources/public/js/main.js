$(document).ready(function(){
    $('#send-mail').click(function(){
        $.ajax({
            type: "POST",
            url: "/sendmail",
            data: {
                mail : $('#sender-mail').val(),
                name : $('#sender-name').val(),
                text : $('#sender-message').val()
            },
            success: function(msg){
                if (msg == "ok") {
                    alert( "Mail has been send" );
                    $('.form-signin').find('.form-control').attr('disabled', 'disabled');
                }
            }
        });
    });
});

toggleMessage = function(id) {
    $('.but_' + id).toggle();
    $('#mes_' + id + ' div').toggle();
}

delMessage = function(id) {
    $.ajax({
            url: document.URL,
            method: "POST",
            data: ({action :"delMessage",
                    idMessage     :id}),
            success: function(msg){
                location.reload();
            }
        }
    )
}
count = 0;
showMoreArticles = function() {
    count++;
    $.ajax({
        type: "POST",
        url: "/morearticles",
        dataType: "html",
        data: ({count : count, page : $('.pagerfanta .current').text()}),
        success: function(msg){
            $('.prev-article-container:last').append(msg);
        }
    });
}