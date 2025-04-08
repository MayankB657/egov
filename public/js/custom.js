$(document).ready(function () {
    var defaultThemeMode = "light";
    var themeMode;
    if (document.documentElement) {
        if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
            themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
        } else {
            if (localStorage.getItem("data-bs-theme") !== null) {
                themeMode = localStorage.getItem("data-bs-theme");
            } else {
                themeMode = defaultThemeMode;
            }
        }
        if (themeMode === "system") {
            themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
        }
        document.documentElement.setAttribute("data-bs-theme", themeMode);
    }

    //image validation
    var imageValidator = "extension[jpg|jpeg|png]";
    $('.imgVal').attr('data-bvalidator', imageValidator);
    $('.imgVal').attr('data-bvalidator-msg', "Please select file of type png, jpg, jpeg");

    //password meter
    KTPasswordMeter.getInstance($("#FormId [data-kt-password-meter='true']")[0]);

    //preloader
    $('#preloader').delay(150).fadeOut('fast');

    $('.CheckAll').change(function () {
        if ($('.CheckAll:checked').length == $('.CheckAll').length) {
            $('#RoleSelectAll').prop('checked', true);
        } else {
            $('#RoleSelectAll').prop('checked', false);
        }
        var inputElement = $(".SelectRoleRow");
        $.each(inputElement, function (index, value) {
            var inputClass = $(value).attr("class");
            var className = inputClass.split(" ")[2];
            if ($('.CheckAll.' + className + ':checked').length == $('.CheckAll.' + className).length) {
                $('.SelectRoleRow.' + className).prop('checked', true)

            } else {
                $('.SelectRoleRow.' + className).prop('checked', false)
            }
        });
    });

    $('#RoleSelectAll').change(function (e) {
        e.preventDefault();
        if ($(this).is(':checked')) {
            $('.CheckAll').prop('checked', true);
        } else {
            $('.CheckAll').prop('checked', false);
        }
        var inputElement = $(".SelectRoleRow");
        $.each(inputElement, function (index, value) {
            var inputClass = $(value).attr("class");
            var className = inputClass.split(" ")[2];
            if ($('.CheckAll.' + className + ':checked').length == $('.CheckAll.' + className).length) {
                $('.SelectRoleRow.' + className).prop('checked', true)

            } else {
                $('.SelectRoleRow.' + className).prop('checked', false)
            }
        });
    });

    $('.SelectRoleRow').change(function (e) {
        e.preventDefault();
        if ($(this).is(':checked')) {
            $("." + $(this).prev('span').html()).prop('checked', true);
        } else {
            $("." + $(this).prev('span').html()).prop('checked', false);
        }
        if ($('.CheckAll:checked').length == $('.CheckAll').length) {
            $('#RoleSelectAll').prop('checked', true);
        } else {
            $('#RoleSelectAll').prop('checked', false);
        }
    });

    if ($('.table-row-dashed td').length == 0) {
        var count = $('.table-row-dashed th').length;
        $('.table-row-dashed tbody').html('<tr><td class="text-center text-muted fs-6 fw-bold" colspan="' + count + '">No Records</td></tr>');
    }

    //set tooltip
    $('.CopyEmail').each(function () {
        $(this).attr('data-bs-toggle', 'tooltip');
        $(this).attr('title', 'Click to copy.');
        $(this).attr('data-bs-placement', 'bottom');
        new bootstrap.Tooltip(this);
    });

    $('.maxlength').maxlength({
        warningClass: "badge badge-primary",
        limitReachedClass: "badge badge-success"
    });

    $('.flatpickr').each(function () {
        const minToday = $(this).data('min-today') === true;
        $(this).flatpickr({
            enableTime: true,
            dateFormat: "Y-m-d H:i",
            minDate: minToday ? new Date() : null,
        });
    });

    $('.flatDatepickr').each(function () {
        const minToday = $(this).data('min-today') === true;
        const altFormat = $(this).data('alt-format');
        const isReadonly = $(this).data('readonly') === true;
        const isRequired = $(this).data('bvalidator') === 'required';
        const isNull = $(this).data('default-null') === true;
        $(this).flatpickr({
            enableTime: false,
            dateFormat: "Y-m-d",
            defaultDate: isNull ? "" : new Date(),
            altInput: true,
            altFormat: altFormat,
            minDate: minToday ? new Date() : null,
            clickOpens: !isReadonly,
            allowInput: !isReadonly,
            onClose: function (selectedDates, dateStr, instance) {
                if (isRequired && !dateStr) {
                    instance.open(); // Reopen calendar if required field is empty
                }
            }
        });
    });

    $('.flatTimepicker').each(function () {
        $(this).flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            altInput: true,
            altFormat: "h:i K",
            defaultHour: 10
        });
    });

    function updateClock() {
        if ($('#LiveDate')) {
            $('#LiveDate').html(moment().locale(lang).format('dddd DD/MM/YYYY'));
        }
        if ($('#LiveTime')) {
            $('#LiveTime').html(moment().locale(lang).format('hh:mm:ss A'));
        }
    }
    setInterval(updateClock, 1000);
    updateClock();
});

