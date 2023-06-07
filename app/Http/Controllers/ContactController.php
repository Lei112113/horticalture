<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Contact;
use Exception;

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

        // 验证请求数据
        $validator = Validator::make($request->all(), [
            'companyName' => 'required|max:50',
            'email' => 'required|email',
            'addrass' => 'required|max:50',
            'telphone' => 'required|numeric',
        ]);

        $contact = new Contact;
        $contact->companyName = $request->companyName;
        $contact->addrass = $request->addrass;
        $contact->telphone = $request->telphone;
        $contact->email = $request->email;
        $this->checkout($validator->fails(),$contact);
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
            'companyName' => 'required|max:50',
            'email' => 'required|email',
            'addrass' => 'required|max:50',
            'telphone' => 'required|numeric',
        ]);


        // 更新数据库中的记录
        $contact = Contact::findOrFail($id);
        $contact->companyName = $request->companyName;
        $contact->addrass = $request->addrass;
        $contact->telphone = $request->telphone;
        $contact->email = $request->email;
        $this->checkout($validator->fails(),$contact);

       
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    private function checkout($validator,$contact){
        try {
            if ($validator) {
                // $error = $validator->errors()->first();
                // return response()->json(['status' => false, 'error' => $error], 400);
                throw new Exception(implode('<br>', $validator->errors()->all()), 999);
            } else {
                $contact->save();
                // 返回更新成功的响应
                return response(['status'=>'success','message' => '資料成功儲存'],200);
            }
        } catch (Exception $ex) {
            if ($ex->getCode() == 999) {
                return response(['status' => 'error', 'error' => $ex->getMessage()], 400);
            }
            return response(['status' => 'error', 'error' => 'An error occurred'], 500);
        };
    }
}
