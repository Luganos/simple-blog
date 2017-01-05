

var slideWidth=275;

var sliderTimer;
$(function(){
$('.slidewrapper').width($('.slidewrapper').children().size()*slideWidth);
 

    $('#next').click(function(){
     
        nextSlide();
    
    });
    $('#prev').click(function(){
      
        prevSlide();
   
    });


function nextSlide(){
    var currentSlide=parseInt($('.slidewrapper').data('current'));
    currentSlide++;
    if(currentSlide < $('.slidewrapper').children().size())
    {
        $('.slidewrapper').animate({left: -currentSlide*slideWidth},275).data('current',currentSlide);     
    }
}

function prevSlide(){
    var currentSlide=parseInt($('.slidewrapper').data('current'));
    currentSlide--;
    if(currentSlide > -1)
    {
	  $('.slidewrapper').animate({left: -currentSlide*slideWidth},275).data('current',currentSlide); 
    }

}
		
			
});




