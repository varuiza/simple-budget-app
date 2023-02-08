<?php

declare( strict_types=1 );

function get_transaction_files( string $dir_path ): array {
    $files = [];
    foreach ( scandir( $dir_path ) as $file ) {
        // We don't need folders, so we skip them
        if ( is_dir( $file ) ) {
            continue;
        }
        // If we find a file, we add it to the files array
        $files[] = $dir_path . $file;
    }
    return $files;
}

function get_transactions( string $file_name, ?callable $transaction_handler = null ): array {
    // Trigger an error if we can't find the file
    if ( ! file_exists( $file_name ) ) {
        trigger_error( 'File "' . $file_name . '" does not exist.', E_USER_ERROR );
    }
    // If we can find the file, we'll open it in read-only mode
    $file = fopen( $file_name, 'r' );

    // We don't need the header of the CSV file, so we discard it
    fgetcsv( $file );

    $transactions = [];
    // We read the CSV file line by line, adding its content to our transactions array
    while ( ( $transaction = fgetcsv( $file ) ) !== false ) {
        // Process each transaction row with the specified function (if there is one)
        if ( $transaction_handler !== null ) {
            $transaction = $transaction_handler( $transaction );
        }
        $transactions[] = $transaction;
    }
    return $transactions;
}

function extract_csv_transaction( array $transaction_row ):array {
    // Identify the data obtained on each row
    [$date, $check_number, $description, $amount] = $transaction_row;
    // Remove the "$" and the "," from the amount data to give it consistency; also convert it into a float type
    $amount = (float) str_replace( ['$', ','], '', $amount );
    // Return the transaction data in an associative array
    return [
        'date'          =>  $date,
        'check_number'  =>  $check_number,
        'description'   =>  $description,
        'amount'        =>  $amount
    ];
}

function calculate_totals ( array $transactions ): array {
    $totals = [
        'total_income'  =>  0,
        'total_expense' =>  0,
        'net_total'     =>  0
    ];
    // If the amount is positive, it's an income; otherwise, it's an expense
    foreach( $transactions as $transaction ) {
        $amount = $transaction['amount'];
        if ( $amount >= 0 ) {
            $totals['total_income'] += $amount;
        } else {
            $totals['total_expense'] += $amount;
        }
    }
    // Calculate net totals using total income and total expense
    $totals['net_total'] = $totals['total_income'] + $totals['total_expense'];
    return $totals;
}