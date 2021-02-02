import '../styles/adminstyles.css';

class Admin{
  constructor(){
    //elements
    this.table = $("#roi-table");
    this.showMore = $("#roi-show-more");
    this.showingCount = $("#roi-showing-count");
    this.totalCount = $("#roi-total-count");

    //data
    this.lastId = 0;
    this.subscribers;
    this.loadedData = 0;
    this.totalData = 0;
    this.limit = 10;

    this.init();
    this.events();
  }

  events(){

  }

  init(){
    let myClass = this;

      $.ajax({
        url : roi_admin_ajax_script.ajaxurl,
        type : 'post',
        data : {
            action : 'get_user_data',
            datatype: 'json',
            init : 'yes'
        }
      }).done( function( response ) {
          let result = $.parseJSON(response);
          myClass.table.append(result["output"]);
          myClass.subscribers = result["subscribers"];
          myClass.totalData = Number(result["count"]);
          myClass.loadedData += myClass.limit;
          myClass.lastId = Number(result["last"]["id"]);
          myClass.updateCount();
        }).fail(function(response) {
          console.log(response);
        })
  }

  updateCount(){
    $(this.showingCount).html(this.loadedData);
    $(this.totalCount).html(this.totalData);
  }

}


const $ = jQuery;
$(function() {
  new Admin();
});