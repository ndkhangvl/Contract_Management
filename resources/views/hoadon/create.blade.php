<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<h1>Thêm mới Hoá đơn</h1>
<style>
        form {
                width: 80%;
        }
        table, th, td {
        border: 1px solid black;
        border-collapse: collapse;
       

    }  
    
    th {
        background: #337ab7; 
        color:white;
        text-align:center;
    }
    
    table {
        width:90%;
    }
</style>

<form action="/hoadon" method="post">
@csrf
    <!--<h3>Hợp đồng số: {{$hopdongso}}</h3>-->
    Hợp đồng số: 
    <input class="form-control" 
            type="text" name="sohopdong" 
            value="{{$hopdongso}}" readonly>
    Hóa đơn số: <input class="form-control" 
            type="text" name="sohoadon" 
            placeholder="Số hóa đơn">
    File: <input class="form-control" 
            type="file" name="filehoadon">
    Thuế (%): <button class="btn btn-primary" onclick="myFunction()" type="button">
        Tính toán
    </button>
    <input class="form-control" id="thuesuat"
            type="number" name="thuesuat" value=0 min="0">
    Tổng tiền (VNĐ): 
    <input class="form-control" 
            type="text" name="tongtien" id="tongtien"
            readonly>
    Tiền thuế (VNĐ): 
    <input class="form-control" 
            type="text" name="tienthue" id="tienthue"
            readonly>
    Tổng tiền có thuế (VNĐ): 
    <input class="form-control" 
            type="text" name="tongtiencothue" id="tongtiencothue"
            readonly>
    Số tiền (bằng chữ): <input class="form-control" 
            type="text" name="sotienbangchu">
    Người tạo: <input class="form-control" 
            type="text" name="nguoitao">
    Người mua hàng: <input class="form-control" 
            type="text" name="nguoimuahang">
    <div>
    <hr>
    <label>Trạng thái hóa đơn:</label>
    <select name="trangthaihoadon">
        <option value=0>
            Chưa thanh toán
        </option>  
        <option value=1>
            Đã thanh toán
        </option>                               
    </select>
    <hr>
    </div>
    <h1>Danh sách chi tiết</h1>
    <hr>
    Số lượng loại sản phẩm:
    <input class="form-control" 
            type="number" name="soluongchitiet" value=0 min="0" max="10" id="slct"><hr>
    <table>
        <tr>
            <th width="10%" color="blue">STT</th>
            <th width="20%">Nội dung</th>
            <th width="10%">Số lượng</th>
            <th width="10%">Đơn vị tính</th>
            <th width="20%">Đơn giá</th>
            <th width="30%">Thành tiền</th>
        </tr>
        @for ($i = 1; $i <= 10; $i++)
             <tr>
                <td><input type="text" name="stt{{$i}}" value="{{$i}}" readonly></td>
                <td><input type="text" name="noidung{{$i}}" ></td>
                <td><input type="text" name="soluong{{$i}}" id="soluong{{$i}}"></td>
                <td><input type="text" name="donvitinh{{$i}}" ></td>
                <td><input type="text" name="dongia{{$i}}" id="dongia{{$i}}"></td>
                <td><input type="text" name="thanhtien{{$i}}" readonly id="thanhtien{{$i}}"></td>
            </tr>
        @endfor     
    </table>
    <hr>
    <button class="btn btn-primary" type="submit">
        Tạo hóa đơn
    </button>
    <button class="btn btn-primary" onclick="myFunction()" type="button">
        Tính toán
    </button><hr>
        <script>
        function myFunction() {
                $cnt = document.getElementById("slct").value;
                $thue = document.getElementById("thuesuat").value;
                $tongtien = 0;
                $tienthue = 0;
                $tongtiencothue = 0;
                for($i = 1; $i <= $cnt; $i++){
                        $sluong = "soluong"+$i;
                        $dgia = "dongia"+$i;
                        $ttien = "thanhtien"+$i;
                        $sl = document.getElementById($sluong).value;
                        $dg = document.getElementById($dgia).value;
                        $cal = parseInt($sl) * parseInt($dg);
                        document.getElementById($ttien).value = $cal;
                        $tongtien = $tongtien + $cal;
                        //console.log($i);
                }
                $tienthue = $tongtien/100*$thue;
                $tongtiencothue = $tongtien+$tienthue;
                document.getElementById("tongtien").value= $tongtien;
                document.getElementById("tienthue").value= $tienthue;
                document.getElementById("tongtiencothue").value= $tongtiencothue;
                
        }
        </script>



</form>


@if ($errors->any())
      <div>
        @foreach ($errors->all() as $error)
          <p class="text-danger">
            {{ $error }}
          </p>
        @endforeach
      </div>
    @endif