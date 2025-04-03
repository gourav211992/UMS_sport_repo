<!-- BEGIN: Vendor JS-->
<script src="{{ url('/app-assets/vendors/js/vendors.min.js') }}"></script>
<!-- BEGIN Vendor JS-->
<meta name="csrf-token" content="{{ csrf_token() }}">
<!-- BEGIN: Page Vendor JS-->
<script src="{{ url('/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('/app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ url('/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ url('/app-assets/vendors/js/tables/datatable/responsive.bootstrap5.min.js') }}"></script>
<script src="{{ url('/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
<script src="{{ url('/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
<script src="{{ url('/app-assets/vendors/js/tables/datatable/jszip.min.js') }}"></script>
<script src="{{ url('/app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
<script src="{{ url('/app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
<script src="{{ url('/app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
<script src="{{ url('/app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
<script src="{{ url('/app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
<script src="{{ url('/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ url('/app-assets/vendors/js/editors/quill/katex.min.js') }}"></script>
<script src="{{ url('/app-assets/vendors/js/editors/quill/highlight.min.js') }}"></script>
<script src="{{ url('/app-assets/vendors/js/editors/quill/quill.min.js') }}"></script>
<script src="{{ asset('app-assets/js/moment.js') }}"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{ url('/app-assets/js/core/app-menu.js') }}"></script>
<script src="{{ url('/app-assets/js/core/app.js') }}"></script>
<script src="{{ url('/app-assets/js/ajax-script.js') }}"></script>
<script src="{{ url('/app-assets/js/vendor-customer-script.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ url('/app-assets/js/jquery-ui.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>

<!-- END: Theme JS-->


<!-- BEGIN: Page JS-->
<script src="{{ url('/app-assets/js/scripts/forms/form-quill-editor.js') }}"></script>

<script src="{{ url('/app-assets/js/scripts/pages/app-email.js') }}"></script>
<!-- END: Page JS-->


<script src="{{ url('/app-assets/js/scripts/forms/pickers/form-pickers.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
<script src="{{ url('/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="{{ url('/app-assets/js/scripts/forms/form-select2.js') }}"></script>
<script src="{{ url('/app-assets/js/common-script.js') }}"></script>
<script src="https://unpkg.com/feather-icons"></script>

<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>

<!-- Then, include Laravel Echo -->
<script src="https://cdn.jsdelivr.net/npm/laravel-echo@1.15.0/dist/echo.iife.js"></script>

<!-- Other Pusher Beams scripts -->
<script src="https://js.pusher.com/beams/service-worker.js"></script>
<script src="https://js.pusher.com/beams/1.0/push-notifications-cdn.js"></script>

{{--<script defer>--}}
{{--    var userId = @json(\App\Helpers\Helper::getAuthenticatedUser()->id);--}}

