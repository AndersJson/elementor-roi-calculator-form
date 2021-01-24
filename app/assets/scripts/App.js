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
        this.trapInput = $("#city-input")[0];
        this.moneySavedSpan = $("#roi-money-saved")[0];
        this.hoursSavedSpan = $("#roi-hours-saved")[0];
        this.coulddoCostSpans = $(".could-do__cost");
        this.checkboxes = checklist;
        this.moneyRange = money;
        this.amountRanges = amount;
        this.timeRanges = time;
        this.calculateButton = $("#roi-submit-button");
        //Data-properties
        this.minuteSalary = 0;
        this.oneYearMinutesSaved = 0;
        this.threeYearMinutesSaved = 0;
        this.fiveYearMinutesSaved = 0;
        this.oneYearMoneySaved = 0;
        this.threeYearMoneySaved = 0;
        this.threeYearMoneySaved = 0;
        this.events();
      }
  
      events(){
        $(this.phone).on("keydown", this.isInputNumber);
        this.calculateButton.on("click", this.validateForm.bind(this));
        for (let i = 0; i < this.yearTabs.length; i++){
          $(this.yearTabs[i]).on("click", this.changeResultTab.bind(this));
        }
      }

      isInputNumber(e) {
        let event = String.fromCharCode(e.which);
        if (e.which < 96 || e.keyCode > 105) {
          if (!/[0-9]/.test(event) && e.which !== 8 && e.which !== 189) {
            e.preventDefault();
          }
        }
      }
  
      validateForm(e){
        e.preventDefault();
        //trap-input
        if (this.trapInput.value !== ""){
          return;
        }
        //check for valid form and run calculation
        if (this.validChecklist() && this.validOnlyLetters() && this.validOnlyLetters() && this.validEmail() && this.validPhone() ){
          this.calculate(e);
        } else {
          return;
        }
      }

      validChecklist(){
        for (let checkbox of this.checkboxes){
          if (checkbox.checked){
            return true;
          }
        }
        return false;
      }

      validOnlyLetters(){
        if (this.firstname.value == ""){
          this.firstname.focus();
          return false;
        }
        if (this.lastname.value == ""){
          this.lastname.focus();
          return false;
        }
        
        if (!/^[-\sa-zA-Z]+$/.test(this.firstname.value)){
          this.firstname.focus();
          return false;
        }

        if (!/^[-\sa-zA-Z]+$/.test(this.lastname.value)){
          this.lastname.focus();
          return false;
        }

        return true; 
      }

      validEmail(){
        if (this.email.value == "") {
          this.email.focus();
          return false;
        }

        if (!/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/.test(this.email.value)){
          this.email.focus();
          return false;
        }

        return true;
      }

      validPhone(){
        if (this.phone.value == ""){
          this.phone.focus();
          return false;
        }

        if (this.phone.value.length < 6){
          this.phone.focus();
          return false;
        }

        return true;
      }

      calculate(e){
        this.oneYearMinutesSaved = 0;
        this.threeYearMinutesSaved = 0;
        this.fiveYearMinutesSaved = 0;
        this.oneYearMoneySaved = 0;
        this.threeYearMoneySaved = 0;
        this.fiveYearMoneySaved = 0;

        if (this.minuteSalary == 0){
          this.minuteSalary = (this.moneyRange.value)/60;
        }

        for (let i = 0; i < this.checkboxes.length; i++){

          if (this.checkboxes[i].checked){
            let savePercent = $(this.checkboxes[i]).data("save")/100;
            //calculate time saved in hours for current tab of years
            this.oneYearMinutesSaved += Math.floor(((Number(this.timeRanges[i].value) * Number(this.amountRanges[i].value)) * 12) * savePercent);
            this.threeYearMinutesSaved += Math.floor(((Number(this.timeRanges[i].value) * Number(this.amountRanges[i].value)) * 36) * savePercent);
            this.fiveYearMinutesSaved += Math.floor(((Number(this.timeRanges[i].value) * Number(this.amountRanges[i].value)) * 60) * savePercent);

            //calculate money saved for current tab of years
            this.oneYearMoneySaved += Math.floor((((Number(this.timeRanges[i].value) * Number(this.amountRanges[i].value)) * 12) * savePercent) * this.minuteSalary );
            this.threeYearMoneySaved += Math.floor((((Number(this.timeRanges[i].value) * Number(this.amountRanges[i].value)) * 36)* savePercent) * this.minuteSalary );
            this.fiveYearMoneySaved += Math.floor((((Number(this.timeRanges[i].value) * Number(this.amountRanges[i].value)) * 60)* savePercent) * this.minuteSalary );
          }
        }

        this.displayMoneySaved(1);

        //this.insertData(e);
      }

      insertData(e){
      let formdata = {
        firstname: this.firstname.value,
        lastname: this.lastname.value,
        email: this.email.value,
        phone: this.phone.value      
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

      changeResultTab(e){
        if (e.target.localName !== "li" && $(e.target).parent().hasClass("tabs__link--active")){
          return;
        } else if (e.target.localName == "li" && $(e.target).hasClass("tabs__link--active")){
          return;
        }

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

      //display result-data for the clicked year-tab
      if (e.target.localName !== "li"){
        if ($(e.target).parent().data("time") == "12"){
          this.displayMoneySaved(1);
        }else if ($(e.target).parent().data("time") == "36"){
          this.displayMoneySaved(3);
        }else if ($(e.target).parent().data("time") == "60"){
          this.displayMoneySaved(5);
        }
      }
      else{
        if ($(e.target).data("time") == "12"){
          this.displayMoneySaved(1);
        }else if ($(e.target).data("time") == "36"){
          this.displayMoneySaved(3);
        }else if ($(e.target).data("time") == "60"){
          this.displayMoneySaved(5);
        }
      } 
    }

    displayMoneySaved(years){
      let output;

      if (years == 1){ 
        if (this.oneYearMoneySaved >= 1000){
          output = `${Number((this.oneYearMoneySaved/1000).toFixed(1))}k`
        }else{
          output = this.oneYearMoneySaved;
        }
        
        $(this.moneySavedSpan).html(output);
      }

      if (years == 3){ 
        if (this.threeYearMoneySaved >= 1000){
          output = `${Number((this.threeYearMoneySaved/1000).toFixed(1))}k`
        }else{
          output = this.threeYearMoneySaved;
        }
        
        $(this.moneySavedSpan).html(output);
      }

      if (years == 5){ 
        if (this.fiveYearMoneySaved >= 1000){
          output = `${Number((this.fiveYearMoneySaved/1000).toFixed(1))}k`
        }else{
          output = this.fiveYearMoneySaved;
        }
        
        $(this.moneySavedSpan).html(output);
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
  
  const calculationForm = new RoiForm(checklist.checkboxes, moneyRange, amountRanges, timeRanges);
});


