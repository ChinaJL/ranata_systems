<table id="quotation-item-table" class="table display dataTable text-right strong table-responsive">     
    <tr>
        <td><?php echo lang("sub_total"); ?></td>
        <td><?php echo to_currency($invoice_total_summary->invoice_subtotal, $invoice_total_summary->currency_symbol); ?></td>
    </tr>
    <?php if ($invoice_total_summary->tax) { ?>
        <tr>
            <td><?php echo $invoice_total_summary->tax_name; ?></td>
            <td><?php echo to_currency($invoice_total_summary->tax, $invoice_total_summary->currency_symbol); ?></td>
        </tr>
    <?php } ?>
    <!-- <tr>
        <td><?php echo lang("balance_due"); ?></td>
        <td><?php echo to_currency($invoice_total_summary->balance_due, $invoice_total_summary->currency_symbol); ?></td>
    </tr> -->
</table>