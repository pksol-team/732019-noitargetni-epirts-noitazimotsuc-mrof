/*custom js*/

$(document).ready(function(){
	
	$('.accordian-head').click(function(){
 		if($(this).parents('.row').parents('.box').hasClass('active')){
			$('.accordian-head').children('.arrow').removeClass('show');
			$(this).parents('.row').next('.row').children('.contents').slideUp(function(){
				$(this).parents('.row').parents('.box').removeClass('active');
			})
			
		  }
		else
		{
		  $('.accordian-head').children('.arrow').removeClass('show');
		  $('.accordian-head').parents('.row').next('.row').children('.contents').slideUp()
		$(this).parents('.row').next('.row').children('.contents').slideDown()
		$('.accordian-head').parents('.row').parents('.box').removeClass('active');
		$(this).children('.arrow').addClass('show');
		$(this).parents('.row').parents('.box').addClass('active');
	  	}
		
	})
	$('.country-ul li').click(function(){
	
$('.html').html('');
    var ref=$(this).attr('class');
	
	var html=$('[data-text="'+ref+'"]').clone();
	$('.html').html(html);
	$('.html [data-text="'+ref+'"]').removeClass('hidden');
	
  })
	})



$('.nav li a').click(function(){
	$(this).next('ul').toggle();
	
})  
  