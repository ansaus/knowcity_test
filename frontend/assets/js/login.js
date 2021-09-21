$(document).ready(function(){
});
$(document).on('submit', "form", function(e) {
    e.preventDefault();
    let form = $(this);
    $.ajax({
        method: 'POST',
        url: apiUrl+"/auth",
        dataType: 'json',
        data: {
            'username': form.find('#inputLogin').val(),
            'password': form.find('#inputPassword').val(),
        },
        success: function (response) {
            if (response.status == 1) {
                let rememberSecs = 10;
                if (form.find("#chRememberMe").prop('checked')) {
                    rememberSecs = 60
                }
                setApiKey(response.token, rememberSecs);
                window.location.href = 'students.html'
            }
        },
        error: function (response) {
            console.log('auth fail!');
        }
    });

    return false;
});
