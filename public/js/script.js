$(document).ready(function(){

    $("a[href='/newsletter']").click(function(event){
    		
    		event.preventDefault();
    		var position = $("#register-newsletter").offset().top;
    		$("html, body").animate({ scrollTop: position }, 600); 
    		
    		$("#register-newsletter").focus();
  });
 	
    
    $("#btn-newsletter").click(function(event){
    	
    	event.preventDefault();
    	
    	  $.ajax({
            type: 'POST',
            url: '/newsletter',
            data: {email : $("#register-newsletter").val()}
    		
            	
          })
          .done(function (response, textStatus, jqXHR) {
        	  
        	 $("#btn-newsletter").html(response.email);
        	 $("#message-newsletter").html(response.message);

        	 console.log('requête OK');
        	  
        	  
          })
          .fail(function (jqXHR, textStatus, errorThrown) {
        	  
        	  console.log('requête KO');


          })
          .always(function (jqXHR, textStatus, errorThrown) {


          });
   	
    });
    
    $("#btn-review").click(function(event){
    	
    	event.preventDefault();
    	
    	$.ajax({
            type: 'POST',
            url: '/review',
            data: $("#reviewform").serialize()
          })
          .done(function (response, textStatus, jqXHR) {
        	  
         	 $("#response-review").html(response);

         	  console.log('requête OK');
       	  
           })
           .fail(function (jqXHR, textStatus, errorThrown) {
         	  
         	  console.log('requête KO');

           })
           .always(function (jqXHR, textStatus, errorThrown) {

           });
    
    });
    
});

/* Fonction lors de l'ajout d'un produit dans le panier  */

function addProductQuantity(param, quantity, url) {
	
	
	$.ajax({
        type: 'POST',
        url: '/caddie',
        data: {id : param.id, quantity : quantity, url : url}
	})
	.done(function (response, textStatus, jqXHR) {
		
		console.log(typeof(response));
		
	    let caddieObjet = JSON.parse(response);
		
	 	let countCaddie = Object.keys(caddieObjet).length -1;
	 	
	 	console.log(caddieObjet.totalcaddie);
		
		let newContentCaddieHeader = '<li id="cart-ajax" class="header-cart dropdown default-dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">';
		newContentCaddieHeader += '<div class="header-btns-icon"><i class="fa fa-shopping-cart"></i><span class="qty" id="qty-product-caddie"></span></div>';
		newContentCaddieHeader += '<strong class="text-uppercase">My Cart:</strong><br><span>' + caddieObjet.totalcaddie + '</span></a><div class="custom-menu">';
		
		newContentCaddieHeader += '<div id="shopping-cart"><div class="shopping-cart-list">';
		
		let newContentCaddieBody = '';
		
		for (  i = 0;  i < countCaddie; i++) {
			
		newContentCaddieBody += '<div class="product product-widget">';
		newContentCaddieBody += '<div class="product-thumb"><img src="/img/' + caddieObjet[i].product.image.url + '" alt=""></div>';
		newContentCaddieBody += '<div class="product-body">';
		newContentCaddieBody += '<h3 class="product-price">$' + caddieObjet[i].product.price + ' <span class="qty">x' + caddieObjet[i].quantity +'</span></h3>';
		newContentCaddieBody += '<h2 class="product-name"><a href="/product/' + caddieObjet[i].product.id + '">' + caddieObjet[i].product.name + '</a></h2>';
		newContentCaddieBody += '</div><button class="cancel-btn"><i class="fa fa-trash"></i></button></div>';
		
		}
		
		let newContentCaddieFooter = '</div><div class="shopping-cart-btns"><button class="main-btn">View Cart</button><button class="primary-btn">Checkout <i class="fa fa-arrow-circle-right"></i></button></div></div></div></li>';
	  
		result = newContentCaddieHeader + newContentCaddieBody + newContentCaddieFooter;
		
		$('#cart-ajax').html(newContentCaddieHeader + newContentCaddieBody + newContentCaddieFooter);
		$("#qty-product-caddie").html(countCaddie);
		console.log(result);
		
		})
    	
    	
      .fail(function (jqXHR, textStatus, errorThrown) {
    	  
    	  console.log('requête KO');

      })
      .always(function (jqXHR, textStatus, errorThrown) {

      });
    
}

