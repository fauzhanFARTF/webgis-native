<?php 

$conn = mysqli_connect("localhost","root","","kabtangcorona");

// Fungsi query
function query($query){
    // Koneksi DBMS
    global $conn;
    // ambil query
    $result = mysqli_query($conn,$query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)){
            $rows[] = $row;
    }
    return $rows;
}

?>