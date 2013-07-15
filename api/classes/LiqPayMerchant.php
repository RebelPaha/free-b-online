<?php


class LiqPayMerchant {
    const MERCHANT_ID = 'i4160233971';
    const SERVICE_URL = "https://www.liqpay.com/?do=clickNbuy";
    const SIGNATURE   = 'fmWAhmPgpnubBuYInRdhsaGj5UdGnT3';
    const METHOD      = 'card,liqpay';
    const PHONE       = '+380663755528';

    public $response;

    private $_account_id;
    private $_description;
    private $_currency = 'USD';
    private $_amount;

    public function getAccountId(){
        return $this->_account_id;
    }

    public function setAccountId( $account_id ){
        $this->_account_id = $account_id;

        return $this;
    }

    public function setDescription( $description ){
        $this->_description = $description;

        return $this;
    }

    public function getDescription(){
        return $this->_description;
    }

    public function setCurrency( $currency ){
        $this->_currency = $currency;

        return $this;
    }

    public function getCurrency(){
        return $this->_currency;
    }

    public function setAmount( $amount ){
        $this->_amount = $amount;

        return $this;
    }

    public function getAmount(){
        return $this->_amount;
    }

    public function getSignature(){
        return base64_encode( sha1( self::SIGNATURE . $this->composeXML() . self::SIGNATURE, 1 ) );
    }

    public function getEncodedXML(){
        return base64_encode( $this->composeXML() );
    }

    public function parseResponseString( $string ){
        $this->response = simplexml_load_string( base64_decode ( $string ) );

        return $this->responce;
    }

    public function composeXML(){
        return "<request>
                <version>1.2</version>
                <result_url>http://fbo.cawoon.com/page/18?pay=success</result_url>
                <server_url>http://fbo.cawoon.com/api/handler.php</server_url>
                <merchant_id>" . self::MERCHANT_ID . "</merchant_id>
                <order_id>" . $this->getAccountId() . "</order_id>
                <amount>" . $this->getAmount() . "</amount>
                <currency>" . $this->getCurrency() . "</currency>
                <description>" . $this->getDescription() . "</description>
                <default_phone>" . self::PHONE . "</default_phone>
                <pay_way>" . self::METHOD . "</pay_way>
                </request>";
    }
}