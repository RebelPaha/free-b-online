<?php

class cs_mail extends cs
{
    function action()
        {
	$this->view_data();
        }

    function view_data()
        {
        	header('Content-Type: text/html; charset=utf-8');
        $model = new model_mail();
        $data = $model->set_data();
	echo $data;
        }

    function send_data()
        {
        }
}

?>