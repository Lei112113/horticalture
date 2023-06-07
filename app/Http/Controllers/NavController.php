<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nav;


class NavController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public  $nav = ['nav' => [
        'webName' => 'HORTICULTRUE',
        'website' => 'admin',
        'navName' => '管理選單',
        'admin_nav' => [
            'index' => ['index', '回到管理首頁'],
            'contact' => ['contact.index', '聯絡資訊管理'],
            'orders' => ['orders.index', '商品管理']
        ]

    ]];

    protected $data = [];


    public function index()
    {
        $olddata = Nav::all();

        if(isset($olddata[0])){
            $this->data['navDatas'] = $olddata[0];
        }


        return  view("admin.nav.nav", $this->nav);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return  view("admin.nav.create", $this->nav);
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
