var editId = null;
$(document).ready(function () {
    var transactionDataTable = $('#transactionDataTable').DataTable({
        columns: [
            {
                'title': '#SL', data: 'id', width: '50px', render: function (data, row, type, col) {
                    var pageInfo = transactionDataTable.page.info();
                    return (col.row + 1) + pageInfo.start;
                }
            },
            { 'title': 'Trnx', data: 'transaction_id', name: 'transaction_id' },
            { 'title': 'Price', data: 'total_amount', name: 'total_amount' },
            { 'title': 'Method', data: 'payment_method', name: 'payment_method' },
            { 'title': 'Status', data: 'status', name: 'status' },
            {
                'title': 'Student', data: 'student.first_name', name: 'student.first_name', render: function (data, type, row, col) {
                    return data + ' ' + row.student.last_name;
                }
            },
            { 'title': 'Course', data: 'course.name', name: 'course.name' },
        ],

        ajax: {
            url: utlt.siteUrl("transactions"),
        },

        responsive: true,
        serverSide: true,
        processing: true,
    });
});