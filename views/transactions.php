<!DOCTYPE html>
<html>
    <head>
        <title>Simple Budget App</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                text-align: center;
            }

            table tr th, table tr td {
                padding: 5px;
                border: 1px #eee solid;
            }

            tfoot tr th, tfoot tr td {
                font-size: 20px;
            }

            tfoot tr th {
                text-align: right;
            }
        </style>
    </head>
    <body>
    <h1>Simple Budget App</h1>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Check #</th>
                    <th>Description</th>
                    <th>Amount</th>
                </tr>
            </thead>
            <tbody>
                <?php if ( ! empty( $transactions ) ): ?>
                    <?php foreach( $transactions as $transaction ): ?>
                        <tr>
                            <td><?php echo format_date( $transaction['date'] ); ?></td>
                            <td><?php echo $transaction['check_number']; ?></td>
                            <td><?php echo $transaction['description']; ?></td>
                            <td style="color: <?php echo amount_color( $transaction['amount'] ); ?>">
                                <?php echo format_amount( $transaction['amount'] ); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <th colspan="3">Total Income:</th>
                    <td><?php echo format_amount( $totals['total_income'] ); ?></td>
                </tr>
                <tr>
                    <th colspan="3">Total Expense:</th>
                    <td><?php echo format_amount( $totals['total_expense'] ); ?></td>
                </tr>
                <tr>
                    <th colspan="3">Net Total:</th>
                    <td><?php echo format_amount( $totals['net_total'] ); ?></td>
                </tr>
            </tfoot>
        </table>
    </body>
</html>