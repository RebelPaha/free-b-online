<?php
class cs_vendor extends cs
{
    function action()
        {
	$this->view_data();
        }

    function view_data()
	{
	$model = new model_vendor();
	$data = $model->get_data();
	$view = new view();
	$view->data = $data;
	$view->show();
	}

    function send_data()
	{
	}
}
?>