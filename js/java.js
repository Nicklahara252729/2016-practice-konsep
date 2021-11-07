$(function(){
	$(window).scroll(function(){
		if($(window).scrollTop()> 250){
			$('.header-tengah').css({
				position:'fixed',
				boxShadow:'0px 0px 3px 0px blue',
				top:'0',
				background:'white',
				height:'50px',
			});
			$('.header-tengah ul').fadeIn('slow');
		}else{
			$('.header-tengah').css({
				position:'relative',
				boxShadow:'0px 0px 0px 0px blue',
				background:'white',
			});
			$('.header-tengah ul').fadeOut('slow');
			
		}
	});
});

$(function(){
	$(window).scroll(function(){
		if($(window).scrollTop()>100){
			$('.top').css({
				height:'40px',
			});
		}else{
			$('.top').css({
				height:'0px',
			});
		}
		});
			$('.top').click(function(){
		$('body,html').animate({
				scrollTop:'0'
			},500);
			return true;
			});
	});

$(function(){
    $('.btn-login').click(function(){
        $('.login').css({
        display:'block',
    });
        
    });
    $('.btn-register').click(function(){
        $('.register').css({
            display:'block'
        });
    });
    $('.li-cart').click(function(){
        $('.cart').css({
            display:'block'
        });
    });
    $('.img-profil').click(function(){
        $('.profil').css({
            display:'block'
        });
    });
    $('#addbuku').click(function(){
        $('#tmbhbuku').css({
            right:'0',
        });
    });
    $('#cbuku').click(function(){
        $('#tmbhbuku').css({
            right:'-1100px',
        });
    });
    $('.li-buku').click(function(){
        $('#buku').css({
            display:'block'
        });
        $('#penulis').css({
            display:'none'
        });
        $('#penerbit').css({
            display:'none'
        });
    });
    $('.li-penulis').click(function(){
        $('#buku').css({
            display:'none'
        });
        $('#penulis').css({
            display:'block'
        });
        $('#penerbit').css({
            display:'none'
        });
    });
    $('.li-penerbit').click(function(){
        $('#buku').css({
            display:'none'
        });
        $('#penulis').css({
            display:'none'
        });
        $('#penerbit').css({
            display:'block'
        });
    });
});
	