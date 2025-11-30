let form_id = ['#form-pengaduan'];
let table_id = ['#table-pengaduan'];

let modal_form_id = ['#modal-pengaduan'];
let modal_title_id = [modal_form_id[0] + ' h4.modal-title'];

let form_element = {};

form_element['input'] = ['#id', '#latitude', '#longitude'];
form_element['select'] = ['#id_user', '#status'];
form_element['textarea'] = ['#lokasi_text', '#keterangan_pengaduan', '#keterangan_admin'];
form_element['imageInput'] = ['#foto_bukti'];
form_element['imagePreview'] = ['#foto_bukti_preview'];
form_element['imageFileName'] = ['#foto_bukti_filename'];


// --- Inisialisasi Peta ---
// Set view awal ke Indonesia (Medan) sebagai default
var map = L.map('map').setView([3.59066, 98.67852], 13);
// --- VARIABEL GLOBAL ---
var currentMarker = null;
var currentCircle = null;

$(document).ready(function () {
    loadTableMain(table_id[0]);

    $(form_element['imageInput'][0]).on('change', function (e) {
        var file = e.target.files[0];
        var reader = new FileReader();

        reader.onload = function (e) {
            $(form_element['imagePreview'][0]).attr('src', e.target.result);
            $(form_element['imageFileName'][0]).html($(form_element['imageInput'][0]).val().replace(/C:\\fakepath\\/i, ''));
        }

        reader.readAsDataURL(file);
    });

    // Tambahkan Tile Layer (Peta dasar dari OpenStreetMap)
    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        maxZoom: 19,
        attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);

    // --- FITUR 1: Klik Peta ---
    map.on('click', function(e) {
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;
        console.log("Koordinat diklik:", lat, lng);

        // 1. Hapus Marker Lama
        if (currentMarker) {
            map.removeLayer(currentMarker);
            currentMarker = null;
        }

        // 2. Hapus Lingkaran Lama
        if (currentCircle) {
            map.removeLayer(currentCircle);
            currentCircle = null; // Reset variabel jadi kosong
        }

        // 3. Tambah Marker Baru
        currentMarker = L.marker([lat, lng]).addTo(map)
            .openPopup();

        $(form_element['input'][1]).val(lat);
        $(form_element['input'][2]).val(lng);
    });

    // --- FITUR 2: Tombol Cari Lokasi ---
    $(document).on('click', '.btn-lokasi-terkini', function () {
        if (!navigator.geolocation) {
            alert("Browser tidak mendukung Geolocation.");
            return;
        }

        // Hapus marker/circle lama dulu biar bersih saat proses pencarian dimulai
        if (currentMarker) map.removeLayer(currentMarker);
        if (currentCircle) map.removeLayer(currentCircle);

        console.log("Sedang mencari lokasi akurat...");

        map.locate({
            setView: true,
            maxZoom: 16,
            enableHighAccuracy: true,
            maximumAge: 0,
            timeout: 10000
        });
        
    });

    map.on('locationfound', function(e) {
        console.log("Lokasi ditemukan:", e.latlng);

        // Bersihkan marker lama
        if (currentMarker) {
            map.removeLayer(currentMarker);
            currentMarker = null;
        }
        
        // Bersihkan lingkaran lama sebelum membuat yang baru
        if (currentCircle) {
            map.removeLayer(currentCircle);
            currentCircle = null;
        }

        // Buat variabel koordinat
        var lat = e.latlng.lat;
        var lng = e.latlng.lng;

        // Buat Marker Baru
        currentMarker = L.marker(e.latlng).addTo(map)
            .bindPopup("Anda berada di sini!")
            .openPopup();
        
        $(form_element['input'][1]).val(lat);
        $(form_element['input'][2]).val(lng);

        // Buat Lingkaran Baru dan SIMPAN ke variabel currentCircle
        currentCircle = L.circle(e.latlng, e.accuracy).addTo(map);
    });

    map.on('locationerror', function(e) {
        alert("Gagal menemukan lokasi: " + e.message);
    });
});

function isNumeric(value) {
  return !isNaN(parseFloat(value)) && isFinite(value);
}

function loadingButton(button, loading = true, button_icon) {
    if (loading) {
        button.attr("disabled", "disabled");
    } else {
        button.removeAttr("disabled");
    }
    button.find("i").removeClass();
    button.find("i").attr("class", button_icon);
}

function loadTableMain(table) {
    let url = base_url + current_controller + '/' + current_page + '/table';

    $(table).DataTable().destroy();

    $(table).DataTable({
        "autoWidth": false,
        "retrieve": true,
        "processing": true,
        "serverSide": true,
        "ordering": false,
        "stateSave": true,
        "stateDuration": 0,

        "ajax": {
            "url": url,
            "type": "POST"
        },

        "columnDefs": [
            {
                "targets": [0, 4, -1],
                "width": '5%',
            }
        ]
    });
}

