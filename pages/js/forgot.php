<script>
$(document).ready(function() {

    $("#form-forget").submit(function (event) {
        event.preventDefault();
        // mengambil value email
        var email = $('#email').val();
        // mengecek apa bila password kosong
        if (email == '' || email == null) {
            $('.response').html('Silahkan di isi');
        } else {
            // apa bila berhasil
            $.ajax({
                method: 'post',
                url: 'forgot.php',
                dataType: 'json',
                data: {
                    email: email,
                },
                success: function(data) {
                    if (data.success) {
                        $('.response').html(data.msg);
                    } else {
                        $('.response').html(data.msg);
                    }
                }
            })
        }
    });

});
</script>