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
    this.deleteIcons;
    this.headerButtons = $("#roi-admin-controls");
    this.mailCount = $("#roi-mail-count");
    this.deleteCount = $("#roi-delete-count");
    this.showAllButton = $("#roi-show-all");
    this.deleteConfirm = $("#roi-delete-confirm");
    this.deleteDecline = $("#roi-delete-decline");
    this.modalLayer = $("#admin-modal");
    this.deleteModal = $("#delete-modal");
    this.deleteSelectedButton = $("#roi-delete-selected");
    this.mailSelectedButtons = $("#roi-mail-selected");
    this.deleteText = $("#roi-delete-modal-text");
    
    //data
    this.selected = [];
    this.selectedMail = [];
    this.trashCan = [];
    this.selectedCount = 0;
    this.currentIndex = 0;
    this.lastId = 0;
    this.subscribers = {};
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
    $(this.deleteDecline).click(this.hideDeleteModal.bind(this));
    $(this.deleteSelectedButton).click(this.showDeleteModal.bind(this));
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
          myClass.addCheckboxEventListener();
          myClass.addDeleteIconsEventListener();
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
          myClass.pushSubscribers(result["subscribers"]);
          myClass.loadedData += Number(result["subscribers"].length);
          myClass.lastId = Number(result["last"]["id"]);
          myClass.updateShowingCount();
          myClass.checkboxes = $(".checkbox__input");
          myClass.deleteIcons = $(".roi-icon-delete");
          myClass.addCheckboxEventListener();
          myClass.addDeleteIconsEventListener();
          myClass.currentIndex = myClass.loadedData;
        }).fail(function(response) {
          console.log(response);
        })
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

  clearDuplicates(){
    // clear list of duplicate emails
    console.log("Clear list");
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

    }else if (this.selected.length == 1){
      let firstname = this.subscribers[this.selected[0]]["firstname"];
      let lastname = this.subscribers[this.selected[0]]["lastname"];
      let email = this.subscribers[this.selected[0]]["email"];
      let output = `Are you sure you want to delete:
      <span class="roi-delete-modal__text--data">${firstname} ${lastname} ${email}</span>`;
      this.deleteText.append(output);
    }else {
      let output = `Are you sure you want to delete (${this.selected.length}) selected rows?`;
      this.deleteText.append(output);
    }
      $(this.modalLayer).removeClass("roi-hidden");
      setTimeout(()=>{     
        $(this.deleteModal).css("right", "10%");
      }, 100);
  }

  hideDeleteModal(){
    if (this.trashCan.length){
      this.trashCan = [];
    }
    $(this.deleteModal).css("right", "-110%");
    setTimeout(()=>{
      $(this.modalLayer).addClass("roi-hidden");
      this.deleteText.html("");

    }, 100);
  }

}


const $ = jQuery;
$(function() {
  new Admin();
});