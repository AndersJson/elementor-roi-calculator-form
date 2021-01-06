class Checklist {
  constructor() {
    this.checkboxes = $(".roi-checklist__checkbox");
    this.rangewrappers = $(".checklist-rangewrapper");
    this.events();
  }
  events() {
    for (let i = 0; i < this.checkboxes.length; i++){
      $(this.checkboxes[i]).change(()=>{
        {
          if ($(this.checkboxes[i]).is(':checked') ){
              $(this.rangewrappers[i]).slideDown();
            }else{
              $(this.rangewrappers[i]).slideUp();
            }
        }
      });
    }
  }
}

const $ = jQuery;
$(function() {
  const checklist = new Checklist();
});
