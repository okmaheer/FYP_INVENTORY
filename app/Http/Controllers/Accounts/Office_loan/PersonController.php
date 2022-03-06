<?php

namespace App\Http\Controllers\Dashboard\Office_loan;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Person;

class PersonController extends Controller
{
    public $model;

    function __construct(Person $person)
    {
        $this->middleware('auth');
        $this->model = $person;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $this->authorize('view', Person::class);
        $person = Person::all();
        return view('dashboard.Human-Resource.Office-Loan.manage_person',compact('person'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $this->authorize('create', Person::class);
        return view('dashboard.Human-Resource.Office-Loan.add_person');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->authorize('create', Person::class);
        $person = Person::create([
            'person_name' => $request->person_name,
            'person_phone' => $request->person_phone,
            'person_address' => $request->person_address,
        ]);

        // dd($person);

        return redirect()->route('person.index');
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
        //
        $person = Person::where('id',$id)->first();
        return view('dashboard.Human-Resource.HRM.edit_person',compact('person'));
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
        //
        $person = Person::findorfail($id);
        $person->fill([
            'person_name' => $request->person_name,
            'person_phone' => $request->person_phone,
            'person_address' => $request->person_address,
        ])->save();

        return redirect()->route('person.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $person = Person::findorfail($id);
        $person->delete();
        return redirect()->route('person.index');
    }
}
