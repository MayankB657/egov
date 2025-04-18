"use strict";
var KTModalTwoFactorAuthentication = function () {
    var e, t, o, n, i, d, c, u, m, f,
        p = function () {
            o.classList.remove("d-none"),
                i.classList.add("d-none"),
                d.classList.add("d-none")
        };
    return {
        init: function () {
            (e = document.querySelector("#kt_modal_two_factor_authentication")) && (t = new bootstrap.Modal(e),
                o = e.querySelector('[data-kt-element="options"]'),
                n = e.querySelector('[data-kt-element="options-select"]'),
                i = e.querySelector('[data-kt-element="sms"]'),
                d = e.querySelector('[data-kt-element="apps"]'),
                c = e.querySelector('[data-kt-element="apps-form"]'),
                u = e.querySelector('[data-kt-element="apps-submit"]'),
                m = e.querySelector('[data-kt-element="apps-cancel"]'),
                n.addEventListener("click",
                    (function (e) {
                        e.preventDefault();
                        var t = o.querySelector('[name="auth_option"]:checked');
                        o.classList.add("d-none"),
                            "sms" == t.value ? i.classList.remove("d-none") : d.classList.remove("d-none")
                    })),
                f = FormValidation.formValidation(c,
                    {
                        fields: {
                            code: {
                                validators: {
                                    notEmpty: {
                                        message: "Code is required"
                                    }
                                }
                            }
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger,
                            bootstrap: new FormValidation.plugins.Bootstrap5({
                                rowSelector: ".fv-row",
                                eleInvalidClass: "",
                                eleValidClass: ""
                            })
                        }
                    }),
                u.addEventListener("click",
                    (function (e) {
                        e.preventDefault(),
                            f && f.validate().then((function (e) {
                                console.log("validated!"),
                                    "Valid" == e ? (u.setAttribute("data-kt-indicator", "on"),
                                        u.disabled = !0
                                    ) : Swal.fire({
                                        text: "Sorry, looks like there are some errors detected, please try again.",
                                        icon: "error",
                                        buttonsStyling: !1,
                                        confirmButtonText: "Ok, got it!",
                                        customClass: {
                                            confirmButton: "btn btn-primary"
                                        }
                                    })
                            }))
                    })),
                m.addEventListener("click",
                    (function (e) {
                        e.preventDefault(),
                            o.querySelector('[name="auth_option"]:checked'),
                            o.classList.remove("d-none"),
                            d.classList.add("d-none")
                    })))
        }
    }
}();
KTUtil.onDOMContentLoaded((function () {
    KTModalTwoFactorAuthentication.init()
}));
