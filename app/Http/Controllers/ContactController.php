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
            $this->data= [$key => $value];
        }
    }

    public function index()
    {
        
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
      $contact=new Contact;
      $contact->companyName=$request->companyName;  
      $contact->addrass=$request->addrass;  
      $contact->telphone=$request->telphone;  
      $contact->email=$request->email; 
      
      $contact->save();
      return redirect('contact.index');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
