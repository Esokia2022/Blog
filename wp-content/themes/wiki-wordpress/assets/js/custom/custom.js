jQuery.noConflict();
(function ($) {
     $(function(){
         //jQuery ready
         $('#avatar').on('change',function(){
            //get the file name
            var fileName = $(this).val();
            fileName = fileName.split("\\");
           // var _name = fileName[]
            //console.log(fileName);
            //replace the "Choose a file" label
            $(this).next('.custom-file-label').html(fileName[fileName.length - 1]);
        })
         $('.delete-subject').on('click', function(e){
            e.preventDefault();
            var post_id = $(this).attr('data-post-id');
            var post = $(this).parents('tr');
            var message = $('#message');


            $.ajax({
                url: ajaxurl, 
                type: 'post',
                data: {
                    post_id: post_id, 
                    action: 'delete_subject_wiki'
                },
                error: function (response) {
                    console.log('erreur');
                },
                success: function (response) {
                    //$('.question_freq').html(response);
                    //console.log(response);

                    // $('.successMessage').html("Ce sujet a été bien supprimer"); // Afficher le HTML
                    // $('#btn-popup').trigger('click');
                    if(response == 'success'){
                        message.addClass('alert alert-success');
                        message.text('Suppression reussie');
                       
                        post.fadeOut( function(){
                            post.remove();
                        });
                    }else{
                        message.addClass('alert alert-danger');
                        message.text('Erreur lors de la tentative de suppression');
                    }
                }
            });
         });
     });
})(jQuery);


