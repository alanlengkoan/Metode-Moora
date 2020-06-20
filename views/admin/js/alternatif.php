<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>

<script>
    // untuk tambah data
    var untukTambahData = function() {
        $('#form-add').parsley();

        $('#form-add').submit(function(e) {
            e.preventDefault();

            $('#inpnama').attr('required', 'required');

            if ($('#form-add').parsley().isValid() == true) {
                $.ajax({
                    method: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: 'json',
                    beforeSend: function() {
                        $('#add').attr('disabled', 'disabled');
                        $('#add').html('Waiting...');
                    },
                    success: function(data) {
                        console.log(data);

                        if (data.type == 'success') {
                            alert(data.text);
                            location.reload();
                        } else {
                            alert(data.text);
                            location.reload();
                        }
                    }
                })
            }
        });
    }();

    // untuk ambil data id
    var untukAmbilIdData = function() {
        $(document).on('click', '#upd', function() {
            var ini = $(this);

            $.ajax({
                type: "post",
                url: "aksi/?aksi=alternatif_get",
                dataType: 'json',
                data: {
                    id: ini.data('id')
                },
                beforeSend: function() {
                    ini.attr('disabled', 'disabled');
                    ini.html('Waiting...');
                },
                success: function(data) {
                    console.log(data);

                    $('form').attr('action', 'aksi/?aksi=alternatif_upd');
                    $('form').attr('id', 'form-upd');
                    $('#inpidalternatif').attr('name', 'inpidalternatif');
                    $('#inpidalternatif').attr('value', data.id_alternatif);
                    $('#inpnama').attr('value', data.alternatif);
                    $('#add').html('Upd');
                    ini.removeAttr('disabled');
                    ini.html('<i class="fa fa-edit"></i> Ubah');
                }
            });
        });
    }();

    // untuk ubah data
    var untukUbahData = function() {
        $('#form-upd').parsley();

        $(document).on('submit', '#form-upd', function(e) {
            e.preventDefault();

            $('#inpkdgejala').attr('required', 'required');
            $('#inpnama').attr('required', 'required');

            if ($('#form-upd').parsley().isValid() == true) {
                $.ajax({
                    method: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: 'json',
                    beforeSend: function() {
                        $('#add').attr('disabled', 'disabled');
                        $('#add').html('<i class="fa fa-spinner"></i> Waiting...');
                    },
                    success: function(data) {
                        console.log(data);

                        if (data.type == 'success') {
                            alert(data.text);
                            location.reload();
                        } else {
                            alert(data.text);
                        }
                    }
                })
            }
        });
    }();

    // untuk menghapus data
    var untukHapusData = function() {
        $(document).on('click', '#del', function() {
            var ini = $(this);

            if (confirm("Apakah Anda yakin ingin menghapusnya?")) {
                $.ajax({
                    type: "post",
                    url: "aksi/?aksi=alternatif_del",
                    dataType: 'json',
                    data: {
                        id: ini.data('id')
                    },
                    beforeSend: function() {
                        ini.attr('disabled', 'disabled');
                        ini.html('<i class="fa fa-spinner"></i> Waiting...');
                    },
                    success: function(data) {
                        console.log(data);

                        if (data.type == "success") {
                            alert(data.text);
                            location.reload();
                        } else {
                            alert(data.text);
                            location.reload();
                        }
                    }
                });
            } else {
                return false;
            }
        });
    }();

    // eksekusi jquery
    jQuery(document).ready(function() {
        untukTambahData;
        untukAmbilIdData;
        untukUbahData;
        untukHapusData;
    });
</script>