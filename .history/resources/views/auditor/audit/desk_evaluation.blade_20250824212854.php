// Modifikasi bagian pengumpulan data di event handler "Simpan Evaluasi"
$('#submit-final-step').on('click', function(e) {
    e.preventDefault();

    if (confirm('Apakah Anda yakin ingin menyimpan evaluasi ini?')) {
        // Clear existing validation errors
        $('.text-red-500').remove();
        $('.border-red-500').removeClass('border-red-500');

        // Get current active step
        const activeStep = $('.wizard-step.active').data('step');

        // Only collect data from active step
        const formData = new FormData();
        formData.append('_token', $('meta[name="csrf-token"]').attr('content'));
        formData.append('pengajuan_id', $('#pengajuan_id').val());

        // Collect data only from current active step
        $(`.wizard-section[data-step="${activeStep}"] textarea, .wizard-section[data-step="${activeStep}"] select`).each(function() {
            const name = $(this).attr('name');
            const value = $(this).val();
            if (name && value) {
                formData.append(name, value);
            }
        });

        // Add ikss_auditee_ids for current step
        $(`.wizard-section[data-step="${activeStep}"] input[name="ikss_auditee_ids[]"]`).each(function() {
            formData.append('ikss_auditee_ids[]', $(this).val());
        });

        // Submit data
        $.ajax({
            url: '{{ route("auditor.audit.submitDeskEvaluation") }}',
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert('Evaluasi berhasil disimpan!');
                location.reload();
            },
            error: function(xhr) {
                if (xhr.status === 422) {
                    displayValidationErrors(xhr.responseJSON.errors);
                    scrollToFirstError();
                } else {
                    alert('Terjadi kesalahan saat menyimpan evaluasi.');
                }
                $('#submit-final-step').prop('disabled', false);
            }
        });
    }
});
