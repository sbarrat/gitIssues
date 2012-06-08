/**
 *  Funciones de la aplicacion
 */

$('form').submit(function(){
	$.post('app/process.php',$('form').serialize(),function(data){
		$('#mensaje').html(data);
		$('.progress').removeClass('active');
	});
	return false;
});
$('.process').ajaxStart(function(){
	$('#mensaje').html('Enviando datos...');
	this.show();
});
$('.process').ajaxError(function(){
	$('#mensaje').html("<span class='label label-important'>Error enviando datos</span>");
});
