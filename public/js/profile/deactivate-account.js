"use strict";

var KTAccountSettingsDeactivateAccount = function () {
    var t, n, e;

    return {
        init: function () {
            t = document.querySelector("#kt_account_deactivate_form");
            if (t) {
                e = document.querySelector("#kt_account_deactivate_account_submit");

                n = FormValidation.formValidation(t, {
                    fields: {
                        deactivate: {
                            validators: {
                                notEmpty: {
                                    message: "Please check the box to deactivate your account"
                                }
                            }
                        }
                    },
                    plugins: {
                        trigger: new FormValidation.plugins.Trigger(),
                        submitButton: new FormValidation.plugins.SubmitButton(),
                        bootstrap: new FormValidation.plugins.Bootstrap5({
                            rowSelector: ".fv-row",
                            eleInvalidClass: "",
                            eleValidClass: ""
                        })
                    }
                });

                e.addEventListener("click", function (event) {
                    event.preventDefault();

                    n.validate().then(function (status) {
                        if (status === 'Valid') {
                            swal.fire({
                                text: "Are you sure you would like to deactivate your account?",
                                icon: "warning",
                                buttonsStyling: false,
                                showDenyButton: true,
                                confirmButtonText: "Yes",
                                denyButtonText: "No",
                                customClass: {
                                    confirmButton: "btn btn-light-primary",
                                    denyButton: "btn btn-danger"
                                }
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    t.submit(); // Submit the form
                                } else if (result.isDenied) {
                                    Swal.fire({
                                        text: "Account not deactivated.",
                                        icon: "info",
                                        confirmButtonText: "Ok",
                                        buttonsStyling: false,
                                        customClass: {
                                            confirmButton: "btn btn-light-primary"
                                        }
                                    });
                                }
                            });
                        } else {
                            swal.fire({
                                text: "Sorry, looks like there are some errors detected, please try again.",
                                icon: "error",
                                buttonsStyling: false,
                                confirmButtonText: "Ok, got it!",
                                customClass: {
                                    confirmButton: "btn btn-light-primary"
                                }
                            });
                        }
                    });
                });
            }
        }
    };
}();

KTUtil.onDOMContentLoaded(function () {
    KTAccountSettingsDeactivateAccount.init();
});
