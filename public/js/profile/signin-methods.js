"use strict";
var KTAccountSettingsSigninMethods = function () {
    var t, e, n, o, i, s, r, a, l, d = function () {
        e.classList.toggle("d-none"),
            s.classList.toggle("d-none"),
            n.classList.toggle("d-none")
    },
        c = function () {
            o.classList.toggle("d-none"),
                a.classList.toggle("d-none"),
                i.classList.toggle("d-none")
        };
    return {
        init: function () {
            var m;
            t = document.getElementById("kt_signin_change_email"),
                e = document.getElementById("kt_signin_email"),
                n = document.getElementById("kt_signin_email_edit"),
                o = document.getElementById("kt_signin_password"),
                i = document.getElementById("kt_signin_password_edit"),
                s = document.getElementById("kt_signin_email_button"),
                r = document.getElementById("kt_signin_cancel"),
                a = document.getElementById("kt_signin_password_button"),
                l = document.getElementById("kt_password_cancel"),
                e && (s.querySelector("button").addEventListener("click", (function () {
                    d()
                })),
                    r.addEventListener("click", (function () {
                        d()
                    })),
                    a.querySelector("button").addEventListener("click", (function () {
                        c()
                    })),
                    l.addEventListener("click", (function () {
                        c()
                    }))),
                t && (m = FormValidation.formValidation(t,
                    {
                        fields: {
                            emailaddress: {
                                validators: {
                                    notEmpty: { message: "Email is required" },
                                    emailAddress: { message: "The value is not a valid email address" }
                                }
                            },
                            confirmemailpassword: { validators: { notEmpty: { message: "Password is required" } } }
                        },
                        plugins: {
                            trigger: new FormValidation.plugins.Trigger,
                            bootstrap: new FormValidation.plugins.Bootstrap5({ rowSelector: ".fv-row" })
                        }
                    }))
        }
    }
}(); KTUtil.onDOMContentLoaded((function () {
    KTAccountSettingsSigninMethods.init()
}));
