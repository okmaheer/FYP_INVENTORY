<?php

namespace App\Http\Controllers\Marquee;

use App\Enum\SessionEnum;
use App\Http\Controllers\Controller;
use App\Models\Marquee\Booking;
use App\Models\Marquee\EventArea;
use App\Models\Marquee\TentativeBooking;
use App\Models\Prefixes;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TentativeBookingController extends Controller
{
    private $model;
    private $eventArea;
    private $location;

    public function __construct(TentativeBooking $model, EventArea $area)
    {
        $this->middleware('auth');
        $this->model = $model;
        $this->eventArea = $area;
        $this->middleware(function ($request, $next){
            $this->location = session(SessionEnum::SESSION_LOCATION_ID);
            return $next($request);
        });
    }

    public function index()
    {
        $page_title = "Tentative Bookings";
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Tentative Bookings' => '',
        ]);

        $data = $this->model->where('location_id', $this->location)
            ->orderBy('created_at', 'DESC')->get();

        return view('dashboard.marquee.tentative-booking.index', compact('page_title', 'breadcrumbs', 'data'));
    }

    public function create()
    {
        $page_title = "New Tentative Booking";
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Tentative Bookings' => route('dashboard.marquee.tentative-booking.index'),
            'New Tentative Booking' => ''
        ]);

        $bookingNumber = Prefixes::generateNumber('TB');
        $event_areas = $this->eventArea->where('location_id', $this->location)->orderBy('name', 'ASC')->pluck('name', 'id');
        return view('dashboard.marquee.tentative-booking.create', compact('page_title','breadcrumbs', 'bookingNumber', 'event_areas'));
    }

    public function store(Request $request)
    {
        $this->model = $this->model->create($request->all());
        if ($this->model) {
            $this->model->location_id = $this->location;
            $this->model->created_by = auth()->user()->id;
            $this->model->save();
            Prefixes::updateNumber('TB');

            if ($request->doPrint == 1) {
                return redirect()->route('dashboard.marquee.tentative-booking.show',$this->model->id);
            } else {
                return redirect()->route('dashboard.marquee.tentative-booking.index')->with('success', 'Tentative booking saved successfully');
            }
        }
    }

    public function show($id)
    {
        abort(404);
    }

    public function edit($id)
    {
        $model = $this->model->where('location_id', $this->location)->findorFail($id);
        $page_title = "Modify Tentative Booking";
        $breadcrumbs = collect([
            'Dashboard' => route('dashboard'),
            'Tentative Bookings' => route('dashboard.marquee.tentative-booking.index'),
            'Modify Tentative Booking' => ''
        ]);

        $bookingNumber = $model->tentative_number;
        $event_areas = $this->eventArea->where('location_id', $this->location)->orderBy('name', 'ASC')->pluck('name', 'id');
        return view('dashboard.marquee.tentative-booking.edit', compact('page_title','breadcrumbs', 'bookingNumber', 'event_areas', 'model'));
    }

    public function update(Request $request, $id)
    {
        $this->model->where('location_id', $this->location)->findorFail($id)->update($request->all());

        $this->model = $this->model->where('location_id', $this->location)->find($id);
        $this->model->updated_by = auth()->user()->id;
        $this->model->save();

        if ($request->doPrint == 1) {
            return redirect()->route('dashboard.marquee.tentative-booking.show',$this->model->id);
        } else {
            return redirect()->route('dashboard.marquee.tentative-booking.index')->with('success', 'Tentative booking updated successfully');
        }
    }

    public function destroy($id)
    {
        $this->model = $this->model->where('location_id', $this->location)->findorFail($id);
        if ($this->model) {
            $this->model->delete();
        }
        return redirect()->route('dashboard.marquee.tentative-booking.index')->with('success', 'Tentative booking removed successfully');
    }

    public function checkBookingAvailable(Request $request) {
        $output = ['success' => false, 'msg' => __('accounts.message.sortBy')];

        if ($request->ajax() && $request->isMethod('post')) {
            $bookingDate = Carbon::parse($request->date);
            $bookingTime = $request->time;
            $tentativeRecord = $request->has('tentative') ? $request->tentative : 0;
            $bookingRecord = $request->has('booking') ? $request->booking : 0;

            $booking = $this->model->where('location_id', $this->location)
                ->where('event_date', $bookingDate)
                ->where('event_time', $bookingTime)
                ->whereDate('created_at', '>=', Carbon::today()->subDays(2)->toDateString())
                ->whereDate('created_at', '<=', Carbon::today()->toDateString())
                ->where('id', '!=', $tentativeRecord)
                ->first();

            if ($booking) {
                $output['msg'] = 'On selected date and time a tentative booking already exists.';
            } else {
                $booking = Booking::where('location_id', $this->location)
                    ->where('event_date', $bookingDate)
                    ->where('event_time', $bookingTime)
                    ->where('status', 2)
                    ->where('id', '!=', $bookingRecord)
                    ->first();
                if ($booking) {
                    $output['msg'] = 'On selected date and time an event booking already exists.';
                } else {
                    $output = ['success' => true, 'msg' => ''];
                }
            }
        }

        return $output;
    }
}
