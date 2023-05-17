<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NavController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public  $nav = [
        'website' => 'admin',
        'navName' => '管理選單',
        'index' => ['index', '回到管理首頁'],
        'contact' => ['contact.index', '聯絡資訊管理']
    ];
    
    



    public function index()
    {
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
