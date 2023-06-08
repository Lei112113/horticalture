@extends('layouts.nav');
<div class="container-md" style="margin-top: 14vh">
    <button class="btn btn-success float-end mb-5" onclick="location.href='{{ route('nav.create') }}'">
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
                    <td>{{ $navData['admin_nav_name'] }}</td>
                    <td>{{ $navData['admin_nav_route'] }}</td>
                    <td>
                        <button
                            class="btn btn-sm btn-primary"onclick="location.href='{{ route('nav.edit', ['nav' => $navData['id']]) }}'">操作</button>
                        <button class="btn btn-sm btn-danger" onclick="nav_delete($navData['id'])">
                            刪除
                        </button>
                       
                    </td>
                    @csrf
                </tr>
            @endforeach
        @endisset
    </table>
</div>

<script>
    function nav_delete(id){

    }
</script>
