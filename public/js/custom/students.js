var editId = null;
$(document).ready(function () {
    var studentDataTable = $('#studentDataTable').DataTable({
        columns: [
            {
                'title': '#SL', data: 'id', width: '50px', render: function (data, row, type, col) {
                    var pageInfo = studentDataTable.page.info();
                    return (col.row + 1) + pageInfo.start;
                }
            },
            { 'title': 'First Name', data: 'first_name', name: 'first_name' },
            { 'title': 'Last Name', data: 'last_name', name: 'last_name' },
            { 'title': 'Registration No', data: 'registration_no', name: 'registration_no' },
            {
                'title': 'Photo', name: 'photo', data: "photo", render: function (data, type, row, col) {
                    return `<img src="${utlt.siteUrl(data)}" class="img-thumbnail rounded-circle w70" alt="${utlt.siteUrl(data)}">`;
                }
            },
            {
                'title': 'Option', data: 'id', class: 'text-end', render: function (data, type, row, col) {
                    let returnData = `<div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton${data}" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Action
                            </button>
                            <ul class="dropdown-menu py-0" aria-labelledby="dropdownMenuButton${data}">
                                <li><a class="dropdown-item" href="${utlt.siteUrl('students/' + data)}">View</a></li>
                                <li> <hr class="m-0 dropdown-divider"></li>
                                <li><button type="button" class="dropdown-item editStudent" data-id="${data}">Edit</button></li>
                                <li> <hr class="m-0 dropdown-divider"></li>
                                <li><button type="button" class="dropdown-item deleteStudent" data-id="${data}">Delete</button></li>
                            </ul>
                        </div>`;

                    return returnData;
                }
            },
        ],

        ajax: {
            url: utlt.siteUrl("students"),
        },

        responsive: true,
        serverSide: true,
        processing: true,
    });
    
    $(document).on('click', '.deleteStudent', function () {
        var $el = $(this);
        if (confirm("Are you sure you want to delete this?")) {
            utlt.Delete('students/' + $el.attr('data-id'), '#studentDataTable');
        }
    });

    $(document).on('click', '#addBtn', function () {
        utlt.request('post', 'students', '#studentAddForm', '#studentDataTable', '#studentModal');
    });

    $(document).on('click', '#editBtn', function () {
        utlt.request('put', 'students/' + editId, '#studentEditForm', '#studentDataTable', '#studentEditModal');
    });

    $(document).on('click', '.editStudent', function () {
        var $el = $(this);
        axios.get(utlt.siteUrl('students/' + $el.attr('data-id') + '/edit')).then(resData => {
            editId = $el.attr('data-id');
            $('#studentEditForm').html(resData.data);
            $('#studentEditModal').show();
        });
    });

    $(document).on('click', '.btn-remove', function () {
        $(this).closest('.modal').hide();
    });
});