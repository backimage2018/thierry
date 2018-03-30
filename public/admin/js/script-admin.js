
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

function displayProduct(id) {
	
	$.ajax({
        type: 'POST',
        url: '/product/display',
        data: {id : id}
	})
	.done(function (response, textStatus, jqXHR) {
		
		//let result = '<img src="../img/' + response[0].image.url +'" id="picture-product" alt="">';
		
		
		let result = '<div id="picture-product">';		
		result += '<img src="../../../img/' + response[0].image.url + '" class="img-responsive" id="picture-product" alt="">';
		result += '<div>';
		
		$("#picture-product").html(result);
				
	})
	.fail(function (jqXHR, textStatus, errorThrown) {
  	  
  	  console.log('requête KO');

    })
    .always(function (jqXHR, textStatus, errorThrown) {

    });
	
}
