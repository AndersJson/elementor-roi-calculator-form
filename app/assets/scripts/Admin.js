import '../styles/adminstyles.css';

const $ = jQuery;
$(function() {
  // let myClass = this;

      $.ajax({
        url : roi_admin_ajax_script.ajaxurl,
        type : 'post',
        data : {
            action : 'get_user_data',
           // nonce : $(e.target).data("nonce"),
            init : 'yes'
        }
      }).done( function( response ) {
          $("#roi-table").append(response);          
        }).fail(function(response) {
          console.log(response);
        })
});