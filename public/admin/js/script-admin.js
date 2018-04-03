$(document).ready(function(){
	
	 $('#example').DataTable();
	
});



/*  Ajout stock entrepôt  */

function addQuantityStore(param, quantityStore) {
	
	
	$.ajax({
        type: 'POST',
        url: '/dashboard/stock/add',
        data: {id : param.id, quantityStore : quantityStore}
	})
	.done(function (response, textStatus, jqXHR) {
		
		document.location.reload(true);
		console.log('requête reçu');
	})
	.fail(function (jqXHR, textStatus, errorThrown) {
  	  
  	  console.log('requête KO');

    })
    .always(function (jqXHR, textStatus, errorThrown) {

    });
    
}

/*  Ajout stock dans la boutique  */

function addQuantityShop(param, quantityShop) {
	
	
	$.ajax({
        type: 'POST',
        url: '/dashboard/shop/add',
        data: {id : param.id, quantityShop : quantityShop}
	})
	.done(function (response, textStatus, jqXHR) {
		document.location.reload(true);
		console.log('requête reçu');
	})
	.fail(function (jqXHR, textStatus, errorThrown) {
  	  
  	  console.log('requête KO');

    })
    .always(function (jqXHR, textStatus, errorThrown) {

    });
    
}

/*  Affiche thumbail lors de l'appui sur le bouton radio  */

function displayProduct(id) {
	
	$.ajax({
        type: 'POST',
        url: '/product/display',
        data: {id : id}
	})
	.done(function (response, textStatus, jqXHR) {
		
		console.log(response.product)
		
		 
		let result = '<div class="product product-single"><div class="product-thumb">'
			result += '<div class="product-label"><span>' + response.product[0].new + '</span><span class="sale">'+ response.product[0].reduction +'</span></div><button class="main-btn quick-view"><i class="fa fa-search-plus"></i> Quick view</button>'
			result += '<img src="../../../img/' + response.product[0].image.url + '" alt=""></div>'
			result += '<div class="product-body"><h3 class="product-price">$' + response.product[0].price + '<del class="product-old-price">$' + response.product[0].oldprice + '</del></h3>'
			
			result += '<h2 class="product-name"><a href="/product/2">' + response.product[0].name + '</a></h2>'
			result += '</div></div>'
		
	
		
		$("#picture-product").html(result);
				
	})
	.fail(function (jqXHR, textStatus, errorThrown) {
  	  
  	  console.log('requête KO');

    })
    .always(function (jqXHR, textStatus, errorThrown) {

    });
	
}
