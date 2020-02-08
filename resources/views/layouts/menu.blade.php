@if(\Auth::User()->type == 'sales')
<li><a href="{{ url('/home') }}">Dashboard</a></li>
<li><a href="{{ url('/drug') }}">Drug/Stock</a></li>
<li><a href="{{ url('/sales') }}">sales</a></li>
<li><a href="{{ url('/profit') }}">Profit Margin</a></li>
<li><a href="{{ url('/recall') }}">Recall Prescription</a></li>
<li><a href="{{ url('/report') }}">Report</a></li>
<li><a href="{{ url('/return') }}">Return stock</a></li>
@endif

@if(\Auth::User()->type == 'store' || 'substore')
<li><a href="{{ url('/stock') }}">Store/Stock</a></li>
@endif

@if(\Auth::User()->type == 'payment')
<li><a href="{{ url('/payment') }}">Payment</a></li>
@endif

@if(\Auth::User()->type == '0')
<li><a href="{{ url('/worker') }}">Worker(s)</a></li>
@endif