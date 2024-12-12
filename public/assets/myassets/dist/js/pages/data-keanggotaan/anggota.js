$(function () {
    const kolomExportable = [0, 1, 2, 3];
    const konfigurasiDataTable = {
        scrollX: true,
        scrollCollapse: true,
        scrollY: '56.9vh',
        buttons: [
            { extend: 'copy', exportOptions: { columns: kolomExportable } },
            { extend: 'excel', exportOptions: { columns: kolomExportable } },
            { extend: 'pdf', exportOptions: { columns: kolomExportable } },
            { extend: 'print', exportOptions: { columns: kolomExportable } }
        ],
        columnDefs: [
            { targets: [4], orderable: false, searchable: false }
        ]
    };

    const dataTable = $("#table-anggota").DataTable(konfigurasiDataTable);
    const request = '/data-keanggotaan/anggota/';

    dataTable.buttons().container().appendTo('#table-anggota_wrapper .col-md-6:eq(0)');

    $(document).on('click', 'a[href="#collapseTwo"]', function () {
        dataTable.columns.adjust().draw();
    });

    $(document).on('click', '[data-target^="#modal-"]', function () {
        const id = $(this).data('id');
        const modalId = $(this).data('target');
        tampilkanLoading(modalId);
        ambilData(id, modalId);
    });

    const ambilData = (id, modalId) => {
        $.ajax({
            url: url(`${request}${id}`),
            type: 'GET',
            success: (response) => isiModal(modalId, response),
            error: () => tampilkanError(modalId),
            complete: () => hilangkanLoading(modalId)
        });
    };

    const isiModal = (modalId, response) => {
        const modal = $(modalId);
        const { id, nik, nama, jenis_kelamin, grup_id, grup, alamat } = response;
        const actions = {
            '#modal-detail': () => {
                modal.find('#nik').text(nik);
                modal.find('#nama_anggota').text(nama);
                modal.find('#jenis_kelamin').text(jenis_kelamin);
                modal.find('#nama_grup').text(grup?.nama);
                modal.find('#alamat').text(alamat);
            },
            '#modal-ubah': () => {
                modal.find('form').attr('action', url(`${request}${id}`));
                modal.find('[name="id"]').val(id);
                modal.find('[name="nik"]').val(nik);
                modal.find('[name="nama"]').val(nama);
                modal.find('[name="jenis_kelamin"]').val(jenis_kelamin).trigger('change');
                modal.find('[name="grup_id"]').val(grup_id).trigger('change');
                modal.find('[name="alamat"]').val(alamat);
            },
            '#modal-hapus': () => {
                modal.find('form').attr('action', url(`${request}${id}`));
                modal.find('#nik').text(nik);
            }
        };

        actions[modalId]?.();
    };

    const tampilkanLoading = (modalId) => {
        $(modalId).find('.modal-content').prepend('<div class="overlay"><i class="fas fa-2x fa-sync fa-spin"></i></div>');
    };

    const hilangkanLoading = (modalId) => {
        $(modalId).find('.overlay').remove();
    };

    const tampilkanError = (modalId) => {
        $(modalId).find('.modal-body').html('<p class="m-0">Terjadi kesalahan. Silakan coba lagi.</p>');
        $(modalId).find('.modal-footer').remove();
    };

    const modalUbah = $('#modal-ubah');
    if (modalUbah.find('.is-invalid').length) {
        const id = modalUbah.find('[name="id"]').val();
        modalUbah.find('form').attr('action', url(`${request}${id}`));
        setTimeout(() => modalUbah.modal('show'), 500);
    }
});
