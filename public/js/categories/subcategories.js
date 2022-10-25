"use strict";
// Class definition

var KTCategoriesDatatable = function () {
    // variables
    var datatable;
    var addModal = $('#addSubcategory');
    var addForm = $('form', addModal);

    // init
    var init = function () {
        $(".navItem").removeClass("active");
        $("#navSubcategories").addClass("active");
        $('#categoriesSelect').select2({
            allowClear: true,
            width: '100%',
            height: '37px',
            placeholder: 'Please select category ...',
            dropdownParent: $("#addSubcategory")
            //data: data
        });
        datatable = $('#subcategories').DataTable({

            ajax: {
                url: '/api/subcategories',
                dataSrc: ''
            },
            "language": {
                "paginate": {
                  "next": '<i class="bi bi-arrow-right-circle-fill"></i>',
                  "previous": '<i class="bi bi-arrow-left-circle-fill"></i>',
                }
            },
            columns: [
                {data: 'id'},
                {data: 'name'},
                {data: 'description'},
                {data: 'category'},
            ]
        });
    };

    var initSubmit = function () {
        var addModal = $('#addSubcategory');
        var addForm = $('form', addModal);
    
        $('#saveSubcategory').click(function () {
            addForm.trigger('submit');
        });
    };

    var initValidation = function () {
        var addModal = $('#addSubcategory');
        var addForm = $('form', addModal);
    
        addForm.validate({
            // Validate only visible fields
            // ignore: ":hidden",

            // Validation rules
            errorClass: "text-danger",
            rules: {
                name: {
                    required: true
                },
                categories: {
                    required: true
                }
            },

            // Display error
            invalidHandler: function (event, validator) {
                swal.fire("", "There are some errors in your submission. Please correct them.", "error");
            },
            // Submit valid form
            submitHandler: function (form) {

                var formData = new FormData(addForm[0]);

                $.ajax({
                    type: 'POST',
                    url: '/subcategories/add',
                    cache: false,
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function (res) {
                        if (res.status === "success") {
                            swal.fire({
                                "title": "",
                                "text": "Subcategory has been successfully added!",
                                "icon": "success",
                                "confirmButtonClass": "btn btn-secondary"
                            }).then(() => {
                                addModal.modal('hide');
                                $('[data-ktwizard-type="action-submit"]').unbind().removeData();
                                addForm.unbind().removeData();
                                datatable.ajax.reload();
                            });
                        } else {
                            swal.fire({
                                "title": "",
                                "text": "There are some errors in your submission. Check unique fields. Please correct them.",
                                "icon": "error",
                                "buttonStyling": false,
                                "confirmButtonClass": "btn btn-brand btn-sm btn-bold"
                            });
                        }
                    },
                    error: function (res) {
                        swal.fire({
                            "title": "",
                            "text": "There are some errors in your submission. Please correct them.",
                            "icon": "error",
                            "buttonStyling": false,
                            "confirmButtonClass": "btn btn-brand btn-sm btn-bold"
                        });
                    }
                });
            }
        });
    };

    return {
        // public functions
        init: function () {
            init();
            initValidation();
            initSubmit();
        },
    };
}();

// On document ready
$( document ).ready(function () {
    KTCategoriesDatatable.init();
});