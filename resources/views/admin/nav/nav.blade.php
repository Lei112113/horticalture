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
                            class="btn btn-sm btn-primary"onclick="location.href='{{ route('nav.edit', ['nav' => $navData['id']]) }}'">操作
                        </button>
                        <button class="btn btn-sm btn-danger" onclick="nav_delete($(this).data('url'))" data-url="{{ route('nav.destroy', ['nav' => $navData['id']])}}">
                            刪除
                        </button>
                        @csrf
                    </td>

                </tr>
            @endforeach
        @endisset
    </table>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js"
    integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


<script>
    function nav_delete(url) {
       
        console.log(url);
        Swal.fire({
            title: '確定刪除嗎',
            text: "你確定要刪除這底資料嗎？刪除後無法恢復喔",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '確定刪除'
        }).then((result) => {
            if (result.isConfirmed) {
               
                
                let data = {
                    _token: $("input[name='_token']").val(),
                   

                }
                
                $.ajax({
                    type: "delete",
                    url: url,
                    data: data,

                    success: function(response) {
                        location.reload();
                        

                    }
                });
                Swal.fire(
                    'Deleted!',
                    '已經刪除',
                    'success'
                )
            }
        })



    }
</script>
