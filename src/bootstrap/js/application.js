/**
 *  Funciones de la aplicacion
 */

$('form').submit(function(){
	$('.progress').addClass('active');
	$('.progress').show();
	$('#mensaje').html('');
	$.post('app/process.php',$('form').serialize(),function(data){
		$('#mensaje').html(data);
		$('.progress').removeClass('active');
	});
	return false;
});

