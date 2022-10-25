"use strict";

// Class definition

var KTCItemsDatatable = function () {
    // variables
    var datatable;
    var addModal = $('#addItem');
    var addForm = $('form', addModal);


    // init
    var init = function () {
        
       $('#categoriesSelect, #subcategoriesSelect').select2({
            allowClear: true,
            width: '100%',
            height: '37px',
            placeholder: 'Please select category ...',
            dropdownParent: $("#addItem")
            //data: data
        });
        $(".navItem").removeClass("active");
        $("#navItem").addClass("active");

    };

    var handleSelect = function(){
        $('#categoriesSelect').on('select2:select', function (e) {
            var data = e.params.data;
            var id = data.id;
            $.getJSON('/api/subcategories?id=' + id, function (res) {
                for (var key in res) {
                    var data = {
                        id: res[key]["id"],
                        text: res[key]["name"]
                    };
                    
                    var newOption = new Option(data.text, data.id, false, false);
                    $('#subcategoriesSelect').append(newOption).trigger('change');
                }
            });

        });
    };

    var initSubmit = function () {
        var addModal = $('#addItem');
        var addForm = $('form', addModal);
    
        $('#saveItem').click(function () {
            addForm.trigger('submit');
        });
    };

    var initValidation = function () {
        var addModal = $('#addItem');
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
                description: {
                    required: true
                },
                file: {
                    required: true
                },
                categories: {
                    required: true
                },
                price: {
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
                    url: '/items/add',
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
                                "text": "Category has been successfully added!",
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
            handleSelect();
        },
    };
}();

// On document ready
$( document ).ready(function () {
    KTCItemsDatatable.init();
});