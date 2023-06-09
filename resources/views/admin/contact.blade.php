<style>
    label {
        text-align: center;
    }
</style>
@extends('layouts.nav')


<h2 style="margin:30vh auto 10px auto;" class="text-center">聯絡資訊管理</h2>
<form action="" method="post" class="text-center m-auto" style="width: 75vw">
    @csrf
    <input type="hidden" name="id" value="{{ $contact['id'] ?? '' }}" id="id">
    <div class="mb-1 ">
        <label for="companyName">公司名稱:</label>
        <input class="w-50" type="text" name="companyName" id="companyName" value=" {{ $contact['companyName'] ?? '' }}">
    </div>
    <div class="mb-1 ">
        <label for="addrass" style="margin-right:34px">地址:</label>
        <input class="w-50" type="text" name="addrass" id="addrass" value="{{ $contact['addrass'] ?? '' }}">
    </div>
    <div class="mb-1 ">
        <label for="telphone" style="margin-right:34px">電話:</label>
        <input class="w-50" type="text" name="telphone" id="telphone" maxlength="10" oninput="chk()" value="{{ $contact['telphone'] ?? '' }}" >
    </div>
    <div style="font-size:10px;margin-left:300px;color:red" class="w-25 mt-1">*電話最長10字元喔，只能輸入數字</div>
    <div class="mb-1 ">
        <label for="email">電子郵件:</label>
        <input class="w-50" type="email" name="email" id="email" value="{{ $contact['email'] ?? '' }}">
    </div>
    <div class="mb-1 " style="margin-left:35vw">
        <input class="btn btn-secondary" type="reset" value="重置">
        <input class="btn btn-primary" type="submit" value="送出" onclick="stop(event)">
    </div>
</form>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    function chk() {
        if (isNaN($('#telphone').val())) {
            Swal.fire({
                icon: 'warning',
                title: '錯誤',
                text: '只能輸入電話號碼',

            })
            $('#telphone').val('')
        }
    }

    function stop(event) {
        event.preventDefault();
        if ($('#companyName').val() == "" || $('#addrass').val == "" || $('#telphone').val() == "" || $('#email').val() == "") {
            Swal.fire({
                icon: 'error',
                title: '錯誤',
                text: '資料不可為空白喔',

            })
        } else {
            let method = ($('#id').val() == "") ? 'POST' : 'PUT'
            $.ajax({
                type: method,
                url: "{{ $contact['send'] ?? route('contact.store') }}",

                data: {

                    companyName: $('#companyName').val(),
                    addrass: $('#addrass').val(),
                    telphone: $('#telphone').val(),
                    email: $('#email').val(),
                    _token: $('input[type="hidden"]').val(),
                    _method: method
                },
                statusCode: {
                    400: function(res) {
                        console.log(res);
                        Swal.fire({
                            icon: 'error',
                            title: '失敗',
                            text: '資料格式錯誤'

                        })
                    },
                    500:function(res){
                        console.log(res);
                        Swal.fire({
                            icon: 'error',
                            title: '失敗',
                            text: '資料格式錯誤'

                        })
                    },
                    200: function(res) {
                        console.log(res);
                        Swal.fire({
                            icon: 'success',
                            title: '成功',
                            text: '資料儲存成功'

                        })
                    }

                }
            });


        }
    }
</script>