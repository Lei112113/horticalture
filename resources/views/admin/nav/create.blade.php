<div style="padding:224px" class="w-100 vh-100 ">
    <div style="width:300px;margin:0 auto;" class="">
       <h2 >管理連結新增</h2>
    <form action="{{route('nav.store')}}" method="post"  class="">
        @csrf
        <table >
            <tr>
                <td><label for="admin_nav_key">應用頁面名稱<br>(請輸入英文)</label></td>
                <td><input type="text" name="admin_nav_key" id="admin_nav_key"></td>
            </tr>
            <tr>
                <td><label for="admin_nav_name">連結名稱:</label></td>
                <td><input type="text" name="admin_nav_name" id="admin_nav_name"></td>
            </tr>
            <tr>
                <td> <label for="admin_nav_route">短連結:</label></td>
                <td><input type="text" name="admin_nav_route" id="admin_nav_route"></td>
            </tr>
            <tr>
                <td></td>
                <td class="text-end">
                    <input type="submit" value="新增" class="btn btn-primary btn-sm">
                    <input type="reset" value="重整" class="btn btn-warning btn-sm">
                    <input type="button" value="回上一頁" onclick="history.go(-1)" class="btn btn-secondary btn-sm">
                </td>
            </tr>
        </table>


    </form>  
    </div>
   
</div>
