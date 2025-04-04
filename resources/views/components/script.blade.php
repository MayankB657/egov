<script src="{{ url('/') }}/public/js/plugins.bundle.js"></script>
<script src="{{ url('/') }}/public/js/scripts.bundle.js"></script>
<script src="{{ url('/') }}/public/js/widgets.bundle.js"></script>
<!--begin::Profile Page-->
<script src="{{ url('/') }}/public/js/profile/signin-methods.js"></script>
<script src="{{ url('/') }}/public/js/profile/deactivate-account.js"></script>
<!--end::Profile Page-->
<script src="{{ url('/') }}/public/js/intlTelInput.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.30.1/moment.min.js"></script>
<script>
    const telinput = document.querySelector(".phone");
    var country = $('#CountryIso').length && $('#CountryIso').val() ? $('#CountryIso').val() : 'in';
    if (telinput) {
        const iti = window.intlTelInput(telinput, {
            initialCountry: country,
            hiddenInput: () => ({
                phone: "full_phone",
                country: "country_code"
            }),
            utilsScript: "{{ url('/') }}/public/js/utils.js",
        });
    }

    $(document).ready(function() {
        $(".countries").select2({
            placeholder: "Country",
            templateResult: formatState,
            templateSelection: formatState
        });

        function formatState(state) {
            if (!state.element) {
                return state.text;
            }
            var dataCode = $(state.element).data('code');
            if (!dataCode) {
                return state.text;
            }
            var $state = $('<span> <span class="flag-icon flag-icon-' + dataCode + ' mr-2"></span>' + state
                .text + '</span>');
            return $state;
        }
    });
</script>
<!--end::Bvalidation-->
<script src="{{ url('/') }}/public/js/bvalidator/jquery.bvalidator.js"></script>
<script src="{{ url('/') }}/public/js/bvalidator/bValidator.Bs3FormPresenter.js"></script>
<script src="{{ url('/') }}/public/js/bvalidator/bs3form.js"></script>
<!--end::Bvalidation-->
<script src="{{ url('/') }}/public/ckeditor/ckeditor.js"></script>
<script src="{{ url('/') }}/public/js/fslightbox.bundle.js"></script>
<script src="{{ url('/') }}/public/js/custom.js"></script>
<script>
    navigator.serviceWorker.register("{{ url('/') }}/public/js/sw.js");
    $(document).ready(function() {
        var options = {
            useTheme: 'bs3form'
        };
        $('#FormId').bValidator(options);
        $('.FormClass').bValidator(options);
        $(document).on('submit', '#FormId, .FormClass', function() {
            removeServerErrors();
        });

        function removeServerErrors() {
            $('.error').remove();
        }
        if (Notification.permission !== 'granted') {
            requestPermission();
        }

        const ckeditorConfig = {
            height: 200,
            toolbar: [{
                    name: 'basicstyles',
                    items: ['Bold', 'Italic', 'Underline', 'Strike']
                },
                {
                    name: 'insert',
                    items: ['HorizontalRule']
                },
                {
                    name: 'styles',
                    items: ['Format']
                },
                {
                    name: 'tools',
                    items: ['Maximize', 'Source']
                }
            ],
            removePlugins: 'elementspath',
            resize_enabled: false
        };
        $(document).find('.CkeditorClass').each(function() {
            CKEDITOR.replace($(this).attr('id'), ckeditorConfig);
        });
    });

    function requestPermission() {
        Notification.requestPermission().then((permission) => {});
    }
</script>
@stack('js')