function passwordFormat(password) {
    regex = new RegExp(/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/);
    if (regex.test(password))
        return true;
    return false;
}
function URLModifier(oldValue) {
    if (oldValue.substring(0, 4) != 'http')
        return 'http://' + oldValue
}
function DigitsModifier(oldValue) {
    return oldValue.replace(/[^0-9+ \.]/g, "")
}

//delete record
$(document).on("click", ".ConfirmDelete", function (e) {
    e.preventDefault();
    var form = $(this).closest("form");
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!"
    }).then(function (result) {
        if (result.value) {
            form.trigger("submit");
        }
    });
});

$(document).on("click", ".ConfirmAction", function (e) {
    e.preventDefault();
    var form = $(this).closest("form");
    var msg = $(this).data('mb-confirm-msg');
    var buttonText = $(this).data('mb-confirm-btn-text');
    Swal.fire({
        title: "Are you sure?",
        text: msg,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: buttonText
    }).then(function (result) {
        if (result.value) {
            form.trigger("submit");
        }
    });
});

//unlink record
$(document).on("click", ".ConfirmUnlink", function (e) {
    e.preventDefault();
    var form = $(this).closest("form");
    Swal.fire({
        title: "Are you sure?",
        text: "You can link again later.",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, unlink it!"
    }).then(function (result) {
        if (result.value) {
            form.trigger("submit");
        }
    });
});

//Copy Clipboard
$(document).on("click", ".CopyEmail", function (e) {
    e.preventDefault();
    $(this).find("span").remove();
    var $tempElement = $("<input>");
    $("body").append($tempElement);
    $tempElement.val($(this).text().trim()).select();
    document.execCommand("Copy");
    $tempElement.remove();
    $(this).append('<span class="text-success text-end fs-7 ms-2">Copied!</span>');
    var Tthis = $(this);
    setTimeout(ChangeIcon, 3000, Tthis);

    function ChangeIcon(parameter1) {
        Tthis.find("span").remove();
    }
});

//role and permission
if ($('.CheckAll:checked').length == $('.CheckAll').length) {
    $('#RoleSelectAll').prop('checked', true);
} else {
    $('#RoleSelectAll').prop('checked', false);
}

//role and permission check controller
var inputElement = $(".SelectRoleRow");
$.each(inputElement, function (index, value) {
    var inputClass = $(value).attr("class");
    var className = inputClass.split(" ")[2];
    if ($('.CheckAll.' + className + ':checked').length == $('.CheckAll.' + className).length) {
        $('.SelectRoleRow.' + className).prop('checked', true)

    } else {
        $('.SelectRoleRow.' + className).prop('checked', false)
    }
});


//Add more start
$(document).on("click", "#addclone", function () {
    var copyRow = $("tbody#tableclone").find("tr:last").clone();
    $(copyRow).find("input[type='text']").val('');
    $(copyRow).find("input[type='hidden']").val('');
    $(copyRow).find("input[type='file']").val('');
    $(copyRow).find("select").val('');
    $(copyRow).find("textarea").html('');
    $(copyRow).find("textarea").val('');
    $(copyRow).find("img").attr("src", " ");
    $(copyRow).find("input[type='number']").val('');
    $("tbody#tableclone").find("tr:last").after(copyRow);
});

$(document).on("click", ".removeclone", function () {
    var el = $(this).closest("tr");
    if ($(this).closest("tbody").find("tr:gt(0)").length >= 1) {
        el.remove();
        len = $("#tableclone tr").length;
    }
});

