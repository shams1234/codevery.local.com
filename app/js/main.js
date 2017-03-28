$(document).ready(function () {
    toggle();
    sendId();
});

function addComment() {

    $(document).on('submit', '.commentForm', function (e) {
        e.preventDefault();
        
        var id = $(this).parent('.messages').attr('id');
        var textVal = $(this).parent('.messages').find('textarea').val();

        $.ajax({
            type: "POST",
            url: "/setComments",
            dataType: 'html',
            data: {
                mid: id,
                parent_id: id,
                comment: textVal
            },

            success: function (jsonStr) {

                $('ul.comments').append(jsonStr);

                toggle();

                noty({
                    "theme": 'bootstrap',
                    "text": '<h4>Comment successfully added! </h4>',
                    "layout": 'topRight',
                    "timeout": 5000,
                    "animation": {
                        "open": 'animated bounceInRight',
                        "close": 'animated bounceOutRight',
                        "easing": 'swing',
                        "speed": 500
                    },
                    "modal": false
                });

                console.log("Form submitted successfully.\nReturned comment: " + JSON.stringify(jsonStr));
            }
        });

        return false;

    })
}


function addMessage() {

    $(document).on('submit', '#messageForm', function (e) {
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: "/setMessages",
            dataType: 'html',
            data: {
                title: $('#title').val(),
                message: $('#message').val()
            },

            success: function (jsonStr) {

                $('ul.messages-list').html(jsonStr);

                toggle();

                noty({
                    "theme": 'bootstrap',
                    "text": '<h4>Message successfully added! </h4>',
                    "layout": 'topRight',
                    "timeout": 5000,
                    "animation": {
                        "open": 'animated bounceInRight',
                        "close": 'animated bounceOutRight',
                        "easing": 'swing',
                        "speed": 500
                    },
                    "modal": false
                });

                console.log("Form submitted successfully.\nReturned message: " + JSON.stringify(jsonStr));
            }
        });

        return false;

    })
}


function sendId() {
    $('.shortMessage').each(function () {

        var ifLoaded = false;

        var id = $(this).attr('id');

        $(document).on('click', 'a#' + id, function () {

            if (!ifLoaded) {

                console.log(id);
                $.ajax({
                    type: "POST",
                    url: "/getComments",
                    data: {'id': id},
                    dataType: 'html',
                    success: function (data) {

                        $('li' + '#' + id + '.messages').append(data);

                        ifLoaded = true;
                    }
                });
            }

            return false;
        })
    });
}


