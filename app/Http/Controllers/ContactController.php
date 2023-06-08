<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Contact;
use Exception;

class ContactController extends NavController
{

    public function index()
    {
        $this->navfunc($this->nav);
        $olddata = Contact::all();
        if (isset($olddata[0])) {
            $id = $olddata[0]->id;
            //確認資料庫有沒有資料了，有資料就傳送這個
            $olddata[0]['send'] = route("contact.update", ['contact' => $id]);
            $this->data['contact'] = $olddata[0];
        }
        return view("admin.contact", $this->data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // 验证请求数据
        $validator = Validator::make($request->all(), [

            'companyName' => 'required|max:50|regex:/^[\x{4e00}-\x{9fa5}_a-zA-Z0-9]+$/u',
            'email' => 'required|email',
            'addrass' => 'required|max:50|regex:/^[\x{4e00}-\x{9fa5}_a-zA-Z0-9]+$/u',
            'telphone' => 'required|numeric',
        ]);

        $contact = new Contact;
        $contact->companyName = $request->companyName;
        $contact->addrass = $request->addrass;
        $contact->telphone = $request->telphone;
        $contact->email = $request->email;
        $chk = $this->checkout($validator, $contact);
        $status = 'error';
        $message = '儲存失敗';
        if ($chk->getStatusCode() == 200) {
            $contact->save();
            $status = 'success';
            $message = '儲存成功';
        }
        return response(['status' => $status, 'message' => $message], $chk->getStatusCode());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        // 验证请求数据
        $validator = Validator::make($request->all(), [

            'companyName' => 'required|max:50|regex:/^[\x{4e00}-\x{9fa5}_a-zA-Z0-9]+$/u',
            'email' => 'required|email',
            'addrass' => 'required|max:50|regex:/^[\x{4e00}-\x{9fa5}_a-zA-Z0-9]+$/u',
            'telphone' => 'required|numeric',
        ]);


        // 更新数据库中的记录
        $contact = Contact::findOrFail($id);
        $contact->companyName = $request->companyName;
        $contact->addrass = $request->addrass;
        $contact->telphone = $request->telphone;
        $contact->email = $request->email;
        $chk = $this->checkout($validator, $contact);
        $status = 'error';
        $message = '儲存失敗';
        if ($chk->getStatusCode() == 200) {
            $contact->save();
            $status = 'success';
            $message = '儲存成功';
        }
        return response(['status' => $status, 'message' => $message], $chk->getStatusCode());
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
