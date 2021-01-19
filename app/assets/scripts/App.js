import '../styles/styles.css';

//Range-Class
class RangeInput {
  constructor(inputId, valueId, color) {
    this.rangeinput = $(inputId);
    this.valueBubble = $(valueId);
    this.leftfill = color;
    this.value;
    this.events();
    this.setValue();
  }
  events() {
    this.rangeinput.on("input", this.setValue.bind(this));
  }

  setValue(){
  //Set value for value-bubble
   this.value = this.rangeinput.val();
   let newValue = Number( (this.rangeinput.val() - this.rangeinput.attr("min")) * 100 / (this.rangeinput.attr("max") - this.rangeinput.attr("min")) );
   let newPosition = 10 - (newValue * 0.2);
   this.valueBubble.html(`<span>${this.value}</span>`);
   this.valueBubble.css("left", `calc(${newValue}% + (${newPosition}px))`);

   //Add background to fill leftside of thumb
   let value = (this.rangeinput.val()-this.rangeinput.attr("min"))/(this.rangeinput.attr("max")-this.rangeinput.attr("min"))*100
   this.rangeinput.css("background", `linear-gradient(to right, ${this.leftfill} 0%, ${this.leftfill} ${value}%, #fff ${value}%, white 100%)`);
  }
}

//Class Checklist
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
  //Checklist
  const checklist = new Checklist();
  //Ranges
  const checklistRangeValues = $(".checklist-range-value");
  const checklistRangeInputs = $(".checklist-range__input");
  for (let i = 0; i < checklistRangeValues.length; i++){
    new RangeInput(`#${checklistRangeInputs[i].id}`, `#${checklistRangeValues[i].id}`, $(checklistRangeInputs[i]).data("fill"));
  }
  const moneyRange = $("#money-range");
  new RangeInput("#money-range", "#money-range__value", $(moneyRange).data("fill"));
});


