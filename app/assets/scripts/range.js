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

const $ = jQuery;
$(function() {
  const checklistRangeValues = $(".checklist-range__value");
  const checklistRangeInputs = $(".checklist-range__input");
  for (let i = 0; i < checklistRangeValues.length; i++){
    new RangeInput(`#${checklistRangeInputs[i].id}`, `#${checklistRangeValues[i].id}`, $(checklistRangeInputs[i]).data("fill"));
  }
  const thirdRange = $("#third-range");
  const secondRange = $("#second-range");
  new RangeInput("#second-range", "#second-rangevalue", $(secondRange).data("fill"));
  new RangeInput("#third-range", "#third-rangevalue", $(thirdRange).data("fill"));
});
