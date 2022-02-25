<?php

namespace App\Http\Controllers\Marquee;

use App\Http\Controllers\Controller;
use App\Models\Marquee\SeatPlanning;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SeatPlanningController extends Controller
{
    public $model;

    public function __construct()
    {
        $this->model = new SeatPlanning();
    }

    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View|Response
     */
    public function index()
    {
        $data = $this->model->get();
        $page_title = 'All Seating Plannings';
        $breadcrumbs = [['text' => 'All Users']];
        $viewParams = [
            'data' => $data,
            'breadcrumbs' => $breadcrumbs,
            'page_title' => $page_title
        ];
        return view('dashboard.marquee.seat-plannings.index', $viewParams);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View|Response
     */
    public function create()
    {
        $page_title = 'Create New Seating Planning';
        $breadcrumbs = [['text' => $page_title]];
        $viewParams = [
            'breadcrumbs' => $breadcrumbs,
            'page_title' => $page_title
        ];

        return view('dashboard.marquee.seat-plannings.create', $viewParams);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'unique:seat_plannings,name',
        ]);
        $this->model = $this->model->create($request->all());
        if ($this->model) {
            return redirect()->route('dashboard.marquee.seat-plannings.index')
                ->with('success', 'Seat Planning is Created Successfully.');
        }

    }

    /**
     * @param Request $request
     * @param $id
     * @return Application|Factory|View
     */
    public function edit(Request $request, $id)
    {
        $model = $this->model->find($id);
        $page_title = 'Edit ' . $model->name;
        $breadcrumbs = [['text' => $page_title]];
        $viewParams = [
            'breadcrumbs' => $breadcrumbs,
            'page_title' => $page_title,
            'model' => $model,
        ];

        return view('dashboard.marquee.seat-plannings.edit', $viewParams);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $this->model->find($id)->update($request->all());
        $this->model = $this->model->find($id);
        $request->validate([
            'name' => 'nullable|max:255|unique:seat_plannings,name,' . $id
        ]);
        return redirect()->route('dashboard.marquee.seat-plannings.index')
            ->with('success', 'Seat Planning updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function destroy(int $id)
    {
        $this->model = $this->model->find($id);
        if ($this->model) {
            $this->model->delete();
            return \view('dashboard.marquee.seat-plannings.index')
                ->with('success', 'Seat Planning Deleted successfully');
        }
    }


}
