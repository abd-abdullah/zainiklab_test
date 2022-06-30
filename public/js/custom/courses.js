var editId = null;
var assignCourseId = null;
$(document).ready(function () {
    $('.select2').select2({
        dropdownParent: $('#assignModal')
    });
    var courseDataTable = $('#courseDataTable').DataTable({
        columns: [
            {
                'title': '#SL', data: 'id', width: '50px', render: function (data, row, type, col) {
                    var pageInfo = courseDataTable.page.info();
                    return (col.row + 1) + pageInfo.start;
                }
            },
            { 'title': 'Name', data: 'name', name: 'name' },
            { 'title': 'Code', data: 'code', name: 'code' },
            { 'title': 'Price', data: 'price', name: 'price' },
            {
                'title': 'Thumbnail', name: 'thumbnail', data: "thumbnail", render: function (data, type, row, col) {
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
                                <li><a class="dropdown-item" href="${utlt.siteUrl('courses/' + data)}">View</a></li>
                                <li> <hr class="m-0 dropdown-divider"></li>
                                <li><button type="button" class="dropdown-item editCourse" data-id="${data}">Edit</button></li>
                                <li> <hr class="m-0 dropdown-divider"></li>
                                <li><button type="button" class="dropdown-item deleteCourse" data-id="${data}">Delete</button></li>
                                <li> <hr class="m-0 dropdown-divider"></li>
                                <li><button type="button" class="dropdown-item assignCourse" data-id="${data}">Assign to Student</button></li>
                            </ul>
                        </div>`;

                    return returnData;
                }
            },
        ],

        ajax: {
            url: utlt.siteUrl("courses"),
        },

        responsive: true,
        serverSide: true,
        processing: true,
    });
    
    $(document).on('click', '.deleteCourse', function () {
        var $el = $(this);
        if (confirm("Are you sure you want to delete this?")) {
            utlt.Delete('courses/' + $el.attr('data-id'), '#courseDataTable');
        }
    });

    $(document).on('click', '#addBtn', function () {
        utlt.request('post', 'courses', '#courseAddForm', '#courseDataTable', '#courseModal');
    });

    $(document).on('click', '#editBtn', function () {
        utlt.request('put', 'courses/' + editId, '#courseEditForm', '#courseDataTable', '#courseEditModal');
    });
    
    
    $(document).on('click', '#assignBtn', function () {
        utlt.request('post', 'courses/' + assignCourseId + '/assign-student', '#assignStudent', '#courseDataTable', '#assignModal');
    });

    $(document).on('click', '.editCourse', function () {
        var $el = $(this);
        axios.get(utlt.siteUrl('courses/' + $el.attr('data-id') + '/edit')).then(resData => {
            editId = $el.attr('data-id');
            $('#courseEditForm').html(resData.data);
            $('#courseEditModal').show();
        });
    });
    
    $(document).on('click', '.assignCourse', function () {
        var $el = $(this);
        assignCourseId = $el.attr('data-id');
        $('#assignModal').show();
    });

    $(document).on('click', '.btn-remove', function () {
        $(this).closest('.modal').hide();
    });
});