<script src="{{ asset('Assets') }}/js/jquery.min.js"></script>
<script src="{{ asset('Assets') }}/js/popper.min.js"></script>
<script src="{{ asset('Assets') }}/js/moment.min.js"></script>
<script src="{{ asset('Assets') }}/js/bootstrap.min.js"></script>
<script src="{{ asset('Assets') }}/js/simplebar.min.js"></script>
<script src='{{ asset(' Assets') }}/js/daterangepicker.js'></script>
<script src='{{ asset(' Assets') }}/js/jquery.stickOnScroll.js'></script>
<script src="{{ asset('Assets') }}/js/tinycolor-min.js"></script>
<script src="{{ asset('Assets') }}/js/config.js"></script>
<script src="{{ asset('Assets') }}/js/d3.min.js"></script>
<script src="{{ asset('Assets') }}/js/topojson.min.js"></script>
<script src="{{ asset('Assets') }}/js/datamaps.all.min.js"></script>
<script src="{{ asset('Assets') }}/js/datamaps-zoomto.js"></script>
<script src="{{ asset('Assets') }}/js/datamaps.custom.js"></script>
<script src="{{ asset('Assets') }}/js/Chart.min.js"></script>
<script>
    /* defind global options */
     Chart.defaults.global.defaultFontFamily = base.defaultFontFamily;
     Chart.defaults.global.defaultFontColor = colors.mutedColor;
</script>
<script src="{{ asset('Assets') }}/js/gauge.min.js"></script>
<script src="{{ asset('Assets') }}/js/jquery.sparkline.min.js"></script>
<script src="{{ asset('Assets') }}/js/apexcharts.min.js"></script>
<script src="{{ asset('Assets') }}/js/apexcharts.custom.js"></script>
<script src='{{ asset(' Assets') }}/js/jquery.mask.min.js'></script>
<script src='{{ asset(' Assets') }}/js/select2.min.js'></script>
<script src='{{ asset(' Assets') }}/js/jquery.steps.min.js'></script>
<script src='{{ asset(' Assets') }}/js/jquery.validate.min.js'></script>
<script src='{{ asset(' Assets') }}/js/jquery.timepicker.js'></script>
<script src='{{ asset(' Assets') }}/js/dropzone.min.js'></script>
<script src='{{ asset(' Assets') }}/js/uppy.min.js'></script>
<script src='{{ asset(' Assets') }}/js/quill.min.js'></script>
<script>
    $('.select2').select2({
         theme: 'bootstrap4',
     });
     $('.select2-multi').select2({
         multiple: true,
         theme: 'bootstrap4',
     });
     $('.drgpicker').daterangepicker({
         singleDatePicker: true,
         timePicker: false,
         showDropdowns: true,
         locale: {
             format: 'MM/DD/YYYY'
         }
     });
     $('.time-input').timepicker({
         'scrollDefault': 'now',
         'zindex': '9999' /* fix modal open */
     });
     /** date range picker */
     if ($('.datetimes').length) {
         $('.datetimes').daterangepicker({
             timePicker: true,
             startDate: moment().startOf('hour'),
             endDate: moment().startOf('hour').add(32, 'hour'),
             locale: {
                 format: 'M/DD hh:mm A'
             }
         });
     }
     var start = moment().subtract(29, 'days');
     var end = moment();

     function cb(start, end) {
         $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
     }
     $('#reportrange').daterangepicker({
         startDate: start,
         endDate: end,
         ranges: {
             'Today': [moment(), moment()],
             'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
             'Last 7 Days': [moment().subtract(6, 'days'), moment()],
             'Last 30 Days': [moment().subtract(29, 'days'), moment()],
             'This Month': [moment().startOf('month'), moment().endOf('month')],
             'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf(
                 'month')]
         }
     }, cb);
     cb(start, end);
     $('.input-placeholder').mask("00/00/0000", {
         placeholder: "__/__/____"
     });
     $('.input-zip').mask('00000-000', {
         placeholder: "____-___"
     });
     $('.input-money').mask("#.##0,00", {
         reverse: true
     });
     $('.input-phoneus').mask('(000) 000-0000');
     $('.input-mixed').mask('AAA 000-S0S');
     $('.input-ip').mask('0ZZ.0ZZ.0ZZ.0ZZ', {
         translation: {
             'Z': {
                 pattern: /[0-9]/,
                 optional: true
             }
         },
         placeholder: "___.___.___.___"
     });
     // editor
     var editor = document.getElementById('editor');
     if (editor) {
         var toolbarOptions = [
             [{
                 'font': []
             }],
             [{
                 'header': [1, 2, 3, 4, 5, 6, false]
             }],
             ['bold', 'italic', 'underline', 'strike'],
             ['blockquote', 'code-block'],
             [{
                     'header': 1
                 },
                 {
                     'header': 2
                 }
             ],
             [{
                     'list': 'ordered'
                 },
                 {
                     'list': 'bullet'
                 }
             ],
             [{
                     'script': 'sub'
                 },
                 {
                     'script': 'super'
                 }
             ],
             [{
                     'indent': '-1'
                 },
                 {
                     'indent': '+1'
                 }
             ], // outdent/indent
             [{
                 'direction': 'rtl'
             }], // text direction
             [{
                     'color': []
                 },
                 {
                     'background': []
                 }
             ], // dropdown with defaults from theme
             [{
                 'align': []
             }],
             ['clean'] // remove formatting button
         ];
         var quill = new Quill(editor, {
             modules: {
                 toolbar: toolbarOptions
             },
             theme: 'snow'
         });
     }
     // Example starter JavaScript for disabling form submissions if there are invalid fields
     (function() {
         'use strict';
         window.addEventListener('load', function() {
             // Fetch all the forms we want to apply custom Bootstrap validation styles to
             var forms = document.getElementsByClassName('needs-validation');
             // Loop over them and prevent submission
             var validation = Array.prototype.filter.call(forms, function(form) {
                 form.addEventListener('submit', function(event) {
                     if (form.checkValidity() === false) {
                         event.preventDefault();
                         event.stopPropagation();
                     }
                     form.classList.add('was-validated');
                 }, false);
             });
         }, false);
     })();
