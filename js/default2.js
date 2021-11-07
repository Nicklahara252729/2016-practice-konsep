$(function(){
    $(window).scroll(function(){
        if($(window).scrollTop()>200){
            $('.top').fadeIn('slow');
            $('#menu').css({
                position:'fixed',
            })
            
        }else{
            $('.top').fadeOut('slow');
            $('#menu').css({
                position:'relative',
            })
        }
    })
    
    $('.top').click(function(){
        $('html,body').animate({
            scrollTop:0
        },1000)
    })
    
})
