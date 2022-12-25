$(document).ready(function () {
    $('body').on('click', '#order', function () {
        var armada = $(this).attr("data-armada");
        var harga = $(this).attr("data-harga");
        $('#tiket_harga').html(new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumSignificantDigits: 3 }).format(harga));
        $('#armada').val(armada);
        console.log(armada);
        $('#harga').val(harga);
        $('#exampleModal').modal('show');
    });
});

$(document).ready(function () {
    $("#hitung").click(function () {
        var nama = $('#nama').val();
        var identitas = $('#identitas').val();
        var handphone = $('#handphone').val();
        var jadwal = $('#jadwal').val();
        var normal = $('#normal').val();
        var lansia = $('#lansia').val();
        var harga = $('#harga').val();
        checkBox = document.getElementById('exampleCheck1');

        if (!nama) {
            $("#pesan").prop('disabled', true);
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Isi Nama Lengkap Anda',
                confirmButtonText: 'Tutup',
                denyButtonText: `Don't save`,
            });
        } else {
            if (!identitas) {
                $("#pesan").prop('disabled', true);
                Swal.fire({
                    icon: 'error',
                    title: 'Terima Kasih',
                    text: 'Masukan Nomor Identitas, Min 16 Digit',
                    confirmButtonText: 'Tutup',
                    denyButtonText: `Don't save`,
                });
            } else {
                if (identitas.length < 16) {
                    $("#pesan").prop('disabled', true);
                    Swal.fire({
                        icon: 'error',
                        title: 'Terima Kasih',
                        text: 'Nomor Identitas Min 16 Digit',
                        confirmButtonText: 'Tutup',
                        denyButtonText: `Don't save`,
                    });
                } else {
                    if (!handphone) {
                        $("#pesan").prop('disabled', true);
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Nomor Handpohone Masih Kosong',
                            confirmButtonText: 'Tutup',
                            denyButtonText: `Don't save`,
                        });
                    } else {
                        if (!jadwal) {
                            $("#pesan").prop('disabled', true);
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Jadwal Berangkat Masih Kosong',
                                confirmButtonText: 'Tutup',
                                denyButtonText: `Don't save`,
                            });
                        } else {
                            if (normal <= 0) {
                                $("#pesan").prop('disabled', true);
                                Swal.fire({
                                    icon: 'error',
                                    title: 'Oops...',
                                    text: 'Jumlah Tiket Minimal 1 Orang',
                                    confirmButtonText: 'Tutup',
                                    denyButtonText: `Don't save`,
                                });
                            } else {
                                if (checkBox.checked) {
                                    if (!lansia) {
                                        var total = normal * harga;
                                    } else {
                                        var jumlah = parseInt(normal) + parseInt(lansia);
                                        var harga_total = jumlah * harga;
                                        var potongan = harga_total * 10 / 100;
                                        var total = harga_total - potongan;
                                    }
                                    const formatter = new Intl.NumberFormat('id-ID', {
                                        style: 'currency',
                                        currency: 'IDR',
                                    });

                                    let timerInterval
                                    Swal.fire({
                                        title: 'Sedang Menghitung',
                                        html: 'Menghitung Harga Terbaik Untuk Anda',
                                        timer: 2000,
                                        timerProgressBar: true,
                                        didOpen: () => {
                                            Swal.showLoading()
                                            const b = Swal.getHtmlContainer().querySelector('b')
                                            timerInterval = setInterval(() => {
                                                b.textContent = Swal.getTimerLeft()
                                            }, 100)
                                        },
                                        willClose: () => {
                                            clearInterval(timerInterval)
                                        }
                                    }).then((result) => {
                                        /* Read more about handling dismissals below */
                                        if (result.dismiss === Swal.DismissReason.timer) {
                                            // console.log(jumlah);
                                            // console.log(harga_total);
                                            // console.log(potongan);
                                            $("#pesan").prop('disabled', false);
                                            // log
                                            $('#total_harga').val(total);
                                            $('#total').html(new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR', maximumSignificantDigits: 3 }).format(total));
                                        }
                                    });
                                } else {
                                    $("#pesan").prop('disabled', true);
                                    Swal.fire({
                                        icon: 'error',
                                        title: 'Oops...',
                                        text: 'Anda Belum Mencentang',
                                        confirmButtonText: 'Tutup',
                                        denyButtonText: `Don't save`,
                                    });
                                }
                            }
                        }
                    }
                }
            }
        }
    });
});

$(document).ready(function () {
    $('#type').on('change', function () {
        document.getElementById("type").submit();
    });
});