</script>
<script>
    var uptarg = document.getElementById('drag-drop-area');
     if (uptarg) {
         var uppy = Uppy.Core().use(Uppy.Dashboard, {
             inline: true,
             target: uptarg,
             proudlyDisplayPoweredByUppy: false,
             theme: 'dark',
             width: 770,
             height: 210,
             plugins: ['Webcam']
         }).use(Uppy.Tus, {
             endpoint: 'https://master.tus.io/files/'
         });
         uppy.on('complete', (result) => {
             console.log('Upload complete! We’ve uploaded these files:', result.successful)
         });
     }
</script>
<script src="{{ asset('Assets') }}/js/apps.js"></script>
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-56159088-1"></script>
<script>
    window.dataLayer = window.dataLayer || [];

     function gtag() {
         dataLayer.push(arguments);
     }
     gtag('js', new Date());
     gtag('config', 'UA-56159088-1');
</script>

{{-- Search Scripts --}}
<script>
    jQuery(document).ready(function($) {
         // Toggle filters panel with smooth animation
         $('#toggle-filters').click(function() {
             var $panel = $('#filters-panel');
             var $btn = $(this);
             if ($panel.is(':visible')) {
                 $panel.slideUp(250);
                 $btn.removeClass('active').css('background', '');
             } else {
                 $panel.slideDown(250);
                 $btn.addClass('active').css('background', 'rgba(0,123,255,0.15)');
             }
         });

         // Auto-submit on filter change
         $('#filters-panel select').on('change', function() {
             $('#search-form').submit();
         });

         // Quick search on Enter key
         $('#quick-search').on('keypress', function(e) {
             if (e.which === 13) {
                 e.preventDefault();
                 $('#search-form').submit();
             }
         });
     });
</script>

<script>
    // ── Dashboard Charts ────────────────────────────────────────────────
(function () {
    if (!document.getElementById('booksChart')) return;

    var palette = ['#2563eb','#059669','#ea580c','#9333ea','#eab308','#06b6d4','#f43f5e','#84cc16'];
    var categoryLabels    = ['روايات', 'أدب عالمي', 'تقنية', 'علم النفس', 'تاريخ', 'إدارة', 'علوم', 'ديني'];
    var categoryBookCounts = [25, 18, 22, 14, 16, 10, 8, 7];

    // Bar Chart
    new Chart(document.getElementById('booksChart').getContext('2d'), {
        type: 'bar',
        data: {
            labels: categoryLabels,
            datasets: [{
                label: 'عدد الكتب',
                data: categoryBookCounts,
                backgroundColor: palette.map(function(c){ return c + 'cc'; }),
                borderColor: palette,
                borderWidth: 2,
                borderRadius: 6,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#1e2235',
                    titleColor: '#e0e0e0',
                    bodyColor: '#9ca3af',
                    borderColor: 'rgba(255,255,255,.08)',
                    borderWidth: 1,
                    rtl: true,
                    textDirection: 'rtl',
                }
            },
            scales: {
                x: { ticks: { color: '#8b949e', font: { size: 11 } }, grid: { color: 'rgba(255,255,255,.05)' } },
                y: { beginAtZero: true, ticks: { color: '#8b949e', stepSize: 1, font: { size: 11 } }, grid: { color: 'rgba(255,255,255,.05)' } }
            }
        }
    });

    // Doughnut Chart
    new Chart(document.getElementById('categoryChart').getContext('2d'), {
        type: 'doughnut',
        data: {
            labels: categoryLabels,
            datasets: [{
                data: categoryBookCounts,
                backgroundColor: palette.map(function(c){ return c + 'cc'; }),
                borderColor: '#1e2235',
                borderWidth: 3,
                hoverOffset: 6,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '68%',
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { color: '#9ca3af', padding: 14, font: { size: 11 }, usePointStyle: true }
                },
                tooltip: {
                    backgroundColor: '#1e2235',
                    titleColor: '#e0e0e0',
                    bodyColor: '#9ca3af',
                    borderColor: 'rgba(255,255,255,.08)',
                    borderWidth: 1,
                }
            }
        }
    });
})();
</script>