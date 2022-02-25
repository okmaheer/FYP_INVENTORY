<?php

namespace App\Http\Controllers\Marquee;

use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use App\Models\Marquee\EventArea;
use Illuminate\Http\Request;

class EventAreaController extends Controller
{

    public $model;
    private $location;

    public function __construct(EventArea $area)
    {
        $this->middleware('auth');
        $this->model = $area;
        $this->middleware(function ($request, $next){
            $this->location = session(SessionEnum::SESSION_LOCATION_ID);
            return $next($request);
        });
    }

    public function index()
    {
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Event Areas' => '',
        ]);

        $page_title = "Event Areas";
        $data = $this->model->where('location_id', $this->location)->get();

        return view('dashboard.marquee.event_area.index', compact('breadcrumbs', 'page_title', 'data'));
    }

    public function create()
    {
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Event Areas' => route('dashboard.marquee.eventarea.index'),
            'New Event Area' => ''
        ]);

        $page_title = "New Event Areas";
        return view('dashboard.marquee.event_area.create', compact('page_title', 'breadcrumbs'));
    }

    public function store(Request $request)
    {
        $this->model = $this->model->create($request->all());
        if ($this->model) {

            if ($request->saveNew == 1) {
                return redirect()->route('dashboard.marquee.eventarea.create')
                    ->with('success', 'Event Area Created Successfully.');
            } else {
                return redirect()->route('dashboard.marquee.eventarea.index')
                    ->with('success', 'Event Area Created Successfully.');
            }
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $model = $this->model->where('location_id', $this->location)->findorFail($id);
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Event Areas' => route('dashboard.marquee.eventarea.index'),
            'Modify Event Area' => ''
        ]);

        $page_title = "Modify Event Areas";
        return view('dashboard.marquee.event_area.edit', compact('page_title', 'breadcrumbs', 'model'));
    }

    public function update(Request $request, $id)
    {

        $this->model->where('location_id', $this->location)->findorFail($id)->update($request->all());
        $this->model = $this->model->where('location_id', $this->location)->find($id);

        return redirect()->route('dashboard.marquee.eventarea.index')
            ->with('success', 'Event Area Updated Successfully.');
    }

    public function destroy($id)
    {
        $this->model = $this->model->where('location_id', $this->location)->findorFail($id);
        if ($this->model) {
            $this->model->delete();
            return redirect()->route('dashboard.marquee.eventarea.index')
                ->with('success', 'Event Area Removed Successfully.');
        }
    }
}
