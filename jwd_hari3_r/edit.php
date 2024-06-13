<?php
require_once "koneksi.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM tb_order WHERE order_id =?";
    $stmt = $koneksi->prepare($sql);
    $stmt->execute([$id]);
    $row = $stmt->fetch();

    if (isset($_POST['submit'])) {
        $nama = $_POST['nama'];
        $hp = $_POST['hp'];
        $tanggal = $_POST['tanggal']; // bagian tgl
        $paket = $_POST['finding'];
        $tambahan = implode(',', $_POST['tambahan']);
        $harga = $_POST['harga'];

        $sql = "UPDATE tb_order SET order_nama =?, order_hp =?, order_finding =?, order_tambahan =?, order_harga =?, order_tanggal =? WHERE order_id =?";
        $stmt = $koneksi->prepare($sql);
        $stmt->execute([$nama, $hp, $finding, $tambahan, $harga, $tanggal, $id]);

        header('location:index.php?page=order_tampil');
        exit;
    }
}

?>

<form action="" method="post">

    <table>
        <tr>
            <td><label>Nama:</label></td>
            <td><input type="text" name="nama" value="<?php echo $row['order_nama'];?>"></td>
        </tr>
        <tr>
            <td> <label>HP:</label></td>
            <td> <input type="text" name="hp" value="<?php echo $row['order_hp'];?>"></td>
        </tr>
        <tr>
            <td><label>Tanggal:</label></td>
            <td><input type="date" name="tanggal" value="<?php echo $row['order_tanggal'];?>"></td>
        </tr>
        <tr>
            <td><label>Paket:</label></td>
            <td>
                <select name="paket" id="paket" onchange="hitungHarga()">
                    <option value="1" <?php if($row['order_finding'] == 1) echo 'elected';?>>Finding 1 (Rp 100.000)</option>
                    <option value="2" <?php if($row['order_finding'] == 2) echo 'elected';?>>Finding 2 (Rp 200.000)</option>
                    <option value="3" <?php if($row['order_finding'] == 3) echo 'elected';?>>finding 3 (Rp 300.000)</option>
                    <option value="4" <?php if($row['order_finding'] == 4) echo 'elected';?>>finding 4 (Rp 400.000)</option>
                </select>
            </td>
        </tr>
        <tr>
            <td><label>Tambahan:</label></td>
            <td>
                <?php
                $tambahan_array = explode(',', $row['order_tambahan']); // convert string to array
             ?>
                <input type="checkbox" name="tambahan[]" value="Hotel" <?php if(in_array('Hotel', $tambahan_array)) echo 'checked';?> onchange="hitungHarga()"> Extra Hotel (Rp 50.000)<br>
                <input type="checkbox" name="tambahan[]" value="Mobil" <?php if(in_array('Mobil', $tambahan_array)) echo 'checked';?> onchange="hitungHarga()"> Extra Mobil (Rp 75.000)<br>
                <input type="checkbox" name="tambahan[]" value="Kapal" <?php if(in_array('Kapal', $tambahan_array)) echo 'checked';?> onchange="hitungHarga()"> Extra Kapal (Rp 100.000)<br>
            </td>
        </tr>
        <tr>
            <td><label>Harga:</label></td>
            <td><input type="text" name="harga" id="harga" value="<?php echo $row['order_harga'];?>" readonly></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="submit" name="submit" value="Update"></td>
        </tr>
    </table>

    <script>
        function hitungHarga() {
            var paket = document.getElementById("paket").value;
            var tambahan = [];
            var hargaTambahan = 0;

            // Get the checked tambahan checkboxes
            var tambahanCheckboxes = document.getElementsByName("tambahan[]");
            for (var i = 0; i < tambahanCheckboxes.length; i++) {
                 if (tambahanCheckboxes[i].checked) {
                    tambahan.push(tambahanCheckboxes[i].value);
                    switch (tambahanCheckboxes[i].value) {
                        case "Hotel":
                            hargaTambahan += 50000;
                            break;
                        case "Mobil":
                            hargaTambahan += 75000;
                            break;
                        case "Kapal":
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
    </script>
</form>