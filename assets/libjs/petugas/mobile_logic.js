$(document).ready(function() {
    
    // Fitur Pencarian Real-time
    $("#searchInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        
        $("#listContainer .item-riwayat").filter(function() {
            // Cari teks di dalam elemen class 'search-target' (Lokasi jalan)
            var textLokasi = $(this).find(".search-target").text().toLowerCase();
            
            // Toggle tampil/sembunyi
            $(this).toggle(textLokasi.indexOf(value) > -1)
        });
    });

    // Handler Form Selesai (Petugas)
    $('#formSelesai').on('submit', function(e) {
        e.preventDefault();
        
        // Tutup Modal dulu biar rapi
        $('#modalSelesai').modal('hide');

        // Loading
        Swal.fire({
            title: 'Mengirim Data...',
            text: 'Sedang mengupload bukti perbaikan.',
            allowOutsideClick: false,
            didOpen: () => { Swal.showLoading() }
        });

        let formData = new FormData(this);

        $.ajax({
            url: base_url + 'petugas/aksi_selesai',
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
            success: function(response) {
                if(response.status) {
                    Swal.fire('Kerja Bagus!', response.message, 'success').then(() => {
                        window.location.href = base_url + 'petugas/dashboard';
                    });
                } else {
                    Swal.fire('Gagal', response.message, 'error').then(() => {
                        $('#modalSelesai').modal('show'); // Munculkan lagi kalau error
                    });
                }
            },
            error: function() {
                Swal.fire('Error', 'Terjadi kesalahan jaringan.', 'error');
            }
        });
    });
});

window.bukaDetail = function(jsonString) {
    // 1. Parsing Data dari PHP
    let item;
    try {
        item = JSON.parse(jsonString);
    } catch (e) {
        console.error("Gagal parse JSON", e);
        return;
    }

    // 2. Isi Tab 1 (Sebelum / Laporan Awal)
    $('#detailFotoAwal').attr('src', base_url + item.foto_bukti);
    $('#detailKetAwal').text(item.keterangan_pengaduan);
    // Tampilkan nama pelapor jika ada (dari join table users)
    let namaPelapor = item.nama_pelapor ? item.nama_pelapor : 'Warga'; 
    $('#detailPelapor').text(namaPelapor);

    // 3. Isi Tab 2 (Sesudah / Bukti Selesai)
    if (item.foto_bukti_selesai) {
        $('#detailFotoSelesai').attr('src', base_url + item.foto_bukti_selesai);
    } else {
        // Fallback jika foto selesai corrupt/hilang
        $('#detailFotoSelesai').attr('src', base_url + 'assets/dist/img/no-image.png'); 
    }
    
    $('#detailKetAdmin').text(item.keterangan_admin || "Tidak ada keterangan pengerjaan.");

    // 4. Reset Tab ke posisi awal (Tab 'Sebelum' aktif duluan)
    let tabAwalBtn = document.querySelector('#tab-laporan');
    let tabAwalInstance = new bootstrap.Tab(tabAwalBtn);
    tabAwalInstance.show();

    // 5. Tampilkan Modal
    $('#modalDetailRiwayat').modal('show');
};

// Helper Preview Image
function previewImage(src) {
    Swal.fire({
        imageUrl: src,
        imageWidth: '100%',
        showConfirmButton: false,
        showCloseButton: true
    });
}