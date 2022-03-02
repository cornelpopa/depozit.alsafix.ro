<?php

namespace App\Http\Controllers;

use App\Forwarder;
use Illuminate\Http\Request;

class ForwarderController extends Controller
{

    public function index()
    {

        $forwarders = Forwarder::all();

        return view('forwarder.index')->with(['forwarders' => $forwarders]);
    }

    public function show(Forwarder $forwarder)
    {
        return view('forwarder.show')->with(['forwarder' => $forwarder]);
    }

    public function create()
    {
        $forwarder = new Forwarder();
        $forwarder->is_active = true;

        return view('forwarder.create')->with(['forwarder' => $forwarder]);
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'name'             => 'required|min:3',
            'scan_length'      => 'required|integer|min:0',
            'barcode'          => 'sometimes',
            'limits'           => 'sometimes',
            'tracking_website' => 'sometimes ',
            'is_active'        => 'boolean'
        ]);

        $forwarder = Forwarder::create($attributes);

        return redirect(route('forwarders.show', $forwarder->id));
    }

    public function edit(Forwarder $forwarder)
    {
        return view('forwarder.edit')->with(['forwarder' => $forwarder]);
    }

    public function update(Request $request, Forwarder $forwarder)
    {
        $attributes = $request->validate([
            'name'             => 'required|min:3',
            'scan_length'      => 'required|integer|min:0',
            'barcode'          => 'sometimes',
            'limits'           => 'sometimes',
            'tracking_website' => 'sometimes ',
            'is_active'        => 'boolean'
        ]);

        $forwarder->update($attributes);

        return redirect()->route('forwarders.show', $forwarder);
    }

}
