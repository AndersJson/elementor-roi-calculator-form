class Checklist {
  constructor() {
    this.checkboxes = $(".roi-checklist__checkbox");
    this.rangewrappers = $(".checklist-rangewrapper");
    this.events();
  }
  events() {
    //toggle display of ranges
    for (let i = 0; i < this.checkboxes.length; i++){
      $(this.checkboxes[i]).change( ()=>{
        $(this.rangewrappers[i]).slideDown();
      });
   }
  }

}

const $ = jQuery;
$(function() {
  const checklist = new Checklist();
});
