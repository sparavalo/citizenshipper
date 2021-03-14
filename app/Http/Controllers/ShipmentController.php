<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShipmentRequest;
use App\Models\Category;
use App\Models\CategoryAttributes;
use App\Models\Shipment;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ShipmentController extends Controller
{

    public function index(): Response
    {
        $shipments = Shipment::with('category')->with('catAttributes')->get();

        return response($shipments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ShipmentRequest $request): Response
    {
        $cat = strtolower($request->post('category'));
        $category = Category::where('name', $cat)->first();

        $shipment = new Shipment();
        $shipment->pickup_date = $request->post('pickup_date');
        $shipment->delivery_date = $request->post('delivery_date');
        $shipment->delivery_location = $request->post('delivery_location');
        $shipment->pickup_location = $request->post('pickup_location');
        $shipment->description = $request->post('description');
        if ($request->post('estimated_value')) {
            $shipment->estimated_value = $request->post('estimated_value');
        }
        $shipment->category_id = ($category->id);
        $shipment->save();

        $categoryAttributes = new CategoryAttributes();

        switch ($cat) {
            case 'pets':
                $categoryAttributes->pet_name = $request->post('pet_name');
                $categoryAttributes->pet_weight = $request->post('pet_weight');
                $categoryAttributes->pet_breed = $request->post('pet_breed');
                $categoryAttributes->is_aggressive = $request->post('is_aggressive');
                break;
            case 'boats':
                $categoryAttributes->boat_type = $request->post('boat_type');
                break;
            case 'motorcycles':
            case 'cars':
                $categoryAttributes->make = $request->post('make');
                $categoryAttributes->model = $request->post('model');
                $categoryAttributes->year = $request->post('year');
        }
        $categoryAttributes->category_id = $category->id;
        $categoryAttributes->shipment_id = $shipment->id;
        $categoryAttributes->save();

        return response(['message' => 'Successfully created shipment'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function show(Shipment $shipment)
    {
        return response($shipment->with('category')->with('catAttributes')->get());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shipment $shipment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Shipment  $shipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shipment $shipment)
    {
        //
    }
}
