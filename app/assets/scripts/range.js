class RangeInput {
  constructor(id) {
    this.rangeinput = $(id);
    this.events();
  }
  events() {
    this.rangeinput.change(this.log.bind(this));
  }

  log(){
    console.log(this.rangeinput.val());
  }

} //class

const $ = jQuery;
$(function() {
  const firstRange = new RangeInput("#first-range");
});