import '../styles/adminstyles.css';

class Admin{
  constructor(){
    //elements
    this.table = $("#roi-table");
    this.showMore = $("#roi-show-more");
    this.showingCount = $("#roi-showing-count");
    this.totalCount = $("#roi-total-count");
    this.clearDuplicatesButton = $("#roi-filter-unique");
    this.selectAll = $("#checkbox-select-all")[0];
    this.checkboxes;
    this.headerButtons = $("#roi-admin-controls");
    this.mailCount = $("#roi-mail-count");
    this.deleteCount = $("#roi-delete-count");
    
    //data
    this.selected = [];
    this.selectedMail = [];
    this.selectedCount = 0;
    this.checkboxIndex = 0;
    this.lastId = 0;
    this.subscribers;
    this.loadedData = 0;
    this.totalData = 0;
    this.limit = 10;

    this.init();
    this.events();
  }

  events(){
    $(this.clearDuplicatesButton).click(this.clearDuplicates.bind(this));
    $(this.showMore).click(this.loadMore.bind(this));
    $(this.selectAll).change(this.toggleSelectAll.bind(this));
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
          myClass.updateTotalCount();
          myClass.updateShowingCount();
          myClass.checkboxes = $(".checkbox__input");
          myClass.addCheckboxEventListener();
          myClass.checkboxIndex = myClass.limit;
        }).fail(function(response) {
          console.log(response);
        })
  }

  loadMore(){
    let myClass = this;

      $.ajax({
        url : roi_admin_ajax_script.ajaxurl,
        type : 'post',
        data : {
            action : 'get_user_data',
            datatype: 'json',
            showmore : 'yes',
            id : Number(myClass.lastId)
        }
      }).done( function( response ) {
          let result = $.parseJSON(response);
          myClass.table.append(result["output"]);
          myClass.subscribers.push(result["subscribers"]);
          myClass.loadedData += myClass.limit;
          myClass.lastId = Number(result["last"]["id"]);
          myClass.updateShowingCount();
        }).fail(function(response) {
        })
  }

  updateTotalCount(){
    $(this.totalCount).html(this.totalData);
  }

  updateShowingCount(){
    if (this.loadedData >= this.totalData){
      $(this.showMore).addClass("roi-hidden");
      $(this.showingCount).html(this.totalData);
    }else{
      $(this.showingCount).html(this.loadedData);
    }
  }

  clearDuplicates(){
    // clear list of duplicate emails
    console.log("Clear list");
  }

  addCheckboxEventListener(){
    for (let i = this.checkboxIndex; i < this.checkboxes.length; i++){
      $(this.checkboxes[i]).on("change", () => {
        if (this.checkboxes[i].checked){
          this.selected.push(this.checkboxes[i].value);
          this.selectedMail.push($(this.checkboxes[i]).data("mail"));
          this.selectedCount +=1;
          $(this.mailCount).html(this.selectedCount);
          $(this.deleteCount).html(this.selectedCount);
          if (this.selectedCount == 1) {
            $(this.headerButtons).removeClass("roi-hidden");
            
          }
        }else{
          let index = this.selected.indexOf(this.checkboxes[i].value);
          this.selected.splice(index, 1);

          let mailIndex = this.selectedMail.indexOf($(this.checkboxes[i]).data("mail"));
          this.selectedMail.splice(mailIndex, 1);

          this.selectedCount -=1;
          if (this.selectedCount == 0) {
            $(this.headerButtons).addClass("roi-hidden");
          }
          setTimeout(()=>{
            $(this.mailCount).html("this.selectedCount");
            $(this.deleteCount).html("this.selectedCount");
          }, 300);
          
          
        }
      });
    }
  }

  toggleSelectAll(){
    if (this.selectAll.checked){
      this.selected = [];
      this.selectedMail = [];
      for (let i = 0; i < this.checkboxes.length; i++){
        this.checkboxes[i].checked = true;
        this.selected.push(this.checkboxes[i].value);
        this.selectedMail.push($(this.checkboxes[i]).data("mail"));        
      }
      $(this.mailCount).html(this.loadedData);
      $(this.deleteCount).html(this.loadedData);
      if (this.selectedCount == 0) {
        $(this.headerButtons).removeClass("roi-hidden");
      }
      this.selectedCount = this.loadedData;
      
      
    }else{
      for (let i = 0; i < this.checkboxes.length; i++){
        this.checkboxes[i].checked = false;
      }
      if (this.selectedCount != 0) {
        $(this.headerButtons).addClass("roi-hidden");
      }
      this.selectedCount = 0;
      this.selected = [];
      this.selectedMail = [];
      
      setTimeout(()=>{
          $(this.mailCount).html("0");
          $(this.deleteCount).html("0");
        }, 500);
        
    }
  }

}


const $ = jQuery;
$(function() {
  new Admin();
});