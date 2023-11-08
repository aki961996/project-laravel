<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Http\Requests\InvoiceUpdateReq;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\InvoiceDetailsMail;

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
            // 'qty' => 'required',
            // 'amount' => 'required',
            // 'total_amount' => 'required',
            // 'tax_percentage' => 'required',
            // 'tax_amount' => 'required',
            // 'net_amount' => 'required',
            // 'customer_name' => 'required',
            // 'customer_email' => 'required',
            // 'invoice_date' => 'required',
            'qty' => 'required|numeric',
            'amount' => 'required|numeric',
            'total_amount' => 'numeric',
            'tax_percentage' => 'required|in:0,5,12,18,28',
            'tax_amount' => 'numeric',
            'net_amount' => 'numeric',
            'customer_name' => 'required|regex:/^[a-zA-Z]+$/u',
            'invoice_date' => 'required',
            'file_path' => 'required|file',
            'customer_email' => 'required|unique:invoices,customer_email,'

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

        $user = Invoice::create($input);

        if (!empty($user)) {
            Mail::to($user->customer_email)->send(new InvoiceDetailsMail($user));
            return redirect()->route('invoice')->with('success', 'Data Inserted successfully');
        } else {
            abort(404);
        }

        // Mail::to($user->customer_email)->send(new InvoiceDetailsMail($user));
        //return $todo;

    }

    public function edit($id)
    {
        $singleData = Invoice::getSingle($id);
        //dd($singleData);
        if (!empty($singleData)) {

            return view("invoice.edit",  ['singleDatas' => $singleData]);
        } else {
            abort(404);
        }
    }

    public function customer_update(InvoiceUpdateReq $request)
    {
        $id = request('id');
        $id = Invoice::find($id);
        // $getAlreadtFirts = Invoice::getAlreadtFirts($request->id);
        // dd($getAlreadtFirts);
        $input = $request->validated();
        if ($request->hasFile('file_path')) {
            Storage::delete('images/' . $id->file_path);
            $extension = request('file_path')->extension();
            $fileName = 'voice_pic_' . time() . '.' . $extension;
            request('file_path')->storeAs('images', $fileName);
        }

        $input['file_path'] = $fileName;
        $id->update($input);

        return redirect()->route('invoice')->with('success', 'Updated successfully');
    }

    public function customer_delete($id)
    {
        $id = decrypt($id);
        $id = Invoice::find($id);

        if (!empty($id->file_path)) {
            Storage::delete('images/' . $id->file_path);
        }
        $id->delete();
        return redirect()->route('invoice')->with('success', 'deleted successfully');
    }
}
