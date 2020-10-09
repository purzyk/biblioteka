jQuery(document).ready(function( $ ) {
	
    $('.module__ksiazki_lista ul li > a > div:first-child > img').hover( function() { 
        $('.module__ksiazki_lista h2').toggleClass('z-index-0'); 
    });
    
    
    $('.ksiazki_lista-dbs article figure').on('mouseenter', function(){
        $(this).prev().toggleClass('show-excerpt'); 
    });
    
    $('.ksiazki_lista-dbs article .excerpt').on('mouseleave', function(){
        $('.ksiazki_lista-dbs article .excerpt').removeClass('show-excerpt');
    });
	
});