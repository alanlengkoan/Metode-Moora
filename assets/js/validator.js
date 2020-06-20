$(':input[type="submit"]').prop('disabled', true);

function cekPass() {
    var passnm = $('#inppassname').val();
    var passwd = $('#inppassword').val();

    if (passnm != passwd) {
        $(':input[type="submit"]').prop('disabled', true);
        $('.pesan').html('Password tidak sesuai!');
        return false;
    } else {
        $(':input[type="submit"]').prop('disabled', false);
        $('.pesan').html('Password sesuai!');
        return true;
    }
}

$('.form-checkbox').click(function () {
    if ($(this).is(':checked')) {
        $('.form-password').attr('type', 'text');
    } else {
        $('.form-password').attr('type', 'password');
    }
});