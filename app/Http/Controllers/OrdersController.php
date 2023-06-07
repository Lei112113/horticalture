<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Orders;

class OrdersController extends NavController
{
    protected $data = [];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        foreach ($this->nav as $key => $value) {
            $this->data['nav'][$key]= $value;
        }
        // dd($this->data);
        $olddata = Orders::all();
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
