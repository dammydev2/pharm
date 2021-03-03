@if(\Auth::User()->type == 'sales' || \Auth::User()->type == 'In-patient')
<li><a href="{{ url('/home') }}">Dashboard</a></li>
<li><a href="{{ url('/sales') }}">sales</a></li>
<li><a href="{{ url('/profit') }}">Profit Margin</a></li>
<li><a href="{{ url('/recall') }}">Recall Prescription</a></li>
<li><a href="{{ url('/report') }}">Report</a></li>
<li><a href="{{ url('/return') }}">Return Stock</a></li>
<li><a href="{{ url('/returnReceipt') }}">Return Receipt</a></li>
<li><a href="{{ url('/totalSales') }}">Total Sales</a></li>
<li><a href="{{ url('/drug') }}">Drug/Stock</a></li>
@endif


@if(\Auth::User()->type === 'store')
<li><a href="{{ url('/stock') }}">Main Store/Stock</a></li>
<li><a href="{{ url('/stockReport') }}">Stock/Sales Report</a></li>
<li><a href="{{ url('/monthlyConsumption') }}">Monthly Consumption/Forecast</a></li>
<li><a href="{{ url('/deptStockReport') }}">Actual Sales by Units</a></li>
<li><a href="{{ url('/multipleMonths') }}">Multiple Months Consumption</a></li>
<li><a href="{{ url('/singleMonth') }}">Single Month Consumption</a></li>
<li><a href="{{ url('/checkExpiring') }}">Soon to Expire Drugs</a></li>
<li><a href="{{ url('/viewExpiredDrugs') }}">View Expired Drugs</a></li>
@endif

@if(\Auth::User()->type === 'price autenticator')
<li><a href="{{ url('/stock') }}">Main Store/Stock</a></li>
@endif

@if(\Auth::User()->type === 'auditor')
<li><a href="{{ url('/audit') }}">Audit</a></li>
@endif

<!-- @if(\Auth::User()->type == 'substore' || \Auth::User()->type == 'In-patient')
<li><a href="{{ url('/drug') }}">Drug/Stock</a></li>
@endif -->

@if(\Auth::User()->type == 'payment')
<li><a href="{{ url('/payment') }}">Payment</a></li>
@endif

@if(\Auth::User()->type == '0')
<li><a href="{{ url('/worker') }}">Worker(s)</a></li>
@endif