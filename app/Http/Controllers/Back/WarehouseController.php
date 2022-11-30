<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warehouse;
use App\Repositories\Back\WarehouseRepository;

class WarehouseController extends Controller
{
    /**
     * Constructor Method.
     *
     * Setting Authentication
     *
     * @param  \App\Repositories\Back\WarehouseRepository $repository
     *
     */
    public function __construct(WarehouseRepository $repository)
    {
        $this->middleware('auth:admin');

        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datas = Warehouse::orderBy('id','desc')->get();
        return view('back.warehouse.index', compact('datas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $warehouse = Warehouse::first();
        return view('back.warehouse.create',compact('warehouse'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'               => 'required|string|max:50',
            // 'available_quantity' => 'required|numeric',
            'delivery_time'      => 'required',
            // 'min_order_amount'   => 'required|numeric'
        ]);

        $this->repository->store($request);
        return redirect()->route('back.warehouse.add')->withSuccess(__('Warehouse Updated Successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $warehouse = Warehouse::find($id)->first();
        return view('back.warehouse.edit',compact('warehouse'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $warehouse = Warehouse::find($id)->first();
        $this->repository->update($warehouse, $request);
        return redirect()->route('back.warehouse.index')->withSuccess(__('Warehouse Updated Successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $warehouse = Warehouse::find($id)->first();
        $mgs = $this->repository->delete($warehouse);
        
        if($mgs['status'] == 1){
            return redirect()->route('back.warehouse.index')->withSuccess($mgs['message']);
        }
        else{
            return redirect()->route('back.warehouse.index')->withError($mgs['message']);
        }
    }
}
