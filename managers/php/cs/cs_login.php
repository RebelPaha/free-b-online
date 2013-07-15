<?php
class cs_login extends cs
{
    function action($login,$pass)
	{
	$model = new model_login();
	$model->set_data($login,$pass); 
	$data = $model->get_data();
	$view = new view();
	$view->data = $data;
	$view->show();
	}
}

?>