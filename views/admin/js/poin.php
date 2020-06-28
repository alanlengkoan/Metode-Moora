<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>

<script>
    // untuk tambah data
    var untukTambahData = function() {
        var parsleyConfig = {
            errorsContainer: function(parsleyField) {
                var $err = parsleyField.$element.siblings('#error');
                return $err;
            }
        }

        $('#form-add').parsley(parsleyConfig);

        $('#form-add').submit(function(e) {
            e.preventDefault();

            $('#inpkdpoin').attr('required', 'required');
            $('#inppoin').attr('required', 'required');
            $('#inpketerangan').attr('required', 'required');

            if ($('#form-add').parsley().isValid() == true) {
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
                        } else if (data.type == 'validasi') {
                            $.each(data.error, function(index, value) {
                                $('#' + value + '').attr('required', 'required');
                            });
                        } else {
                            alert(data.text);
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
                url: "aksi/?aksi=poin_get",
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

                    $('form').attr('action', 'aksi/?aksi=poin_upd');
                    $('form').attr('id', 'form-upd');
                    $('#inpidpoin').attr('value', data.id_poin);
                    $('#inpidpoin').attr('name', 'inpidpoin');
                    $('#inpkdpoin').attr('value', data.kd_poin);
                    $('#inppoin').attr('value', data.poin);
                    $('#inpketerangan').attr('value', data.kt_poin);
                    $('#add').html('Upd');
                    ini.removeAttr('disabled');
                    ini.html('<i class="fa fa-edit"></i> Ubah');
                }
            });
        });
    }();

    // untuk ubah data
    var untukUbahData = function() {
        var parsleyConfig = {
            errorsContainer: function(parsleyField) {
                var $err = parsleyField.$element.siblings('#error');
                return $err;
            }
        }

        $('#form-upd').parsley(parsleyConfig);

        $(document).on('submit', '#form-upd', function(e) {
            e.preventDefault();

            $('#inpkdpoin').attr('required', 'required');
            $('#inppoin').attr('required', 'required');
            $('#inpketerangan').attr('required', 'required');

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
                        } else if (data.type == 'validasi') {
                            $.each(data.error, function(index, value) {
                                $('#' + value + '').attr('required', 'required');
                            });
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
                    url: "aksi/?aksi=poin_del",
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

                        if (data.type == 'success') {
                            alert(data.text);
                        } else {
                            alert(data.text);
                        }
                        location.reload();
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