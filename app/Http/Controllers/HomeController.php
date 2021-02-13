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
use Session;
use Hash;
use Redirect;

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
      return view('drug.adddrug');
    }

    public function enterdrug(Request $request)
    {
      $request->validate([
        'name' => 'required|unique:drugs',
        'markup' => 'required',
        'price' => 'required',
      ]);
       // dd($request);
      $cost = ($request['markup']/100) * $request['price'] + $request['price'];
      //sdd($request['price']);
      Drug::create([
        'name' => $request['name'],
        'markup' => $request['markup'],
        'cprice' => $request['price'],
        'sprice' => $cost,
      ]);
      return redirect('drug');
    }

    public function drug()
    {
      $data = Drug::orderBy('qty', 'desc')->get();
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
      $markup = ((($request['price'] - $request['c_price']) * 100 ) / $request['c_price'] );
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
      $markup = ((($request['price'] - $request['cprice']) * 100 ) / $request['cprice'] );
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
     if($request->ajax())
     {
      $output = '';
      $query = $request->get('query');
      if($query != '')
      {
       $data = Drug::where('name', 'like', '%'.$query.'%')
     //->orWhere('name', 'like', '%'.$query.'%')
        /** ->orWhere('City', 'like', '%'.$query.'%')
         ->orWhere('PostalCode', 'like', '%'.$query.'%')
         ->orWhere('Country', 'like', '%'.$query.'%')**/
         ->orderBy('id', 'desc')
         ->get();
         
       }
       else
       {
         $data = DB::table('tbl_customer')
         ->orderBy('CustomerID', 'desc')
         ->get();
       }
       $total_row = $data->count();
       if($total_row > 0)
       {
         foreach($data as $row)
         {
          $output .= '

          <div class="col-sm-12 rst"
          data-sprice = "'.$row->sprice.'"
          data-c_price = "'.$row->cprice.'"
          data-qty2 = "'.$row->qty.'"
          data-id = "'.$row->id.'"
          style="cursor:pointer;"
          >'.$row->name.'</div>';
        }
      }
      else
      {
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
  $data = Sale::orderBy('id','desc')->first();
  $rec = $data->id + 1000;
  $num = count($_POST['name']);
  for ($i=0; $i < $num; $i++) { 
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

public function tendered()
{
  $rec = Session::get('rec');
  $data = Sale::where('rec', $rec)->get();
  return view('drug.tendered', compact('data'));
}

public function entertendered(Request $request)
{
  $request->validate([
    'amount' => 'required',
  ]);
  if ($request['percent'] == 0) {
    $nhis = 'nil';
  }
  else{
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
    'seller' => \Auth::User()->name,
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
  return view('drug.receipt', compact('data','data2'));
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
  $date = $request['start']." 00:00:00";
  $date2 = $request['end']." 23:59:00";
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
  $data = Store::where('type', \Auth::User()->type)->orderBy( 'qtyonhand', 'desc')->paginate(200);
  return view('drug.stock', compact('data'));
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
  ]);
  $chk = Store::where('name', $request['name'])
  ->where('type', \Auth::User()->type)->get();
  if (!$chk->isEmpty()) {
    return Redirect::back()->withErrors(['Drug already added']);
  }
  Store::create([
    'name' => $request['name'],
    'cprice' => $request['cprice'],
    'reorder' => $request['reorder'],
    'type' => \Auth::User()->type,
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
  ]);
  Store::where('id', $request['id'])
  ->update([
    'name' => $request['name'],
    'qtyonhand' => $request['qty'],
    'cprice' => $request['cprice'],
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
    return redirect('order/'.$request['id']);
  }

  Order::create([
    'name' => $request['name'],
    'quantity' => $request['quantity'],
    'collector' => $request['collector'],
    'collecting_unit' => $request['unit'],
    'bulk' => $request['bulk'],
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
  $date = $request['start']." 00:00:00";
  $date2 = $request['end']." 23:59:00";
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

  return view('drug.breakdown', compact('data','data2'));
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
  $date = $request['start']." 00:00:00";
  $date2 = $request['end']." 23:59:00";
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
  $data = Payment::where('created_at', '>=', $date)
  ->where('created_at', '<=', $date2)
  ->where('nhis', $stat)->paginate(25);
  if ($stat == 'nil') {
    Session::put('info', 'non-NHIS');
  }
  else{
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
  return view('drug.thereturn', compact('data','data2'));
}

public function returndrugs(Request $request)
{
  $num = count($_POST['qty']);
  for ($i=0; $i < $num; $i++) { 
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






}
