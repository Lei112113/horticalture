<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use App\Models\Nav;


class NavController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public  $nav =  [
        'webName' => 'HORTICULTRUE',
        'website' => 'admin',
        'navName' => '管理選單',
        'admin_nav' => [
            'index' => ['index', '回到管理首頁'],
            'contact' => ['contact.index', '聯絡資訊管理'],
            'orders' => ['orders.index', '商品管理']
        ]

    ];

    protected $data = [];


    public function index()
    {
        foreach ($this->nav as $key => $value) {
            $this->data['nav'][$key] = $value;
        }
        $olddata = Nav::all();

        if (isset($olddata[0])) {
            $this->data['navDatas'] = $olddata[0];
        }


        return  view("admin.nav.nav", $this->data);
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
        // 验证请求数据
        $validator = Validator::make($request->all(), [

            'admin_nav_key' => 'required|max:50|regex:/[a-zA-Z]+$/u',
            'admin_nav_name' => 'required|max:50|regex:/^[\x{4e00}-\x{9fa5}_a-zA-Z0-9]+$/u',
            'admin_nav_route' => 'required|max:50|regex:/[a-zA-Z.]+$/u',

        ]);

        $nav = new Nav;
        $nav->admin_nav_key = $request->admin_nav_key;
        $nav->admin_nav_name = $request->admin_nav_name;
        $nav->admin_nav_route = $request->admin_nav_route;

        $chk = $this->checkout($validator, $nav);
        
        if($chk->getStatusCode()==200){
            $nav->save();
            $status='success';
        }else{
            $status='error';

        }
        return redirect()->route('nav.index')->with('status')->with($status);
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
    public function checkout($validator, $value)
    {
        try {
            if ($validator->fails()) {

                throw new Exception(implode('<br>', $validator->errors()->all()), 999);
            } else {

                // 返回更新成功的响应
                return response(['status' => 'success', 'message' => '資料成功儲存'], 200);
            }
        } catch (Exception $ex) {
            if ($ex->getCode() == 999) {
                return response(['status' => 'error', 'error' => $ex->getMessage()], 400);
            }
            return response(['status' => 'error', 'error' => 'An error occurred'], 500);
        };
    }
}
