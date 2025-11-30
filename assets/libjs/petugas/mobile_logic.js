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
});

function selesaikanTugas(id) {
    Swal.fire({
        title: 'Konfirmasi',
        text: "Apakah perbaikan jalan ini sudah selesai 100%?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#198754', // Bootstrap success color
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Selesai!',
        cancelButtonText: 'Batal'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: base_url + 'petugas/aksi_selesai', // Pastikan base_url didefinisikan
                type: 'POST',
                data: {id: id},
                dataType: 'json',
                success: function(res){
                    Swal.fire('Berhasil', 'Laporan telah ditutup.', 'success')
                    .then(() => {
                        window.location.href = base_url + 'petugas/dashboard';
                    });
                }
            });
        }
    })
}

// Helper Preview Image
function previewImage(src) {
    Swal.fire({
        imageUrl: src,
        imageWidth: '100%',
        showConfirmButton: false,
        showCloseButton: true
    });
}