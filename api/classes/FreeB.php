<?php

/**
 * Class FreeB реализует возможность провеки актуальности кода скидки
 * и отправки информации о заказе.
 */
class FreeB {
    const API_URL = "http://fbo.cawoon.com/api/handler.php";
    const OP_KEY_EXISTS = 'key_exists';
    const OP_ORDER = 'order';

    /**
     * @var int Идентификатор компани в системе free-B
     */
    private $_companyId;

    public function __construct( $companyId ){
        $this->setCompanyId( $companyId );
    }

    /**
     * @param int $companyId
     */
    public function setCompanyId( $companyId ){
        $this->_companyId = $companyId;
    }

    /**
     * @return int
     */
    public function getCompanyId(){
        return $this->_companyId;
    }

    public function checkCodeExists( $code ){
        return  $this->_sendRequest( array( 'operation' => self::OP_KEY_EXISTS, 'code' => $code ) );
    }

    public function sendOrderData( $code, $amount ){
        return $this->_sendRequest( array( 'operation' => self::OP_ORDER, 'code' => $code, 'amount' => $amount ) );
    }

    private function _sendRequest( $data ){
        return (bool) @fopen( self::API_URL . "?" . http_build_query( $data ), 'r' );
    }
}