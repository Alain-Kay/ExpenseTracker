<?php

namespace App\Repositories;

use App\Contracts\ExpenseInterface;
use App\Models\Expense;

class ExpenseRepository implements ExpenseInterface
{
     /**
     * Retrieve all expense.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getExpenses()
    {
        return Expense::all();
    }

      /**
     * Create a new expense with the provided data.
     * 
     * @param array $data The data for the expense to be created.
     * @return \App\Models\Expense
     */
    public function createExpense(array $data)
    {
        return Expense::create($data);
    }

     /**
     * Update an existing expense with new data.
     * 
     * @param array $data The new data for the expense.
     * @param int $id The ID of the expense to update.
     * @return \App\Models\Expense|null
     */
    public function updateExpense($id, array $data)
    {
        $expense = Expense::find($id);
        if ($expense) {
            $expense->update($data);
            return $expense;
        }
        return null;
    }

    
     /**
     * Delete an Expense by its ID.
     * 
     * @param int $id The ID of the expense to delete.
     * @return bool
     */
    public function deleteExpense($id)
    {
        $expense = Expense::find($id);
        if ($expense) {
            $expense->delete();
            return true;
        }
        return false;
    }
}
