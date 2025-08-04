$(document).ready(function () {
    // CSRF Token setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // menampilakn data siswa
    function loadData() {
        $.ajax({
            url: '/home/api/siswa/show',
            type: 'GET',
            dataType: 'json',
            success: function (resultData) {
                if (resultData.success) {
                    let html = "";
                    $.each(resultData.dataSiswa, function (index, item) {
                        html += `
                        <tr class="text-center">
                            <td>${index + 1}</td>
                            <td>${item.nis}</td>
                            <td>${item.nama}</td>
                            <td>${item.kelas}</td>
                            <td>${item.tanggal_lahir}</td>
                            <td>${item.alamat}</td>
                            <td>
                                <button class="btn btn-warning btn-update" data-bs-toggle="modal" data-bs-target="#modal-update" data-id="${item.id}" data-nis="${item.nis}" data-nama="${item.nama}" data-kelas="${item.kelas}" data-tanggal_lahir="${item.tanggal_lahir}" data-alamat="${item.alamat}"><i class="fa-solid fa-pen-to-square"></i> </button>
                                <button class="btn btn-danger btn-del" data-id="${item.id}"><i class="fa-solid fa-trash"></i> </button>
                            </td>
                        </tr>
                        `;
                    });
                    $('#dataSiswa').html(html);
                }
            }
        });
    }

    loadData();

    // tambah data siswa
    $('#siswa-form').off('submit').on('submit', function (e) {
        e.preventDefault();
        let resultForm = $(this).serialize();
    
        // penanganan REST condition
        Swal.fire({
            title: 'Menyimpan...',
            html: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

        $.ajax({
            url: '/home/api/siswa/store',
            type: 'POST',
            data: resultForm,
            dataType: 'json',
            success: function (resultData) {
                if (resultData.success) {
                    Swal.fire({
                        title: 'Sukses!',
                        text: 'Data berhasil disimpan.',
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        loadData();
                        let modal = bootstrap.Modal.getInstance($('#modal-add')[0]);
                        if (modal) modal.hide();
                        // Fallback cleanup di gunakan agar modal ketutup sempurna
                        $('.modal-backdrop').remove();
                        $('body').removeClass('modal-open');
                        $('body').css('padding-right', '');
                        $('#siswa-form')[0].reset();
                    });

                }
            },
            error: function (xhr) {
                Swal.fire({
                    title: 'Gagal!',
                    text: 'Terjadi kesalahan saat menyimpan data.',
                    icon: 'error',
                    confirmButtonText: 'Tutup'
                });
            }
        });
    });


    // edit data siswa
  $(document).on('click', '.btn-update', function () {
    let id = $(this).data('id');
    let nis = $(this).data('nis');
    let nama = $(this).data('nama');
    let kelas = $(this).data('kelas');
    let tanggal_lahir = $(this).data('tanggal_lahir');
    let alamat = $(this).data('alamat');

    $('#id').val(id);
    $('#nis').val(nis);
    $('#nama').val(nama);
    $('#kelas').val(kelas);
    $('#tanggal_lahir').val(tanggal_lahir);
    $('#alamat').val(alamat);
});



$('#siswa-form-update').off('submit').on('submit', function(e){
    e.preventDefault();

    let id = $('#id').val();
    let resultForm = $(this).serialize();

    // penanganan REST condition
    Swal.fire({
            title: 'Menyimpan data terbaru...',
            html: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

    $.ajax({
        url: `/home/api/siswa/update/${id}`,
        type: 'PUT',
        data: resultForm,
        dataType: 'json',
        success: function(resultData){
            if(resultData.success){
                Swal.fire({
                        title: 'Sukses!',
                        text: 'Data berhasil diperbarui.',
                        icon: 'success',
                    })
                loadData();
            }
        }
    });

})


// delete data siswa 
$(document).on('click', '.btn-del', function () {
    let id = $(this).data('id');
    Swal.fire({
        title: "Kamu Yakin?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Iya, hapus data berikut!"
    }).then((result) => {
        if (result.isConfirmed) {

     // penanganan REST condition
        Swal.fire({
            title: 'Menghapus data...',
            html: 'Mohon tunggu sebentar',
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading();
            }
        });

            $.ajax({
                url: `/home/api/siswa/delete/${id}`, 
                type: 'DELETE',
                dataType: 'json',
                success: function (res) {
                    if (res.success) {
                        Swal.fire({
                        title: 'Sukses!',
                        text: 'Data berhasil dihapus.',
                        icon: 'success',
                    })
                        loadData();
                    } else {
                        Swal.fire('Error!', res.message, 'error');
                    }
                }
            });
        }
    });
});

});
