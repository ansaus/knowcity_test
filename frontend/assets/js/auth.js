$(document).ready(function(){
});

function checkLogin(onSuccess) {
    $.ajax({
        method: 'POST',
        url: apiUrl+"/auth",
        dataType: 'json',
        data: {
            'api_key': getApiKey()
        },
        success: function (response) {
            if (!response.status) {
                redirectToLoginPage();
            } else {
                if (typeof onSuccess === "function") {
                    onSuccess();
                }
            }
        },
        error: function (response) {
            console.log('auth fail!');
        }
    });
}

function logout() {
    setApiKey(null);
    redirectToLoginPage();
}

function redirectToLoginPage() {
    window.location.href = 'login.html';
}