$(document).on("click", ".addclone", function () {
    var copyRow = $(this).closest("table").find("tbody.tableclone tr:last").clone();
    copyRow.find("input[type='text']").val('');
    copyRow.find("input[type='hidden']").val('');
    copyRow.find("input[type='file']").val('');
    copyRow.find("select").val('');
    copyRow.find("textarea").html('');
    copyRow.find("textarea").val('');
    copyRow.find("img").attr("src", "");
    copyRow.find("input[type='number']").val('');
    $(this).closest("table").find("tbody.tableclone").append(copyRow);
});
//End

//for sidebar
function redirectToIndex(path) {
    if (window.innerWidth > 991) {
        window.location.href = `${base_url}/${path}`;
    }
}

//for filter get submit
$(document).on('submit', '.ajax-get-submit', function (e) {
    e.preventDefault();
    var formData = $(this).serialize();
    var route = $(this).attr('action');
    $.ajax({
        type: "GET",
        url: route,
        data: formData,
        success: function (response) {
            $('.tablebody').html(response.html);
            $('#pagination-container').html(response.pagination);
            // KTMenu.createInstances();
        }
    });
});

let timer;
$('#InputSearch').on('keyup', handleKeyup);
$('#InputSearch').on('keypress', function (e) {
    if (e.which == 13) {
        searchtable();
    }
});

function handleKeyup() {
    clearTimeout(timer);
    timer = setTimeout(searchtable, 1000);
}

function searchtable() {
    let searchQuery = $('#InputSearch').val();
    let searchUrl = $('#InputSearch').data('search-url');
    $.ajax({
        type: "GET",
        url: searchUrl,
        data: {
            search: searchQuery
        },
        success: function (response) {
            $('.tablebody').html(response.html);
            $('#pagination-container').html(response.pagination);
            KTMenu.createInstances();
        },
    });
}

$(document).on('click', '.ajaxedit', function (e) {
    e.preventDefault();
    var url = $(this).data('url');
    $.ajax({
        type: "GET",
        url: url,
        beforeSend: function () {
            showPageLoader();
        },
        success: function (response) {
            hidePageLoader();
            $('.edit').html(response.html);
            $('.edit').find('form').bValidator();
            $('select[data-control="select2"]').each(function () {
                $(this).select2({
                    dropdownParent: $('.edit'),
                    minimumResultsForSearch: Infinity
                });
            });
            KTImageInput.createInstances();

            // Reinitialize intl-tel-input for phone inputs in the new modal content
            const telinput = document.querySelector(".edit .phone");
            if (telinput) {
                window.intlTelInput(telinput, {
                    initialCountry: response.country_iso,
                    hiddenInput: () => ({ phone: "full_phone", country: "country_code" }),
                    utilsScript: "{{ url('/') }}/public/js/utils.js",
                });
            }
            $('.select2_rich_content').select2({
                placeholder: "Select an option",
                minimumResultsForSearch: Infinity,
                templateSelection: optionFormat,
                templateResult: optionFormat
            });
            $('.edit input.flatDatepickr').each(function () {
                const minToday = $(this).attr('data-min-today') === 'true';
                const altFormat = $(this).attr('data-alt-format');
                const isReadonly = $(this).attr('data-readonly') === 'true';
                const isRequired = $(this).attr('data-bvalidator') === 'required';
                $(this).flatpickr({
                    enableTime: false,
                    dateFormat: "Y-m-d",
                    altInput: true,
                    altFormat: altFormat,
                    minDate: minToday ? new Date() : null,
                    clickOpens: !isReadonly,
                    allowInput: !isReadonly,
                    onClose: function (selectedDates, dateStr, instance) {
                        if (isRequired && !dateStr) {
                            instance.open();
                        }
                    }
                });
            });
            $('.flatTimepicker').each(function () {
                $(this).flatpickr({
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i",
                    altInput: true,
                    altFormat: "h:i K",
                    defaultHour: 10
                });
            });
            $('.edit').modal('show');
        },
        complete: function () {
            hidePageLoader();
        }
    });
});

$(document).ready(function () {
    $('.ajax-form-submit').bValidator();
});

