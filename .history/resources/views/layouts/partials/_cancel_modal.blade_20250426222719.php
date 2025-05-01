<script>
    document.getElementById('cancelModal').addEventListener('click', function (e) {
        e.preventDefault();

        Swal.fire({
            text: "Apakah Anda yakin ingin membatalkan?",
            icon: "warning",
            showCancelButton: true,
            buttonsStyling: false,
            confirmButtonText: "Ya, batalkan!",
            cancelButtonText: "Tidak, kembali",
            customClass: {
                confirmButton: "btn btn-primary btn-sm",
                 style="padding-top: .8rem; padding-bottom: .8rem;"
                cancelButton: "btn btn-danger" // Warna merah untuk tombol cancel
            }
        }).then(function (result) {
            if (result.value) {
                document.getElementById('kt_modal_form').reset(); // Reset form
                $('#kt_modal').modal('hide'); // Tutup modal
            } else if (result.dismiss === 'cancel') {
                Swal.close();
            }
        });
    });
</script>
