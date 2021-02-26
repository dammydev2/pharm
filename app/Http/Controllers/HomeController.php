<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Drug;
use App\User;
use App\NewStock;
use App\Sale;
use App\Store;
use App\Payment;
use App\Storestock;
use App\Order;
use App\DailyStock;
use Session;
use DB;
use Hash;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Support\Facades\Session as FacadesSession;
use Redirect;
use SebastianBergmann\CodeCoverage\Report\Xml\Report;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('home');
  }

  public function adddrug()
  {
    $drugs = Store::orderBy('name', 'asc')->get();
    return view('drug.adddrug')->with('drugs', $drugs);
  }

  public function enterdrug(Request $request)
  {
    $request->validate([
      'name' => 'required|unique:drugs',
    ]);
    // getting the cost and selling price
    $details = Store::where('id', $request['name'])->first();
    //sdd($request['price']);
    Drug::create([
      'name' => $details->name,
      'markup' => $details->markup,
      'cprice' => $details->cprice,
      'sprice' => $details->selling_price,
    ]);
    return redirect('drug');
  }

  public function drug()
  {
    $data = Drug::orderBy('name', 'asc')->get();
    return view('drug.drug', compact('data'));
  }

  public function drugedit($id)
  {
    $data = Drug::where('id', $id)->get();
    return view('drug.drugedit', compact('data'));
  }

  public function updatedrug(Request $request)
  {
    $request->validate([
      'name' => 'required',
      'price' => 'required',
    ]);
    #calculating the % profit
    $markup = ((($request['price'] - $request['c_price']) * 100) / $request['c_price']);
    Drug::where('id', $request['id'])
      ->update([
        'name' => $request['name'],
        'sprice' => $request['price'],
        'markup' => $markup,
      ]);
    Session::flash('success', 'updated successfully');
    return redirect('drug');
  }

  public function drugadd($id)
  {
    $data = Drug::where('id', $id)->get();
    return view('drug.drugadd', compact('data'));
  }

  public function addstock(Request $request)
  {
    $request->validate([
      'name' => 'required',
      'price' => 'required',
      'cprice' => 'required',
      'quantity' => 'required',
      'exp' => 'required',
    ]);
    #calculating the % profit
    $markup = ((($request['price'] - $request['cprice']) * 100) / $request['cprice']);
    $newqty = $request['qty'] + $request['quantity'];
    Drug::where('id', $request['id'])
      ->update([
        'qty' => $newqty,
        'sprice' => $request['price'],
        'cprice' => $request['cprice'],
        'markup' => $markup
      ]);
    NewStock::create([
      'name' => $request['name'],
      'sprice' => $request['price'],
      'cprice' => $request['cprice'],
      'quantity' => $request['quantity'],
      'exp' => $request['exp'],
      'stockid' => $request['id'],
      'identity' => \Auth::User()->email,
    ]);
    Session::flash('success', 'new stock added successfully');
    return redirect('drug');
  }

  public function drugbreakdown($id)
  {
    $data = NewStock::where('stockid', $id)->orderBy('id', 'desc')->paginate(50);
    return view('drug.drugbreakdown', compact('data'));
  }

  public function sales()
  {
    return view('drug.sales');
  }

  public function action(Request $request)
  {
    if ($request->ajax()) {
      $output = '';
      $query = $request->get('query');
      if ($query != '') {
        $data = Drug::where('name', 'like', '%' . $query . '%')
          //->orWhere('name', 'like', '%'.$query.'%')
          /** ->orWhere('City', 'like', '%'.$query.'%')
         ->orWhere('PostalCode', 'like', '%'.$query.'%')
         ->orWhere('Country', 'like', '%'.$query.'%')**/
          ->orderBy('id', 'desc')
          ->get();
      } else {
        $data = DB::table('tbl_customer')
          ->orderBy('CustomerID', 'desc')
          ->get();
      }
      $total_row = $data->count();
      if ($total_row > 0) {
        foreach ($data as $row) {
          $output .= '

          <div class="col-sm-12 rst"
          data-sprice = "' . $row->sprice . '"
          data-c_price = "' . $row->cprice . '"
          data-qty2 = "' . $row->qty . '"
          data-id = "' . $row->id . '"
          style="cursor:pointer;"
          >' . $row->name . '</div>';
        }
      } else {
        $output = '
       <tr>
       <td align="center" colspan="5">No Data Found</td>
       </tr>
       ';
      }
      $data = array(
        'table_data'  => $output,
        'total_data'  => $total_row
      );

      echo json_encode($data);
    }
  }

  public function sale_enter(Request $request)
  {
    //getting the receipt number
    $data = Sale::orderBy('id', 'desc')->first();
    $rec = $data->id + 1000;
    $num = count($_POST['name']);
    for ($i = 0; $i < $num; $i++) {
      Sale::create([
        'name' => $request['name'][$i],
        'quantity' => $request['qty'][$i],
        'cprice' => $request['c_price'][$i],
        'sprice' => $request['price'][$i],
        'stockid' => $request['stockid'][$i],
        'identity' => \Auth::User()->name,
        'rec' => $rec,
      ]);
      //subtracting quantity brought from stock
      $newstock[$i] = $request['qty2'][$i] - $request['qty'][$i];
      Drug::where('id', $request['stockid'][$i])
        ->update([
          'qty' => $newstock[$i]
        ]);
    }
    Session::put('rec', $rec);
    return redirect('recnum');
  }

  public function recnum()
  {
    $rec = Session::get('rec');
    $data = Sale::where('rec', $rec)->get();
    return view('drug.recnum', compact('data'));
  }

  public function payment()
  {
    return view('drug.payment');
  }

  public function searchrec(Request $request)
  {
    $request->validate([
      'rec' => 'required',
    ]);
    $data = Sale::where('rec', $request['rec'])->get();
    if ($data->isEmpty()) {
      Session::flash('error', 'no record found');
      return redirect('payment');
    }
    Session::put('rec', $request['rec']);
    return redirect('tendered');
  }

  public function enterDetails(Request $request)
  {
    $request->validate([
      'name' => 'required|string',
    ]);
    if ($request['percent'] == 0) {
      $nhis = 'nil';
    } else {
      $nhis = 'nhis';
    }
    Payment::create([
      'rec' => Session::get('rec'),
      'name' => $request['name'],
      'nhis' => $nhis,
      'nhis_no' => $request['nhisno'],
      'cprice' => $request['cprice'],
      'sprice' => $request['sprice'],
      'amount' => $request['amount'],
      'balance' => $request['balance'],
      'status' => $request['status'],
      'seller' => \Auth::User()->name,
    ]);
    return redirect('displayRecNum');
  }

  public function displayRecNum()
  {
    $rec = Session::get('rec');
    $data = Payment::where('rec', $rec)->first();
    return view('drug.displayRecNum', compact('data'));
  }

  public function tendered()
  {
    $rec = Session::get('rec');
    $data = Payment::where('rec', $rec)->first();
    return view('drug.tendered', compact('data'));
  }

  public function entertendered(Request $request)
  {
    $request->validate([
      'amount' => 'required',
    ]);
    $rec = Session::get('rec');
    Payment::where('rec', $rec)
    ->update([
      'amount' => $request['amount'],
      'balance' => $request['balance'],
      'payment_status' => 'paid'
    ]);
    return redirect('receipt');
  }

  public function getrec($id)
  {
    Session::put('rec', $id);
    return redirect('receipt');
  }

  public function receipt()
  {
    $rec = Session::get('rec');
    $data = Sale::where('rec', $rec)->get();
    $data2 = Payment::where('rec', $rec)->get();
    return view('drug.receipt', compact('data', 'data2'));
  }

  public function profit()
  {
    return view('drug.profit');
  }

  public function checkprofit(Request $request)
  {
    $request->validate([
      'start' => 'required',
      'end' => 'required',
    ]);
    $date = $request['start'] . " 00:00:00";
    $date2 = $request['end'] . " 23:59:00";
    Session::put('date', $date);
    Session::put('date2', $date2);
    return redirect('rangesales');
  }

  public function rangesales()
  {
    $date = Session::get('date');
    $date2 = Session::get('date2');
    $data = Payment::where('created_at', '>=', $date)
      ->where('created_at', '<=', $date2)
      ->where('return', 0)->paginate(25);
    return view('drug.rangesales', compact('data'));
  }

  public function stock()
  {
    // check if daily opening stock have been added
    $today = date('Y-m-d');
    $checkStock = $this->checkDailyStock($today);
    if (!$checkStock) {
      // getting current stock
      $opening_stock = Store::all();
      // entering the current stock into daily stock
      foreach ($opening_stock as $stock) {
        DailyStock::create([
          'name' => $stock->name,
          'cost_price' => $stock->cprice,
          'selling_price' => $stock->selling_price,
          'current_stock' => $stock->qtyonhand,
        ]);
      }
    }
    $data = Store::where('type', \Auth::User()->type)->orderBy('name', 'asc')->paginate(200);
    return view('drug.stock', compact('data'));
  }

  private function checkDailyStock($today)
  {
    return DailyStock::whereDate('created_at', $today)->first();
  }

  public function addnewstock()
  {
    return view('drug.addnewstock');
  }

  public function enterstock(Request $request)
  {
    $request->validate([
      'name' => 'required',
      'reorder' => 'required',
      'cprice' => 'required',
      'markup' => 'required|integer',
    ]);
    $chk = Store::where('name', $request['name'])
      ->where('type', \Auth::User()->type)->get();
    if (!$chk->isEmpty()) {
      return Redirect::back()->withErrors(['Drug already added']);
    }
    $newMarkup = $request['markup'] + 5;
    $selling_price = ($newMarkup / 100) * $request['cprice'] + $request['cprice'];
    Store::create([
      'name' => $request['name'],
      'cprice' => $request['cprice'],
      'selling_price' => $selling_price,
      'reorder' => $request['reorder'],
      'markup' => $request['markup'],
      'type' => \Auth::User()->type,
    ]);
    DailyStock::create([
      'name' => $request['name'],
      'cost_price' => $request['cprice'],
      'current_stock' => 0,
      'selling_price' => $selling_price,
    ]);
    Session::flash('success', 'Drug added successfully');
    return redirect('stock');
  }

  public function stockedit($id)
  {
    $data = Store::where('id', $id)->get();
    return view('drug.stockedit', compact('data'));
  }

  public function updatestock(Request $request)
  {
    $request->validate([
      'name' => 'required',
      'qty' => 'required',
      'cprice' => 'required',
      'selling_price' => 'required|integer',
    ]);
    Store::where('id', $request['id'])
      ->update([
        'name' => $request['name'],
        'qtyonhand' => $request['qty'],
        'cprice' => $request['cprice'],
        'selling_price' => $request['selling_price'],
      ]);
    Session::flash('success', 'Drug updated successfully');
    return redirect('stock');
  }

  public function stockadd($id)
  {
    $data = Store::where('id', $id)->get();
    return view('drug.stockadd', compact('data'));
  }

  public function stockenter(Request $request)
  {
    $request->validate([
      'name' => 'required',
      'cprice' => 'required',
      'quantity' => 'required',
      'exp' => 'required',
    ]);
    // return $request;
    Storestock::create([
      'name' => $request['name'],
      'cprice' => $request['cprice'],
      'quantity' => $request['quantity'],
      'exp' => $request['exp'],
      'batch_no' => $request['batch_no'],
      'supplier_name' => $request['supplier_name'],
      'autenticate' => \Auth::User()->name,
      'type' => \Auth::User()->type,
    ]);
    $newstock = $request['quantity'] + $request['qtyonhand'];
    Store::where('id', $request['id'])
      ->where('type', \Auth::User()->type)
      ->update([
        'qtyonhand' => $newstock,
      ]);
    // adding it to daily stock
    $getDrug = DailyStock::where('name', $request['name'])->first();
    $currentStock = $getDrug->current_stock;
    $newStock = $currentStock + $request['quantity'];
    // updating the newstock
    DailyStock::where('name', $request['name'])
      ->update([
        'current_stock' => $newStock
      ]);
    Session::flash('success', 'New stock added successfully');
    return redirect('stock');
  }

  public function order($id)
  {
    $data = Store::where('id', $id)->where('type', \Auth::User()->type)->get();
    return view('drug.order', compact('data'));
  }

  public function orderenter(Request $request)
  {
    $request->validate([
      'quantity' => 'required',
      'collector' => 'required',
      'unit' => 'required',
    ]);

    $newqty = $request['qtyonhand'] - $request['quantity'];
    if ($newqty < 0) {
      Session::flash('error', 'Quantity order cannot be greater than quantity on hand');
      return redirect('order/' . $request['id']);
    }

    Order::create([
      'name' => $request['name'],
      'quantity' => $request['quantity'],
      'collector' => $request['collector'],
      'cost_price' => $request['cost_price'],
      'collecting_unit' => $request['unit'],
      'seller' => \Auth::User()->name,
      'type' => \Auth::User()->type
    ]);

    Store::where('id', $request['id'])
      ->where('type', \Auth::User()->type)
      ->update([
        'qtyonhand' => $newqty,
      ]);
    Session::flash('success', 'Order confirm successfully');
    return redirect('stock');
  }

  public function stockbreakdown($id)
  {
    $data = Store::where('id', $id)->get();
    return view('drug.stockbreakdown', compact('data'));
  }

  public function checkbreakdown(Request $request)
  {
    $request->validate([
      'start' => 'required',
      'end' => 'required',
    ]);
    $date = $request['start'] . " 00:00:00";
    $date2 = $request['end'] . " 23:59:00";
    Session::put('date', $date);
    Session::put('date2', $date2);
    Session::put('name', $request['name']);
    return redirect('breakdown');
  }

  public function breakdown()
  {
    $date = Session::get('date');
    $date2 = Session::get('date2');
    $name = Session::get('name');
    //GETTING THE STOCK
    $data = Storestock::where('created_at', '>=', $date)
      ->where('created_at', '<=', $date2)
      ->where('name', $name)
      ->where('type', \Auth::User()->type)
      ->orderBy('id', 'desc')->paginate(12);
    //GETTING THE SALES
    $data2 = Order::where('created_at', '>=', $date)
      ->where('created_at', '<=', $date2)
      ->where('name', $name)
      ->where('type', \Auth::User()->type)
      ->orderBy('id', 'desc')->paginate(12);

    return view('drug.breakdown', compact('data', 'data2'));
  }

  public function recall()
  {
    $data = Payment::orderBy('id', 'desc')->get();
    return view('drug.recall', compact('data'));
  }

  public function checkpres(Request $request)
  {
    Session::put('rec', $request['rec']);
    return redirect('receipt');
  }

  public function report()
  {
    return view('drug.report');
  }

  public function checkreport(Request $request)
  {
    $request->validate([
      'start' => 'required',
      'end' => 'required',
    ]);
    $date = $request['start'] . " 00:00:00";
    $date2 = $request['end'] . " 23:59:00";
    Session::put('date', $date);
    Session::put('date2', $date2);
    Session::put('stat', $request['stat']);
    return redirect('thereport');
  }

  public function thereport()
  {
    $date = Session::get('date');
    $date2 = Session::get('date2');
    $stat = Session::get('stat');
    if($stat === 'nil' || $stat === 'nhis'){
    $data = Payment::where('created_at', '>=', $date)
      ->where('created_at', '<=', $date2)
      ->where('nhis', $stat)
      ->where('status', 'normal')->get();
    }
    if($stat === 'Unclaimed waiver' || $stat === 'retainership'){
      $data = Payment::where('created_at', '>=', $date)
        ->where('created_at', '<=', $date2)
        ->where('status', $stat)->paginate(25);
      }
    if ($stat == 'nil') {
      Session::put('info', 'non-NHIS');
    } else {
      Session::put('info', 'NHIS');
    }
    return view('drug.thereport', compact('data'));
  }

  public function return()
  {
    $data = Payment::orderBy('id', 'desc')->where('return', 0)->get();
    return view('drug.return', compact('data'));
  }

  public function checkreturn(Request $request)
  {
    Session::put('rec', $request['rec']);
    return redirect('thereturn');
  }

  public function thereturn()
  {
    $rec = Session::get('rec');
    $data = Sale::where('rec', $rec)->get();
    $data2 = Payment::where('rec', $rec)->get();
    return view('drug.thereturn', compact('data', 'data2'));
  }

  public function returndrugs(Request $request)
  {
    $num = count($_POST['qty']);
    for ($i = 0; $i < $num; $i++) {
      $data = Drug::where('name', $request['name'][$i])->get();
      foreach ($data as $row) {
        $qty2[] = array(
          'qty' => $row->qty + $request['qty'][$i]
        );
        print_r($qty2);
        // die;
        Drug::where('name', $request['name'][$i])
          ->update($qty2[$i]);
      }
    }
    Payment::where('rec', $request['rec'])
      ->update([
        'return' => 1
      ]);
    //UPDATING THE SALES TABLE
    Sale::where('rec', $request['rec'])
      ->update([
        'return' => 1
      ]);
    Session::flash('success', 'drug added bac to stock');
    return redirect('drug');
  }

  public function worker()
  {
    $data = User::orderBy('id', 'desc')->get();
    return view('drug.worker', compact('data'));
  }

  public function addworker()
  {
    return view('drug.addworker');
  }

  public function registerworker(Request $request)
  {
    $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);
    User::create([
      'name' => $request['name'],
      'email' => $request['email'],
      'password' => Hash::make($request['password']),
      'type' => $request['type']
    ]);
    return redirect('worker');
  }

  public function workeredit($id)
  {
    $data = User::where('id', $id)->get();
    return view('drug.workeredit', compact('data'));
  }

  public function workerdelete($id)
  {
    $data = User::where('id', $id)->delete();
    Session::flash('error', 'dele6ted successfully');
    return redirect('worker');
  }

  public function updateworker(Request $request)
  {
    $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255'],
      'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);
    User::where('id', $request['id'])
      ->update([
        'name' => $request['name'],
        'email' => $request['email'],
        'password' => Hash::make($request['password']),
        'type' => $request['type']
      ]);
    return redirect('worker');
  }

  public function stockReport()
  {
    return view('report.stockReport');
  }

  public function checkStockReport(Request $request)
  {
    $request->validate([
      'start_date' => 'required',
      'end_date' => 'required',
    ]);
    Session::put('dates', $request->all());
    return redirect('getStockReport');
  }

  public function getStockReport()
  {
    $dates = Session::get('dates');
    // adding a day to the end date
    $endDate = $this->addADay($dates['end_date']);

    // checking if there is a closing stock at the end date
    $closing_stock = DailyStock::whereDate('created_at', $endDate)->first();
    if (!$closing_stock) {
      Session::flash('error', 'there is no closing stock on the selected date');
      return redirect('stockReport');
    }
    // getting opening stock
    $data['opening_stock'] = DailyStock::whereDate('created_at', $dates['start_date'])->get();

    // getting sales
    $data['sales'] = Order::whereDate('created_at', '>=', $dates['start_date'])
      ->whereDate('created_at', '<=', $dates['end_date'])->orderBy('created_at', 'asc')->get();

    // $stocks = DailyStock::whereDate('created_at', '>=', $dates['start_date'])
    //   ->whereDate('created_at', '<=', $endDate)->orderBy('created_at', 'asc')->get();
    // // closing stock
    // $closing_stocks = DailyStock::whereDate('created_at', $endDate)->get();
    // $closingStockTotal = 0;
    // foreach ($closing_stocks as $closing_stock) {
    //   $subTotal = $closing_stock->current_stock * $closing_stock->cost_price;
    //   $closingStockTotal += $subTotal;
    // }
    return view('report.getStockReport')->with('data', $data);
  }

  private function addADay($date)
  {
    $daystosum = 1;
    $datesum = date('Y-m-d', strtotime($date . ' + ' . $daystosum . ' days'));
    return $datesum;
  }

  public function monthlyConsumption()
  {
    return view('report.monthlyConsumption');
  }

  public function checkMonthReport(Request $request)
  {
    $request->validate([
      'month' => 'required',
      'year' => 'required',
    ]);
    Session::put('selection', $request->all());
    return redirect('getMonthlyConsumption');
  }

  public function getMonthlyConsumption()
  {
    $selection = Session::get('selection');
    $month = $selection['month'];
    $year = $selection['year'];
    // return $month;

    // $result = Order::groupBy('name')->select('name', 'collector', 'cost_price', 'collecting_unit', 'quantity')
    //   ->sum('quantity');

    $consumptions = DB::select('SELECT name, collector, cost_price, collecting_unit, quantity, SUM(quantity) FROM orders WHERE MONTH(created_at) = ' . $month . ' && YEAR(created_at) = ' . $year . ' GROUP BY name ORDER BY id ASC');
    $consumptions = json_decode(json_encode($consumptions), true);

    return view('report.getMonthlyConsumption')->with('consumptions', $consumptions)->with('sn', 1);
  }

  public function deptStockReport()
  {
    $departments = Order::groupBy('collecting_unit')->get();
    return view('report.deptStockReport')->with('departments', $departments);
  }

  public function checkDeptStockReport(Request $request)
  {
    $request->validate([
      'start_date' => 'required',
      'end_date' => 'required',
    ]);
    Session::put('request', $request->all());
    return redirect('getDeptStockReport');
  }

  public function getDeptStockReport()
  {
    $request = Session::get('request');
    $orders = Order::where('collecting_unit', $request['department'])
    ->whereDate('created_at', '>=', $request['start_date'])
    ->whereDate('created_at', '<=', $request['end_date'])
    ->orderBy('created_at', 'asc')->get();
    return view('report.getDeptStockReport')->with('orders', $orders)->with('sn',1);
  }

  public function multipleMonths()
  {
    return view('report.multipleMonths');
  }

  public function checkMultipleReport(Request $request)
  {
    $request->validate([
      'start_month' => 'required|integer',
      'end_month' => 'required|integer|gt:start_month',
      'year' => 'required'
    ]);
    Session::put('request', $request->all());
    return redirect('getMultipleReport');
  }

  public function getMultipleReport()
  {
    $request = Session::get('request');
    $start_month = $request['start_month'];
    $end_month = $request['end_month'];
    $year = $request['year'];
    $consumptions = DB::select('SELECT name, collector, cost_price, collecting_unit, quantity, SUM(quantity) FROM orders WHERE MONTH(created_at) >= ' . $start_month .' AND MONTH(created_at) <= ' . $end_month . ' && YEAR(created_at) = ' . $year . ' GROUP BY name ORDER BY id ASC');
    $consumptions = json_decode(json_encode($consumptions), true);
    
    return view('report.getMultipleReport')->with('consumptions', $consumptions)->with('sn', 1);
  
  }

  public function singleMonth()
  {
    return view('report.singleMonth');
  }

  public function checkSingleMonth(Request $request)
  {
    $request->validate([
      'month' => 'required',
      'year' => 'required',
    ]);
    Session::put('selection', $request->all());
    return redirect('getSingleConsumption');
  }

  public function getSingleConsumption()
  {
    $selection = Session::get('selection');
    $month = $selection['month'];
    $year = $selection['year'];
    // return $month;

    // $result = Order::groupBy('name')->select('name', 'collector', 'cost_price', 'collecting_unit', 'quantity')
    //   ->sum('quantity');

    $consumptions = DB::select('SELECT name, collector, cost_price, collecting_unit, quantity, SUM(quantity) FROM orders WHERE MONTH(created_at) = ' . $month . ' && YEAR(created_at) = ' . $year . ' GROUP BY name ORDER BY id ASC');
    $consumptions = json_decode(json_encode($consumptions), true);

    return view('report.getSingleConsumption')->with('consumptions', $consumptions)->with('sn', 1);
  
  }

  public function returnReceipt()
  {
    $receipts = Sale::orderBy('id', 'desc')->groupBy('rec')->get();
    return view('drug.returnReceipt')->with('receipts', $receipts);
  }

  public function removeReceipt(Request $request)
  {
    $request->validate([
      'rec' => 'required|integer'
    ]);
    // checking if the receipt have not been paid
    $checkPayment = Payment::where('rec', $request['rec'])->where('payment_status', 'paid')->first();
    if($checkPayment){
      Session::flash('error', 'receipt has been paid');
      return redirect()->back();
    }
    Sale::where('rec', $request['rec'])->delete();
    Payment::where('rec', $request['rec'])->delete();
    Session::flash('success', 'details removed successfully');
    return redirect()->back();
  }

}
