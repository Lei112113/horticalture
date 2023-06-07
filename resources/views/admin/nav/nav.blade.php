@extends('layouts.nav');
<div class="container-md" style="margin-top: 14vh">
    <button class="btn btn-success float-end mb-5" onclick="location.href='{{route('nav.create')}}'">
        新增管理項目列表
    </button>
    <table class="w-100 text-center ">
        <tr style="border: 1px solid gray">
            <td>項目</td>
            <td>連結</td>
            <td>
                操作
            </td>
        </tr>
        @isset($navDatas)
            @foreach ($navDatas as $navData)
            <tr style="border: 1px solid gray">
                <td>{{$navData['name']}}</td>
                <td>{{$navData['route']}}</td>
                <td>
                    <button>操作</button>
                    <button>刪除</button>
                </td>
            </tr>
            @endforeach
        @endisset
    </table>
</div>
