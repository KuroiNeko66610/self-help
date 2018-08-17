
function resetForm() {
    $.post( "/admin/step/ajax-load-form", {'step': '', 'post_id':  $( "#step-post_id" ).val()}, function( data ) {
        $( "#step-form" ).html( data );
        $('#step-order option').last().prop('selected', true);
    });

    /*
    $( "#step-id" ).val('');
    $('#step-order option').last().prop('selected', true);
    $("#step-image_file").val('');
    $("#step-text").val('');
    $('.cke_editable ').val('');
    $('#new-message').show();
    */
}

function loadForm(step) {
    $.post( "/admin/step/ajax-load-form", {'step': step}, function( data ) {
        $( "#step-form" ).html( data );
    });
}

function deleteStep() {
    if (confirm('Удалить шаг ?')) {
        var step = $( "#step-id" ).val()
        if(step != ''){
            $.post( "/admin/step/ajax-delete-step", {'step': step}, function( step_id ) {
                var item = $('#step-carousel').find("[step='" + step_id + "']");
                var indicator = $('.carousel-indicators').find("[data-slide-to='" + step_id + "']");
                var indicator = $('.carousel-indicators > .active');
                var next = item.next();
                var indicator_next = indicator.next();

                if((next.attr('step')) === undefined){
                    next = item.prev();
                    indicator_next = indicator.prev();
                }


                item.remove();
                indicator.remove();
                if((next.attr('step')) !== undefined){
                    next.addClass('active');
                    indicator_next.addClass('active');
                    loadForm(next.attr('step'));
                }else
                    resetForm()
            });
        }
    }
}

function copyToClipboard(text) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val(text).select();
    document.execCommand("copy");
    $temp.remove();
}

function addToFavorites(ref, post_id) {
    //alert(post_id)
    if(ref.hasClass('fa-heart-o'))
        operation = 'add';
    else
        operation = 'remove';

    $.post( "/admin/post/add-to-favorites", {'operation': operation,'post_id': post_id}, function(result) {
        if(result){
            if(operation == 'add'){
                ref.removeClass('fa-heart-o');
                ref.addClass('fa-heart');
            }else{
                ref.removeClass('fa-heart');
                ref.addClass('fa-heart-o');
            }
        }else{
            alert("Добавить в избранное не удалось.")
        }
    });
}
