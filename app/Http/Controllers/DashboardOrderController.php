<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Order;
use App\Models\Detail;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;

use Intervention\Image\Facades\Image;

use Illuminate\Support\Facades\Storage;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;



class DashboardOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.orders.index', [
            'orders' => Order::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.orders.create', [
            'clients' => Client::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // ddd($request);
        $validatedData = $request->validate([
            'jenis' => 'required|max:255',
            'client_id' => 'required|max:255',
            'tgl' => 'required|date',
        ]);


        // $validatedData['user_id'] = auth()->user()->id;

        
        Order::create($validatedData);
        
        return redirect('/dashboard/orders')->with('success', 'New order has been added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $details = $order->details;
        return view('dashboard.orders.show', compact('order', 'details'));
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Order $order)
    {
        return view('dashboard.orders.edit', [
            'order' => $order,
            'clients' => Client::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Order $order)
    {
        $rules = [
            'jenis' => 'required|max:255',
            'client_id' => 'required|max:255',
            'tgl' => 'required|date'
        ];



        $validatedData = $request->validate($rules);



        Order::where('id', $order->id)
            -> update($validatedData);

        return redirect('/dashboard/orders')->with('success', 'Order has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        if(Detail::where('order_id', $order->id)->exists()) {
            return redirect('/dashboard/orders')->with('errors', 'Data details masih ada, Hapus data didalam '. $order->jenis . ' terlebih dahulu!');
        } else {
            Order::destroy($order->id);
            
            return redirect('/dashboard/orders')->with('success', 'Order has been deleted!');
        }
    }




    public function createDetail(Order $order, Detail $detail)
    {
        return view('dashboard.orders.details.create', compact('order', 'detail'));
    }

    public function storeDetail(Request $request, Order $order)
    {
        $validatedData = $request->validate([
            'jenis_detail' => 'required|max:255',
            'qty' => 'required|integer',
            'keterangan' => 'required|max:255',
            'perbaikan' => 'required|max:255',
            'status' => 'required|max:255',
            'sebelum' => 'image|file|max:10240',
            'pengerjaan' => 'image|file|max:10240',
            'sesudah' => 'image|file|max:10240',
        ]);

        if($request->file('sebelum')) {
            $validatedData['sebelum'] = $request->file('sebelum')->store('sebelum-images');
            // Image::make(storage_path('sebelum-mages'))->resize(150, 150)->save();
        }
        
        if($request->file('pengerjaan')) {
            $validatedData['pengerjaan'] = $request->file('pengerjaan')->store('pengerjaan-images');
            // Image::make(storage_path('pengerjaan-images'))->resize(300, 300)->save();
        }

        if($request->file('sesudah')) {
            $validatedData['sesudah'] = $request->file('sesudah')->store('sesudah-images');
        }

        $order->details()->create($validatedData);

        return redirect()->route('orders.show', $order)->with('success', 'Detail created successfully.');
    }

    public function editDetail(Order $order, Detail $detail)
    {
        return view('dashboard.orders.details.edit', compact('order', 'detail'));
    }

    public function updateDetail(Request $request, Order $order, Detail $detail)
    {
        $validatedData = $request->validate([
            'jenis_detail' => 'required|max:255',
            'qty' => 'required|integer',
            'keterangan' => 'required|max:255',
            'perbaikan' => 'required|max:255',
            'status' => 'required|max:255',
            'sebelum' => 'image|file|max:10240',
            'pengerjaan' => 'image|file|max:10240',
            'sesudah' => 'image|file|max:10240',
        ]);

        if($request->file('sebelum') || $request->file('pengerjaan') || $request->file('sesudah')) {
            if($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validatedData['sebelum'] = $request->file('sebelum')->store('sebelum-images');
            $validatedData['pengerjaan'] = $request->file('pengerjaan')->store('pengerjaan-images');
            $validatedData['sesudah'] = $request->file('sesudah')->store('sesudah-images');
        }
         
        $detail->update($validatedData);

        return redirect()->route('orders.show', $order)->with('success', 'Detail updated successfully.');
    }

    public function destroyDetail(Order $order, Detail $detail)
    {
        if($detail->sebelum || $detail->pengerjaan || $detail->sesudah) {
            Storage::delete($detail->sebelum);
            Storage::delete($detail->pengerjaan);
            Storage::delete($detail->sesudah);
        }

        $detail->delete();

        return redirect()->route('orders.show', $order)->with('success', 'Detail deleted successfully.');
    }



    public function report(Request $request)
    {
        $orders = Order::query();

        if ($request->has('order') && $request->order != 0) {
            $orders->where('orders.id', $request->order);
        }
        if ($request->has('client') && $request->client != 0) {
            $orders->where('orders.client_id', $request->client);
        }

        $details = $orders->join('details', 'orders.id', '=', 'details.order_id')
                        ->select('details.*')
                        ->get();

        $orderOptions = Order::all();
        $clientOptions = Client::all();
        


        return view('dashboard.reports.index', compact('details', 'orderOptions', 'clientOptions'));
    }

    public function pdf(Request $request)
    {

        set_time_limit(36000);

    	// $project = Project::all();
        $orderFilter = $request->input('order');

        $clientFilter = $request->input('client');
        $jenisDB=DB::table('orders')->where('id', $orderFilter)->pluck('jenis');

 
        if($orderFilter == 0 && $clientFilter == 0){
            
             $queryorder = DB::table('orders')
             ->join('clients', 'orders.id', '=', 'clients.id')
             ->join('details', 'orders.id', '=', 'details.order_id');
          
        } elseif($orderFilter == 0 && $clientFilter != 0) {
            
            $queryorder = DB::table('orders')
            ->join('clients', 'orders.client_id', '=', 'clients.id')
            ->join('details', 'orders.id', '=', 'details.order_id')
            ->where('orders.client_id', $clientFilter);
            
        
        } elseif($orderFilter != 0 && $clientFilter == 0) {
            
            $queryorder = DB::table('orders')->
            join('clients', 'orders.client_id', '=', 'clients.id')->
             join('details', 'orders.id', '=', 'details.order_id')
            ->where('orders.jenis', $jenisDB);
            
        } else {
            
            $queryorder = DB::table('orders')
            ->join('clients', 'orders.client_id', '=', 'clients.id')
            ->join('details', 'orders.id', '=', 'details.order_id')
            ->where('client_id', $clientFilter)
            ->where('jenis', $jenisDB);
            
            
        } 
        
  

        //untuk Judul PDF, jika pilihan semua order maka isi variabel = semua, jika tidak = au ah 
        if($orderFilter == 0 && $clientFilter == 0) {
            $jumlah = "semua";
        } elseif($orderFilter == 0 && $clientFilter != 0 ) {
            $jumlah = "only_client";
        } elseif($orderFilter != 0 && $clientFilter == 0) {
            $jumlah = "only_order";
        } else {
            $jumlah = "au ah";
        }

        $orders = $queryorder->get();

        
        $pdf = app('dompdf.wrapper')->loadView('/dashboard/reports/pdf', compact('orders', 'jumlah'));
        
    	return $pdf->download('laporan-detail.pdf');
    }
}
