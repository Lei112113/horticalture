<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    protected $data = [];

    public function __construct(NavController $nav)
    {
        foreach ($nav as $key => $value) {
            $this->data = [$key => $value];
        }
    }

    public function index()
    {
        $olddata = Contact::all();
        if (isset($olddata[0])) {
            $id = $olddata[0]->id;
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
        $contact = new Contact;
        $contact->companyName = $request->companyName;
        $contact->addrass = $request->addrass;
        $contact->telphone = $request->telphone;
        $contact->email = $request->email;
        $contact->save();
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
        $validatedData = $request->validate([
            'name' => 'required',
           
        ]);

        // 更新数据库中的记录
        $contact = Contact::findOrFail($id);
        $contact->companyName = $request->companyName;
        $contact->addrass = $request->addrass;
        $contact->telphone = $request->telphone;
        $contact->email = $request->email;
        // 更新其他字段

        $contact->save();

        // 返回更新成功的响应
        return response()->json(['message' => 'Contact updated successfully']);
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