$(document).on('click', '.btn-tambah-pengaduan', function (e) {
    e.preventDefault();

    let url = base_url + current_controller + '/' + current_page + '/tambah/';

    $(form_id[0] + ' input').val('');
    $(form_id[0] + ' select').val('');
    $(form_id[0] + ' textarea').html('');
    $("#bukti_foto_filename").html('Pilih Foto');
    $(form_id + ' #foto_bukti_preview').attr('src', base_url + 'assets/dist/img/none.png');
    $(form_element['select'][0]).html('<option value="" hidden selected>-- Pilih --</option>');

    $.ajax({
        type: "POST",
        url: url,
        data: "",
        dataType: "JSON",
        success: function (res) {
            if (res.status) {
                res.users.forEach(user => {
                    let user_opt = "<option value='" + user.id_user + "'>[" + user.role + "] " + user.email + "</option>";
                    $(form_element['select'][0]).append(user_opt);
                });

                // 1. Hapus Marker Lama
                if (currentMarker) {
                    map.removeLayer(currentMarker);
                    currentCircle = null;
                }

                // 2. Hapus Lingkaran Lama
                if (currentCircle) {
                    map.removeLayer(currentCircle);
                    currentCircle = null;
                }

                map.panTo([3.59066, 98.67852]);

                $(modal_title_id[0]).text('Tambah Pengaduan');
                $(modal_form_id[0]).modal('show');

                setTimeout(function() {
                    map.invalidateSize();
                }, 500);
            }
        }
    });
});

$(document).on('click', '.btn-edit-pengaduan', function (e) {
    e.preventDefault();

    let id = $(this).data('id');

    let url = base_url + current_controller + '/' + current_page + '/edit/' + id;

    $(form_id[0] + ' input').val('');
    $(form_id[0] + ' select').val('');
    $(form_id[0] + ' textarea').html('');
    $("#bukti_foto_filename").html('Pilih Foto');
    $(form_id + ' #foto_bukti_preview').attr('src', base_url + 'assets/dist/img/none.png');
    $(form_element['select'][0]).html('<option value="" hidden selected>-- Pilih --</option>');

    $.ajax({
        type: "POST",
        url: url,
        data: "",
        dataType: "JSON",
        success: function (res) {
            if (res.status) {
                $(modal_title_id[0]).text('Edit Pengaduan');

                const data = Object.values(res.data);

                let userExist = false;
                res.users.forEach(user => {
                    let user_opt = "<option value='" + user.id_user + "'>[" + user.role + "] " + user.email + "</option>";
                    $(form_element['select'][0]).append(user_opt);
                    if (user.id_user == data[1]) {
                        userExist = true;
                    }
                });

                // 1. Hapus Marker Lama
                if (currentMarker) {
                    map.removeLayer(currentMarker);
                    currentCircle = null;
                }

                // 2. Hapus Lingkaran Lama
                if (currentCircle) {
                    map.removeLayer(currentCircle);
                    currentCircle = null;
                }

                currentMarker = L.marker([data[4], data[5]]).addTo(map).openPopup();
                map.panTo([data[4], data[5]]);

                $(form_element['input'][0]).val(data[0]);
                $(form_element['input'][1]).val(data[4]);
                $(form_element['input'][2]).val(data[5]);
                $(form_element['textarea'][0]).html(data[3]);
                $(form_element['textarea'][1]).html(data[8]);
                $(form_element['textarea'][2]).html(data[9]);
                $(form_element['select'][0]).val(data[1]);
                $(form_element['select'][1]).val(data[10]);

                $(form_element['imagePreview'][0]).attr('src', base_url + data[6]);

                $(modal_form_id[0]).modal('show');

                setTimeout(function() {
                    map.invalidateSize();
                }, 500);
            }
        }
    });
});

$(document).on('click', '.btn-simpan', function () {
    console.log("Button Simpan Clicked");

    let url = base_url + current_controller + '/' + current_page + '/simpan';
    let formData = new FormData($(form_id[0])[0]);

    var isEmpty = false;

    $(form_id[0] + " :input:not(#id, .optional)").each(function () {
        if ($(this).val() == "") {
            $(this).addClass("is-invalid");
            console.log("Input ada yang kosong");
            isEmpty = true;
        } else {
            $(this).removeClass("is-invalid");
            if (!isEmpty) {
                isEmpty = false;
            }
        }
    })

    if (!isEmpty) {
        $.ajax({
            type: "POST",
            url: url,
            data: formData,
            contentType: false,
            processData: false,
            dataType: "JSON",
        }).done(function (res) {
            if (res.status) {
                toastr.success(res.msg);
                $(modal_form_id[0]).modal('hide');
                loadTableMain(table_id[0]);
            } else {
                toastr.error(res.msg);
            }
            console.log(res.test);
        }).fail(function () {
            toastr.warning('Terjadi kesalahan dalam sistem!');
        })
    }
});

$(document).on('click', '.btn-hapus-pengaduan', function () {
    console.log("Button Hapus Clicked");

    let id = $(this).data('id');
    let url = base_url + current_controller + '/' + current_page + '/hapus/' + id;

    Swal.fire({
        title: "Apakah anda yakin?",
        text: "Data yang dihapus tidak bisa dikembalikan!",
        icon: "warning",
        showCancelButton: true,
        cancelButtonText: "Batal",
        confirmButtonText: "Ya, hapus!",
        confirmButtonColor: "#dc3545",
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST",
                url: url,
                data: "",
                dataType: "JSON",
                success: function (res) {
                    if (res.status) {
                        toastr.success(res.msg);
                    } else {
                        toastr.error(res.msg);
                    }
                    console.log(res);
                    setTimeout(function () {
                        loadTableMain(table_id[0]);
                    }, 500);
                }
            });
        }
    });
});