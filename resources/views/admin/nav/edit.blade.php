<div style="padding:224px" class="w-100 vh-100 ">
    <div style="width:300px;margin:0 auto;" class="">
        <h2>管理連結編輯</h2>
        <form action="{{ route('nav.update', ['nav' => $data->id]) }}" method="post" class="">
            @csrf
            @method('PUT')
            <table>
                <tr>
                    <td><label for="admin_nav_key">應用頁面名稱<br>(請輸入英文)</label></td>
                    <td><input type="text" name="admin_nav_key" id="admin_nav_key" readonly
                            value="{{ $data->admin_nav_key }}"></td>
                </tr>
                <tr>
                    <td><label for="admin_nav">是否管理層連結:</label></td>
                    <td>
                        <select name="admin_nav" id="admin_nav">
                            <option value="0">是</option>
                            <option value="1">否</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label for="admin_nav_name">連結名稱:</label></td>
                    <td><input type="text" name="admin_nav_name" id="admin_nav_name"
                            value="{{ $data->admin_nav_name }}"></td>
                </tr>
                <tr>
                    <td> <label for="admin_nav_route">短連結:</label></td>
                    <td><input type="text" name="admin_nav_route" id="admin_nav_route"
                            value="{{ $data->admin_nav_route }}"></td>
                </tr>
                <tr>
                    <td></td>
                    <td class="text-end">
                        <input type="submit" value="編輯" class="btn btn-primary btn-sm">
                        <input type="reset" value="重整" class="btn btn-warning btn-sm">
                        <input type="button" value="回上一頁" onclick="history.go(-1)" class="btn btn-secondary btn-sm">
                    </td>
                </tr>
            </table>


        </form>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var selectedValue = "{{ $data->admin_nav }}";
        var selectElement = document.getElementById("admin_nav");

        for (var i = 0; i < selectElement.options.length; i++) {
            if (selectElement.options[i].value === selectedValue) {
                selectElement.options[i].selected = true;
                break;
            }
        }
    });
</script>
