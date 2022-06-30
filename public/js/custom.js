
/************************************************/
/***common  method for Delete a data****/
/************************************************/
utlt['Delete'] = function (url, dataTableId) {

    axios.delete(utlt.siteUrl(url)).then(resData => {
            alert("Successfully Deleted!! :-");
            if (typeof dataTableId != 'undefined') {
                $(dataTableId).DataTable().ajax.reload();
            }
    }).catch(failData => {
        if (failData.response.data.message.search('SQLSTATE\\[23000\\]') != -1) {
            alert("Database Relation Exist :-")
        }
        else if (failData.response.data.message.search('No query results') != -1) {
            alert("This data has not found on server")
        }
    });
}
/*end Delete method*/


/****************************************/
/*common add method for insert form data*/
/****************************************/
utlt['request'] = function (type, url, formId, dataTable, modalId) {

    $(document).find(formId + ' .is-invalid').removeClass('is-invalid');
    $(document).find(formId).find('.invalid-feedback').empty();

    let axiosOption = {
        method: 'Post',
        url: utlt.siteUrl(url),
        headers: {
            'Content-Type': 'multipart/form-data'
        }
    };

    let formData = new FormData($(document).find(formId)[0]);
    formData.append("_method", type);
    axiosOption.data = formData;

    axios(axiosOption).then(resData => {

        if (typeof dataTable !== "undefined" && dataTable != null) {
            $(dataTable).DataTable().ajax.reload();
        }

        if (typeof modalId != 'undefined' && modalId != null) {
            $(modalId).hide();
            $('.modal-backdrop').removeClass('modal-backdrop fade in');
        }

        $(formId).trigger("reset");

        alert('Successfully' + (type == 'post' ? 'Added' : 'Updated'));

    }).catch(failData => {
        setError(failData, formId);
        if ((typeof failData.response.data.message != 'undefined') && failData.response.data.message.search('SQLSTATE\\[23000\\]') != -1) {
            alert("Database Error!!");
        }
    });
}


function setError(failData, formId) {
    $.each(failData.response.data.errors, function (inputName, errors) {
        inputName = inputName.split(".")[0];
        inputSelector = $(document).find(formId + ' [name^="' + inputName + '"]');
        $(inputSelector).addClass('is-invalid');
        if (typeof errors == "object") {
            $(inputSelector).closest('.form-group').find('.invalid-feedback').empty();
            $.each(errors, function (indE, valE) {
                $(inputSelector).closest('.form-group').find('.invalid-feedback').append(valE + "<br>");
            });

        }
        else {
            $(inputSelector).closest('.form-group').find('.invalid-feedback').html(valE);
        }
    });
}