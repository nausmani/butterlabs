<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RednightInvoice extends Model
{
    protected $table = 'rednight_invoices';
    protected $fillable = ['id','invoice_date', 'invoice_number', 'account_name', 'bill_to', 'ship_to', 'total_products_and_other_charges', 'invoice_sub_total', 'sales_tax', 'invoice_total', 'payments', 'credits', 'balance_due', 'created_by', 'created_at', 'updated_at', 'deleted_at'];

    protected $dates = [
        'invoice_date', 'created_at', 'updated_at', 'deleted_at'
    ];
}
