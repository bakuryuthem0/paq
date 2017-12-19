function getRootUrl () {
  return $('.baseUrl').val();
}
function activeteStatus (inp,toHidden,toShow,toRemove,toAdd) {
	inp.prevAll(toHidden).addClass('hidden');
	inp.prevAll(toShow).removeClass('hidden');
	inp.parent().removeClass(toRemove);
	inp.parent().addClass(toAdd);
	inp.nextAll('.form-control-feedback').addClass('active');
}
function startAjax (btn) {
	btn.prevAll('.miniLoader').addClass('active');
	btn.addClass('disabled').attr('disabled', true);
}
function endAjax (response, btn) {
	btn.prevAll('.miniLoader').removeClass('active');
	btn.removeClass('disabled').attr('disabled',false);
	removeResponseAjax();
	$('.responseAjax').addClass('alert-'+response.type).addClass('active');
}
function startIconAjax (btn) {
	btn.find('.fa').addClass('hidden');
	startAjax(btn);
}
function ajaxErrorWithIcon (btn) {
	btn.find('.fa-times').removeClass('hidden');
	ajaxError(btn);
}

function responseMsg(response)
{

	if (typeof response.msg == "object") {
		$('.responseAjax').children('p').html('<ul class="listErrors"></ul>');
		$.each(response.msg, function(index, val) {
			$('.listErrors').append('<li>'+val+'</li>');
		});
	}else
	{
		$('.responseAjax').children('p').html(response.msg);
	}
}
function ajaxError (btn) {
	endAjax ({ type: 'danger'}, btn);
	btn.removeClass('disabled').attr('disabled', false);
	$('.responseAjax').children('p').html('Ups, ha habido un error.');
}
function addValToElim (toAdd, esto) {
	esto.addClass('to-elim');
	$(toAdd).val(esto.val()).attr('data-url',esto.data('url')).attr('data-tosend',esto.data('tosend'));
}
function closeModalElim (boton) {
	$('.to-elim').removeClass('to-elim');
	$(boton).removeClass('disabled').attr('disabled', false);
	removeResponseAjax();
}
function elimSuccess (response, btn) {
	endAjax(response, btn)
	responseMsg(response);
	if (response.type == 'danger') {
		btn.removeClass('disabled').attr('disabled', false);
	}else
	{
		$('.to-elim').parent().parent().remove();
	}
}
function beforeLoadContent (btn) {
	$(btn.data('toload')).html('');
}
function loadContent (response, btn) {
	console.log(response)
	$(btn.data('toload')).html(response);
}
function login (response, btn) {
	endAjax(response, btn)
	$('.responseAjax').children('p').html(response.msg);

	if (response.type == 'danger') {
		btn.removeClass('disabled').attr('disabled',false);
	}else
	{
		btn.addClass('disabled').attr('disabled',true);
		setTimeout(function() {
			window.location.reload();	
		},2000);
	}
}
function changePassSuccess(response, btn) {
	endAjax(response, btn);
	responseMsg(response);
	if (response.type != 'danger') {
		$('.validate-input').val('');
	}
	btn.removeClass('disabled').attr('disabled', false);

}
function removeResponseAjax() {
	$('.responseAjax').removeClass('alert-success');
	$('.responseAjax').removeClass('alert-danger');
	$('.responseAjax').removeClass('active');

}
function checkEmpty(inp) {
	if (inp.val() == "") {
		activeteStatus(inp,'.control-label','.label-control-danger','has-success','has-error');
		return 0;
	}else
	{
		activeteStatus(inp,'.control-label','.label-control-success','has-error','has-success');
		return 1;
	}
}
function restoreInput (inp) {
	inp.nextAll('.control-label').remove();
}
function addHtml (inp,toShow,msg) {
	var $content = $('<p></p>');
	$content.html(msg).addClass('control-label').addClass(toShow);
	inp.nextAll('.control-label').remove();
	inp.after($content);
}
function validateEmail(inp) {

	var atpos = inp.val().indexOf("@");
    var dotpos = inp.val().lastIndexOf(".");
    if (atpos<1 || dotpos<atpos+2 || dotpos+2>=inp.val().length) {
        return false;
    }
	return true;
}
function validate($ele) {
	var proceed = 1;
	var radio   = {
		name : ""
	};
	$ele.each(function(index, el) {
		var msg;
		restoreInput($(el)); 
		if ($(el).is('input')) {
			if ($(el).attr('type') == "text") {
				if (checkEmpty($(el)) == 0) {
					msg = 'El campo '+$(el).data('name')+' es obligatorio';
					addHtml($(el),'label-control-danger',msg);
					proceed = 0;
				}
			}else if($(el).attr('type') == "email")
			{
				if(checkEmpty($(el)) == 0 || validateEmail($(el)) == false)
				{
					msg = 'El campo '+$(el).data('name')+' es obligatorio y debe ser un email valido';
					addHtml($(el),'label-control-danger',msg);
					proceed = 0;
				}
			}else if($(el).attr('type') == "radio")
			{
				var name = $(el).attr('name');
				if (radio.name != name) {
					radio.name = name;
					if (!$('$(el)ut[name = '+radio.name+']').is(':checked')) {
						msg = 'Debe seleccionar una opción en el campo '+$(el).data('name');
						addHtml($(el),'label-control-danger',msg);
						proceed = 0;
					}
				};
			}else if($(el).attr('type') == "number"){
				if (checkEmpty($(el)) == 0) {
					msg = 'El campo '+$(el).data('name')+' es obligatorio';
					addHtml($(el),'label-control-danger',msg);
					proceed = 0;
				}else if(isNaN($(el).val()) || $(el).val() <= 0)
				{
					msg = 'El campo '+$(el).data('name')+' debe ser un numero mayor a 0';
					addHtml($(el),'label-control-danger',msg);
					proceed = 0;
				}
			}
		}else if($(el).is('select'))
		{
			if($(el).val() == "")
			{
				msg = 'El campo '+$(el).data('name')+' seleccionado es invalido';
				addHtml($(el),'label-control-danger',msg);
				proceed = 0;
			}
		}
		else if($(el).is('textarea'))
		{
			if(checkEmpty($(el)) == 0)
			{
				msg = 'El campo '+$(el).data('name')+' es obligatorio';
				addHtml($(el),'label-control-danger',msg);
				proceed = 0;
			}
		}

	});
	return proceed;
}
function doAjax(url, method, dataType, dataPost, btn, beforeSendCallback, successCallback, errorCallback) {
	$.ajax({
		headers: {'csrftoken': $('input[name = _token]').val()},
		url: url,
		type: method,
		dataType: dataType,
		data: dataPost,
		beforeSend: function(){
			beforeSendCallback(btn)
		},
		success: function(response){
			successCallback(response, btn);
		},
		error: function(){
			errorCallback(btn)
		}
	});
}
function successModalWithInput (response, btn) {
	endAjax(response, btn);
	responseMsg(response);
	if (response.type == 'danger') {
		btn.removeClass('disabled').attr('disabled', false);
	}else
	{
		$(btn.data('target')).val('');
		$('input[name = _token]').remove();

	}

}
function send_things () {
	var lines = $('#mytextarea').val().split(/\n/);
	var texts = [];
	for (var i=0; i < lines.length; i++) {
	  // only push this line if it contains a non whitespace character.
	  if (/\S/.test(lines[i])) {
	    texts.push($.trim(lines[i]));
	  }
	}
}
function endSelectLoadAjax (btn) {
	btn.removeClass('disabled').attr('disabled', false);
}
function beforeSelectLoad (btn) {
	$(btn.data('target')).html('');
	btn.addClass('disabled').attr('disabled', true);
}
function successSelectLoad (response, btn) {
	endSelectLoadAjax(btn);
	$(btn.data('target')).html(response);
}
jQuery(document).ready(function($) {
	$('.contLoading').removeClass('active');
	$('.btn-submit').on('click', function(event) {
		var $ele = $('.validate-input');
		var proceed = validate($ele);
		
		if (proceed) {
			$('form').submit();
		};
	});
	$('.validate-input').on('focus', function(event) {
		restoreInput($(this)); 
	});
	$('#modalElim').on('hide.bs.modal', function(event) {
		closeModalElim('.btn-elim')
	});
	$('#changeRole').on('hide.bs.modal', function(event) {
		closeModalElim('.btn-change-role')
	});
	$('#changeLocation').on('hide.bs.modal', function(event) {
		closeModalElim('.btn-change-role')
	});
	$('#recoverPassword').on('hide.bs.modal', function(event) {
		closeModalElim('.btn-change-role')
	});
	$('.btn-elim').on('click', function(event) {
		var btn = $(this);
		var url = btn.data('url');
		var dataPost = {};
		dataPost[btn.data('tosend')] = btn.val();
		doAjax(url, 'POST', 'json', dataPost, btn, startAjax, elimSuccess, ajaxError);
	});
});