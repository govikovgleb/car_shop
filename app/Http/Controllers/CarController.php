<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Car;
use Illuminate\Contracts\View\View;

class CarController extends Controller
{
    public function index(Request $request): View
    {
        $cars = Car::all();

        return view('catalog', compact('cars'));
    }

    /**
     * этот метод отвечает за выбор логики фильтрации в зависимости от входных данных.
     * в варианте по умолчанию фильтрует товары по любым параметрам
     * @param Request $filters
     * @return View|\Illuminate\Routing\Redirector|string
     */
    public function filter(Request $filters): View|\Illuminate\Routing\Redirector|string
    {
        $cars = Car::filter($filters->all())->get();
        // вариант при фильтрации по ajax (для типа двигателя и приводу)
        if ($filters->ajax()) {
            return view('ajax.filter-result', compact('cars'))->render();
        }

        // вариант при фильтрации по бренду и моделе
        if (isset($filters['brand'])) {
            return redirect(route('brand_model_filter', ['brand' => $filters['brand'], 'model' => $filters['model']]));
        }

        // вариант без изменений url и ajax
        return view('catalog', compact('cars'));
    }

    /**
     * @param Request $request
     * @param $brand
     * @param null $model
     * @return View
     */
    public function brandFilter(Request $request, $brand, $model = null): View
    {
        // сбор параметров для фильтра из данных реквеста и url
        $filters['brand'] = $brand;
        if ($model) $filters['model'] = $model;
        if ($request->all()) {
            $filters = array_merge($filters, $request->all());
        }

        $cars = Car::filter($filters)->get();

        return view('catalog', compact(['cars', 'brand', 'model']));
    }
}