function loadMore() {
    // $('.loadmore').on('click', function(){
    //     var elCount = $(' .loadmore').data('val');
    //     $('.loadmore').html("Loading...");

    // var offset = 0;
    //
    //     $.ajax({
    //         type: "GET",
    //         url: "/loadMore",
    //         data: {
    //             'offset': offset + 1,
    //             'limit': 1
    //         },
    //         dataType: 'html',
    //
    //         success: function(data) {
    //
    //             $('ul.messages-list').append(data);
    //
    //             offset += 1;
    //
    //             // if(data != '') {
    //             //     $('ul.messages-list').append(data);
    //                 //
    //                 // $.each(data, function(i, item) {
    //                 //     var output = "<li class='messages'>" +
    //                 //         "<div class='message-id'>" + data[i].MID + "</div>" +
    //                 //         "<div class='row'>" +
    //                 //         "<div class='three columns'>" +
    //                 //         "<div class='user-avatar-small'>" +
    //                 //         "<img src='" + data[i].mpic + "' alt='" + data[i].mpic + "'>" +
    //                 //         "</div>" +
    //                 //         "<p class='comments-count'>Total Comments: </span></p>" +
    //                 //         "<a class='button u-full-width' href='#'>View Comments</a>" +
    //                 //         "</div>" +
    //                 //         "<div class='nine columns'>" +
    //                 //         "<div class='row'>" +
    //                 //         "<div class='six columns'>" +
    //                 //         "<p class='message'><span class='message-title'>Title: </span>" + data[i].mtitle + "</p>" +
    //                 //         "</div>" +
    //                 //         "<div class='six columns'>" +
    //                 //         "<span class='message-date'>Created at: </span>" + data[i].mdate + "" +
    //                 //         "<p class='message-author'>Author : <span>" + data[i].mauthor + "</span></p>" +
    //                 //         "</div></div>" +
    //                 //         "<p class='message-desc-header'>Description: </p>" +
    //                 //         "<p class='message-desc'>" + data[i].mdesc + "</p></div></div></li>" +
    //                 //         "<hr>";
    //                 //
    //                 //
    //                 //     $(".messages-list").append(output);
    //                 //     console.log("Returned : " + data[i].MID);
    //                 //
    //                 //
    //             // }else {
    //             //     $('.loadmore').html("No Data");
    //             // }
    //
    //         }
    //         });
    //     // $(window).scroll(function(){
    //     //     if ($(window).scrollTop() >= $(document).height() - $(window).height()){
    //     //         console.log("Bottom");
    // $('.loadmore').on('click', function(){
    //
    //             $.ajax({
    //                 type: "GET",
    //                 url: "/loadMore",
    //                 data: {
    //                     'offset': offset,
    //                     'limit': 1
    //                 },
    //                 dataType: 'html',
    //
    //                 success: function(data) {
    //
    //                     $('ul.messages-list').append(data);
    //
    //                     offset += 1;
    //
    //                 }
    //             });
    //     })
    // })
}
function toggle() {

    $('.messages').each(function () {
        var id = $(this).attr('id');

        // $('li.messages').hide();
        $('a').find('i').removeClass('fa-minus-circle').addClass('fa-plus-circle');
        $(document).on('click', 'a#' + id, function (e) {

            e.preventDefault();
            $('li.' + id).slideToggle('slow');


            $('.messages').not('.' + id).hide('slow');
            $('a').find('i').toggleClass('fa-plus-circle fa-minus-circle');
            $('.messages' + id).show('slow');
            $('a').not('#' + id).find('i').removeClass('fa-minus-circle').addClass('fa-plus-circle');
        });


    });


}


function checkMessage() {


    $.validate({
        form: '#messageForm',
        onError: function ($form) {
            noty({

                "text": '<h4>Required fields must be not empty!</h4>',
                "layout": 'topRight',
                "timeout": 5000,
                "animation": {
                    "open": 'animated bounceInRight',
                    "close": 'animated bounceOutRight',
                    "easing": 'swing',
                    "speed": 500
                },
                "modal": false
            })
        },

        onSuccess: function ($form) {

            addMessage();

        }
    });


}

function checkComments() {

    $.validate({
        form: '.commentForm',
        onError: function ($form) {
            noty({
                "text": '<h4>Required fields must be not empty!</h4>',
                "layout": 'topRight',
                "timeout": 5000,
                "animation": {
                    "open": 'animated bounceInRight',
                    "close": 'animated bounceOutRight',
                    "easing": 'swing',
                    "speed": 500
                },
                "modal": false
            })
        },

        onSuccess: function ($form) {

            addComment();

        }
    });


}


function checkLisence() {

    $.validate({
        form: '#anonumousForm',
        onError: function ($form) {
            noty({
                "theme": 'bootstrap',
                "text": '<h4>Sorry, your must be agree with a lisence! </h4>',
                "layout": 'topRight',
                "timeout": 5000,
                "animation": {
                    "open": 'animated bounceInRight',
                    "close": 'animated bounceOutRight',
                    "easing": 'swing',
                    "speed": 500
                },
                "modal": false
            })
        }
    });
}

function checkUsersInput() {

    $.validate({
        form: '#standardLogin',
        onError: function ($form) {
            noty({
                "theme": 'bootstrap',
                "text": '<h4>Both fields must not be empty! </h4>',
                "layout": 'topRight',
                "timeout": 5000,
                "animation": {
                    "open": 'animated bounceInRight',
                    "close": 'animated bounceOutRight',
                    "easing": 'swing',
                    "speed": 500
                },
                "modal": false
            });
        }
    });
}