{{-- <!-- BEGIN: Vendor JS-->

<!-- BEGIN: Vendor JS-->
<script src="../../../sports/app-assets/vendors/js/vendors.min.js"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="../../../sports/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js"></script>
<script src="../../../sports/app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js"></script>
<script src="../../../sports/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
<script src="../../../sports/app-assets/vendors/js/tables/datatable/responsive.bootstrap5.min.js"></script>
<script src="../../../sports/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
<script src="../../../sports/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js"></script>
<script src="../../../sports/app-assets/vendors/js/tables/datatable/jszip.min.js"></script>
<script src="../../../sports/app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
<script src="../../../sports/app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
<script src="../../../sports/app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
<script src="../../../sports/app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
<script src="../../../sports/app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js"></script>
<script src="../../../sports/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js"></script>
<script src="../../../sports/app-assets/vendors/js/forms/select/select2.full.min.js"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="../../../sports/app-assets/js/core/app-menu.js"></script>
<script src="../../../sports/app-assets/js/core/app.js"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="../../../sports/app-assets/js/scripts/forms/pickers/form-pickers.js"></script>
<script src="../../../sports/app-assets/js/scripts/forms/form-select2.js"></script>
<!-- END: Page JS-->
 --}}

 

 <!-- BEGIN: Vendor JS-->
<script src="{{ url('sports/app-assets/vendors/js/vendors.min.js') }}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{ url('sports/app-assets/vendors/js/tables/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ url('sports/app-assets/vendors/js/tables/datatable/dataTables.bootstrap5.min.js') }}"></script>
<script src="{{ url('sports/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ url('sports/app-assets/vendors/js/tables/datatable/responsive.bootstrap5.min.js') }}"></script>
<script src="{{ url('sports/app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js') }}"></script>
<script src="{{ url('sports/app-assets/vendors/js/tables/datatable/datatables.buttons.min.js') }}"></script>
<script src="{{ url('sports/app-assets/vendors/js/tables/datatable/jszip.min.js') }}"></script>
<script src="{{ url('sports/app-assets/vendors/js/tables/datatable/pdfmake.min.js') }}"></script>
<script src="{{ url('sports/app-assets/vendors/js/tables/datatable/vfs_fonts.js') }}"></script>
<script src="{{ url('sports/app-assets/vendors/js/tables/datatable/buttons.html5.min.js') }}"></script>
<script src="{{ url('sports/app-assets/vendors/js/tables/datatable/buttons.print.min.js') }}"></script>
<script src="{{ url('sports/app-assets/vendors/js/tables/datatable/dataTables.rowGroup.min.js') }}"></script>
<script src="{{ url('sports/app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js') }}"></script>
<script src="{{ url('sports/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{ url('sports/app-assets/js/core/app-menu.js') }}"></script>
<script src="{{ url('sports/app-assets/js/core/app.js') }}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="{{ url('sports/app-assets/js/scripts/forms/pickers/form-pickers.js') }}"></script>
<script src="{{ url('sports/app-assets/js/scripts/forms/form-select2.js') }}"></script>
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
    $(function () { 

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
  
  order: [[0, 'asc']],
  dom: 
    '<"d-flex justify-content-between align-items-center mx-2 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-3 withoutheadbuttin dt-action-buttons text-end"B><"col-sm-12 col-md-3"f>>t<"d-flex justify-content-between mx-2 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
  displayLength: 7,
  lengthMenu: [7, 10, 25, 50, 75, 100],
  buttons: [
    {
      extend: 'collection',
      className: 'btn btn-outline-secondary dropdown-toggle',
      text: feather.icons['share'].toSvg({ class: 'font-small-4 mr-50' }) + 'Export',
      buttons: [
        {
          extend: 'print',
          text: feather.icons['printer'].toSvg({ class: 'font-small-4 mr-50' }) + 'Print',
          className: 'dropdown-item',
          exportOptions: {
            // This will export all columns by removing the 'columns' restriction
            modifier: {
              page: 'all' // Ensures the print/export includes all rows and columns
            }
          }
        },
        {
          extend: 'csv',
          text: feather.icons['file-text'].toSvg({ class: 'font-small-4 mr-50' }) + 'Csv',
          className: 'dropdown-item',
          exportOptions: {
            // Export all columns
            modifier: {
              page: 'all'
            }
          }
        },
        {
          extend: 'excel',
          text: feather.icons['file'].toSvg({ class: 'font-small-4 mr-50' }) + 'Excel',
          className: 'dropdown-item',
          exportOptions: {
            // Export all columns
            modifier: {
              page: 'all'
            }
          }
        },
        {
          extend: 'pdf',
          text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 mr-50' }) + 'Pdf',
          className: 'dropdown-item',
          exportOptions: {
            // Export all columns
            modifier: {
              page: 'all'
            }
          }
        },
        {
          extend: 'copy',
          text: feather.icons['copy'].toSvg({ class: 'font-small-4 mr-50' }) + 'Copy',
          className: 'dropdown-item',
          exportOptions: {
            // Export all columns
            modifier: {
              page: 'all'
            }
          }
        }
      ]
    },
  ],
  
  language: {
    paginate: {
      previous: '&nbsp;',
      next: '&nbsp;'
    }
  }

  // Initialize data-feather 
  
  
  
});




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
$('.data-submit').on('click', function () {
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
$('.datatables-basic tbody').on('click', '.delete-record', function () {
dt_basic.row($(this).parents('tr')).remove().draw();
});

 

});


 // Initialize the charts once the DOM is fully loaded
 $(document).ready(function () {
     // Line Chart
     var ctx1 = document.getElementById('leavebar-chart').getContext('2d');
     var leaveChart = new Chart(ctx1, {
         type: 'line',
         data: {
             labels: ['January', 'February', 'March', 'April', 'May', 'June'], // Change labels as needed
             datasets: [{
                 label: 'Applications Submitted',
                 data: [65, 59, 80, 81, 56, 55], // Example data
                 borderColor: 'rgba(75, 192, 192, 1)',
                 fill: false
             }]
         },
         options: {
             responsive: true,
             maintainAspectRatio: false
         }
     });

     // Donut Chart
     var ctx2 = document.getElementById('donut-opentask').getContext('2d');
     var donutChart = new Chart(ctx2, {
         type: 'doughnut',
         data: {
             labels: ['Completed', 'Pending', 'Failed'],
             datasets: [{
                 label: 'Tasks',
                 data: [300, 50, 100], // Example data
                 backgroundColor: ['#36a2eb', '#ff6384', '#ffcd56']
             }]
         },
         options: {
             responsive: true,
             maintainAspectRatio: false
         }
     });
 });		
    
