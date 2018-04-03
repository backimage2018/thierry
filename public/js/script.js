$(document).ready(function(){
	
	
	/* Scroll vers l'input newsletter */

    $("a[href='/newsletter']").click(function(event){
    		
    		event.preventDefault();
    		var position = $("#register-newsletter").offset().top;
    		$("html, body").animate({ scrollTop: position }, 600); 
    		
    		$("#register-newsletter").focus();
  });
    
    /* Inscription à la newsletter */
    
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
    
    
    /* Commentaire sur un produit */
    
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

function addProductQuantity(param, quantity) {
	
	
	$.ajax({
        type: 'POST',
        url: '/caddie/add',
        data: {id : param.id, quantity : quantity}
	})
	.done(function (response, textStatus, jqXHR) {
		
		
		displayCaddie(response);
		document.location.reload(true);
		
		
		})
    	
    	
      .fail(function (jqXHR, textStatus, errorThrown) {
    	  
    	  console.log('requête KO');

      })
      .always(function (jqXHR, textStatus, errorThrown) {

      });
    
}

/* Fonction lors de la mise à jour d'un produit dans le panier depuis order-review */

function updateProductQuantity(param, quantity) {
	
	
	$.ajax({
        type: 'POST',
        url: '/order-review/caddie',
        data: {id : param.id, quantity : quantity}
	})
	.done(function (response, textStatus, jqXHR) {
		
		document.location.reload(true);
		
/*		let countItems = response['items'].length;
		
		displayCaddie(response);
		
		
		let newContentTab = '<div class="order-summary clearfix" id="tab-order-review"><div class="section-title"><h3 class="title">Order Review</h3></div>';
		newContentTab += '<table class="shopping-cart-table table">';
		newContentTab += '<thead><tr><th>Product</th><th></th><th class="text-center">Price</th><th class="text-center">Quantity</th>';
		newContentTab += '<th class="text-center">Total</th><th class="text-right"></th></tr></thead>';
		newContentTab += '<tbody id="tab-order-review">';
			
		for (  i = 0;  i < countItems; i++) {
		
		newContentTab += '<tr><td class="thumb"><img src="/img/' + response['items'][i].product.image.url + '" alt=""></td><td class="details">';
		newContentTab += '<a href="#">'+ response['items'][i].product.name +'</a><ul><li><span>'+ response['items'][i].product.size +'</span></li><li><span>' + response['items'][i].product.color + '</span></li>'
		newContentTab += '</ul></td><td class="price text-center"><strong>' + response['items'][i].product.price + '</strong><br><del class="font-weak"><small>' + response['items'][i].product.oldprice + '</small></del></td>'
		newContentTab += '<td class="qty text-center"><input class="input" id="' + response['items'][i].product.id + '" name="' + response['items'][i].product.id + '" type="number" min="1" value="' + response['items'][i].quantity + '" onchange="updateProductQuantity(this, this.value);"></td>'
		newContentTab += '<td class="total text-center"><strong class="primary-color">' + response['total-caddie'] + '</strong></td>'
		newContentTab += '<td class="text-right"><button class="main-btn icon-btn"><i class="fa fa-close"></i></button></td></tr>'
		
		}
		newContentTab += '</tbody>';
		
		newContentTab += '<tfoot><tr><th class="empty" colspan="3"></th><th>SUBTOTAL</th><th colspan="2" class="sub-total">$' + response['total-caddie'] + '</th></tr>';
		newContentTab += '<tr><th class="empty" colspan="3"></th><th>SHIPING</th><td colspan="2">Free Shipping</td></tr><tr>';
		newContentTab += '<th class="empty" colspan="3"></th><th>TOTAL</th><th colspan="2" class="total">$' + response['total-caddie'] + '</th></tr></tfoot></table>';
		newContentTab += '<div class="pull-right"><button class="primary-btn">Place Order</button></div></div>';
		
			$("#tab-order-review").html(newContentTab); */
		
		
		})
    	
    	
      .fail(function (jqXHR, textStatus, errorThrown) {
    	  
    	  console.log('requête KO');

      })
      .always(function (jqXHR, textStatus, errorThrown) {

      });
    
}


function displayCaddie(response) {
	
	let countItems = response['items'].length;
	
	let newContentCaddieHeader = '<li id="cart-ajax" class="header-cart dropdown default-dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">';
	newContentCaddieHeader += '<div class="header-btns-icon"><i class="fa fa-shopping-cart"></i><span class="qty" id="qty-product-caddie"></span></div>';
	newContentCaddieHeader += '<strong class="text-uppercase">My Cart:</strong><br><span id="total-caddie"></span></a><div class="custom-menu">';
	newContentCaddieHeader += '<div id="shopping-cart"><div class="shopping-cart-list">';
	
	let newContentCaddieBody = '';
	
	for (  i = 0;  i < countItems; i++) {
		
	newContentCaddieBody += '<div class="product product-widget">';
	newContentCaddieBody += '<div class="product-thumb"><img src="/img/' + response['items'][i].product.image.url + '" alt=""></div>';
	newContentCaddieBody += '<div class="product-body">';
	newContentCaddieBody += '<h3 class="product-price">$' + response['items'][i].product.price + ' <span class="qty">x' + response['items'][i].quantity +'</span></h3>';
	newContentCaddieBody += '<h2 class="product-name"><a href="/product/' + response['items'][i].product.id + '">' + response['items'][i].product.name + '</a></h2>';
	newContentCaddieBody += '</div><button class="cancel-btn"><i class="fa fa-trash" id="' + response['items'][i].product.id + '" onclick="deletedProduct(this);"></i></button></div>';
	
	}
	
	let newContentCaddieFooter = '</div><div class="shopping-cart-btns"><button class="main-btn">View Cart</button><button class="primary-btn">Checkout <i class="fa fa-arrow-circle-right"></i></button></div></div></div></li>';
  
	result = newContentCaddieHeader + newContentCaddieBody + newContentCaddieFooter;
	
	$('#cart-ajax').html(newContentCaddieHeader + newContentCaddieBody + newContentCaddieFooter);
	$("#qty-product-caddie").html(countItems);
	$("#total-caddie").html(response['total-caddie'] + '$' );
	
	
	return response;
	
}


/* Fonction lors de l'appui sur la poubelle pour supprimer produit */


function deletedProduct(param) {
	
	$.ajax({
        type: 'POST',
        url: '/caddie/deleted',
        data: {id : param.id}
	})
	
	.done(function (response, textStatus, jqXHR) {
		
		displayCaddie(response);
		
	});
	
}	

