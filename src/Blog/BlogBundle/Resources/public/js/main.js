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
};

delMessage = function(id , url) {
    $.ajax({
            url: url,
            method: "POST",
            data: ({idMessage : id}),
            success: function(msg){
                location.reload();
            }
        }
    )
};
count = 0;
showMoreArticles = function(url) {
    count++;
//    alert(url + "/" + window.location.search);
    $.ajax({
        type: "POST",
        url: url + window.location.search,
        dataType: "html",
        data: ({count : count, page : $('.pagerfanta .current').text()}),
        success: function(msg){
            $('#more-container').replaceWith(msg);
        }
    });
};

countPosts = 0;
showMorePosts = function() {
    countPosts++;
    $.ajax({
        type: "POST",
        url: "/moreposts",
        dataType: "html",
        data: ({count : countPosts, page : $('.pagerfanta .current').text()}),
        success: function(msg){
            $('#more-container').replaceWith(msg);
        }
    });
};

inlineSearch = function(tre) {
    document.location.replace("http://localhost/?type=intext&query=" + $('#search-input').val());
};