$(document).ready(function(){
    getUsers(1);
});

function getUsers(page) {
    $.get(apiUrl+"/users?page="+page+"&api_key="+getApiKey(), function(data, status){
        if (data.status) {
            let table = $('#tbStudents');
            table.find('tr').remove();
            let html = '';
            $.each(data.rows, function(key, row) {
                html += '<tr>'+
                    '<td>' + row.name + '</td>' +
                    '<td>' + row.group + '</td>' +
                    '</tr>';
            });
            table.find('tbody').html(html);
            let pagination = $('ul.pagination');
            pagination.find('li').remove();
            let paginationHtml = '';
            for(let i = 1; i <= data.pageCount;i++) {
                let activeStr = (page == i) ? ' active' : '';
                paginationHtml += '<li class="page-item'+activeStr+'"><a class="page-link" data-role="page-link" href="#" data-page="'+i+'">'+i+'</a></li>'
            }
            pagination.html(paginationHtml);
        } else {
            redirectToLoginPage();
        }
    });
}

$(document).on('click', "[data-role='page-link']", function(e) {
    e.preventDefault();
    let page = $(this).data('page');
    getUsers(page);
});

$(document).on('click', ".logout-button", function(e) {
    e.preventDefault();
    logout();
});
