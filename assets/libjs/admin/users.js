let form_id = ['#form-users'];
let table_id = ['#table-users'];

let modal_form_id = ['#modal-users'];
let modal_title_id = [modal_form_id[0] + ' h4.modal-title'];

let form_element = {};

form_element['input'] = ['#id', '#nama_lengkap', '#email', '#password', '#no_telp'];
form_element['select'] = ['#role'];
form_element['textarea'] = [];
form_element['imageInput'] = [];
form_element['imagePreview'] = [];
form_element['imageFileName'] = [];

$(document).ready(function () {
    loadTableMain(table_id[0]);
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

$(document).on('click', '.btn-tambah-user', function (e) {
    e.preventDefault();

    let url = base_url + current_controller + '/' + current_page + '/tambah/';

    $("#text-password").addClass("d-none");
    $(form_element['input'][3]).removeClass("optional");

    $(form_id[0] + ' input').val('');
    $(form_id[0] + ' select').val('');

    $.ajax({
        type: "POST",
        url: url,
        data: "",
        dataType: "JSON",
        success: function (res) {
            if (res.status) {
                $(modal_title_id[0]).text('Tambah User');
                $(modal_form_id[0]).modal('show');
            }
        }
    });
});

$(document).on('click', '.btn-edit-user', function (e) {
    e.preventDefault();

    let id = $(this).data('id');

    let url = base_url + current_controller + '/' + current_page + '/edit/' + id;

    $("#text-password").removeClass("d-none");
    $(form_element['input'][3]).addClass("optional");

    $(form_id[0] + ' input').val('');
    $(form_id[0] + ' select').val('');

    $.ajax({
        type: "POST",
        url: url,
        data: "",
        dataType: "JSON",
        success: function (res) {
            if (res.status) {
                $(modal_title_id[0]).text('Edit User');

                const data = Object.values(res.data);

                $(form_element['input'][0]).val(data[0]);
                $(form_element['input'][1]).val(data[1]);
                $(form_element['input'][2]).val(data[2]);
                $(form_element['input'][4]).val(data[4]);
                $(form_element['select'][0]).val(data[5]);

                $(modal_form_id[0]).modal('show');
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

$(document).on('click', '.btn-hapus-user', function () {
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