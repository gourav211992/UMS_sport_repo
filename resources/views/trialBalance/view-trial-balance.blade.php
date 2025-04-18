@php
    use App\Helpers\CurrencyHelper;
@endphp

@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
                <div class="content-header-left col-md-6  mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="col-12">
                            <h2 class="content-header-title float-start mb-0">Trial Balance</h2>
                            <div class="breadcrumb-wrapper">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{route('trial_balance')}}">Finance</a></li>
                                    <li class="breadcrumb-item active">Trial Balance View</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
				<div class="content-header-right text-md-end col-md-6 mb-50 mb-sm-0">
                    <div class="form-group breadcrumb-right">
                        <button type="button" class="btn btn-sm btn-primary dropdown-toggle exportcustomdrop" data-bs-toggle="dropdown">
                            <i data-feather="share"></i> Export
                        </button>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a class="dropdown-item" href="javascript:;" onclick="exportTrialBalanceReport(1)">
                                <i data-feather="upload" class="me-50"></i>
                                <span>Level1</span>
                            </a>
                            <a class="dropdown-item" href="javascript:;" onclick="exportTrialBalanceReport(2)">
                                <i data-feather="upload" class="me-50"></i>
                                <span>Level2</span>
                            </a>
                            <a class="dropdown-item" href="javascript:;" onclick="exportTrialBalanceReport(3)">
                                <i data-feather="upload" class="me-50"></i>
                                <span>Level3</span>
                            </a>
                        </div>
                        <button class="btn btn-warning btn-sm mb-50 mb-sm-0" data-bs-target="#filter" data-bs-toggle="modal"><i data-feather="filter"></i> Filter</button>
                    </div>
                </div>
            </div>
            <div class="content-body">
                 <div class="row">
					 <div class="col-md-12">
					 	<div class="card">

							 <div class="card-body">


                                 <div class="row align-items-center">
                                     <div class="col-md-8">
                                         <div class="newheader">
                                            <div>
                                                <h4 class="card-title text-theme text-dark" id="company_name"></h4>
                                                <p class="card-text"><span id="startDate"></span> to <span id="endDate"></span></p>
                                            </div>
                                        </div>
                                     </div>
                                     <div class="col-md-4 text-sm-end">
										<a href="#" class="trail-exp-allbtnact" id="expand-all">
                                            <i data-feather='plus-circle'></i> Expand All
                                        </a>
                                        <a href="#" class="trail-col-allbtnact" id="collapse-all">
                                            <i data-feather='minus-circle'></i> Collapse All
                                        </a>
									 </div>
                                 </div>



								 <div class="row">
								 	<div class="col-md-12 earn-dedtable trail-balancefinance trailbalnewdesfinance">
										<div class="table-responsive">
											<table class="table border">
												<thead>
                                                    <tr>
                                                        <th>Particulars</th>
														<th width="150px">Opening Balance</th>
                                                        <th width="150px">Debit</th>
														<th width="170px">Credit</th>
														<th width="170px">Closing Balance</th>
													</tr>
												</thead>
                                                <tbody id="tableData"></tbody>
												<tfoot>
													<tr>
														<td class="text-center">Grand Total</td>
                                                        <td id="openingAmt">0</td>
                                                        <td id="crd_total">0</td>
                                                        <td id="dbt_total">0</td>
                                                        <td id="closingAmt">0</td>
														<td></td>
													</tr>
												</tfoot>
											</table>
										</div>
									</div>
								 </div>
							 </div>
						</div>
					 </div>
				 </div>
            </div>
        </div>
    </div>


    <div class="modal modal-slide-in fade filterpopuplabel" id="filter">
        <div class="modal-dialog sidebar-sm">
            <form class="add-new-record modal-content pt-0">
                <div class="modal-header mb-1">
                    <h5 class="modal-title" id="exampleModalLabel">Apply Filter</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">×</button>
                </div>
                <div class="modal-body flex-grow-1">
                    <div class="mb-1">
                        <label class="form-label" for="fp-range">Select Period</label>
                        <input type="text" id="fp-range" class="form-control flatpickr-range bg-white"
                            placeholder="YYYY-MM-DD to YYYY-MM-DD"/>
                    </div>

                    <div class="mb-1">
                                    <label class="form-label">Company</label>
                                    <select id="organization_id" class="form-select select2" multiple>
                                        <option value="" disabled>Select</option>
                                        @foreach($companies as $organization)
                                            <option value="{{ $organization->organization->id }}"
                                                {{ $organization->organization->id == $organizationId ? 'selected' : '' }}>
                                                {{ $organization->organization->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-1">
                                    <label class="form-label">Currency</label>
                                    <select id="currency" class="form-select select2">
                                        <option value="org"> {{strtoupper(CurrencyHelper::getOrganizationCurrency()->short_name) ?? ""}} (Organization)</option>
                                        <option value="comp">{{strtoupper(CurrencyHelper::getCompanyCurrency()->short_name)??""}} (Company)</option>
                                        <option value="group">{{strtoupper(CurrencyHelper::getGroupCurrency()->short_name)??""}} (Group)</option>

                                    </select>
                                </div>

                    {{-- <div class="mb-1">
                        <label class="form-label">Group</label>
                        <select class="form-select">
                            <option>Select</option>
                        </select>
                    </div>

                    <div class="mb-1">
                        <label class="form-label">Ledger Name</label>
                        <select class="form-select">
                            <option>Select</option>
                        </select>
                    </div> --}}
                </div>
                <div class="modal-footer justify-content-start">
                    <button type="button" class="btn btn-primary data-submit mr-1 apply-filter">Apply</button>
                    <button type="reset" class="btn btn-outline-secondary" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
<!-- END: Content-->
@endsection

@section('scripts')
<script>
    const group_id=@json($id);
    var reservesSurplus='';

    $(document).ready(function () {
        $(document).ready(function() {
            getInitialGroups();
            $('#company_name').text(
                $('#organization_id option:selected')
                    .map(function() {
                        return $(this).text();
                    })
                    .get()
                    .join(', ')
            );
        });

        // Filter record
		$(".apply-filter").on("click", function () {
			// Hide the modal
			$(".modal").modal("hide");
            $('.collapse').click();
            $('#tableData').html('');
            getInitialGroups();

            var selectedValues = $('#organization_id').val() || [];
            if (selectedValues.length === 0) {
                $('#company_name').text('All Companies');
            } else {
                $('#company_name').text(
                    $('#organization_id option:selected')
                        .map(function() {
                            return $(this).text();
                        })
                        .get()
                        .join(', ')
                );
            }
		})

        function getInitialGroups() {
            var obj={ date:$('#fp-range').val(),currency:$('#currency').val(),'_token':'{!!csrf_token()!!}',group_id:group_id};
            var selectedValues = $('#organization_id').val() || [];
            var filteredValues = selectedValues.filter(function(value) {
                return value !== null && value.trim() !== '';
            });
            if (filteredValues.length>0) {
                obj.organization_id=filteredValues
            }

            $.ajax({
				headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
				type    :"POST",
				url     :"{{route('getInitialGroups')}}",
				dataType:"JSON",
				data    :obj,
                success: function(data) {
                    if (data['data'].length > 0) {
                        reservesSurplus=data['profitLoss'];
                        let html = '';

                        var openingDrTotal=0;
                        var openingCrTotal=0;
                        var closingDrTotal=0;
                        var closingCrTotal=0;

                        for (let i = 0; i < data['data'].length; i++) {
                            var total_debit=data['data'][i].total_debit;
                            var total_credit=data['data'][i].total_credit;

                            var opening=data['data'][i].opening;
                            var opening_type='';
                            var closingText='';
                            var closing=total_debit - total_credit;

                            if (closing != 0) {
                                closingText=closing > 0 ? 'Dr' : 'Cr';
                            }
                            closing=closing > 0 ? closing : -closing;

                            if (data['data'][i].name=="Liabilities") {
                                if (data['profitLoss']['closing_type']==data['data'][i].opening_type) {
                                    opening_type=data['data'][i].opening_type;
                                    opening=parseFloat(opening) + parseFloat(data['profitLoss']['closingFinal']);
                                } else {
                                    var openingDiff=parseFloat(opening) - parseFloat(data['profitLoss']['closingFinal']);
                                    if (openingDiff!=0) {
                                        var openingDiff=openingDiff > 0 ? openingDiff : -openingDiff;
                                        if (parseFloat(opening) > parseFloat(data['profitLoss']['closingFinal'])) {
                                            opening_type=data['data'][i].opening_type;
                                        } else {
                                            opening_type=data['profitLoss']['closing_type'];
                                        }
                                    }
                                    opening=openingDiff;
                                }

                                if (opening_type==closingText) {
                                    closingText=closingText;
                                    closing=parseFloat(opening) + parseFloat(closing);
                                } else {
                                    var closingDiff=parseFloat(opening) - parseFloat(closing);
                                    if (closingDiff!=0) {
                                        var closingDiff=closingDiff > 0 ? closingDiff : -closingDiff;
                                        if (parseFloat(opening) > parseFloat(closing)) {
                                            closingText=opening_type;
                                        } else {
                                            closingText=closingText;
                                        }
                                    }
                                    closing=closingDiff;
                                }
                            }

                            if (opening_type=="Cr") {
                                openingCrTotal=parseFloat(openingCrTotal) + parseFloat(opening);
                            }
                            if (opening_type=="Dr") {
                                openingDrTotal=parseFloat(openingDrTotal) + parseFloat(opening);
                            }

                            if (closingText=="Cr") {
                                closingCrTotal=parseFloat(closingCrTotal) + parseFloat(closing);
                            }
                            if (closingText=="Dr") {
                                closingDrTotal=parseFloat(closingDrTotal) + parseFloat(closing);
                            }

                            const groupUrl="{{ route('trial_balance') }}/"+data['data'][i].id;
                            html += `
                                <tr class="trail-bal-tabl-none" id="${data['data'][i].id}">
                                    <input type="hidden" id="check${data['data'][i].id}">
                                    <td>
                                        <a href="#" class="trail-open-new-listplus-btn expand exp${data['data'][i].id}" data-id="${data['data'][i].id}"><i data-feather='plus-circle'></i></a>
                                        <a href="#" class="trail-open-new-listminus-btn collapse"><i data-feather='minus-circle'></i></a>
                                        <a href="${groupUrl}">
                                            ${data['data'][i].name}
                                        </a>
                                    </td>
                                    <td>${parseFloat(opening).toLocaleString('en-IN')} ${opening_type}</td>
                                    <td class="crd_amt">${parseFloat(total_debit).toLocaleString('en-IN')}</td>
                                    <td class="dbt_amt">${parseFloat(total_credit).toLocaleString('en-IN')}</td>
                                    <td>${parseFloat(closing).toLocaleString('en-IN')} ${closingText}</td>
                                </tr>`;
                        }

                        var openingTotalType='';
                        var openingTotalDiff=parseFloat(openingDrTotal) - parseFloat(openingCrTotal);
                        if (openingTotalDiff!=0) {
                            var openingTotalDiff=openingTotalDiff > 0 ? openingTotalDiff : -openingTotalDiff;
                            if (parseFloat(openingDrTotal) > parseFloat(openingCrTotal)) {
                                openingTotalType='Dr';
                            } else {
                                openingTotalType='Cr';
                            }
                        }

                        var closingTotalType='';
                        var closingTotalDiff=parseFloat(closingDrTotal) - parseFloat(closingCrTotal);
                        if (closingTotalDiff!=0) {
                            var closingTotalDiff=closingTotalDiff > 0 ? closingTotalDiff : -closingTotalDiff;
                            if (parseFloat(closingDrTotal) > parseFloat(closingCrTotal)) {
                                closingTotalType='Dr';
                            } else {
                                closingTotalType='Cr';
                            }
                        }

                        $('#openingAmt').text(openingTotalDiff.toLocaleString('en-IN')+openingTotalType);
                        $('#closingAmt').text(closingTotalDiff.toLocaleString('en-IN')+closingTotalType);

                        $('#tableData').append(html);
                    }

                    $('#startDate').text(data['startDate']);
                    $('#endDate').text(data['endDate']);

                    if (feather) {
                        feather.replace({
                            width: 14,
                            height: 14
                        });
                    }

                    calculate_cr_dr();

                    $('#expand-all').click();
                }
            });
        }

        function calculate_cr_dr() {
            let cr_sum = 0;
            $('.crd_amt').each(function() {
                const value = parseNumberWithCommas($(this).text()) || 0;
                cr_sum = parseFloat(parseFloat(cr_sum + value).toFixed(2));
            });
            $('#crd_total').text(cr_sum.toLocaleString('en-IN'));

            let dr_sum = 0;
            $('.dbt_amt').each(function() {
                const value = parseNumberWithCommas($(this).text()) || 0;
                dr_sum = parseFloat(parseFloat(dr_sum + value).toFixed(2));
            });
            $('#dbt_total').text(dr_sum.toLocaleString('en-IN'));
        }

        function parseNumberWithCommas(str) {
            return parseFloat(str.replace(/,/g, ""));
        }

        function getIncrementalPadding(parentPadding) {
            return parentPadding + 10; // Increase padding by 10px
        }

        $(document).on('click', '.expand', function() {
            const id = $(this).attr('data-id');
            const parentPadding = parseInt($(this).closest('td').css('padding-left'));

            if ($('#name' + id).text()=="Reserves & Surplus") {
                const padding = getIncrementalPadding(parentPadding);

                let html= `
                    <tr class="trail-sub-list-open parent-${id}">
                        <td style="padding-left: ${padding}px">Profit & Loss</td>
                        <td>${parseFloat(reservesSurplus['closingFinal']).toLocaleString('en-IN')} ${reservesSurplus['closing_type']}</td>
                        <td></td>
                        <td></td>
                        <td>${parseFloat(reservesSurplus['closingFinal']).toLocaleString('en-IN')} ${reservesSurplus['closing_type']}</td>
                    </tr>`;
                $('#'+id).closest('tr').after(html);
            } else {
                if ($('#check' + id).val() == "") {
                    var obj={ id:id,date:$('#fp-range').val(),currency:$('#currency').val(),'_token':'{!!csrf_token()!!}'};
                    var selectedValues = $('#organization_id').val() || [];
                    var filteredValues = selectedValues.filter(function(value) {
                        return value !== null && value.trim() !== '';
                    });
                    if (filteredValues.length>0) {
                        obj.organization_id=filteredValues
                    }

                    $.ajax({
                        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                        type    :"POST",
                        url     :"{{route('getSubGroups')}}",
                        dataType:"JSON",
                        data    :obj,
                        success: function(data) {
                            $('#check' + id).val(id);
                            if (data['data'].length > 0) {
                                let html = '';
                                if (data['type'] == "group") {
                                    for (let i = 0; i < data['data'].length; i++) {
                                        const padding = getIncrementalPadding(parentPadding);
                                        var closingText='';
                                        const closing=data['data'][i].total_debit - data['data'][i].total_credit;
                                        if (closing != 0) {
                                            closingText=closing > 0 ? 'Dr' : 'Cr';
                                        }
                                        const groupUrl="{{ route('trial_balance') }}/"+data['data'][i].id;

                                        if (data['data'][i].name=="Reserves & Surplus") {
                                            html += `
                                            <tr class="trail-sub-list-open expandable parent-${id}" id="${data['data'][i].id}">
                                                <input type="hidden" id="check${data['data'][i].id}">
                                                <td style="padding-left: ${padding}px">
                                                    <a href="#" class="trail-open-new-listplus-sub-btn text-dark expand exp${data['data'][i].id}" data-id="${data['data'][i].id}">
                                                        <i data-feather='plus-circle'></i>
                                                    </a>
                                                    <a href="#" class="trail-open-new-listminus-sub-btn text-dark collapse" style="display:none;">
                                                        <i data-feather='minus-circle'></i>
                                                    </a>
                                                    <span id="name${data['data'][i].id}">${data['data'][i].name}</span>
                                                </td>
                                                <td>${parseFloat(reservesSurplus['closingFinal']).toLocaleString('en-IN')} ${reservesSurplus['closing_type']}</td>
                                                <td></td>
                                                <td></td>
                                                <td>${parseFloat(reservesSurplus['closingFinal']).toLocaleString('en-IN')} ${reservesSurplus['closing_type']}</td>
                                            </tr>`;
                                        } else {
                                            html += `
                                            <tr class="trail-sub-list-open expandable parent-${id}" id="${data['data'][i].id}">
                                                <input type="hidden" id="check${data['data'][i].id}">
                                                <td style="padding-left: ${padding}px">
                                                    <a href="#" class="trail-open-new-listplus-sub-btn text-dark expand exp${data['data'][i].id}" data-id="${data['data'][i].id}">
                                                        <i data-feather='plus-circle'></i>
                                                    </a>
                                                    <a href="#" class="trail-open-new-listminus-sub-btn text-dark collapse" style="display:none;">
                                                        <i data-feather='minus-circle'></i>
                                                    </a>
                                                    <a href="${groupUrl}">
                                                        ${data['data'][i].name}
                                                    </a>
                                                </td>
                                                <td>${parseFloat(data['data'][i].opening).toLocaleString('en-IN')} ${data['data'][i].opening_type}</td>
                                                <td>${parseFloat(data['data'][i].total_debit).toLocaleString('en-IN')}</td>
                                                <td>${parseFloat(data['data'][i].total_credit).toLocaleString('en-IN')}</td>
                                                <td>${parseFloat(closing < 0 ? -closing : closing).toLocaleString('en-IN')} ${closingText}</td>
                                            </tr>`;
                                        }
                                    }
                                } else {
                                    for (let i = 0; i < data['data'].length; i++) {
                                        const padding = getIncrementalPadding(parentPadding);
                                        var closingText='';
                                        const closing=data['data'][i].details_sum_debit_amt - data['data'][i].details_sum_credit_amt;
                                        if (closing != 0) {
                                            closingText=closing > 0 ? 'Dr' : 'Cr';
                                        }
                                        const ledgerUrl="{{ url('trailLedger') }}/"+data['data'][i].id;

                                        html += `
                                            <tr class="trail-sub-list-open parent-${id}">
                                                <td style="padding-left: ${padding}px"><a href='${ledgerUrl}'>
                                                    <i data-feather='arrow-right'></i>${data['data'][i].name}</a>
                                                </td>
                                                <td>${parseFloat(data['data'][i].opening).toLocaleString('en-IN')} ${data['data'][i].opening_type ?? ''}</td>
                                                <td>${parseFloat(data['data'][i].details_sum_debit_amt).toLocaleString('en-IN')}</td>
                                                <td>${parseFloat(data['data'][i].details_sum_credit_amt).toLocaleString('en-IN')}</td>
                                                <td>${parseFloat(closing < 0 ? -closing : closing).toLocaleString('en-IN')} ${closingText}</td>
                                            </tr>`;
                                    }
                                }
                                $('#' + id).closest('tr').after(html);
                            }

                            if (feather) {
                                feather.replace({
                                    width: 14,
                                    height: 14
                                });
                            }
                        }
                    });
                }
            }

            // Expand all direct children of this row
            $('.parent-' + id).show();
            $(this).hide();
            $(this).siblings('.collapse').show();
        });

        $(document).on('click', '.collapse', function() {
            const id = $(this).closest('tr').attr('id');

            // Collapse all children of this row recursively and hide their expand icons
            function collapseChildren(parentId) {
                $(`.parent-${parentId}`).each(function() {
                    const childId = $(this).attr('id');
                    $(this).hide(); // Hide the child row
                    $(this).find('.collapse').hide(); // Hide the collapse icon
                    $(this).find('.expand').show(); // Show the expand icon
                    collapseChildren(childId); // Recursively collapse the child's children
                });
            }

            collapseChildren(id);

            $(this).hide();
            $(this).siblings('.expand').show();
        });

        // Expand All rows
        $('#expand-all').click(function() {
            $('.expand').hide();

            var trIds = $('tbody tr').map(function() {
                return this.id; // Return the ID of each tr element
            }).get().filter(function(id) {
                return id !== "" && $('#check' + id).val() == ""; // Filter out any empty IDs
            });

            if (trIds.length>0) {

                var obj={ ids:trIds,date:$('#fp-range').val(),currency:$('#currency').val(),'_token':'{!!csrf_token()!!}'};
                var selectedValues = $('#organization_id').val() || [];
                var filteredValues = selectedValues.filter(function(value) {
                    return value !== null && value.trim() !== '';
                });
                if (filteredValues.length>0) {
                    obj.organization_id=filteredValues
                }

                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    type    :"POST",
                    url     :"{{route('getSubGroupsMultiple')}}",
                    dataType:"JSON",
                    data    :obj,
                    success: function(res) {
                        if (res['data'].length > 0) {
                            res['data'].forEach(data => {
                                $('#check'+data['id']).val(data['id']);
                                const parentPadding = parseInt($('.exp'+data['id']).closest('td').css('padding-left'));

                                if ($('#name' + data['id']).text()=="Reserves & Surplus") {
                                    const padding = getIncrementalPadding(parentPadding);

                                    let html= `
                                        <tr class="trail-sub-list-open parent-${data['id']}">
                                            <td style="padding-left: ${padding}px">Profit & Loss</td>
                                            <td>${parseFloat(reservesSurplus['closingFinal']).toLocaleString('en-IN')} ${reservesSurplus['closing_type']}</td>
                                            <td></td>
                                            <td></td>
                                            <td>${parseFloat(reservesSurplus['closingFinal']).toLocaleString('en-IN')} ${reservesSurplus['closing_type']}</td>
                                        </tr>`;
                                    $('#'+data['id']).closest('tr').after(html);
                                } else {
                                    if (data['data'].length > 0) {
                                        let html = '';
                                        if (data['type'] == "group") {
                                            for (let i = 0; i < data['data'].length; i++) {
                                                const padding = getIncrementalPadding(parentPadding);
                                                var closingText='';
                                                const closing=data['data'][i].total_debit - data['data'][i].total_credit;
                                                if (closing != 0) {
                                                    closingText=closing > 0 ? 'Dr' : 'Cr';
                                                }
                                                const groupUrl="{{ route('trial_balance') }}/"+data['data'][i].id;
                                                if (data['data'][i].name=="Reserves & Surplus") {
                                                    html += `
                                                    <tr class="trail-sub-list-open expandable parent-${data['id']}" id="${data['data'][i].id}">
                                                        <input type="hidden" id="check${data['data'][i].id}">
                                                        <td style="padding-left: ${padding}px">
                                                            <a href="#" class="trail-open-new-listplus-sub-btn text-dark expand exp${data['data'][i].id}" data-id="${data['data'][i].id}">
                                                                <i data-feather='plus-circle'></i>
                                                            </a>
                                                            <a href="#" class="trail-open-new-listminus-sub-btn text-dark collapse" style="display:none;">
                                                                <i data-feather='minus-circle'></i>
                                                            </a>
                                                            <span id="name${data['data'][i].id}">${data['data'][i].name}</span>
                                                        </td>
                                                        <td>${parseFloat(reservesSurplus['closingFinal']).toLocaleString('en-IN')} ${reservesSurplus['closing_type']}</td>
                                                        <td></td>
                                                        <td></td>
                                                        <td>${parseFloat(reservesSurplus['closingFinal']).toLocaleString('en-IN')} ${reservesSurplus['closing_type']}</td>
                                                    </tr>`;
                                                } else {
                                                    html += `
                                                    <tr class="trail-sub-list-open expandable parent-${data['id']}" id="${data['data'][i].id}">
                                                        <input type="hidden" id="check${data['data'][i].id}">
                                                        <td style="padding-left: ${padding}px">
                                                            <a href="#" class="trail-open-new-listplus-sub-btn text-dark expand exp${data['data'][i].id}" data-id="${data['data'][i].id}">
                                                                <i data-feather='plus-circle'></i>
                                                            </a>
                                                            <a href="#" class="trail-open-new-listminus-sub-btn text-dark collapse" style="display:none;">
                                                                <i data-feather='minus-circle'></i>
                                                            </a>
                                                            <a href="${groupUrl}">
                                                                ${data['data'][i].name}
                                                            </a>
                                                        </td>
                                                        <td>${parseFloat(data['data'][i].opening).toLocaleString('en-IN')} ${data['data'][i].opening_type}</td>
                                                        <td>${parseFloat(data['data'][i].total_debit).toLocaleString('en-IN')}</td>
                                                        <td>${parseFloat(data['data'][i].total_credit).toLocaleString('en-IN')}</td>
                                                        <td>${parseFloat(closing < 0 ? -closing : closing).toLocaleString('en-IN')} ${closingText}</td>
                                                    </tr>`;
                                                }
                                            }
                                        } else {
                                            for (let i = 0; i < data['data'].length; i++) {
                                                const padding = getIncrementalPadding(parentPadding);
                                                var closingText='';
                                                const closing=data['data'][i].details_sum_debit_amt - data['data'][i].details_sum_credit_amt;
                                                if (closing != 0) {
                                                    closingText=closing > 0 ? 'Dr' : 'Cr';
                                                }
                                                const ledgerUrl="{{ url('trailLedger') }}/"+data['data'][i].id;

                                                html += `
                                                    <tr class="trail-sub-list-open parent-${data['id']}">
                                                        <td style="padding-left: ${padding}px"><a href='${ledgerUrl}'>
                                                            <i data-feather='arrow-right'></i>${data['data'][i].name}</a>
                                                        </td>
                                                        <td>${parseFloat(data['data'][i].opening).toLocaleString('en-IN')} ${data['data'][i].opening_type ?? ''}</td>
                                                        <td>${parseFloat(data['data'][i].details_sum_debit_amt).toLocaleString('en-IN')}</td>
                                                        <td>${parseFloat(data['data'][i].details_sum_credit_amt).toLocaleString('en-IN')}</td>
                                                        <td>${parseFloat(closing < 0 ? -closing : closing).toLocaleString('en-IN')} ${closingText}</td>
                                                    </tr>`;
                                            }
                                        }
                                        $('#'+data['id']).closest('tr').after(html);
                                    }
                                }
                            });
                        }

                        if (feather) {
                            feather.replace({
                                width: 14,
                                height: 14
                            });
                        }
                    }
                });
            }

            $('.collapse').show();
            $('.expandable').show();
        });

        // Collapse All rows
        $('#collapse-all').click(function() {
            $('tbody tr').each(function() {
                const id = $(this).attr('id');
                if (id) {
                    collapseChildren(id); // Collapse all children for each parent row
                }
            });
            $('.collapse').hide();
            $('.expand').show();
        });

        // Recursive collapse function
        function collapseChildren(parentId) {
            $(`.parent-${parentId}`).each(function() {
                const childId = $(this).attr('id');
                $(this).hide(); // Hide the child row
                $(this).find('.collapse').hide(); // Hide the collapse icon
                $(this).find('.expand').show(); // Show the expand icon
                collapseChildren(childId); // Recursively collapse the child's children
            });
        }
    });

    function exportTrialBalanceReport(level){
        var obj={ date:$('#fp-range').val(),currency:$('#currency').val(),'_token':'{!!csrf_token()!!}',group_id:group_id,level:level};
        var selectedValues = $('#organization_id').val() || [];
        var filteredValues = selectedValues.filter(function(value) {
            return value !== null && value.trim() !== '';
        });
        if (filteredValues.length>0) {
            obj.organization_id=filteredValues
        }

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            type    :"POST",
            url     :"{{ route('exportTrialBalanceReport') }}",
            data    :obj,
            xhrFields: {
                responseType: 'blob'
            },
            success: function(data, status, xhr) {
                var link = document.createElement('a');
                var url = window.URL.createObjectURL(data);
                link.href = url;
                link.download = 'trialBalance.xlsx';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            },
            error: function(xhr, status, error) {
                console.log('Export failed:', error);
            }
        });
    }

    // selected arrow using down, up key
    $(document).ready(function () {
        let selectedRow = null;

        function setSelectedRow(row) {
            if (selectedRow) {
                selectedRow.removeClass('trselected');
            }
            selectedRow = row;
            selectedRow.addClass('trselected');
        }

        function expandRow(row) {
            const id = row.attr('id');
            $('.parent-' + id).show();
            row.find('.expand').hide();
            row.find('.collapse').show();
        }

        function collapseRow(row) {
            const id = row.attr('id');
            collapseChildren(id);
            row.find('.expand').show();
            row.find('.collapse').hide();
        }

        function collapseChildren(parentId) {
            $(`.parent-${parentId}`).each(function() {
                const childId = $(this).attr('id');
                $(this).hide();
                $(this).find('.collapse').hide();
                $(this).find('.expand').show();
                collapseChildren(childId);
            });
        }

        // Arrow key navigation
        $(document).keydown(function (e) {
            const rows = $('tbody tr');
            if (rows.length === 0) return;

            let currentIndex = rows.index(selectedRow);
            let nextIndex = currentIndex;

            switch (e.which) {
                case 38: // Up arrow key
                    if (currentIndex > 0) {
                        nextIndex = currentIndex - 1;
                        while (nextIndex >= 0 && rows.eq(nextIndex).is(':hidden')) {
                            nextIndex--;
                        }
                        if (nextIndex >= 0) {
                            setSelectedRow(rows.eq(nextIndex));
                        }
                    }
                    break;
                case 40: // Down arrow key
                    if (currentIndex < rows.length - 1) {
                        nextIndex = currentIndex + 1;
                        while (nextIndex < rows.length && rows.eq(nextIndex).is(':hidden')) {
                            nextIndex++;
                        }
                        if (nextIndex < rows.length) {
                            setSelectedRow(rows.eq(nextIndex));
                        }
                    }
                    break;
                case 37: // Left arrow key
                    if (selectedRow) {
                        collapseRow(selectedRow);
                    }
                    break;
                case 39: // Right arrow key
                    if (selectedRow) {
                        expandRow(selectedRow);
                    }
                    break;
            }
        });

        // Initial row selection
        $('tbody tr').click(function () {
            setSelectedRow($(this));
        });

    });
</script>
@endsection
