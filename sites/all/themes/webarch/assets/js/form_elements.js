//Cool ios7 switch - Beta version
//Done using pure Javascript
var Switch = require('ios7-switch')
        , checkbox = document.querySelector('.ios')
        , mySwitch = new Switch(checkbox);
     var checked = checkbox.getAttribute('checked');
    if (checked) mySwitch.toggle();
      mySwitch.el.addEventListener('click', function(e){
        e.preventDefault();
        mySwitch.toggle();
      }, false);
	  
function format(state) {
  if (!state.id) return state.text;
  return "<i class='fa fa-" + state.text.toLowerCase() + "'></i> " + state.text;
}

$(document).ready(function(){
	  //Dropdown menu - select2 plug-in
	  // $("#source").select2();
	  
	  //Multiselect - Select2 plug-in
	  // $("#multi").val(["Jim","Lucy"]).select2();

    $("#icon-select").select2({
      formatResult: format,
      formatSelection: format,
      escapeMarkup: function(m) { return m; }
    });
	  
	  //Date Pickers
	  $('.input-append.date').datepicker({
				autoclose: true,
				todayHighlight: true
	   });
	 
  $('.slider-element').slider()
    .on('slide', function(ev) {
      $('#progress').val(ev.value);
      if ((mySwitch.input.checked && (ev.value != 100)) || 
        (!mySwitch.input.checked && (ev.value == 100)))
        mySwitch.toggle();
    });

	 // $('#dp5').datepicker();
	 
	 // $('#sandbox-advance').datepicker({
		// 	format: "dd/mm/yyyy",
		// 	startView: 1,
		// 	daysOfWeekDisabled: "3,4",
		// 	autoclose: true,
		// 	todayHighlight: true
  //   });
	
	//Time pickers
	$('.timepicker-default').timepicker();
    $('.timepicker-24').timepicker({
      minuteStep: 30,
      showSeconds: false,
      showMeridian: false
     });
	//Color pickers
	// $('.my-colorpicker-control').colorpicker()
	
	//Input mask - Input helper
	// $(function($){
	//    $("#date").mask("99/99/9999");
	//    $("#phone").mask("(999) 999-9999");
	//    $("#tin").mask("99-9999999");
	//    $("#ssn").mask("999-99-9999");
	// });
	
	//Autonumeric plug-in - automatic addition of dollar signs,etc controlled by tag attributes
	$('.auto').autoNumeric('init');
	
	//HTML5 editor
	$('#text-editor').wysihtml5();
	
	//Drag n Drop up-loader
	// $("div#myId").dropzone({ url: "/file/post" });
	
	//Single instance of tag inputs  -  can be initiated with simply using data-role="tagsinput" attribute in any input field
	// $('#source-tags').tagsinput({
	// 	typeahead: {
	// 		source: ['Amsterdam', 'Washington', 'Sydney', 'Beijing', 'Cairo']
	// 	}	
	// });
});