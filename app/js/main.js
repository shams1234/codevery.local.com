function init () {
    replyForm();
    loadMore();
    toggle();
    sendId();

}


$(document).ready(function () {
init()
});

$(document).ajaxComplete(function(event,request) {

// init();
    toggle();
console.log(event);
console.log(request);
});


    function addReply() {

    $(document).on('submit','.replyForm', function(e){
        e.preventDefault();

        var cid = $(this).attr('data-id');
        var id = $(this).closest('.messages').attr('id');
        var textVal = $(this).find('textarea').val();
        // var parent_id = ;

        console.log(cid);
        console.log(id);

        $.ajax({
            type: "POST",
            url: "/setComments",
            dataType: 'html',
            data: {
                mid: id,
                parent_id: cid,
                comment: textVal,
                child_id: cid
            },

            success: function (jsonStr) {

                  $('ul.comments').html(jsonStr);

                // toggle();

                noty({
                    "text": '<h4>Your Reply successfully added! </h4>',
                    "layout": 'topRight',
                    "timeout": 2000,
                    "animation": {
                        "open": 'animated bounceInRight',
                        "close": 'animated bounceOutRight',
                        "easing": 'swing',
                        "speed": 500
                    },
                    "modal": false
                });

                setTimeout(function(){
                    location.reload();
                }, 3000);

                console.log("Form submitted successfully.\nReturned comment: " + JSON.stringify(jsonStr));
            }
        });

        return false;

    })
}





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

                // toggle();


                noty({
                    "theme": 'bootstrap',
                    "text": '<h4>Comment successfully added! </h4>',
                    "layout": 'topRight',
                    "timeout": 2000,
                    "animation": {
                        "open": 'animated bounceInRight',
                        "close": 'animated bounceOutRight',
                        "easing": 'swing',
                        "speed": 500
                    },
                    "modal": false
                });


                    setTimeout(function(){
                        location.reload();
                    }, 3000);

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

                // toggle();

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
    $('.loadmore').on('click', function(){
        // var elCount = $(' .loadmore').data('val');
        $('.loadmore').html("Loading...");

    var offset = 4;

        $.ajax({
            type: "GET",
            url: "/loadMore",
            data: {
                'offset': offset,
                'limit': 3
            },
            dataType: 'html',

            success: function(data) {

                $('ul.messages-list').append(data);

                offset += 3;
            }
            });
        $(window).scroll(function(){
            if ($(window).scrollTop() >= $(document).height() - $(window).height()){
            console.log("Bottom");
    // $('.loadmore').on('click', function(){

                $.ajax({
                    type: "GET",
                    url: "/loadMore",
                    data: {
                        'offset': offset,
                        'limit': 3
                    },
                    dataType: 'html',

                    success: function(data) {

                        $('ul.messages-list').append(data);

                        offset += 3;

                    }
                });
            }
            $('.loadmore').html('Data Loading').prop('disabled', true);
            $('.loadmore').prop('disabled', true);
        })
    })
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

function checkReply() {


    $.validate({
        form: '#replyForm',
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

            addReply();

        }
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

function replyForm () {

        // var idBtn = $(this).find('.replyFormBtn').attr('data-id');
        $(document).on('click','.replyFormBtn', function(){

            console.log($(this).attr('data-id'));
            var id = ($(this).attr('data-id'));

            $("form[data-id='" + id + "']").slideToggle("fast");
            return false;

    })

}
