jQuery(function($){
		
	var loadContentClass = function (){
		if(window.location.pathname == '/lojas/'){
			$.ajax({
					//beforeSend: function() {$("#list_publicacoes").html('<div class="carregando"><span>Carregando</span></div>');},
					type : "POST",
					url  : "/wp-admin/admin-ajax.php",
					data : {
						action 	: "loadContentFirstElement",
					}
				}).done(function(data){
					//$(".info-map").html(data);
				});
		}
		
		$(document).on('click','.jcarousel-clip', function(){
			var firstClass = $(".cspm_carousel_first_item").attr('class').split(' ')[0];
			
			$.ajax({
					//beforeSend: function() {$("#list_publicacoes").html('<div class="carregando"><span>Carregando</span></div>');},
					type : "POST",
					url  : "/wp-admin/admin-ajax.php",
					data : {
						action 	: "loadContentClass",
						id 		: firstClass
					}
				}).done(function(data){
					//$(".info-map").html(data);
				});
			
		});

		window['aux_cspm_carousel_itemLoadCallback']= function() {
			var firstClass = $(".cspm_carousel_first_item").attr('class')||'';
			firstClass=firstClass.split(' ')[0]||'';
			
			if(firstClass){
				$.ajax({
					//beforeSend: function() {$("#list_publicacoes").html('<div class="carregando"><span>Carregando</span></div>');},
					type : "POST",
					url  : "/wp-admin/admin-ajax.php",
					data : {
						action 	: "loadContentClass",
						id 		: firstClass
					}
				}).done(function(data){
					//$(".info-map").html(data);
				});
			}
		};
		
		};
	
	var changeLink = function (){
		$(document).on('mouseover','.cspm_infobox_img > a',function(){
			/*$(this).attr('href','javascript:void(0)');*/
			$(this).attr('target','_blank');
		});

		$(document).on('mouseover','.details_btn',function(){
			/*$(this).attr('href','javascript:void(0)');*/
		});
	};

	$(document).ready(function() {
 		loadContentClass();
		changeLink();
    });
});