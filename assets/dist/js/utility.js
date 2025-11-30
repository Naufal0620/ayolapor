$(document).on("click", "#btn-logout", function () {
    let role = $(this).data('role');
    let url = base_url + 'login/logout/' + role;

    Swal.fire({
        title: "Apakah anda yakin ingin keluar?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#c82333",
        cancelButtonColor: "#6c757d",
        cancelButtonText: "Batal",
        confirmButtonText: "Ya, keluar!"
    }).then((result) => {
        if (result.isConfirmed) {
            window.location = url;
        }
    });
});