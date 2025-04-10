<script src="{{ url('/') }}/public/js/plugins.bundle.js"></script>
<script src="{{ url('/') }}/public/js/scripts.bundle.js"></script>
<script src="{{ url('/') }}/public/js/widgets.bundle.js"></script>
<!--begin::Profile Page-->
<script src="{{ url('/') }}/public/js/profile/signin-methods.js"></script>
<script src="{{ url('/') }}/public/js/profile/deactivate-account.js"></script>
<!--end::Profile Page-->
<script src="{{ url('/') }}/public/js/intlTelInput.min.js"></script>
<script src="{{ url('/') }}/public/js/moment.js"></script>
<script src="{{ url('/') }}/public/js/moment-mr.js"></script>
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
<script>
    const lbl_today = "{{ __('labels.today') }}";
    const lbl_yesterday = "{{ __('labels.yesterday') }}";
    const lbl_last_7_days = "{{ __('labels.last_7_days') }}";
    const lbl_last_30_days = "{{ __('labels.last_30_days') }}";
    const lbl_this_month = "{{ __('labels.this_month') }}";
    const lbl_last_month = "{{ __('labels.last_month') }}";
    const lbl_custom_dates = "{{ __('labels.custom_dates') }}";
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
<script>
    $(document).ready(function() {
        const isChrome = /Chrome/.test(navigator.userAgent) && /Google Inc/.test(navigator.vendor);
        var transNoticeDiv = $('#no_trans_notice');
        if (isChrome && transNoticeDiv.length > 0) {
            transNoticeDiv.removeClass('d-none');
        }
    });
    $('#DismissTranselationNotice').click(function(e) {
        $.ajax({
            type: "POST",
            url: base_url + "/set-no-trans-notice",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            }
        });
    });
</script>

{{-- <script>
    document.addEventListener("DOMContentLoaded", function() {
        if (document.body.classList.contains("mr")) {
            const marathiDigits = ['०', '१', '२', '३', '४', '५', '६', '७', '८', '९'];

            function convertToMarathiDigits(str) {
                return str.replace(/\d/g, d => marathiDigits[d]);
            }

            function traverseAndConvert(node) {
                if (node.nodeType === 3) { // Text node
                    if (/\d/.test(node.nodeValue)) {
                        node.nodeValue = convertToMarathiDigits(node.nodeValue);
                    }
                } else {
                    node.childNodes.forEach(traverseAndConvert);
                }
            }
            traverseAndConvert(document.body);
        }
    });
</script> --}}
@stack('js')
