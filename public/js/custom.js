function searchDhl () {
	var url = "http://www.dhl.com.ve/es/express/rastreo.html?AWB=";
	var lines = $('.dhl').val().split(/\n/);
	var texts = [];
	var first = 0;
	for (var i=0; i < lines.length; i++) {
	  // only push this line if it contains a non whitespace character.
	  if (/\S/.test(lines[i])) {
	    if(texts.length < 10){
	    	if (first == 1) {
	    		url += "%2C"+$.trim(lines[i]);
	    	}else
	    	{
	    		url += $.trim(lines[i]);
	    		first = 1;
	    	}
	    	texts.push($.trim(lines[i]));
	    }
	  }
	}
	url += "&brand=DHL";
	return url;
}
function startLoadTable (btn) {
	$(btn.data('target')).find('.respone-desc').html('');
	$(btn.data('target')).find('.miniLoader').addClass('active');
}
function loadTable (response, btn) {
	$(btn.data('target')).find('.respone-desc').html(response);
	$(btn.data('target')).find('.miniLoader').removeClass('active');
}
function endTable (btn) {
	$(btn.data('target')).find('.miniLoader').removeClass('active');
}
jQuery(document).ready(function($) {
	$('.btn-elim-shipper').on('click', function(event) {
		$('.elim-title').html('Eliminar remitente');
		addValToElim ($('.btn-elim'), $(this));
	});
	$('.btn-elim-user').on('click', function(event) {
		$('.elim-title').html('Eliminar Usuario');
		addValToElim ($('.btn-elim'), $(this));
	});
	$('.btn-elim-package').on('click', function(event) {
		$('.elim-title').html('Eliminar paquete');
		addValToElim ($('.btn-elim'), $(this));
	});
	$('.change-role').on('click', function(event) {
		$('.btn-change-role').val($(this).val());
	});
	$('.btn-change-role').on('click', function(event) {
		var btn = $(this);
		var dataPost = {
			id  : $(this).val(),
			to_send: $(btn.data('target')).val()
		}
		doAjax(btn.data('url'), 'POST', 'json', dataPost, btn, startAjax, successModalWithInput, ajaxError);
		$(btn.data('target')).val('');
	});
	$('.btn-change-location').on('click', function(event) {
		var btn = $(this);
		var dataPost = {
			id  : $(this).val(),
			to_send: $(btn.data('target')).val()
		}
		doAjax(btn.data('url'), 'POST', 'json', dataPost, btn, startAjax, successModalWithInput, ajaxError);
		$(btn.data('target')).val('');
	});

	$('.btn-recover-pass').on('click', function(event) {
		var btn = $(this);
		var dataPost = {
			to_send: $(btn.data('target')).val()
		}
		doAjax(btn.data('url'), 'GET', 'json', dataPost, btn, startAjax, successModalWithInput, ajaxError);
		$(btn.data('target')).val('');
	});

	$('.show-location').on('click', function(event) {
		var btn = $(this);
		var dataPost = {
			id: btn.val()
		}
		doAjax(btn.data('url'), 'GET', 'html', dataPost, btn, beforeLoadContent, loadContent, ajaxError);
	});
	$('.type').on('change', function(event) {
		var btn = $(this);
		if (btn.val() != "") {
		    var dataPost = {
		      id : btn.val()
		    };
		    doAjax(btn.data('url'), 'GET', 'html', dataPost, btn, beforeSelectLoad, successSelectLoad, endSelectLoadAjax);
		};
	});
	$('.see-extra-details').on('click', function(event) {
		var btn = $(this);
		var dataPost = {
			id : btn.val()
		}
	    doAjax(btn.data('url'), 'GET', 'html', dataPost, btn, startLoadTable, loadTable, endTable);
	});
	$('.dhl').on('keyup', function(event) {
		var code = (e.keyCode ? e.keyCode : e.which);
			if(code == 13) { 
				//Enter keycode
    			searchDhl();
			}
	});
	
	$('.btn-search-dhl').on('click', function(event) {
		if ($('.dhl').val() != "") {
			$(this).attr('href',searchDhl());
			$(this).trigger('click');
		}else{
			event.preventDefault();
		}
		$('.dhl').val('');
	});
});