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
        this.checklistWrapper = $("#roi-checklist-wrapper");
        this.rangewrappers = $(".checklist-rangewrapper");
        this.events();
      }
      events() {
        for (let i = 0; i < this.checkboxes.length; i++){
          $(this.checkboxes[i]).change(()=>{
            {
              if ($(this.checkboxes[i]).is(':checked') ){
                  $(this.rangewrappers[i]).slideDown();
                  if ($(this.checklistWrapper).hasClass("roi-invalid")){
                    $(this.checklistWrapper).removeClass("roi-invalid");
                  }
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
        this.moneySavedSpan = $("#roi-money-saved")[0];
        this.hoursSavedSpan = $("#roi-hours-saved")[0];
        this.coulddoCostSpans = $(".could-do__cost");
        this.roiResult = $("#roi-results");
        this.resultHeading = $("#roi-result-heading")[0];
        this.checkboxes = checklist;
        this.moneyRange = money;
        this.amountRanges = amount;
        this.timeRanges = time;
        this.calculateButton = $("#roi-submit-button");
        this.checklistWrapper = $("#roi-checklist-wrapper");

        //Data-properties
        this.sendNotificationEmailAdresses = $("#roi-calculation-form").data("notification");
        this.minuteSalary = 0;
        this.hourSalary = 0;
        this.oneYearMinutesSaved = 0;
        this.threeYearMinutesSaved = 0;
        this.fiveYearMinutesSaved = 0;
        this.oneYearMoneySaved = 0;
        this.threeYearMoneySaved = 0;
        this.threeYearMoneySaved = 0;
        this.oneYearHoursDisplay = 0;
        this.threeYearHoursDisplay = 0;
        this.fiveYearHoursDisplay = 0;
        this.oneYearMoneyDisplay = 0;
        this.threeYearMoneyDisplay = 0;
        this.fiveYearMoneyDisplay = 0;
        this.oneYearHoursDisplay = 0;
        this.threeYearHoursDisplay = 0;
        this.fiveYearHoursDisplay = 0;


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
          if (!/[0-9]/.test(event) && e.which !== 8 && e.which !== 189 && e.which !== 37 && e.which !== 39 && e.which !== 46) {
            e.preventDefault();
          }
        }
      }
  
      validateForm(e){
        e.preventDefault();

        let invalid = $(".roi-invalid");
        for (let i = 0; i < invalid.length; i++){
          $(invalid[i]).removeClass("roi-invalid");
        }

        //check for valid form and run calculation
        if (this.validChecklist() && this.validOnlyLetters() && this.validOnlyLetters() && this.validEmail() && this.validPhone() ){
          this.calculate(e);
          $(this.calculateButton).html($(this.calculateButton).data("loading"));
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
        $(this.checklistWrapper).addClass("roi-invalid");
        return false;
      }

      validOnlyLetters(){
        if (this.firstname.value == ""){
          this.firstname.focus();
          $(this.firstname).addClass("roi-invalid");
          return false;
        }
        if (this.lastname.value == ""){
          this.lastname.focus();
          $(this.lastname).addClass("roi-invalid");
          return false;
        }
        
        if (!/^[-\sa-zA-ZåäöÅÄÖ]+$/.test(this.firstname.value)){
          this.firstname.focus();
          $(this.firstname).addClass("roi-invalid");
          return false;
        }

        if (!/^[-\sa-zA-ZåäöÅÄÖ]+$/.test(this.lastname.value)){
          this.lastname.focus();
          $(this.lastname).addClass("roi-invalid");
          return false;
        }

        return true; 
      }

      validEmail(){
        if (this.email.value == "") {
          this.email.focus();
          $(this.email).addClass("roi-invalid");
          return false;
        }

        if (!/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/.test(this.email.value)){
          this.email.focus();
          $(this.email).addClass("roi-invalid");
          return false;
        }

        return true;
      }

      validPhone(){
        if (this.phone.value == ""){
          this.phone.focus();
          $(this.phone).addClass("roi-invalid");
          return false;
        }

        if (this.phone.value.length < 6){
          this.phone.focus();
          $(this.phone).addClass("roi-invalid");
          return false;
        }

        return true;
      }

      firstLetterCapitol(string){
        let output = string.toLowerCase();
        return output.charAt(0).toUpperCase() + output.slice(1);
      }

      calculate(e){
        this.oneYearMinutesSaved = 0;
        this.threeYearMinutesSaved = 0;
        this.fiveYearMinutesSaved = 0;
        this.oneYearMoneySaved = 0;
        this.threeYearMoneySaved = 0;
        this.fiveYearMoneySaved = 0;
        this.oneYearMoneyDisplay = 0;
        this.threeYearMoneyDisplay = 0;
        this.threeYearMoneyDisplay = 0;
        this.oneYearHoursDisplay = 0;
        this.threeYearHoursDisplay = 0;
        this.fiveYearHoursDisplay = 0;


        if (this.minuteSalary == 0){
          this.minuteSalary = (this.moneyRange.value)/60;
          this.hourSalary = this.moneyRange.value;
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
          
            //hours to display
            this.oneYearHoursDisplay += Math.round(this.oneYearMinutesSaved/60);
            this.threeYearHoursDisplay += Math.round(this.threeYearMinutesSaved/60);
            this.fiveYearHoursDisplay += Math.round(this.fiveYearMinutesSaved/60);

            //money to display
            this.oneYearMoneyDisplay += Math.round(this.oneYearHoursDisplay * this.hourSalary);
            this.threeYearMoneyDisplay += Math.round(this.threeYearHoursDisplay * this.hourSalary);
            this.fiveYearMoneyDisplay += Math.round(this.fiveYearHoursDisplay * this.hourSalary);

          }
        }


        this.displayMoneySaved(1);
        this.displayTimeSaved(1);
        this.displayCouldDo(1);

        this.insertData(e);
      }

    sendNotificationEmail(){
      if (this.sendNotificationEmailAdresses && this.sendNotificationEmailAdresses !== ''){
        let testArray = this.sendNotificationEmailAdresses.replace(/\s+/g, '').split(",");

        for (let i = 0; i < testArray.length; i++){
          if ( !/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/.test(testArray[i]) ){
            console.log("Falsy email-adresses for notification.");
            return false;
          }
        }
          

        let firstname = this.firstLetterCapitol(this.firstname.value);
        let lastname = this.firstLetterCapitol(this.lastname.value);
        let email = this.email.value.toLowerCase();
        let phone = this.phone.value;
        let to = this.sendNotificationEmailAdresses;

        let subject = 'ROI Calculation-form submitted';
        let rawMessage = `The ROI Calculation-form was just submitted by:

        ${firstname} ${lastname}
        ${email}
        ${phone}

        
        This is an automatically sent notification to inform you that your ROI Calculator-form has been submitted.

        <i>If you wish to change the email-adress or add more email-adresses to recieve these notification please go to the Elementor settings-screen of this widget.</i>
        `;

        let message = rawMessage.replace(/\r\n|\r|\n/g, "<br>");

        let myClass = this;
          $.ajax({
            url : roi_ajax_script.ajaxurl,
            type : 'post',
            data : {
                action : 'send_notification_mail',
                send : 'yes',
                to : to,
                subject : subject,
                message : message
            }
          }).done(function() {

            }).fail(function(response) {
              console.log(response);
            })

      }else{
        return;
      }
      
    }

      insertData(e){
      let formdata = {
        firstname: this.firstLetterCapitol(this.firstname.value),
        lastname: this.firstLetterCapitol(this.lastname.value),
        email: this.email.value.toLowerCase(),
        phone: this.phone.value      
      }

      let myClass = this;

      $.ajax({
        url : roi_ajax_script.ajaxurl,
        type : 'post',
        data : {
            action : 'insert_user_data',
            nonce : $(e.target).data("nonce"),
            formdata : formdata
        }
      }).done( function( response ) {
          $(myClass.roiResult).removeClass("hidden");
          //Scroll down to result
          setTimeout( () =>{
            $(myClass.calculateButton).html($(myClass.calculateButton).data("default"));
            $("html, body").animate({
              scrollTop: ($(myClass.resultHeading).offset().top) - 50
            }, 1000 );
          }, 600 );
          myClass.sendNotificationEmail();
        }).fail(function(response) {
          $(myClass.calculateButton).html($(myClass.calculateButton).data("default"));
          console.log(response);
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
          this.displayTimeSaved(1);
          this.displayCouldDo(1);
        }else if ($(e.target).parent().data("time") == "36"){
          this.displayMoneySaved(3);
          this.displayTimeSaved(3);
          this.displayCouldDo(3);
        }else if ($(e.target).parent().data("time") == "60"){
          this.displayMoneySaved(5);
          this.displayTimeSaved(5);
          this.displayCouldDo(5);
        }
      }
      else{
        if ($(e.target).data("time") == "12"){
          this.displayMoneySaved(1);
          this.displayTimeSaved(1);
          this.displayCouldDo(1);
        }else if ($(e.target).data("time") == "36"){
          this.displayMoneySaved(3);
          this.displayTimeSaved(3);
          this.displayCouldDo(3);
        }else if ($(e.target).data("time") == "60"){
          this.displayMoneySaved(5);
          this.displayTimeSaved(5);
          this.displayCouldDo(5);
        }
      } 
    }

    displayMoneySaved(years){
      let output;

      if (years == 1){ 
        if (this.oneYearMoneyDisplay >= 1000){
          output = `${Number((this.oneYearMoneyDisplay/1000).toFixed(1))}k`;
          if (output[output.length - 1] == "0"){
            output = `${(this.oneYearMoneyDisplay/1000).toFixed(0)}k`; 
          }
        }else{
          output = this.oneYearMoneyDisplay;
        }
        
        $(this.moneySavedSpan).html(output);
      }

      if (years == 3){ 
        if (this.threeYearMoneyDisplay >= 1000){
          output = `${Number((this.threeYearMoneyDisplay/1000).toFixed(1))}k`;
          if (output[output.length - 1] == "0"){
            output = `${(this.threeYearMoneyDisplay/1000).toFixed(0)}k`; 
          }
        }else{
          output = this.threeYearMoneyDisplay;
        }
        
        $(this.moneySavedSpan).html(output);
      }

      if (years == 5){ 
        if (this.fiveYearMoneyDisplay >= 1000){
          output = `${Number((this.fiveYearMoneyDisplay/1000).toFixed(1))}k`;
          if (output[output.length - 1] == "0"){
            output = `${(this.fiveYearMoneyDisplay/1000).toFixed(0)}k`; 
          }
        }else{
          output = this.fiveYearMoneyDisplay;
        }
        
        $(this.moneySavedSpan).html(output);
      }
    }

    displayTimeSaved(years){
      let output;

      if (years == 1){ 
        output = this.oneYearHoursDisplay;        
        $(this.hoursSavedSpan).html(output);
      }

      if (years == 3){ 
        output = this.threeYearHoursDisplay;        
        $(this.hoursSavedSpan).html(output);
      }

      if (years == 5){ 
        output = this.fiveYearHoursDisplay;        
        $(this.hoursSavedSpan).html(output);
      }
    }

    displayCouldDo(years){
      let output;
      if (years == 1){ 
        for (let i = 0; i < this.coulddoCostSpans.length; i++){
          if ($(this.coulddoCostSpans[i]).data("cost") !== undefined){
            output = Math.round(this.oneYearMoneySaved / Number($(this.coulddoCostSpans[i]).data("cost")));
          }else{
            output = Math.round(this.oneYearMinutesSaved / Number($(this.coulddoCostSpans[i]).data("time")));  
          }

          $(this.coulddoCostSpans[i]).html(output);
        }
      }else if (years == 3){ 
        for (let i = 0; i < this.coulddoCostSpans.length; i++){
          if ($(this.coulddoCostSpans[i]).data("cost") !== undefined){
            output = Math.round(this.threeYearMoneySaved / Number($(this.coulddoCostSpans[i]).data("cost")));
          }else{
            output = Math.round(this.threeYearMinutesSaved / Number($(this.coulddoCostSpans[i]).data("time")));  
          }
          
          $(this.coulddoCostSpans[i]).html(output);
        }
      }else if (years == 5){ 
        for (let i = 0; i < this.coulddoCostSpans.length; i++){
          if ($(this.coulddoCostSpans[i]).data("cost") !== undefined){
            output = Math.round(this.fiveYearMoneySaved / Number($(this.coulddoCostSpans[i]).data("cost")));
          }else{
            output = Math.round(this.fiveYearMinutesSaved / Number($(this.coulddoCostSpans[i]).data("time")));  
          }
          
          $(this.coulddoCostSpans[i]).html(output);
        }
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