</script> --}}

<script>
  $(window).on('load', function() {
    if (feather) {
        feather.replace({
            width: 14,
            height: 14
        });
    }
});

$(document).ready(function() {
    if (window.location.pathname === "/book") {
        return;
    }
    if (feather) {
        feather.replace({
            width: 14,
            height: 14
        });
    }


    var dt_basic_table = $('.datatables-basic');
    if (dt_basic_table.length) {
        var dt_basic = dt_basic_table.DataTable({
            order: [[0, 'asc']],
            dom:
                '<"d-flex justify-content-between align-items-center mx-2 row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-3 withoutheadbuttin dt-action-buttons text-end"B><"col-sm-12 col-md-3"f>>t<"d-flex justify-content-between mx-2 row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            displayLength: 7,
            lengthMenu: [7, 10, 25, 50, 75, 100],
            buttons: [
                {
                    extend: 'collection',
                    className: 'btn btn-outline-secondary dropdown-toggle',
                    text: feather.icons['share'].toSvg({ class: 'font-small-4 mr-50' }) + 'Export',
                    buttons: [
                        {
                            extend: 'print',
                            text: feather.icons['printer'].toSvg({ class: 'font-small-4 mr-50' }) + 'Print',
                            className: 'dropdown-item',
                            exportOptions: {


                              columns: ':not(:last-child)'
                              // modifier: { page: 'all' }
                            }
                        },
                        {
                            extend: 'csv',
                            text: feather.icons['file-text'].toSvg({ class: 'font-small-4 mr-50' }) + 'Csv',
                            className: 'dropdown-item',
                            exportOptions: {

                              columns: ':not(:last-child)'
                              // modifier: { page: 'all' }
                              }
                        },
                        {
                            extend: 'excel',
                            text: feather.icons['file'].toSvg({ class: 'font-small-4 mr-50' }) + 'Excel',
                            className: 'dropdown-item',
                            exportOptions: {

                              columns: ':not(:last-child)'
                              // modifier: { page: 'all' }
                              }
                        },
                        {
                            extend: 'pdf',
                            text: feather.icons['clipboard'].toSvg({ class: 'font-small-4 mr-50' }) + 'Pdf',
                            className: 'dropdown-item',
                            exportOptions: {

                              columns: ':not(:last-child)'
                              // modifier: { page: 'all' }
                              }
                        },
                        {
                            extend: 'copy',
                            text: feather.icons['copy'].toSvg({ class: 'font-small-4 mr-50' }) + 'Copy',
                            className: 'dropdown-item',
                            exportOptions: {

                               columns: ':not(:last-child)'
                              //modifier: { page: 'all' }
                          }
                        }
                    ]
                },
            ],
            language: {
                paginate: {
                    previous: '&nbsp;',
                    next: '&nbsp;'
                }
            }
        });
    }

    // Flat Date picker initialization
    var dt_date_table = $('.dt-date');
    if (dt_date_table.length) {
        dt_date_table.flatpickr({
            monthSelectorType: 'static',
            dateFormat: 'm/d/Y'
        });
    }

    // Handle new records
    var count = 101;
    $('.data-submit').on('click', function () {
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

    // Handle delete records
    $('.datatables-basic tbody').on('click', '.delete-record', function () {
        dt_basic.row($(this).parents('tr')).remove().draw();
    });

});

</script>
