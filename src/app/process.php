<?php
/**
 * Procesa los datos enviados desde el formulario
 * y los envia a gitHub
 * 
 * @author Ruben Lacasa ruben@rubenlacasa.es
 * 
 */	
if ( isset($_POST['title']) ) {
    try {
/**
 * Cargamos la librebria de GitHub
 */	
    	require_once 'Github/Autoloader.php';
		Github_Autoloader::register();
		$github = new Github_Client();

/**
 * Cargamos configuracion del config.ini
 */
		$params = parse_ini_file('config.ini');

/**
 * Nos autenticamos en GitHub
 */
		$github->authenticate(
			$params['user'], 
    		$params['pass'], 
    		Github_Client::AUTH_HTTP_PASSWORD
		);
/**
 * Procesamos los datos recibidos
 */
		$data = filter_input_array(INPUT_POST);
/**
 * Etiquetas que usaremos por defecto
 */
		$myLabels = array(
		        'Critica' => '333333',
		        'Alta'    => 'b94a48',
		        'Normal'  => 'f89406',
		        'Baja'    => '999999',
		        'Mejora'  => '3a87ad'
		);
/**
 * Obtenemos las etiquetas del repositorio
 */		
		$gitLabels = $github->getIssueApi()->getLabels(
			$params['repoUser'], 
		    $params['repo']
		);	
/**
 * Creamos el issue en gitHub y almacenamos los resultados
 * de la creacion
 */		
		$result = $github->getIssueApi()->open(
			$params['repoUser'],
			$params['repo'],
			$data['title'],
			$data['body']
		);
/**
 * Agregamos las etiquetas seleccionadas al issue
 */		
		foreach ( $data['labels'] as $label ) {
			$github->getIssueApi()->addLabel(
		    	$params['repoUser'], 
		    	$params['repo'], 
		    	$label, 
		    	$result['number']
			);
		}
/**
 * Cerramos la conexion.
 */		
		$github->deAuthenticate();
		echo "<div class='alert alert-success'>Datos Enviados</div>";
	} catch( Exception $e ) {
    	echo "<div class='alert alert-error'>Error enviando los datos</div>";
	}
}