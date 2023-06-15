<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;
use App\Models\Nav;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

use function PHPSTORM_META\type;

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
        $is_active_url = Validator::make(['admin_nav_route' => $request->admin_nav_route], [
            'admin_nav_route' => 'url'
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
            $this->createNavController($nav->admin_nav_key);
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
        $data = Nav::find($id);
        return view('admin.nav.edit', ['data' => $data]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // 验证條件
        $validator = Validator::make($request->all(), [

            'admin_nav_key' => 'required|max:50|regex:/[a-zA-Z]+$/u',
            'admin_nav_name' => 'required|max:50|regex:/^[\x{4e00}-\x{9fa5}_a-zA-Z0-9]+$/u',
            'admin_nav_route' => 'required|max:50|regex:/[a-zA-Z.]+$/u',

        ]);
        $is_active_url = Validator::make(['admin_nav_route' => $request->admin_nav_route], [
            'admin_nav_route' => 'url'
        ]);


        $nav = Nav::find($id);
        
        
        $input=$request->except('_token', '_method', 'admin_nav_key', 'id');
        $nav->admin_nav_name=$input['admin_nav_name'];
        $nav->admin_nav_route=$input['admin_nav_route'];


        //驗證
        $chk = $this->checkout($validator, $nav);
        if ($is_active_url->passes() && $chk->getStatusCode() == 200) {
            $nav->save();
        } else if (!$is_active_url->passes()) {
            $nav->save();
        }
        $statusCode = $chk->getStatusCode();



        return redirect()->route('nav.index')->with('statusCode')->with($statusCode);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delthing = Nav::find($id);

        dump($delthing->id);
        $delname = ucfirst($delthing->admin_nav_key) . "Controller";
        $controllerPath = app_path("Http/Controllers/$delname.php");
        $routeFilePath = base_path('routes/web.php');
        
        if (File::exists($controllerPath)) {
            File::delete($controllerPath);
           
            $delthing->delete();
            $routeFileContent = file_get_contents($routeFilePath);
            echo "Route::resource('$delthing->admin_nav_key', $delname::class);";
            $routeFileContent = str_replace("Route::resource('$delthing->admin_nav_key',$delname::class);", '', $routeFileContent);
            file_put_contents($routeFilePath, $routeFileContent);
        }
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


    public function createNavController($formName)
    {
        $controllerName = ucfirst($formName) . 'Controller';

        //添加到web route
        $routeCode = "Route::resource('$formName', $controllerName::class);";
        $webFilePath = base_path('routes/web.php');
        $existingRoutes = file_get_contents($webFilePath);

        // 获取新的路由代码
        $newRoutes = "Route::resource('$formName', $controllerName::class); ";

        // 在现有路由组中查找 'prefix' => 'admin' 的位置
        $prefixPosition = strpos($existingRoutes, "Route::prefix('admin')->group(function () {");

        if ($prefixPosition !== false) {
            // 在 'prefix' => 'admin' 之后插入新的路由代码
            $insertPosition = $prefixPosition + strlen("Route::prefix('admin')->group(function () { ");
            $updatedRoutes = substr_replace($existingRoutes, $newRoutes, $insertPosition, 0);

            // 将更新后的路由写入文件
            file_put_contents($webFilePath, $updatedRoutes);
        } else {
            // 如果找不到 'prefix' => 'admin'，则输出错误消息或执行其他处理逻辑
            echo "无法找到 'prefix' => 'admin' 路由组";
        }




        //web.php新增use
        $useStatement = "use App\Http\Controllers\\$controllerName;";
        $webCode = file_get_contents($webFilePath);
        // 检查是否已存在相同的 use 声明
        if (strpos($webCode, $useStatement) === false) {
            // 查找最后一个 use 声明的位置
            $lastUsePosition = strrpos($webCode, 'use');

            // 插入 use 声明到最后一个 use 声明的后面
            $updatedWebCode = substr($webCode, 0, $lastUsePosition) . $useStatement . "\n" . substr($webCode, $lastUsePosition);

            // 将更新后的内容写回文件
            file_put_contents($webFilePath, $updatedWebCode);
        }



        //創造controller
        Artisan::call('make:controller', [
            'name' => $controllerName,
            '--resource' => true,
        ]);
    }
}
