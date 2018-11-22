$(document).ready(function() {
  $(".container").click(function() {
    $(".stick").toggleClass(function () {
    	if ($(this).is('.open, .close')){
    		 $("ul").toggleClass('RR');
    		return 'open close';
    	}
    	else{
			$("ul").toggleClass('RR');
    		return 'open';
    	}


      return $(this).is('.open, .close') ? 'open close' : 'open';
    	
    });
  });
});