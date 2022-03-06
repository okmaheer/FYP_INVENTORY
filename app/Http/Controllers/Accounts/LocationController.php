<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;
use Intervention\Image\Facades\Image;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $location = Location::all();
        return view('dashboard.accounts.doctor.location.location_list' , compact('location'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.accounts.doctor.location.add_location');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if($request->file('logo')) {
            $file = $request->file('logo');
            $name = sha1('img' . time()) . '.' . $file->getClientOriginalExtension();
            $image = Image::make($file);
            $image->save(public_path('website/imgs/') . $name);
            $logo = 'website/imgs/' . $name;

        }
        $location = Location::create([
            'location_name' => $request->location_name,
            'logo' => $logo,
            'color' => $request->color,
        ]);

        return redirect()->route('dashboard.accounts.location.index');
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
        $location = Location::where('id',$id)->first();
        return view('dashboard.accounts.doctor.location.edit_location' ,compact('location'));
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
        $location = Location::findorfail($id);
        if($request->file('logo')) {
            $file = $request->file('logo');
            $name = sha1('img' . time()) . '.' . $file->getClientOriginalExtension();
            $image = Image::make($file);
            $image->save(public_path('website/imgs/') . $name);
            $logo = 'website/imgs/' . $name;

        }
        $location->fill([
            'location_name' => $request->location_name,
            'logo' => $logo,
            'color' => $request->color
        ])->save();

        return redirect()->route('dashboard.accounts.location.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $location = Location::findorfail($id);
        $location -> delete();

        return redirect()->route('dashboard.accounts.location.index');
    }
}
