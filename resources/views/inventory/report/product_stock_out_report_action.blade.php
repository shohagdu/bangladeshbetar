<table id="print_table" rules="all" border="1px" class="table table-striped table-bordered table-hover" width="100%">
    <thead>
    <tr>
        <th data-class="expand"> SL</th>
        <th data-class="expand"> Stock Code</th>
        <th data-class="expand"> Station</th>
        <th data-class="expand"> Product Ctg/Sub-Ctg.</th>
        <th data-class="expand"> Product Info.</th>
        <th data-class="expand"> Reference</th>
        <th data-class="expand"> Room No</th>
        <th data-class="expand"> Purchase Date</th>
        <th data-class="expand"> Warranty</th>
        <th data-class="expand"> Life Time</th>
        <th data-class="expand">Maintenance</th>
        <th data-class="expand">Stock Out DT</th>
        <th data-class="expand">Stock Out Reason</th>



    </tr>
    </thead>
    <tbody>
    @if(empty($stock_report))
        <tr><td colspan="11" style="text-align:center">No data found.</td></tr>
    @endif
    @if(!empty($stock_report))
        @php($i=1)
        @foreach($stock_report as $stock)
            <tr>
                <td>{{ $i++ }}</td>
                <td>{{ $stock->stock_code }}</td>
                <td>{{ $stock->station_name }}</td>
                <td>{{ $stock->product_ctg_title." / ".$stock->product_sub_ctg_title}}</td>
                <td>{{ $stock->product_name }}</td>
                <td>{{ $stock->product_reference }}</td>
                <td>{{ $stock->room_no }}</td>
                <td>{{ $stock->purchase_date_show }}</td>
                <td>{{ $stock->warranty_info_show }}</td>
                <td>{{ $stock->life_time_info_show }}</td>
                <td>{{ ($stock->maintainance_info_show=='Yes')?$stock->maintainance_info_show."(".$stock->maintance_details.")":$stock->maintainance_info_show }}</td>
                <td>{{ (empty($stock->stock_out_date))?'':date('d-m-Y',strtotime($stock->stock_out_date)) }}</td>
                <td>{{ $stock->stock_out_reason }}</td>

            </tr>
        @endforeach
    @endif
    </tbody>
</table>