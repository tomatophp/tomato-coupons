<?php

namespace TomatoPHP\TomatoCoupons\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use TomatoPHP\TomatoAdmin\Facade\Tomato;

class GiftCardController extends Controller
{
    public string $model;

    public function __construct()
    {
        $this->model = \TomatoPHP\TomatoCoupons\Models\GiftCard::class;
    }

    /**
     * @param Request $request
     * @return View|JsonResponse
     */
    public function index(Request $request): View|JsonResponse
    {
        return Tomato::index(
            request: $request,
            model: $this->model,
            view: 'tomato-coupons::gift-cards.index',
            table: \TomatoPHP\TomatoCoupons\Tables\GiftCardTable::class
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function api(Request $request): JsonResponse
    {
        return Tomato::json(
            request: $request,
            model: \TomatoPHP\TomatoCoupons\Models\GiftCard::class,
        );
    }

    /**
     * @return View
     */
    public function create(): View
    {
        return Tomato::create(
            view: 'tomato-coupons::gift-cards.create',
        );
    }

    /**
     * @param Request $request
     * @return RedirectResponse|JsonResponse
     */
    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $response = Tomato::store(
            request: $request,
            model: \TomatoPHP\TomatoCoupons\Models\GiftCard::class,
            validation: [
                            'account_id' => 'nullable|exists:accounts,id',
            'name' => 'required|max:255|string',
            'code' => 'required|max:255|string',
            'balance' => 'nullable',
            'currency' => 'nullable|max:255|string',
            'is_activated' => 'nullable',
            'is_expired' => 'nullable'
            ],
            message: __('GiftCard updated successfully'),
            redirect: 'admin.gift-cards.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }

    /**
     * @param \TomatoPHP\TomatoCoupons\Models\GiftCard $model
     * @return View|JsonResponse
     */
    public function show(\TomatoPHP\TomatoCoupons\Models\GiftCard $model): View|JsonResponse
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-coupons::gift-cards.show',
        );
    }

    /**
     * @param \TomatoPHP\TomatoCoupons\Models\GiftCard $model
     * @return View
     */
    public function edit(\TomatoPHP\TomatoCoupons\Models\GiftCard $model): View
    {
        return Tomato::get(
            model: $model,
            view: 'tomato-coupons::gift-cards.edit',
        );
    }

    /**
     * @param Request $request
     * @param \TomatoPHP\TomatoCoupons\Models\GiftCard $model
     * @return RedirectResponse|JsonResponse
     */
    public function update(Request $request, \TomatoPHP\TomatoCoupons\Models\GiftCard $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::update(
            request: $request,
            model: $model,
            validation: [
                            'account_id' => 'nullable|exists:accounts,id',
            'name' => 'sometimes|max:255|string',
            'code' => 'sometimes|max:255|string',
            'balance' => 'nullable',
            'currency' => 'nullable|max:255|string',
            'is_activated' => 'nullable',
            'is_expired' => 'nullable'
            ],
            message: __('GiftCard updated successfully'),
            redirect: 'admin.gift-cards.index',
        );

         if($response instanceof JsonResponse){
             return $response;
         }

         return $response->redirect;
    }

    /**
     * @param \TomatoPHP\TomatoCoupons\Models\GiftCard $model
     * @return RedirectResponse|JsonResponse
     */
    public function destroy(\TomatoPHP\TomatoCoupons\Models\GiftCard $model): RedirectResponse|JsonResponse
    {
        $response = Tomato::destroy(
            model: $model,
            message: __('GiftCard deleted successfully'),
            redirect: 'admin.gift-cards.index',
        );

        if($response instanceof JsonResponse){
            return $response;
        }

        return $response->redirect;
    }
}
