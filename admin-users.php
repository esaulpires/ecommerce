<?php 


use \Hcode\PageAdmin;
use \Hcode\Model\User;




// Rota para listar usuarios
$app->get("/admin/users/", function() {

	User::verifyLogin();
	$users = User::listAll();

	$page = new PageAdmin();

	$page->setTpl("users", array(
		"users"=>$users
	));	
});



//Tela Criar usuario formulario
$app->get("/admin/users/create/", function() {

User::verifyLogin();

$page = new PageAdmin();

$page->setTpl("users-create");	
});



$app->get("/admin/users/:iduser/delete/", function($iduser){

User::verifyLogin();

$user = new User();

$user->get((int)$iduser);

$user->delete();

header("Location: /admin/users");

exit;

});


//Tela Editar usuario
$app->get('/admin/users/:iduser/', function($iduser){

User::verifyLogin();

$user = new User();

$user->get((int)$iduser);

$page = new PageAdmin();

$page ->setTpl("users-update", array(
	 "user"=>$user->getValues()
 ));

});



//Insert do usuário, salvar usuario
$app->post("/admin/users/create/", function () {

User::verifyLogin();

$user = new User();

$_POST["inadmin"] = (isset($_POST["inadmin"])) ? 1 : 0;

$user->setData($_POST);

$user->save();

header("Location: /admin/users");
exit;

});



// UPDATE - salvar a edição do usuario
$app->post("/admin/users/:iduser/", function($iduser){

	User::verifyLogin();

	$user = new User();

	$_POST["inadmin"] = (isset($_POST["inadmin"]))?1:0;

	$user->get((int)$iduser);

	$user->setData($_POST);

	$user->update();

	header("Location: /admin/users");
	exit;

});


 ?>