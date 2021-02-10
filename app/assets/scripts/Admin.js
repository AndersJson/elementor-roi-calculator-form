import '../styles/adminstyles.css';

class Admin{
  constructor(){
    //elements
    this.table = $("#roi-table");
    this.showMore = $("#roi-show-more");
    this.showingCount = $("#roi-showing-count");
    this.totalCount = $("#roi-total-count");
    this.selectAll = $("#checkbox-select-all")[0];
    this.checkboxes;
    this.deleteIcons;
    this.mailIcons;
    this.headerButtons = $("#roi-admin-controls");
    this.mailCount = $("#roi-mail-count");
    this.deleteCount = $("#roi-delete-count");
    this.showAllButton = $("#roi-show-all");
    this.deleteConfirm = $("#roi-delete-confirm");
    this.deleteDecline = $("#roi-delete-decline");
    this.modalLayer = $("#admin-modal");
    this.deleteModal = $("#delete-modal");
    this.mailModal = $("#mail-modal");
    this.deleteModalButtons = $("#delete-modal-buttons");
    this.deleteSelectedButton = $("#roi-delete-selected");
    this.mailSelectedButton = $("#roi-mail-selected");
    this.deleteText = $("#roi-delete-modal-text");
    this.mailToText = $("#roi-mail-to");
    this.mailCancelButton = $("#roi-mail-cancel");
    this.mailSendButton = $("#roi-mail-send");
    this.deleteLoadingLayer = $("#delete-loading-layer");
    this.deleteLoadingText = $("#delete-loading-text");
    this.mailLoadingLayer = $("#mail-loading-layer");
    this.mailLoadingText = $("#mail-loading-text");

    
    //data
    this.selected = [];
    this.selectedMail = [];
    this.trashCan = [];
    this.mailBox = [];
    this.selectedCount = 0;
    this.currentIndex = 0;
    this.lastId = 0;
    this.subscribers = {};
    this.loadedData = 0;
    this.totalData = 0;
    this.limit = 10;
    this.deleteIds = [];

    this.init();
    this.events();
  }

