$(document).ready(function(){
	$('.closee').click(function(){
		$('.error').hide();
	});
	$('input, textarea').focusin(function()
      {
        input = $(this);
        input.data('place-holder-text', input.attr('placeholder'));
        input.attr('placeholder', '');
      });

      $('input, textarea').focusout(function()
      {
          input = $(this);
          input.attr('placeholder', input.data('place-holder-text'));
      });
      $('.username').val()=='HEllo';
      
});