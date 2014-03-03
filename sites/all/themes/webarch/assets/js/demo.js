$(document).ready(function() {		
	//$('#left-panel').addClass('animated bounceInRight');
	// $('#project-progress').css('width', '50%');
	$('#msgs-badge').addClass('animated bounceIn');	
	$('#my-task-list').popover({
		html:true			
	});
  $('.tip').tooltip();
  $('.slider-element').slider();

  $('#project-capacity').easyPieChart({
    lineWidth:4,
    barColor:'#7dc6ec',
    trackColor:'#e5e9ec',
    scaleColor:false,
    lineCap: 'butt',
  });
  $('#project-progress').easyPieChart({
    lineWidth:4,
    barColor:'#0AA699',
    trackColor:'#e5e9ec',
    scaleColor:false,
    lineCap: 'butt',
  });  

});