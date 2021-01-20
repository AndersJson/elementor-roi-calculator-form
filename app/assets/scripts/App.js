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
  const moneyRangeElement = $("#money-range");
  const moneyRange = new RangeInput("#money-range", "#money-range__value", $(moneyRangeElement).data("fill"));

  const checklistRangeValueAmount = $(".checklist-range-value__amount");
  const checklistRangeInputAmount = $(".checklist-range__amount");
  const checklistRangeValueTime = $(".checklist-range-value__time");
  const checklistRangeInputTime = $(".checklist-range__time");

  const timeRanges = [];
  const amountRanges = [];

  for (let i = 0; i < checklistRangeValueAmount.length; i++){
    timeRanges.push( new RangeInput(`#${checklistRangeInputTime[i].id}`, `#${checklistRangeValueTime[i].id}`, $(checklistRangeInputTime[i]).data("fill")) );
    amountRanges.push( new RangeInput(`#${checklistRangeInputAmount[i].id}`, `#${checklistRangeValueAmount[i].id}`, $(checklistRangeInputAmount[i]).data("fill")) );
  }

  //Text-inputs
  const inputFirstname = $("#roi-input__firstname")[0];
  const inputLastname = $("#roi-input__lastname")[0];
  const inputEmail = $("#roi-input__email")[0];
  const inputPhone = $("#roi-input__phone")[0];
  



  console.log(checklist.checkboxes[0].checked);
  console.log(moneyRange.value);
  console.log(timeRanges[0].value);
  console.log(amountRanges[0].value);
  console.log(inputPhone.value == "" ? false : true);
  console.log(inputEmail.value == "" ? false : true);
  console.log(inputLastname.value == "" ? false : true);
  console.log(inputFirstname.value == "" ? false : true);



});


