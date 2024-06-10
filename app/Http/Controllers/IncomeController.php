<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\IncomeService;
use Illuminate\Support\Facades\Validator;

class IncomeController extends Controller
{
    /**
     * Constructor to initialize the IncomeService.
     *
     * @param IncomeService $incomeService
     */
    public function __construct(
        protected IncomeService $incomeService
    ) {
    }

    /**
     * Retrieve all incomes.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getIncommes()
    {
        $incomes = $this->incomeService->getAllIncomes();

        if ($incomes->isEmpty()) {
            return response()->json([
                'message' => 'No incomes found',
                'incomes' => [],
            ], Response::HTTP_NOT_FOUND);
        }

        return response()->json([
            'incomes' => $incomes,
        ], Response::HTTP_OK);
    }

    /**
     * Create a new income.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createNewIncome(Request $request)
    {
        // Validate the request data
        $validation = Validator::make(
            $request->only(
                'income_category_id',
                'income_currency_id',
                'income_title',
                'income_source',
                'income_description',
                'income_amount',
                'income_date'
            ),
            [
                'income_category_id' => 'required',
                'income_currency_id' => 'required',
                'income_title' => 'required',
                'income_source' => 'required',
                'income_description' => 'nullable',
                'income_amount' => 'required',
                'income_date' => 'nullable',
            ]
        );

        if ($validation->fails()) {
            return response()->json(
                $validation->errors(),
                Response::HTTP_BAD_REQUEST
            );
        }

        // Get the validated data
        $validatedData = $validation->validated();
        $income = $this->incomeService->createNewIncome($validatedData);

        return response()->json([
            'message' => 'Income created successfully',
            'income' => $income,
            'response' => 'success',
        ]);
    }

    /**
     * Update an existing income.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateIncome(Request $request, $id)
    {
        // Validate the request data
        $validation = Validator::make(
            $request->only(
                'income_category_id',
                'income_currency_id',
                'income_title',
                'income_source',
                'income_description',
                'income_amount',
                'income_date'
            ),
            [
                'income_category_id' => 'required',
                'income_currency_id' => 'required',
                'income_title' => 'required',
                'income_source' => 'required',
                'income_description' => 'nullable',
                'income_amount' => 'required',
                'income_date' => 'nullable',
            ]
        );

        if ($validation->fails()) {
            return response()->json(
                $validation->errors(),
                Response::HTTP_BAD_REQUEST
            );
        }

        $validatedData = $validation->validated();
        $income = $this->incomeService->updateExistingIncome($validatedData, $id);

        if ($income) {
            return response()->json([
                'message' => 'Income updated successfully',
                'response' => 'success',
            ], Response::HTTP_OK);
        }

        return response()->json([
            'message' => 'Income not found or could not be updated',
        ], Response::HTTP_NOT_FOUND);
    }

    /**
     * Delete an existing income.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteIncome($id)
    {
        $income = $this->incomeService->deleteIncomeById($id);
        if ($income) {
            return response()->json([
                'message' => 'Income deleted successfully',
                'response' => 'success',
            ], Response::HTTP_OK);
        }

        return response()->json([
            'message' => 'Income not found or could not be deleted',
        ], Response::HTTP_NOT_FOUND);
    }
}
