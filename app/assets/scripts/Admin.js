import '../styles/adminstyles.css';

class Admin{
  constructor(){
    //elements
    this.table = $("#roi-table");
    this.showMore = $("#roi-show-more");
    this.showingCount = $("#roi-showing-count");
    this.totalCount = $("#roi-total-count");
    this.filter = $("#roi-filter-unique");

    //data
    this.unique = 'no';
    this.lastId = 0;
    this.subscribers;
    this.loadedData = 0;
    this.totalData = 0;
    this.limit = 10;

    this.init();
    this.events();
  }

  events(){
    $(this.filter).change(this.toggleUnique.bind(this));
    $(this.showMore).click(this.loadMore.bind(this));
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

  loadMore(e){
    let myClass = this;

      $.ajax({
        url : roi_admin_ajax_script.ajaxurl,
        type : 'post',
        data : {
            action : 'get_user_data',
            datatype: 'json',
            unique : myClass.unique
        }
      }).done( function( response ) {
        console.log(response);
        /*
          let result = $.parseJSON(response);
          myClass.table.append(result["output"]);
          myClass.subscribers.push(result["subscribers"]);
          myClass.loadedData += myClass.limit;
          myClass.lastId = Number(result["last"]["id"]);
          myClass.updateCount();
        */
        }).fail(function(response) {
          //console.log(response);
        })
  }

  updateCount(){
    $(this.showingCount).html(this.loadedData);
    $(this.totalCount).html(this.totalData);
  }

  toggleUnique(){
    this.unique == 'yes' ? this.unique = 'no' : this.unique = 'yes';
  }

}


const $ = jQuery;
$(function() {
  new Admin();
});