$(document).on('submit', '.ajax-form-submit', function (e) {
    e.preventDefault();
    var form = $(this);
    form.find('.error').remove();
    $(this).bValidator();
    if ($(this).data('bValidator').isValid()) {
        var formData = new FormData(this);
        var route = $(this).attr('action');
        let button = form.find('.btn-submit')[0];
        $.ajax({
            type: "POST",
            url: route,
            data: formData,
            dataType: "JSON",
            cache: false,
            contentType: false,
            processData: false,
            beforeSend: function () {
                if (form.data('preloader') === undefined || form.data('preloader') === true) {
                    showPageLoader();
                }
                if (button) {
                    button.setAttribute('disabled', 'disabled');
                    button.setAttribute("data-kt-indicator", "on");
                }
            },
            success: function (response) {
                hidePageLoader();
                if (button) {
                    button.removeAttribute('disabled');
                    button.setAttribute("data-kt-indicator", "off");
                }
                if (response.status == true) {
                    Toast.fire({
                        icon: "success",
                        title: response.msg
                    });
                    if (form.data('dismiss-modal') != null && form.data('dismiss-modal') != undefined) {
                        var id = '#' + form.data('dismiss-modal');
                        $(document).find(id).modal('hide');
                    }
                    if (form.data('reset') === undefined || form.data('reset') === true) {
                        form[0].reset();
                    }
                    if (form.data('refresh') === undefined || form.data('refresh') === true) {
                        setTimeout(() => {
                            window.location.href = response.url;
                        }, 3000);
                    } else {
                        searchtable();
                    }
                } else {
                    if (response.errors) {
                        let modalBody = $(document).find(id).find('div.scroll-y');
                        var errors = response.errors;
                        let firstErrorInput = null;
                        $.each(errors, function (field, messages) {
                            var inputField = form.find(`[name="${field}"]`);
                            if (inputField.length === 0) {
                                inputField = form.find(`[name="${field}[]"]`);
                            }
                            if (inputField.length) {
                                var div = inputField.closest('div.form-group');
                                var errorElement = $(`<div class="text-danger error"><div>${messages[0]}</div></div>`);
                                div.append(errorElement);
                                if (!firstErrorInput) {
                                    firstErrorInput = inputField;
                                }
                            } else {
                                Toast.fire({
                                    icon: "error",
                                    title: messages[0]
                                });
                            }
                        });
                        if (modalBody.length != 0) {
                            if (firstErrorInput) {
                                var id = '#' + form.data('dismiss-modal');
                                let inputOffset = firstErrorInput.offset();
                                $(modalBody).stop().animate({
                                    scrollTop: inputOffset.top
                                }, 500, function () {
                                    firstErrorInput.focus();
                                });
                            }
                        }
                    } else {
                        if (response.reset == true) {
                            $('input[data-reset="true"]').val('');
                        }
                        Toast.fire({
                            icon: "error",
                            title: response.msg
                        });
                    }
                }
            },
            complete: function () {
                hidePageLoader();
                if (button) {
                    button.removeAttribute('disabled');
                    button.setAttribute("data-kt-indicator", "off");
                }
            }
        });
    }
});

//page loader
function showPageLoader() {
    const loadingEl = document.createElement("div");
    document.body.prepend(loadingEl);
    loadingEl.classList.add("page-loader");
    loadingEl.classList.add("flex-column");
    loadingEl.classList.add("bg-dark");
    loadingEl.classList.add("bg-opacity-25");
    loadingEl.innerHTML = `
        <span class="spinner-border text-primary" role="status"></span>
        <span class="text-gray-800 fs-6 fw-semibold mt-5">Loading...</span>
    `;
    KTApp.showPageLoading();
}
function hidePageLoader() {
    KTApp.hidePageLoading();
    const loadingEl = $(".page-loader");
    loadingEl.remove();
}

$(document).on('click', '.LinkGoogle', function () {
    window.location.href = base_url + '/link/google';
});

$(document).on('click', '.LinkFacebook', function () {
    window.location.href = base_url + '/link/facebook';
});

$(document).on('click', '.showPassword', function () {
    var input = $(this).siblings('input');
    if (input.attr('type') === 'password') {
        input.attr('type', 'text');
        $(this).find('.mb').addClass('mb-eye').removeClass('mb-eye-close text-muted');
    } else {
        input.attr('type', 'password');
        $(this).find('.mb').removeClass('mb-eye').addClass('mb-eye-close text-muted');
    }
});

