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
  
  
    //Form-class
    class RoiForm{
      constructor(checklist, money, amount, time){
        //DOM-Elements
        this.firstname = $("#roi-input__firstname")[0];
        this.lastname = $("#roi-input__lastname")[0];
        this.email = $("#roi-input__email")[0];
        this.phone = $("#roi-input__phone")[0];
        this.yearTabs = $(".tabs__link");
        this.checkboxes = checklist;
        this.moneyRange = money;
        this.amountRanges = amount;
        this.timeRanges = time;
        this.calculateButton = $("#roi-submit-button");
        //Data-properties
        this.minuteSalary;
        this.timeSaved;
        this.moneySaved;
        this.months = 12;
        this.events();
      }
  
      events(){
        this.calculateButton.on("click", this.validateForm.bind(this));
        for (let i = 0; i < this.yearTabs.length; i++){
          $(this.yearTabs[i]).on("click", this.changeResultTab.bind(this));
        }
      }
  
      validateForm(e){
        e.preventDefault();
        //check for valid form and run calculation

        this.calculate(e);
      }

      calculate(e){
        this.minuteSalary = (this.moneyRange.value)/60;

        for (let checkbox of this.checkboxes){
          console.log(checkbox.checked);
        }

        this.insertData(e);
      }

      changeResultTab(e){
        for (let i = 0; i < this.yearTabs.length; i++){
          if ($(this.yearTabs[i]).hasClass("tabs__link--active")){
            setTimeout( () => {
            $(this.yearTabs[i]).removeClass("tabs__link--active");
            $(this.yearTabs[i]).addClass("tabs__link--inactive");
            }, 100 );
          }
      }
      if (e.target.localName !== "li"){
        $(e.target).parent().removeClass("tabs__link--inactive");
        $(e.target).parent().addClass("tabs__link--active");
      } else{
        $(e.target).removeClass("tabs__link--inactive");
        $(e.target).addClass("tabs__link--active");
      }
    }

    insertData(e){
      let formdata = {
        firstname: this.firstname.value,
        lastname: this.lastname.value,
        email: this.email.value,
        phone: this.phone.value,
        time: new Date()
      }
      $.ajax({
        url : roi_ajax_script.ajaxurl,
        type : 'post',
        data : {
            action : 'insert_user_data',
            nonce : $(e.target).data("nonce"),
            formdata : formdata
        }
      }).done( function( response ) {
          alert( response );
        }).fail(function() {
          alert( "error" );
        })
    }
  }


const $ = jQuery;
$(function() {
  console.log(new Date());
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
  
  const calculationForm = new RoiForm(checklist.checkboxes, moneyRange, amountRanges, timeRanges);
});


