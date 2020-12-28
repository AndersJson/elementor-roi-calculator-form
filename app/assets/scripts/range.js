class RangeInput {
  constructor(inputId, valueId) {
    this.rangeinput = $(inputId);
    this.rangevalue = $(valueId);
    this.events();
  }
  events() {
    this.setValue.bind(this);
    this.rangeinput.on("input", this.setValue.bind(this));
  }

  setValue(){
    console.log(this.rangeinput.val());
    console.log(this.rangevalue);
  
   let newValue = Number( (this.rangeinput.val() - this.rangeinput.min) * 100 / (this.rangeinput.max - this.rangeinput.min) );
   let newPosition = 10 - (newValue * 0.2);
   this.rangevalue.innerHTML = `<span>${this.rangeinput.val()}</span>`;
   this.rangevalue.css("left", `calc(${newValue}% + (${newPosition}px))`);
  }

}

const $ = jQuery;
$(function() {
  const firstRange = new RangeInput("#first-range", "#first-rangevalue");
});