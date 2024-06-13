<h2 >Input Data Order</h2>
<form action="order_proses.php" method="post" >

<table class="masukkan">
    <tr>
        <td>Nama</td>
        <td><input type="text" name="order_nama" id="nama" onblur="cek_valid2()">
        <label id="namaError" style="color:red"></label></td>
    </tr>
    <tr>
        <td>Hp</td>
        <td><input type="text" name="order_hp" id="hp" onblur="cek_valid2()">
        <label id="hpError" style="color:red"></label></td>
        
    </tr>
    <tr>
        <td>Tanggal</td>
        <td><input type="date" name="order_tanggal" required></td>
    </tr>
    <tr>
        <td>Paket</td>
        <td>
            <select name="order_paket" id="paket" onchange="hitungHarga()">
                <option value="">--PILIH PAKET--</option>
                <option value="1">Finding 1 (Rp 100.000)</option>
                <option value="2">Finding 2 (Rp 200.000)</option>
                <option value="3">Finding 3 (Rp 300.000)</option>
                <option value="4">Finding 4 (Rp 400.000)</option>
            </select>
        </td>
    </tr>
    <tr>
        <td>Tambahan</td>
        <td>
            <input type="checkbox" name="order_tambahan[]" value="Dessert" onchange="hitungHarga()"> Extra Dessert (Rp 50.000)<br>
            <input type="checkbox" name="order_tambahan[]" value="Snack" onchange="hitungHarga()"> Extra Snack (Rp 35.000)<br>
            <input type="checkbox" name="order_tambahan[]" value="Minuman" onchange="hitungHarga()"> Extra Minuman (Rp 15.000)<br>
        </td>
    </tr>
    <tr>
        <td>Harga</td>
        <td><input type="text" name="order_harga" id="harga" readonly></td>
    </tr>
    <tr>
        <td></td>
        <td><input type="submit" name="b_simpan" value="simpan"></td>
    </tr>
</table>

<script>
     function hitungHarga() {
            var paket = document.getElementById("paket").value;
            var tambahan = [];
            var hargaTambahan = 0;

            // Get the checked tambahan checkboxes
            var tambahanCheckboxes = document.getElementsByName("order_tambahan[]");
            for (var i = 0; i < tambahanCheckboxes.length; i++) {
                 if (tambahanCheckboxes[i].checked) {
                    tambahan.push(tambahanCheckboxes[i].value);
                    switch (tambahanCheckboxes[i].value) {
                        case "Dessert":
                            hargaTambahan += 50000;
                            break;
                        case "Snack":
                            hargaTambahan += 75000;
                            break;
                        case "Minuman":
                            hargaTambahan += 100000;
                            break;
                    }
                }
            }

            // Calculate the total price
            var hargaTotal = 0;
            switch (paket) {
                case "1":
                    hargaTotal = 100000;
                    break;
                case "2":
                    hargaTotal = 200000;
                    break;
                case "3":
                    hargaTotal = 300000;
                    break;
                case "4":
                    hargaTotal = 400000;
                    break;
            }
            hargaTotal += hargaTambahan;

            // Update the harga field
            document.getElementById("harga").value = hargaTotal;
        }

        function cek_valid() {                    
            var nama = document.getElementById("nama").value;
            var hp = document.getElementById("hp").value;
            var paket = document.getElementById("paket").value;
            var validasiHuruf = /^[a-zA-Z ]+$/;
            var validasiAngka = /^[0-9]+$/;  
            var data = 'Data Berhasil \n' + 'NIM anda = ' + nim + '\nNama anda = ' + nama + '\nKelas anda = ' + kelas + '\nJenis Kelamin anda = ' + jenkel+ '\nAlamat anda = ' + alamat;
            var pesan = '';           

            if (nama == ""){
                pesan += 'Nama Harus Diisi\n';            
            }                     
                    
            if (nama != "" && !nama.match(validasiHuruf)) {
                pesan += 'Nama Harus Huruf\n';
            } 

            if (hp == ""){
                pesan = 'HP Harus Diisi\n';            
            }                     
                    
            if (hp != "" && !hp.match(validasiAngka)) {
                pesan += 'HP Harus Angka\n';
            }   

            if(pesan != ""){//kondisi untuk menampilkan pesan
                alert('Ada kesalahan pada pengisisan formulir : \n'+pesan);
                return false;
            }
            
            if(nama != "" && hp != ""  && paket != "" ){
                alert(data);
            }
            return true;
        }

        function cek_valid2() {
            var nama = document.getElementById("nama").value;
            var hp = document.getElementById("hp").value;
            var paket = document.getElementById("paket").value;
            //var data = "NIM Anda = " + nim + "<br>Nama Anda = " + nama + "<br>Kelas Anda = " + kelas;
            var validasiHuruf = /^[a-zA-Z ]+$/; 
            var validasiAngka = /^[0-9]+$/;           
                        
            if (nama == ""){
                document.getElementById("namaError").innerHTML = "Nama Masih Kosong";                                  
            } else {
                if (nama.match(validasiHuruf)) {
                    document.getElementById("namaError").innerHTML = "";                        
                } else {
                    document.getElementById("namaError").innerHTML = "Nama Harus Huruf";
                }  
            }  

            if (hp == ""){
                document.getElementById("hpError").innerHTML = "hp Masih Kosong";                    
            } else {
                if (hp.match(validasiAngka)) {
                    document.getElementById("hpError").innerHTML = "";
                } else {
                    document.getElementById("hpError").innerHTML = "hp Harus Angka";
                }                   
            }
        }
</script>
</form>