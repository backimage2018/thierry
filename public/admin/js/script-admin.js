
/*  Ajout stock entrepôt  */

function addQuantityStore(param, quantityStore) {
	
	
	$.ajax({
        type: 'POST',
        url: '/dashboard/stock/add',
        data: {id : param.id, quantityStore : quantityStore}
	})
	.done(function (response, textStatus, jqXHR) {
		
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
		
		console.log('requête reçu');
	})
	.fail(function (jqXHR, textStatus, errorThrown) {
  	  
  	  console.log('requête KO');

    })
    .always(function (jqXHR, textStatus, errorThrown) {

    });
    
}
