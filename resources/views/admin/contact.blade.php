<style>
    label {
        text-align: center;
    }

 
</style>
@extends('layouts.nav')
<h2 style="margin:100px auto 10px auto;" class="text-center">聯絡資訊管理</h2>
<form action="{{ route('contact.store') }}" method="post" class="text-center m-auto" style="width: 75vw">
    @csrf
    <div class="mb-1 ">
        <label for="companyName">公司名稱:</label>
        <input class="w-50" type="text" name="companyName" id="companyName">
    </div>
    <div class="mb-1 ">
        <label for="addrass" style="margin-right:34px">地址:</label>
        <input class="w-50" type="text" name="addrass" id="addrass">
    </div>
    <div class="mb-1 ">
        <label for="telphone" style="margin-right:34px">電話:</label>
        <input class="w-50" type="text" name="telphone" id="telphone" maxlength="10"  oninput="chk()">
    </div>
    <div class="mb-1 ">
        <label for="email">電子郵件:</label>
        <input class="w-50" type="email" name="email" id="email">
    </div>
    <div class="mb-1 " style="margin-left:35vw">
        <input class="btn btn-secondary" type="reset" value="重置">
        <input class="btn btn-primary" type="submit" value="送出">
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
</script>
