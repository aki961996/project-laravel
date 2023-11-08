<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $table = "invoices";

    protected $fillable = ['qty', 'amount', 'total_amount', 'tax_percentage', 'tax_amount', 'net_amount', 'customer_name', 'invoice_date', 'customer_email', 'file_path'];


    //editorm
    static public function getSingle($id)
    {
        $id = decrypt($id);
        return Invoice::find($id);
    }

    //update
    static public function getAlreadtFirts($id)
    {
        return self::where('id', '=', $id)
            ->first();
    }

    public function setInvoiceDateAttribute($value)
    {
        $this->attributes['invoice_date'] = date('Y-m-d', strtotime($value));
    }

    public function getInvoiceDateFormatedAttribute()
    {
        return date('d-m-Y', strtotime($this->invoice_date));
    }

    protected $appends = ['invoice_date_formated'];
}
