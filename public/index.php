<?php

declare( strict_types=1 );

$root = dirname( __DIR__ ) . DIRECTORY_SEPARATOR;

define( 'APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR );
define( 'FILES_PATH', $root . 'transaction_files' . DIRECTORY_SEPARATOR );
define( 'VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR );

/*************************************************************************/

require APP_PATH . "app.php";
require APP_PATH . "helpers.php";

$transaction_files = get_transaction_files( FILES_PATH );
vr_debug( $transaction_files, "Transaction Files" );

$transactions = [];
foreach( $transaction_files as $transaction_file ) {
    $transactions = array_merge( $transactions, get_transactions( $transaction_file ) );
}
vr_debug( $transactions, "Transactions" );

//require VIEWS_PATH . 'transactions.php';
