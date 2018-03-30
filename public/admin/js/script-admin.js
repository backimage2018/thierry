


/*  Ajout stock entrepôt  */

/* Fonction lors de la mise à jour d'un produit dans le panier depuis order-review */

function addQuantityStore(param, quantityStore) {
	
	
	$.ajax({
        type: 'POST',
        url: '/dashboard/stock/add',
        data: {id : param.id, quantityStore : quantityStore}
	})
	.done(function (response, textStatus, jqXHR) {
		
		console.log('requête reçu');
	})
    
}