{{--    Pusher.logToConsole = true; // For debugging, enable Pusher logs--}}

{{--    window.addEventListener('DOMContentLoaded', () => {--}}
{{--        // Pass authenticated user ID from backend to JavaScript--}}
{{--        var userId = @json(\App\Helpers\Helper::getAuthenticatedUser()->id);--}}
{{--        var type = @json(get_class(\App\Helpers\Helper::getAuthenticatedUser()));--}}

{{--        window.Echo = new Echo({--}}
{{--            broadcaster: 'pusher',--}}
{{--            key: '10c23c19df9643f9a945',  // Replace with your actual Pusher key--}}
{{--            cluster: 'mt1',  // Replace with your actual Pusher cluster--}}
{{--            encrypted: true--}}
{{--        });--}}

{{--        // Log Pusher connection state changes (optional for debugging)--}}
{{--        window.Echo.connector.pusher.connection.bind('state_change', (state) => {--}}
{{--            console.log('Pusher connection state:', state);--}}
{{--        });--}}

{{--        window.Echo.private(`user.${userId}`)--}}
{{--            .notification((notification) => {--}}
{{--                console.log('Notification received:', notification);--}}

{{--                // Prepare the notification HTML--}}
{{--                let notificationHtml = `--}}
{{--                <a class="d-flex"--}}
{{--                    href="{{route('notification.read','')}}+${notification.id}">--}}
{{--                    <div--}}
{{--                        class="list-item d-flex align-items-start unread-notification">--}}
{{--                        <div class="me-1">--}}
{{--                            <div class="avatar">--}}
{{--                                <img src="{{ url('app-assets/images/portrait/small/avatar-s-3.jpg') }}"--}}
{{--                                     alt="avatar" width="32" height="32">--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="list-item-body flex-grow-1">--}}
{{--                            <p class="media-heading">--}}
{{--                                <span class="fw-bolder">${notification.title}</span><br>--}}
{{--                                ${notification.description || notification.message}--}}
{{--                            </p>--}}
{{--                            <small class="notification-text">${moment(notification.created_at).fromNow()}</small>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </a>--}}


{{--                `;--}}
{{--                if(notification.notifiable_type === type){--}}
{{--                    $('#list_noti').prepend(notificationHtml); // Prepend it to show at the top--}}
{{--                    $('.count').text(parseFloat($('.count').text())+1);--}}
{{--                    $('.count2').text(parseFloat($('.count').text()));--}}
{{--                }--}}
{{--            });--}}
{{--    })--}}
{{--</script>--}}

<script src="{{ asset('app-assets/summernote/summernote-lite.min.js') }}"></script>

<script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    });
</script>

<script>
    $('#summernote').summernote({
        placeholder: 'Hello stand alone ui',
        tabsize: 2,
        height: 300,
        width: '100%',
        fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Georgia', 'Times New Roman',
            'Verdana'
        ], // Custom font families
        fontNamesIgnoreCheck: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New', 'Georgia',
            'Times New Roman', 'Verdana'
        ], // Ignore check for these fonts
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear', 'fontname', 'fontsize', 'color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'hr', 'codeblock']],
            ['view', ['codeview', 'help']],
            ['align', ['align']],
            ['misc', ['undo', 'redo']]
        ]
    });
</script>



<script>
    function formatIndianNumber(number) {
        // Ensure the number is a float and round it to 2 decimal places
        number = parseFloat(number).toFixed(2);

        // Split the whole part and decimal part
        let parts = number.split('.');
        let wholePart = parts[0];
        let decimalPart = parts[1] || '00'; // Ensure decimal part exists

        // Remove any existing commas from the whole part
        wholePart = wholePart.replace(/,/g, '');

        // Regular expression to match the Indian format
        let lastThreeDigits = wholePart.slice(-3);
        let restOfTheNumber = wholePart.slice(0, -3);

        if (restOfTheNumber !== '') {
            restOfTheNumber = restOfTheNumber.replace(/\B(?=(\d{2})+(?!\d))/g, ',');
            wholePart = restOfTheNumber + ',' + lastThreeDigits;
        } else {
            wholePart = lastThreeDigits;
        }

        // Return the formatted number with two decimals
        return wholePart + '.' + decimalPart.padEnd(2, '0');
    }

    function removeCommas(input) {
        if (typeof input === 'string' && input.includes(',')) {
            return input.replace(/,/g, ''); // Replace all commas
        }
        return input; // Return the same value if no commas are present
    }

    // Function to format numbers with commas
    function formatNumberWithCommas(value) {
        // Remove any existing commas and non-numeric characters except decimal point
        value = value.replace(/[^0-9.]/g, '');

        // If it's an empty string after cleanup, return it as is
        if (!value) return value;

        // Add commas in the correct places for the number
        let parts = value.split('.');
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        return parts.join('.');
    }

    function formatDateToDDMMYYYY(dateString) {
        // Create a new Date object from the input string
        var date = new Date(dateString);

        // Get the day, month, and year
        var day = date.getDate();
        var month = date.getMonth() + 1; // Months are 0-indexed
        var year = date.getFullYear();

        // Add leading zeros if day or month is less than 10
        day = day < 10 ? '0' + day : day;
        month = month < 10 ? '0' + month : month;

        // Return the formatted date
        return day + '-' + month + '-' + year;
    }
</script>

<!-- END: Page JS-->



{{-- <script>
    $(window).on('load', function() {
        if (feather) {
            feather.replace({
                width: 14,
                height: 14
            });
        }
    })
    $(function() {

        var dt_basic_table = $('.datatables-basic'),
            dt_date_table = $('.dt-date'),
            dt_complex_header_table = $('.dt-complex-header'),
            dt_row_grouping_table = $('.dt-row-grouping'),
            dt_multilingual_table = $('.dt-multilingual'),
            assetPath = '../../../app-assets/';

        if ($('body').attr('data-framework') === 'laravel') {
            assetPath = $('body').attr('data-asset-path');
        }

        // DataTable with buttons
        // --------------------------------------------------------------------

        if (dt_basic_table.length) {
            var dt_basic = dt_basic_table.DataTable({

                order: [
                    [0, 'asc']
                ],
                dom: '<"d-flex justify-content-between align-items-center mx-2 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-3 withoutheadbuttin dt-action-buttons text-end"B><"col-sm-12 col-md-3"f>>t<"d-flex justify-content-between mx-2 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
                displayLength: 7,
                lengthMenu: [7, 10, 25, 50, 75, 100],
                buttons: [{
                        extend: 'collection',
                        className: 'btn btn-outline-secondary dropdown-toggle',
                        text: feather.icons['share'].toSvg({
                            class: 'font-small-4 mr-50'
                        }) + 'Export',
                        buttons: [{
                                extend: 'print',
                                text: feather.icons['printer'].toSvg({
                                    class: 'font-small-4 mr-50'
                                }) + 'Print',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [3, 4, 5, 6, 7]
                                }
                            },
                            {
                                extend: 'csv',
                                text: feather.icons['file-text'].toSvg({
                                    class: 'font-small-4 mr-50'
                                }) + 'Csv',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [3, 4, 5, 6, 7]
                                }
                            },
                            {
                                extend: 'excel',
                                text: feather.icons['file'].toSvg({
                                    class: 'font-small-4 mr-50'
                                }) + 'Excel',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [3, 4, 5, 6, 7]
                                }
                            },
                            {
                                extend: 'pdf',
                                text: feather.icons['clipboard'].toSvg({
                                    class: 'font-small-4 mr-50'
                                }) + 'Pdf',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [3, 4, 5, 6, 7]
                                }
                            },
                            {
                                extend: 'copy',
                                text: feather.icons['copy'].toSvg({
                                    class: 'font-small-4 mr-50'
                                }) + 'Copy',
                                className: 'dropdown-item',
                                exportOptions: {
                                    columns: [3, 4, 5, 6, 7]
                                }
                            }
                        ],
                        init: function(api, node, config) {
                            $(node).removeClass('btn-secondary');
                            $(node).parent().removeClass('btn-group');
                            setTimeout(function() {
                                $(node).closest('.dt-buttons').removeClass('btn-group')
                                    .addClass('d-inline-flex');
                            }, 50);
                        }
                    },

                ],

                language: {
                    paginate: {
                        // remove previous & next text from pagination
                        previous: '&nbsp;',
                        next: '&nbsp;'
                    }
                }
            });
            $('div.head-label').html('<h6 class="mb-0">Event List</h6>');
        }

        // Flat Date picker
        if (dt_date_table.length) {
            dt_date_table.flatpickr({
                monthSelectorType: 'static',
                dateFormat: 'm/d/Y'
            });
        }

        // Add New record
        // ? Remove/Update this code as per your requirements ?
        var count = 101;
        $('.data-submit').on('click', function() {
            var $new_name = $('.add-new-record .dt-full-name').val(),
                $new_post = $('.add-new-record .dt-post').val(),
                $new_email = $('.add-new-record .dt-email').val(),
                $new_date = $('.add-new-record .dt-date').val(),
                $new_salary = $('.add-new-record .dt-salary').val();

            if ($new_name != '') {
                dt_basic.row
                    .add({
                        responsive_id: null,
                        id: count,
                        full_name: $new_name,
                        post: $new_post,
                        email: $new_email,
                        start_date: $new_date,
                        salary: '$' + $new_salary,
                        status: 5
                    })
                    .draw();
                count++;
                $('.modal').modal('hide');
            }
        });

        // Delete Record
        $('.datatables-basic tbody').on('click', '.delete-record', function() {
            dt_basic.row($(this).parents('tr')).remove().draw();
        });



    });
</script> --}}
{{--<script>--}}
{{--    $(window).on('load', function() {--}}
{{--        if (feather) {--}}
{{--            feather.replace({--}}
{{--                width: 14,--}}
{{--                height: 14--}}
{{--            });--}}
{{--        }--}}
{{--    })--}}
{{--    $(function () {--}}

{{--var dt_basic_table = $('.datatables-basic'),--}}
{{--dt_date_table = $('.dt-date'),--}}
{{--dt_complex_header_table = $('.dt-complex-header'),--}}
{{--dt_row_grouping_table = $('.dt-row-grouping'),--}}
{{--dt_multilingual_table = $('.dt-multilingual'),--}}
{{--assetPath = '../../../app-assets/';--}}

{{--if ($('body').attr('data-framework') === 'laravel') {--}}
{{--assetPath = $('body').attr('data-asset-path');--}}
{{--}--}}

{{--// DataTable with buttons--}}
{{--// ----------------------------------------------------------------------}}

{{--if (dt_basic_table.length) {--}}
{{--var dt_basic = dt_basic_table.DataTable({--}}

{{--  order: [[0, 'asc']],--}}
{{--  dom:--}}
{{--    '<"d-flex justify-content-between align-items-center mx-2 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-3 withoutheadbuttin dt-action-buttons text-end"B><"col-sm-12 col-md-3"f>>t<"d-flex justify-content-between mx-2 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',--}}
{{--  displayLength: 7,--}}
{{--  lengthMenu: [7, 10, 25, 50, 75, 100],--}}
{{--  buttons: [--}}
{{--    {--}}
{{--      extend: 'collection',--}}
{{--      className: 'btn btn-outline-secondary dropdown-toggle',--}}
{{--      text: feather.icons['share'].toSvg({ class: 'font-small-4 mr-50' }) + 'Export',--}}
{{--      buttons: [--}}
{{--        {--}}
{{--          extend: 'print',--}}
{{--          text: feather.icons['printer'].toSvg({ class: 'font-small-4 mr-50' }) + 'Print',--}}
{{--          className: 'dropdown-item',--}}
{{--          exportOptions: {--}}
{{--            // This will export all columns by removing the 'columns' restriction--}}
{{--            modifier: {--}}
{{--              page: 'all' // Ensures the print/export includes all rows and columns--}}
{{--            }--}}
{{--          }--}}
{{--        },--}}
{{--        {--}}
{{--          extend: 'csv',--}}
{{--          text: feather.icons['file-text'].toSvg({ class: 'font-small-4 mr-50' }) + 'Csv',--}}
{{--          className: 'dropdown-item',--}}
{{--          exportOptions: {--}}
{{--            // Export all columns--}}
{{--            modifier: {--}}
{{--              page: 'all'--}}
{{--            }--}}
{{--          }--}}
{{--        },--}}
{{--        {--}}
{{--          extend: 'excel',--}}
{{--          text: feather.icons['file'].toSvg({ class: 'font-small-4 mr-50' }) + 'Excel',--}}
{{--          className: 'dropdown-item',--}}
{{--          exportOptions: {--}}
{{--            // Export all columns--}}
{{--            modifier: {--}}
{{--              page: 'all'--}}
{{--            }--}}
{{--          }--}}
{{--        },--}}
{{--        {--}}
{{--          extend: 'pdf',--}}
{{--          text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 mr-50' }) + 'Pdf',--}}
{{--          className: 'dropdown-item',--}}
{{--          exportOptions: {--}}
{{--            // Export all columns--}}
{{--            modifier: {--}}
{{--              page: 'all'--}}
{{--            }--}}
{{--          }--}}
{{--        },--}}
{{--        {--}}
{{--          extend: 'copy',--}}
{{--          text: feather.icons['copy'].toSvg({ class: 'font-small-4 mr-50' }) + 'Copy',--}}
{{--          className: 'dropdown-item',--}}
{{--          exportOptions: {--}}
{{--            // Export all columns--}}
{{--            modifier: {--}}
{{--              page: 'all'--}}
{{--            }--}}
{{--          }--}}
{{--        }--}}
{{--      ]--}}
{{--    },--}}
{{--  ],--}}

{{--  language: {--}}
{{--    paginate: {--}}
{{--      previous: '&nbsp;',--}}
{{--      next: '&nbsp;'--}}
{{--    }--}}
{{--  }--}}
{{--});--}}
{{--}--}}


{{--// Flat Date picker--}}
{{--if (dt_date_table.length) {--}}
{{--dt_date_table.flatpickr({--}}
{{--  monthSelectorType: 'static',--}}
{{--  dateFormat: 'm/d/Y'--}}
{{--});--}}
{{--}--}}

{{--// Add New record--}}
{{--// ? Remove/Update this code as per your requirements ?--}}
{{--var count = 101;--}}
{{--$('.data-submit').on('click', function () {--}}
{{--var $new_name = $('.add-new-record .dt-full-name').val(),--}}
{{--  $new_post = $('.add-new-record .dt-post').val(),--}}
{{--  $new_email = $('.add-new-record .dt-email').val(),--}}
{{--  $new_date = $('.add-new-record .dt-date').val(),--}}
{{--  $new_salary = $('.add-new-record .dt-salary').val();--}}

{{--if ($new_name != '') {--}}
{{--  dt_basic.row--}}
{{--    .add({--}}
{{--      responsive_id: null,--}}
{{--      id: count,--}}
{{--      full_name: $new_name,--}}
{{--      post: $new_post,--}}
{{--      email: $new_email,--}}
{{--      start_date: $new_date,--}}
{{--      salary: '$' + $new_salary,--}}
{{--      status: 5--}}
{{--    })--}}
{{--    .draw();--}}
{{--  count++;--}}
{{--  $('.modal').modal('hide');--}}
{{--}--}}
{{--});--}}

{{--// Delete Record--}}
{{--$('.datatables-basic tbody').on('click', '.delete-record', function () {--}}
{{--dt_basic.row($(this).parents('tr')).remove().draw();--}}
{{--});--}}



{{--});--}}


{{-- // Initialize the charts once the DOM is fully loaded--}}
{{-- $(document).ready(function () {--}}
{{--     // Line Chart--}}
{{--     var ctx1 = document.getElementById('leavebar-chart').getContext('2d');--}}
{{--     var leaveChart = new Chart(ctx1, {--}}
{{--         type: 'line',--}}
{{--         data: {--}}
{{--             labels: ['January', 'February', 'March', 'April', 'May', 'June'], // Change labels as needed--}}
{{--             datasets: [{--}}
{{--                 label: 'Applications Submitted',--}}
{{--                 data: [65, 59, 80, 81, 56, 55], // Example data--}}
{{--                 borderColor: 'rgba(75, 192, 192, 1)',--}}
{{--                 fill: false--}}
{{--             }]--}}
{{--         },--}}
{{--         options: {--}}
{{--             responsive: true,--}}
{{--             maintainAspectRatio: false--}}
{{--         }--}}
{{--     });--}}

{{--     // Donut Chart--}}
{{--     var ctx2 = document.getElementById('donut-opentask').getContext('2d');--}}
{{--     var donutChart = new Chart(ctx2, {--}}
{{--         type: 'doughnut',--}}
{{--         data: {--}}
{{--             labels: ['Completed', 'Pending', 'Failed'],--}}
{{--             datasets: [{--}}
{{--                 label: 'Tasks',--}}
{{--                 data: [300, 50, 100], // Example data--}}
{{--                 backgroundColor: ['#36a2eb', '#ff6384', '#ffcd56']--}}
{{--             }]--}}
{{--         },--}}
{{--         options: {--}}
{{--             responsive: true,--}}
{{--             maintainAspectRatio: false--}}
{{--         }--}}
{{--     });--}}
{{-- });--}}

{{--</script>--}}
