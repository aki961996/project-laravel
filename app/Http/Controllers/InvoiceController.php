<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function list()
    {
        $data = Invoice::all();

        return view('invoice.invoice', ['data' => $data]);
    }

    public function add()
    {
        return view('invoice.add');
    }
    public function store(Request $request)
    {


        // dd($request->all());

        $request->validate([
            'qty' => 'required',
            'amount' => 'required',
            'total_amount' => 'required',
            'tax_percentage' => 'required',
            'tax_amount' => 'required',
            'net_amount' => 'required',
            'customer_name' => 'required',
            'customer_email' => 'required',
            'invoice_date' => 'required',

        ]);

        $input = [
            'qty' => request('qty'),
            'amount' => request('amount'),
            'total_amount' => request('total_amount'),
            'tax_percentage' => request('tax_percentage'),
            'net_amount' => request('net_amount'),
            'tax_amount' => request('tax_amount'),

            'customer_email' => request('customer_email'),
            'customer_name' => request('customer_name'),
            'invoice_date' => request('invoice_date'),

        ];

        if ($request->hasFile('file_path')) {
            $extension = request('file_path')->extension();
            $fileName = 'voice_pic_' . time() . '.' . $extension;
            //return $fileName;
            request('file_path')->storeAs('images', $fileName);
            // $path = $image->store('images', 'public');
            $input['file_path'] = $fileName;
        }

        $indata = Invoice::create($input);
        //return $todo;
        return redirect()->route('invoice')->with('success', 'Data Added successfully');
    }
}
