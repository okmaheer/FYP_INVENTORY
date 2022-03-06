<?php

namespace App\Http\Controllers;

use App\Models\Doctor;

use App\Models\Specialist;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\General;

class HomePageController extends Controller

{
    use General;
    public $model;


    function __construct(Doctor $doctor, Specialist $specialist, Location $location)
    {
//        $this->middleware('auth');
        $this->model = $doctor;
        $this->special = $specialist;
        $this->location = $location;


    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data2  = $this->location->all();
      
        $data  = $this->special->all();

        return view('website.index',compact('data','data2'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
    }


    public function liveSearch(Request $request){

       if($request->isMethod('get') ){
        return redirect()->route('home');
       }

        $text = $request->search;

        if ($request->has('location') && $request->has('speciality') )  {
            $id =   $request->speciality;
                $text  = $this->special->where('id',$id[0])->pluck('specialist_name')->first();
                $logo  = $this->special->where('id',$id[0])->pluck('logo')->first();
            
            $special_ids = $request->speciality; 
            $location_ids = $request->location; 
            $search = $this->model->with('specialist', 'location')
                                ->whereIn('specialist_id', $special_ids)
                                ->whereIn('location_id', $location_ids)
                                 ->get();
             
                                

        }
        if (!$request->has('location') && $request->has('speciality'))  {
            $id =   $request->speciality;
            $text  = $this->special->where('id',$id[0])->pluck('specialist_name')->first();
            $logo  = $this->special->where('id',$id[0])->pluck('logo')->first();
 
                    $special_ids = $request->speciality; 
                     $search = $this->model->with('specialist', 'location')
                            ->whereIn('specialist_id', $special_ids)
                           
                             ->get();


        }
        if (!$request->has('speciality') && $request->has('location') )  {
            $id =   $request->location;
             $text  = $this->location->where('id',$id[0])->pluck('location_name')->first();
             $logo  = $this->location->where('id',$id[0])->pluck('logo')->first();


            $location_ids = $request->location; 
        
            $search = $this->model->with('specialist', 'location')
                             
                        ->whereIn('location_id', $location_ids)
                        ->get();


        }
      
      
      
        if (!$request->search == null  )  {
       $search = $this->special->where('specialist_name',$request->search)->pluck('id')->first();
       $logo  = $this->special->where('id',$search)->pluck('logo')->first();
       $search = $this->model->with('specialist')->where('specialist_id',$search)->get();
      

     $data =  count($search);

       if($data == "0"){
  
        $search = Doctor::where('name', 'like', '%'. $request->search . '%')->get();
        
        $logo=" ";

       }
        }
      

        return view('website.show', compact('search','text','logo'));
}

  public function allrecords($id){
//   dd($id);
    $search = $this->model->with('specialist')->where('specialist_id',$id)->get();
    $data = $this->model->with('specialist')->where('specialist_id',$id)->pluck('specialist_id')->first();
    $text  = $this->special->where('id',$data)->pluck('specialist_name')->first();


            return view('website.show', compact('search','text'));  
        }

   public function get_location(Request $request){
           
            $data2  = $this->location->all();
             return $data2;
    
    }
    public function specialist(Request $request){
           
        $data  = $this->special->all();
         return $data;

}
        
        
}
