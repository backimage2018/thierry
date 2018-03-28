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
        url: '/caddie',
        data: {id : param.id, quantity : quantity}
	})
	.done(function (response, textStatus, jqXHR) {
		
		// let caddieObjet = JSON.parse(response);
		// let countCaddie = Object.keys(caddieObjet).length -1;
		
		let caddie = response;
		
		console.log(caddie[0].quantity);
	 	
	 	let newContentCaddieHeader = '<li id="cart-ajax" class="header-cart dropdown default-dropdown"><a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">';
		newContentCaddieHeader += '<div class="header-btns-icon"><i class="fa fa-shopping-cart"></i><span class="qty" id="qty-product-caddie"></span></div>';
		newContentCaddieHeader += '<strong class="text-uppercase">My Cart:</strong><br><span>A CORRIGER</span></a><div class="custom-menu">';
		newContentCaddieHeader += '<div id="shopping-cart"><div class="shopping-cart-list">';
		
		let newContentCaddieBody = '';
		
		for (  i = 0;  i < response.length; i++) {
			
		newContentCaddieBody += '<div class="product product-widget">';
		newContentCaddieBody += '<div class="product-thumb"><img src="/img/' + caddie[i].product.image.url + '" alt=""></div>';
		newContentCaddieBody += '<div class="product-body">';
		newContentCaddieBody += '<h3 class="product-price">$' + caddie[i].product.price + ' <span class="qty">x' + caddie[i].quantity +'</span></h3>';
		newContentCaddieBody += '<h2 class="product-name"><a href="/product/' + caddie[i].product.id + '">' + caddie.product.name + '</a></h2>';
		newContentCaddieBody += '</div><button class="cancel-btn"><i class="fa fa-trash"></i></button></div>';
		
		}
		
		let newContentCaddieFooter = '</div><div class="shopping-cart-btns"><button class="main-btn">View Cart</button><button class="primary-btn">Checkout <i class="fa fa-arrow-circle-right"></i></button></div></div></div></li>';
	  
		result = newContentCaddieHeader + newContentCaddieBody + newContentCaddieFooter;
		
		$('#cart-ajax').html(newContentCaddieHeader + newContentCaddieBody + newContentCaddieFooter);
		$("#qty-product-caddie").html(caddie.length);
		
		
		
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
		
		let caddieObjet = JSON.parse(response);
		let countCaddie = Object.keys(caddieObjet).length -1;
	 	
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
		
		
		let newContentTab = '<div class="order-summary clearfix" id="tab-order-review"><div class="section-title"><h3 class="title">Order Review</h3></div>';
		newContentTab += '<table class="shopping-cart-table table">';
		newContentTab += '<thead><tr><th>Product</th><th></th><th class="text-center">Price</th><th class="text-center">Quantity</th>';
		newContentTab += '<th class="text-center">Total</th><th class="text-right"></th></tr></thead>';
		newContentTab += '<tbody id="tab-order-review">';
			
		for (  i = 0;  i < countCaddie; i++) {
		
		newContentTab += '<tr><td class="thumb"><img src="/img/' + caddieObjet[i].product.image.url + '" alt=""></td><td class="details">';
		newContentTab += '<a href="#">'+ caddieObjet[i].product.name +'</a><ul><li><span>'+ caddieObjet[i].product.size +'</span></li><li><span>' + caddieObjet[i].product.color + '</span></li>'
		newContentTab += '</ul></td><td class="price text-center"><strong>' + caddieObjet[i].product.price + '</strong><br><del class="font-weak"><small>' + caddieObjet[i].product.oldprice + '</small></del></td>'
		newContentTab += '<td class="qty text-center"><input class="input" id="' + caddieObjet[i].product.id + '" name="' + caddieObjet[i].product.id + '" type="number" min="1" value="' + caddieObjet[i].quantity + '" onchange="updateProductQuantity(this, this.value);"></td>'
		newContentTab += '<td class="total text-center"><strong class="primary-color">' + caddieObjet[i].total + '</strong></td>'
		newContentTab += '<td class="text-right"><button class="main-btn icon-btn"><i class="fa fa-close"></i></button></td></tr>'
		
		}
		newContentTab += '</tbody>';
		
		newContentTab += '<tfoot><tr><th class="empty" colspan="3"></th><th>SUBTOTAL</th><th colspan="2" class="sub-total">$' + caddieObjet.totalcaddie + '</th></tr>';
		newContentTab += '<tr><th class="empty" colspan="3"></th><th>SHIPING</th><td colspan="2">Free Shipping</td></tr><tr>';
		newContentTab += '<th class="empty" colspan="3"></th><th>TOTAL</th><th colspan="2" class="total">$' + caddieObjet.totalcaddie + '</th></tr></tfoot></table>';
		newContentTab += '<div class="pull-right"><button class="primary-btn">Place Order</button></div></div>';
		
			$("#tab-order-review").html(newContentTab);
		
		
		})
    	
    	
      .fail(function (jqXHR, textStatus, errorThrown) {
    	  
    	  console.log('requête KO');

      })
      .always(function (jqXHR, textStatus, errorThrown) {

      });
    
}

