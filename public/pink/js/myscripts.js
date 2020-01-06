jQuery(document).ready(function ($) {


    $('.commentlist li').each(function (i) {

        $(this).find('.commentNumber').text('#' + (i + 1))

    });

    $('#commentform').on('click', '#submit', function (event) {
        event.preventDefault();

        let commentParent = $(this);

        $('.wrap-result').css('color', 'green').text('Сохранения комментарии').fadeIn(500, function () {
           let data = $('#commentform').serializeArray();

           $.ajax({
               url: $('#commentform').attr('action'),
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               },
                data: data,
               type: 'POST',
               dataType: 'JSON',
               success: function (responce) {
                console.log(responce, "!!!success!!!");
                if(responce.success) {

                        $('.wrap-result').append('<br /><strong>Сохранено!</strong>').delay(2000).fadeOut(500, function () {
                            if(responce.data.parent_id > 0) {
                                commentParent.parents('div#respond').prev().after('<ul class="children">'+ responce.comment +'</ul>');
                            }
                            else {

                                if( $.contains('#comments', 'ol.commentlist') ) {
                                    $('ol.commentlist').append(responce.comment);
                                }else {
                                    $('#respond').before('<ol class="commentlist group">'+responce.comment+ '</ol>');
                                }
                            }

                        $('#cancel-comment-reply-link').click();

                    });

                } else if(responce.error) {
                        $('.wrap-result').css('color', 'red').append('<br /><strong>Error:</strong>' + responce.error.join('<br />'));
                        $('.wrap-result').delay(2000).fadeOut(500);
                }

               },
               error: function (error) {
                   $('.wrap-result').css('color', 'red').append('<br /><strong>Error</strong>');
                   $('.wrap-result').delay(2000).fadeOut(500, function () {
                       $('#cancel-comment-reply-link').click();
                   });
               }
           });

        });


    });

});