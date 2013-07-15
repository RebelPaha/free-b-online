<?php
class view 
{
    public $data;
    function show()
	{
        echo json_encode($this->data);
	}
}
?>