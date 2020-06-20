<script src="../../assets/admin/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="../../assets/admin/bower_components/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../assets/admin/assets/pages/data-table/js/jszip.min.js"></script>
<script src="../../assets/admin/assets/pages/data-table/js/pdfmake.min.js"></script>
<script src="../../assets/admin/assets/pages/data-table/js/vfs_fonts.js"></script>
<script src="../../assets/admin/bower_components/datatables.net-buttons/js/buttons.print.min.js"></script>
<script src="../../assets/admin/bower_components/datatables.net-buttons/js/buttons.html5.min.js"></script>
<script src="../../assets/admin/bower_components/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../assets/admin/bower_components/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../assets/admin/bower_components/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js"></script>

<script>
    // untuk datatable
    $('#simpletable').DataTable();

    // untuk tambah data
    var untukTambahData = function() {
        $('#form-add').parsley();

        $('#form-add').submit(function(e) {
            e.preventDefault();

            $('#inpidalternatif').attr('required', 'required');
            var inpnilai = $('[id="inpnilai"]');
            for (let i = 0; i < inpnilai.length; i++) {
                $(inpnilai[i]).attr('required', 'required');
            }

            if ($('#form-add').parsley().isValid() == true) {
                $.ajax({
                    method: 'POST',
                    url: $(this).attr('action'),
                    data: $(this).serialize(),
                    dataType: 'json',
                    beforeSend: function() {
                        // $('#add').attr('disabled', 'disabled');
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
                                $(inpnilai[value]).attr('required', 'required');
                            });
                        } else {
                            alert(data.text);
                        }
                    }
                })
            }
        });
    }();

    // eksekusi jquery
    jQuery(document).ready(function() {
        untukTambahData;
    });
</script>