  events(){
    $(this.showMore).click(this.loadMore.bind(this));
    $(this.selectAll).change(this.toggleSelectAll.bind(this));
    $(this.deleteDecline).click(this.hideDeleteModal.bind(this));
    $(this.deleteSelectedButton).click(this.showDeleteModal.bind(this));
    $(this.deleteConfirm).click(this.deleteData.bind(this));
    $(this.mailSelectedButton).click(this.showMailModal.bind(this));
    $(this.mailCancelButton).click(this.hideMailModal.bind(this));

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
          myClass.pushSubscribers(result["subscribers"]);
          //myClass.subscribers = result["subscribers"];
          myClass.totalData = Number(result["count"]);
          myClass.loadedData += Number(result["subscribers"].length);
          myClass.lastId = Number(result["last"]["id"]);
          myClass.updateTotalCount();
          myClass.updateShowingCount();
          myClass.checkboxes = $(".checkbox__input");
          myClass.deleteIcons = $(".roi-icon-delete");
          myClass.mailIcons = $(".roi-icon-mail");
          myClass.addCheckboxEventListener();
          myClass.addDeleteIconsEventListener();
          myClass.addMailIconsEventListener();
          myClass.currentIndex = myClass.loadedData;
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
          myClass.slideDownRows();
          myClass.pushSubscribers(result["subscribers"]);
          myClass.loadedData += Number(result["subscribers"].length);
          myClass.lastId = Number(result["last"]["id"]);
          myClass.updateShowingCount();
          myClass.checkboxes = $(".checkbox__input");
          myClass.deleteIcons = $(".roi-icon-delete");
          myClass.mailIcons = $(".roi-icon-mail");
          myClass.addCheckboxEventListener();
          myClass.addDeleteIconsEventListener();
          myClass.addMailIconsEventListener();
          myClass.currentIndex = myClass.loadedData;
        }).fail(function(response) {
          console.log(response);
        })
  }

  deleteData(){
    if (this.deleteIds.length) {
      this.deleteLoadingLayer.removeClass("roi-hidden");
    setTimeout(()=>{
      let output = 'Deleting...';
      this.deleteLoadingText.html("");
      this.deleteLoadingText.append(output);
    }, 300);    

    let span = "single";

    if ((this.deleteIds.length == this.totalData) && (this.deleteIds.length == this.loadedData)){
      span = "all";
    }

    let myClass = this;
      $.ajax({
        url : roi_admin_ajax_script.ajaxurl,
        type : 'post',
        data : {
            action : 'delete_user_data',
            span : span,
            id : myClass.deleteIds,
        }
      }).done( function() {
          myClass.resetData();         
        }).fail(function(response) {
          console.log(response);
        })
    }
  }

  resetData(){
    let myClass = this;

    $.ajax({
      url : roi_admin_ajax_script.ajaxurl,
      type : 'post',
      data : {
          action : 'get_user_data',
          datatype: 'json',
          reset : 'yes',
          limit: myClass.loadedData
      }
    }).done( function( response ) {
        myClass.table.html("");
        myClass.subscribers = {};
        myClass.totalData = 0;
        myClass.loadedData = 0;
        myClass.lastId = 0;
        myClass.currentIndex = 0;
        myClass.selectedCount = 0;

        let result = $.parseJSON(response);
        myClass.table.append(result["output"]);
        myClass.pushSubscribers(result["subscribers"]);
        myClass.loadedData += Number(result["subscribers"].length);
        myClass.totalData = Number(result["count"]);
        myClass.lastId = Number(result["last"]["id"]);
        myClass.updateShowingCount();
        myClass.updateTotalCount();
        myClass.checkboxes = $(".checkbox__input");
        myClass.deleteIcons = $(".roi-icon-delete");
        myClass.mailIcons = $(".roi-icon-mail");
        myClass.addCheckboxEventListener();
        myClass.addDeleteIconsEventListener();
        myClass.addMailIconsEventListener();
        myClass.currentIndex = myClass.loadedData;
        myClass.selectAll.checked = false;
        $(myClass.headerButtons).addClass("roi-hidden");
            setTimeout(()=>{
            $(myClass.mailCount).html(myClass.selectedCount);
            $(myClass.deleteCount).html(myClass.selectedCount);
          }, 300);

        setTimeout(()=>{
          myClass.deleteLoadingText.html("");
          let output = 'Data deleted successfully.';
          myClass.deleteLoadingText.append(output);
        }, 500);
        setTimeout(()=>{
          myClass.hideDeleteModal();
        }, 2000);
        setTimeout(()=>{
          myClass.deleteLoadingText.html("");
          myClass.deleteLoadingLayer.addClass("roi-hidden");
        }, 2500);
        
      }).fail(function(response) {
        console.log(response);
        setTimeout(()=>{
          myClass.deleteLoadingText.html("");
          let output = 'Unable to delete data, try again later.';
          myClass.deleteLoadingText.append(output);
        }, 500);
        setTimeout(()=>{
          myClass.hideDeleteModal();
        }, 2000);
        setTimeout(()=>{
          myClass.deleteLoadingText.html("");
        }, 2500);
      })
  }

  sendMail(){
    let myClass = this;

      $.ajax({
        url : roi_admin_ajax_script.ajaxurl,
        type : 'post',
        data : {
            action : 'send_user_mail',
            send : 'yes',
            to : 'andersh_@hotmail.com',
            subject : 'Testmail',
            message : 'This is a testmail from Ajax-function'
        }
      }).done( function(response) {
        console.log(response);
      }).fail(function(response) {
        console.log(response);
      })
  }

  slideDownRows(){
    let rows = $(".roi-admin-table__row--wrapper");

    for (let i = this.currentIndex; i < rows.length; i++){
      $(rows[i]).slideDown();
    }

  }

  pushSubscribers(data){
    for (let i = 0; i < data.length; i++){
      this.subscribers[data[i].id] = {
        time: data[i].time,
        firstname: data[i].firstname,
        lastname: data[i].lastname,
        email: data[i].email,
        phone: data[i].phone
      }
    }
  }

  updateTotalCount(){
    $(this.totalCount).html(this.totalData);
  }

  updateShowingCount(){
    if (this.loadedData >= this.totalData){
      $(this.showMore).addClass("roi-hidden");
      $(this.showAllButton).addClass("roi-hidden");
    }
      $(this.showingCount).html(this.loadedData);
  }

  addCheckboxEventListener(){
    for (let i = this.currentIndex; i < this.checkboxes.length; i++){
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
          $(this.mailCount).html(this.selectedCount);
          $(this.deleteCount).html(this.selectedCount);

          if (this.selectedCount == 0) {
            $(this.headerButtons).addClass("roi-hidden");
            setTimeout(()=>{
            $(this.mailCount).html(this.selectedCount);
            $(this.deleteCount).html(this.selectedCount);
          }, 300);
          } 
        }
      });
    }
  }

  addDeleteIconsEventListener(){
    for (let i = this.currentIndex; i < this.deleteIcons.length; i++){
      $(this.deleteIcons[i]).on("click", () => {
        this.trashCan.push($(this.deleteIcons[i]).data("id"));
        this.showDeleteModal();
          });
    }
  }

  addMailIconsEventListener(){
    for (let i = this.currentIndex; i < this.mailIcons.length; i++){
      $(this.mailIcons[i]).on("click", () => {
        this.mailBox.push($(this.mailIcons[i]).data("mail"));
        this.showMailModal();
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

  showDeleteModal(){
    if (this.trashCan.length){
      let firstname = this.subscribers[this.trashCan[0]]["firstname"];
      let lastname = this.subscribers[this.trashCan[0]]["lastname"];
      let email = this.subscribers[this.trashCan[0]]["email"];
      let output = `Are you sure you want to delete:
      <span class="roi-delete-modal__text--data">${firstname} ${lastname} ${email}</span>`;
      this.deleteText.append(output);
      this.deleteIds.push(this.trashCan[0]);
    }else if (this.selected.length == 1){
      let firstname = this.subscribers[this.selected[0]]["firstname"];
      let lastname = this.subscribers[this.selected[0]]["lastname"];
      let email = this.subscribers[this.selected[0]]["email"];
      let output = `Are you sure you want to delete:
      <span class="roi-delete-modal__text--data">${firstname} ${lastname} ${email}</span>`;
      this.deleteText.append(output);
      this.deleteIds.push(this.selected[0]);
    }else if ((this.loadedData >= this.totalData) && (this.loadedData == this.selected.length)){
      let output = `Are you sure you want to delete ALL rows?`;
      this.deleteText.append(output);
      this.deleteIds = this.selected;
    }else {
      let output = `Are you sure you want to delete (${this.selected.length}) selected rows?`;
      this.deleteText.append(output);
      this.deleteIds = this.selected;
    }
      $(this.modalLayer).removeClass("roi-hidden");
      setTimeout(()=>{     
        $(this.deleteModal).css("right", "10%");
      }, 100);
  }

  hideDeleteModal(){
    if (this.trashCan.length){
      this.trashCan = [];
      this.deleteIds = [];
    }
    if (this.selected.length){
      this.deleteIds = [];
    }
    $(this.deleteModal).css("right", "-110%");
    setTimeout(()=>{
      $(this.modalLayer).addClass("roi-hidden");
      this.deleteText.html("");

    }, 100);
  }

  showMailModal(){
    if (this.mailBox.length){
      let to = this.mailBox[0];
      this.mailToText.append(to);
    }else if (this.selectedMail.length == 1){
      let to = this.selectedMail[0];
      this.mailToText.append(to);
    }else{
      let count = (this.selectedMail.length - 1);
      let to = `${this.selectedMail[0]} (+${count} more)`;
      this.mailToText.append(to);
    }

      $(this.modalLayer).removeClass("roi-hidden");
      setTimeout(()=>{     
        $(this.mailModal).css("right", "10%");
      }, 100);
  }

  hideMailModal(){
    if (this.mailBox.length){
      this.mailBox = [];
    }
    $(this.mailModal).css("right", "-110%");
    setTimeout(()=>{
      $(this.modalLayer).addClass("roi-hidden");
      this.mailToText.html("");
    }, 100);
  }

}


const $ = jQuery;
$(function() {
  new Admin();
});