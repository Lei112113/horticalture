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
    ];

    protected $data = [];

    public function navfunc($nav)
    {
        foreach ($this->nav as $key => $value) {
            $this->data['nav'][$key] = $value;
        }
        $olddata = Nav::all();

        if (isset($olddata[0])) {
            $this->data['navDatas'] = $olddata;
        }
        return $this->data;
    }

    public function index()
    {
        $this->navfunc($this->nav);
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
        // 验证條件
        $validator = Validator::make($request->all(), [

            'admin_nav_key' => 'required|max:50|regex:/[a-zA-Z]+$/u',
            'admin_nav_name' => 'required|max:50|regex:/^[\x{4e00}-\x{9fa5}_a-zA-Z0-9]+$/u',
            'admin_nav_route' => 'required|max:50|regex:/[a-zA-Z.]+$/u',

        ]);
        $is_active_url = Validator::make(['admin_nav_route'=>$request->admin_nav_route], [
            'admin_nav_route'=>'url'
        ]);


        $nav = new Nav;
        $nav->admin_nav_key = $request->admin_nav_key;
        $nav->admin_nav_name = $request->admin_nav_name;
        $nav->admin_nav_route = $request->admin_nav_route;


        //驗證
        $chk = $this->checkout($validator, $nav);
        if ($is_active_url->passes() && $chk->getStatusCode() == 200) {
            $nav->save();
        } else if (!$is_active_url->passes()) {
            $nav->admin_nav_route = '';
            $nav->save();
        }
        $statusCode = $chk->getStatusCode();



        return redirect()->route('nav.index')->with('statusCode')->with($statusCode);
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
