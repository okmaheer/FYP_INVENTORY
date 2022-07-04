<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Specialist;
use Intervention\Image\Facades\Image;

class SpecialistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $specialist = Specialist::all();
        return view('dashboard.accounts.doctor.specialist.specialist_list' , compact('specialist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.accounts.doctor.specialist.add_specialist');
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
        $validated = $request->validate([
            'logo' => 'required',
        ]);
        $specialist = Specialist::create([
            'specialist_name' => $request->specialist_name,
            'logo' => $logo,
            'color' => $request->color,
        ]);

        return redirect()->route('dashboard.accounts.specialist.index');
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
        $specialist = Specialist::where('id',$id)->first();
        return view('dashboard.accounts.doctor.specialist.edit_specialist' ,compact('specialist'));
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
        $logo = "empty";
        $specialist = Specialist::findorfail($id);
        if($request->file('logo')) {
            $file = $request->file('logo');
            $name = sha1('img' . time()) . '.' . $file->getClientOriginalExtension();
            $image = Image::make($file);
            $image->save(public_path('website/imgs/') . $name);
            $logo = 'website/imgs/' . $name;

        }

        $validated = $request->validate([
            'logo' => 'required',
        ]);
        $specialist->fill([
            'specialist_name' => $request->specialist_name,
            
            'logo' => $logo,
            'color' => $request->color
        ])->save();

        return redirect()->route('dashboard.accounts.specialist.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $specialist = Specialist::findorfail($id);
        $specialist -> delete();

        return redirect()->route('dashboard.accounts.specialist.index');
    }
}
