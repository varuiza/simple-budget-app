<?php

declare( strict_types=1 );

function get_transaction_files( string $dir_path ): array {
    $files = [];
    foreach ( scandir( $dir_path ) as $file ) {
        // We don't need folders, so we skip them
        if (is_dir( $file )) {
            continue;
        }
        // Add the file to the files array
        $files[] = $dir_path . $file;
    }
    return $files;
}

function get_transactions( string $file_name ): array {
    // Trigger an error if can't find the file
    if ( ! file_exists( $file_name ) ) {
        trigger_error( 'File "' . $file_name . '" does not exist.', E_USER_ERROR );
    }
    // If we can find the file, we open it in read-only mode
    $file = fopen( $file_name, 'r' );

    // We discard the header of the CSV file
    fgetcsv( $file );

    $transactions = [];
    // We read the CSV file line by line, adding its content to our array
    while ( ( $transaction = fgetcsv( $file ) ) !== false ) {
        $transactions[] = $transaction;
    }
    return $transactions;
}