$(document).on('click', '#MarkAsRead', function (e) {
    var id = $(this).data('id');
    $.ajax({
        type: "GET",
        url: base_url + '/markasread/' + id,
        success: function (response) {
            if (response.status == true) {
                $('.noti-div').find('[data-id="' + id + '"]').remove();
                $('#modal_notification').modal('hide');
                if ($('.noti-div').find('[data-id="' + id + '"]').length == 0) {
                    var html = `<div class="my-5 text-center">
                                    <label>No new notification.</label>
                                </div>`;
                    $('.noti-div').html(html);
                }
                if ($('.noti-div').find('.noti-item').length == 0) {
                    var html = `<div class="my-5 text-center">
                                    <label>No new notification.</label>
                                </div>`;
                    $('.noti-div').html(html);
                    $(document).find('span.animation-blink').remove();
                    $(document).find('.badgeCounter').remove();
                    $(document).find('#MarkAllRead').remove();
                }
            } else {
                Toast.fire({
                    icon: "error",
                    title: response.msg
                });
            }
        }
    });
});

$(document).on('click', '#MarkAllRead', function (e) {
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: $(this).attr('href'),
        success: function (response) {
            if (response.status == true) {
                var html = `<div class="my-5 text-center">
                                <label>No new notification.</label>
                            </div>`;
                $('.noti-div').html(html);
                $(document).find('span.animation-blink').remove();
                $(document).find('.badgeCounter').remove();
                $(this).remove();
            } else {
                Toast.fire({
                    icon: "error",
                    title: response.msg
                });
            }
        }
    });
});

$(document).on('click', '.noti-item', function (e) {
    e.preventDefault();
    var url = $(this).data('url');
    $.ajax({
        type: "GET",
        url: url,
        success: function (response) {
            if (response.status == true) {
                $('body').append(response.modal_html);
                $('#modal_notification').modal('show');
                $('#modal_notification').on('hidden.bs.modal', function () {
                    $(this).remove();
                });
            }
        }
    });
});

//select2 rich content
const optionFormat = (item) => {
    if (!item.id) {
        return item.text;
    }
    var span = document.createElement('span');
    var template = '';
    template += '<div class="d-flex align-items-center">';
    template += '<img src="' + item.element.getAttribute('data-kt-rich-content-icon') +
        '" class="rounded-circle h-40px me-3" alt="' + item.text + '"/>';
    template += '<div class="d-flex flex-column">'
    template += '<span class="fs-4 fw-bold lh-1">' + item.text + '</span>';
    template += '<span class="text-muted fs-5">' + item.element.getAttribute(
        'data-kt-rich-content-subcontent') + '</span>';
    template += '</div>';
    template += '</div>';
    span.innerHTML = template;
    return $(span);
}
$('.select2_rich_content').select2({
    placeholder: "Select an option",
    minimumResultsForSearch: Infinity,
    templateSelection: optionFormat,
    templateResult: optionFormat
});

function bytesToGB(size, element = null) {
    if (!size || isNaN(size)) {
        alert("Enter numbers only.");
        return null;
    }
    let sizeInGB = (size / 1073741824).toFixed(2);
    if (element) {
        let badge = element.parentElement.querySelector("span.badge");
        if (badge) {
            badge.textContent = `${sizeInGB} GB`;
        }
    } else {
        return `${sizeInGB} GB`;
    }
}

const target = document.getElementById('kt_clipboard_4');
if (target) {
    const button = target.nextElementSibling;
    clipboard = new ClipboardJS(button, {
        target: target,
        text: function () {
            return target.innerHTML;
        }
    });
    clipboard.on('success', function (e) {
        var checkIcon = button.querySelector('.ki-check');
        var copyIcon = button.querySelector('.ki-copy');
        if (checkIcon) {
            return;
        }
        checkIcon = document.createElement('i');
        checkIcon.classList.add('ki-duotone');
        checkIcon.classList.add('ki-check');
        checkIcon.classList.add('fs-2x');
        button.appendChild(checkIcon);
        const classes = ['text-success', 'fw-boldest'];
        target.classList.add(...classes);
        button.classList.add('btn-success');
        copyIcon.classList.add('d-none');
        setTimeout(function () {
            copyIcon.classList.remove('d-none');
            button.removeChild(checkIcon);
            target.classList.remove(...classes);
            button.classList.remove('btn-success');
        }, 3000)
    });
}
$(document).on('click', '.btnRemoveFile', function (e) {
    e.preventDefault();
    var element = $(this).closest('.file');
    var id = $(this).data('id');
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Yes, delete it!"
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                type: "GET",
                url: base_url + "//" + id,
                success: function (response) {
                    if(response.status == true){
                        element.remove();
                    }
                }
            });
        }
    });
});

$(document).on('click','.langChange',function (e) {
    e.preventDefault();
    var url = $(this).attr('href');
    window.location = url;
});
