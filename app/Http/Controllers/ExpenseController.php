<?php

namespace App\Http\Controllers;

use App\Services\ExpenseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ExpenseController extends Controller
{
    /**
     * Constructor to initialize the ExpenseService.
     *
     * @param ExpenseService $expenseService
     */
    public function __construct(
        protected ExpenseService $expenseService
    ) {
    }

    /**
     * Retrieve all expenses.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function getExpenses(): JsonResponse
    {
        // Retrieve all expenses using the expense service
        $expenses = $this->expenseService->getAllExpenses();

        // Check if expenses are empty and return a 404 response if true
        if ($expenses->isEmpty()) {
            return response()
                ->json([
                    'message' => 'No expenses found',
                    'expenses' => []
                ], Response::HTTP_NOT_FOUND);
        }

        return response()
            ->json([
                'message' => 'Expenses retrieved successfully',
                'response' => 'success',
                'expenses' => $expenses
            ], Response::HTTP_OK);
    }

    /**
     * Create a new expense.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function createNewExpense(Request $request): JsonResponse
    {
        // Validate the request data
        $validation = Validator::make(
            $request->only(
                'expense_category_id',
                'expense_currency_id',
                'expense_title',
                'expense_description',
                'expense_amount',
                'expense_date'
            ),
            [
                'expense_category_id' => 'required|integer',
                'expense_currency_id' => 'required|integer',
                'expense_title' => 'required|string',
                'expense_description' => 'required|string',
                'expense_amount' => 'required|numeric',
                'expense_date' => 'required|date'
            ]
        );

        if ($validation->fails()) {
            return response()
                ->json([
                    $validation->errors(),
                    Response::HTTP_BAD_REQUEST
                ]);
        }

        $validatedData = $validation->validated();
        $expense = $this->expenseService->createNewExpense($validatedData);

        return response()
            ->json([
                'message' => 'Expense created successfully',
                'response' => 'success',
                'expense' => $expense
            ], Response::HTTP_OK);
    }

    /**
     * Update an existing expense.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateExpense(Request $request, $id): JsonResponse
    {
        // Validate the request data
        $validation = Validator::make(
            $request->only(
                'expense_category_id',
                'expense_currency_id',
                'expense_title',
                'expense_description',
                'expense_amount',
                'expense_date'
            ),
            [
                'expense_category_id' => 'required|integer',
                'expense_currency_id' => 'required|integer',
                'expense_title' => 'required|string',
                'expense_description' => 'required|string',
                'expense_amount' => 'required|numeric',
                'expense_date' => 'required|date'
            ]
        );

        if ($validation->fails()) {
            return response()
                ->json([
                    $validation->errors(),
                    Response::HTTP_BAD_REQUEST
                ]);
        }

        $validatedData = $validation->validated();
        $expense = $this->expenseService->updateExistingExpense($id, $validatedData);

        if ($expense) {
            return response()
                ->json([
                    'message' => 'Expense updated successfully',
                    'response' => 'success',
                    'expense' => $expense
                ], Response::HTTP_OK);
        }

        return response()
            ->json([
                'message' => 'Expense not found',
                'response' => 'error'
            ], Response::HTTP_NOT_FOUND);
    }

    /**
     * Delete an existing expense.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function deleteExpense($id)
    {
        $expense = $this->expenseService->deleteExpense($id);
        if ($expense) {
            return response()
                ->json([
                    'message' => 'Expense deleted successfully',
                    'response' => 'success'
                ], Response::HTTP_OK);
        }

        return response()->json([
            'message' => 'Expense not found or could not be deleted',
        ], Response::HTTP_NOT_FOUND);
    }
}
