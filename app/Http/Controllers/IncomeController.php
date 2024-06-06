<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Services\IncomeService;
use Illuminate\Support\Facades\Validator;

class IncomeController extends Controller
{
    public function __construct(
        protected IncomeService $incomeService
    ) {
    }

    public function index()
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

    public function store(Request $request)
    {
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

        $this->incomeService->createNewIncome($validatedData);

        return response()->json([
            'message' => 'Income created successfully',
            'response' => 'success',
        ]);
    }

    public function update(Request $request, $id)
    {
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
    
        $updatedIncome = $this->incomeService->updateExistingIncome($validatedData, $id);
    
        if ($updatedIncome) {
            return response()->json([
                'message' => 'Income updated successfully',
                'response' => 'success',
            ], Response::HTTP_OK);
        }
    
        return response()->json([
            'message' => 'Income not found or could not be updated',
        ], Response::HTTP_NOT_FOUND);
    }
    
    public function delete($id)
    {
        $deleted = $this->incomeService->deleteIncomeById($id);

        if ($deleted) {
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
