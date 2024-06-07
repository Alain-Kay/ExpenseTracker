<?php

namespace App\Services;

use App\Repositories\ExpenseRepository;
use Illuminate\Support\Arr;

class ExpenseService
{
    public function __construct(
        protected ExpenseRepository $expenseRepository
    ) {
    }

    
    /**
     * Retrieve all expense.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllExpenses()
    {
        return $this->expenseRepository->getExpenses();
    }

     /**
     * Create a new expense with the provided data.
     * 
     * @param array $data The data for the expense to be created.
     * @return \App\Models\Expense
     */
    public function createNewExpense(array $data)
    {
        return $this->expenseRepository->createExpense($data);
    }

    /**
     * Update an existing expense with new data.
     * 
     * @param array $data The new data for the expense.
     * @param int $id The ID of the expense to update.
     * @return \App\Models\Expense|null
     */
    public function updateExistingExpense($id, array $data)
    {
        return $this->expenseRepository->updateExpense($id, $data);
    }

     /**
     * Delete an expense by its ID.
     * 
     * @param int $id The ID of the expense to delete.
     * @return bool
     */
    public function deleteExpense($id)
    {
        return $this->expenseRepository->deleteExpense($id);
    }
}
