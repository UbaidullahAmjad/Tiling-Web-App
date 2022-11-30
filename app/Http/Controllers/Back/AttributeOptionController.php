<?php

namespace App\Http\Controllers\Back;

use App\{
    Models\Item,
    Models\Attribute,
    Models\WarehouseAvailability,
    Models\AttributeOption,
    Http\Controllers\Controller,
    Http\Requests\AttributeOptionRequest
};
use App\Models\Currency;
use Illuminate\Http\Request;

class AttributeOptionController extends Controller
{
    /**
     * Constructor Method.
     *
     * Setting Authentication
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Item $item)
    {

        return view('back.item.attribute_option.index', [
            'item'  => $item,
            'curr' => Currency::where('is_default', 1)->first(),
            'datas' => $item->join('attributes', 'attributes.item_id', '=', 'items.id')
                ->join('attribute_options', 'attribute_options.attribute_id', '=', 'attributes.id')
                ->select('attribute_options.id', 'attribute_options.attribute_id', 'attribute_options.name', 'attribute_options.keyword', 'attribute_options.stock', 'attribute_options.price', \DB::raw('attributes.name as attribute'))
                ->where('items.id', '=', $item->id)
                ->latest('id')
                ->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Item $item)
    {
        // dd($item->attributes);
        return view('back.item.attribute_option.create', [
            'item'  => $item,
            'curr' => Currency::where('is_default', 1)->first(),
            'attributes' => Attribute::whereItemId($item->id)->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AttributeOptionRequest $request, Item $item)
    {

        $input = $request->all();
        $curr = Currency::where('is_default', 1)->first();
        $input['price'] = $request->price / $curr->value;
        $opt = AttributeOption::create($input);
        $file = $request->image;
        // $image = \Image::make($file)->resize(230, 230);

        //     $image->save(public_path() . '/assets/images/' . $image);

            $photo = time() . $file->getClientOriginalName();
            $file->move(public_path() . '/assets/images/', $photo);
            $opt->image = $photo;
            $opt->save();

            $payload = [
                'attribute_options_id' => $opt->id,
                'availability' => $input['availability'],
            ];
            $saveWarehouseAvailability = WarehouseAvailability::create($payload); // warehouse saved

        return redirect()->route('back.option.index', $item->id)->withSuccess(__('New Attribute Option Added Successfully.'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Item $item, AttributeOption $option)
    {
        return view('back.item.attribute_option.edit', [
            'item'  => $item,
            'option' => $option,
            'curr' => Currency::where('is_default', 1)->first(),
            'attributes' => Attribute::whereItemId($item->id)->get()

        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AttributeOptionRequest $request, Item $item, AttributeOption $option)
    {

        $input = $request->all();
        $curr = Currency::where('is_default', 1)->first();
        $input['price'] = $request->price / $curr->value;
        $option->update($input);

        if($request->hasFile('image')){
            $file = $request->image;
        // $image = \Image::make($file)->resize(230, 230);

        //     $image->save(public_path() . '/assets/images/' . $image);

            $photo = time() . $file->getClientOriginalName();
            $file->move(public_path() . '/assets/images/', $photo);
            $option->image = $photo;
            $option->save();
        }
        return redirect()->route('back.option.index', $item->id)->withSuccess(__('Attribute Option Updated Successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item, AttributeOption $option)
    {
        $option->delete();
        return redirect()->route('back.option.index', $item->id)->withSuccess(__('Attribute Option Deleted Successfully.'));
    }

    public function checkAttribute(Request $request)
    {
        $attr = Attribute::find($request->id);
        // dd($attr);
        if ($attr->abbrivation == "sq" || $attr->abbrivation == "sqr" || $attr->abbrivation == "m²" || $attr->abbrivation == "m^2" || $attr->abbrivation == "m2" || $attr->abbrivation == "mn") {
            return response()->json("square");
        } else {
            return response()->json("other");
        }
    }
}
