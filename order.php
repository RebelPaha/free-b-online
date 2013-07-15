<DOCTYPE html>
<html>
<head>
    <meta charset='windows-1251'>
</head>
<body>
<?php

require_once 'api/classes/FreeB.php';

//$freeb = new FreeB( 5 );
//
//$result = fopen( "http://fbo.cawoon.com/api/handler.php?operation=order&code=44651cb83ffce086c67ed4602ec19b6e&company_id=5&amount=500", 'r' );
//
//var_dump( $freeb->checkCodeExists( 'ab33877842b511bc5471a3ffd008333e' ) ); exit;

require_once( 'api/classes/LiqPayMerchant.php' );

$lpMerchant = new LiqPayMerchant;
$lpMerchant->setAccountId( (int) $_GET['account_id'] )
           ->setAmount( 0.02 )
           ->setDescription(  'Оплата скидочной карты №' . (int) $_GET['account_id'] );

var_dump($lpMerchant->composeXML());
//echo $lpMerchant->composeXML();

?>
<br/>
<form action='<?php echo LiqPayMerchant::SERVICE_URL; ?>' method='post'>
    <input type='hidden' name='operation_xml' value='<?php echo $lpMerchant->getEncodedXML(); ?>' />
    <input type='hidden' name='signature' value='<?php echo $lpMerchant->getSignature(); ?>' />
    <input type='submit' value='Pay' />
</form>
</body>
</html>
