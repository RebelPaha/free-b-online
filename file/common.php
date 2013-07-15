<?php

class CodeGenerator
{
    public $user_id;
    public $code;

    public function __construct( $user_id ){
        $this->user_id = $user_id;
    }

    public function run(){
        $this->code   = md5( $this->user_id . time() . rand( 0, 5 ) );

        if( $this->check_code() ){
            return $this->run();
        }

        return $this;
    }

    public function save(){
        $sql = "UPDATE `member`
                SET `code` = '" . $this->code . "', code_created = NOW()
                WHERE id = '" . mysql_real_escape_string( $this->user_id ) . "'";

        return mysql_query( $sql ) or die( mysql_error() );
    }

    public function getCode(){
        return $this->code;
    }

    public function generateEveryDay(){
        $sql    = "SELECT `code_created` FROM `member` WHERE `code` = '" . $this->code . "' LIMIT 1";
        $result = mysql_query( $sql ) or die( mysql_error() );

        return (bool) mysql_num_rows( $result );
    }

    protected  function check_code(){
        $sql    = "SELECT `code` FROM `member` WHERE `code` = '" . $this->code . "' LIMIT 1";
        $result = mysql_query( $sql ) or die( mysql_error() );

        return (bool) mysql_num_rows( $result );
    }
}

function convert_id( $id ){
    return sprintf("%11d", (string) $id );
}

//$codeGenerator = new CodeGenerator( '000000001' );
//var_dump( $codeGenerator->run()->save() );


