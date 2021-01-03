class RangeInput {
  constructor(inputId, valueId) {
    this.rangeinput = $(inputId);
    this.rangevalue = $(valueId);
    this.events();
    this.setValue();
  }
  events() {
    this.rangeinput.on("input", this.setValue.bind(this));
  }

  setValue(){
   let newValue = Number( (this.rangeinput.val() - this.rangeinput.attr("min")) * 100 / (this.rangeinput.attr("max") - this.rangeinput.attr("min")) );
   let newPosition = 10 - (newValue * 0.2);
   this.rangevalue.html(`<span>${this.rangeinput.val()}</span>`);
   this.rangevalue.css("left", `calc(${newValue}% + (${newPosition}px))`);
  }

}

const $ = jQuery;
$(function() {
  const checklistRangeValues = $(".checklist-range__value");
  const checklistRangeInputs = $(".checklist-range__input");
  for (let i = 0; i < checklistRangeValues.length; i++){
    new RangeInput(`#${checklistRangeInputs[i].id}`, `#${checklistRangeValues[i].id}`);
  }
  new RangeInput("#second-range", "#second-rangevalue");
  new RangeInput("#third-range", "#third-rangevalue");
});