<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = "invoices";

    protected $fillable = ['qty', 'amount', 'total_amount', 'tax_percentage', 'tax_amount', 'net_amount', 'customer_name', 'invoice_date', 'customer_email', 'file_path'];
}
