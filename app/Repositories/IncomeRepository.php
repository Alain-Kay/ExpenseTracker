<?php

namespace App\Http\Repository;

use App\Models\Income;

class IncomeRepository implements IncomeRepositoryInteface
{
    /**
     * Retrieve all incomes.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getIncomes()
    {
       return Income::all();
    }

     /**
     * Create a new income with the provided data.
     * 
     * @param array $data The data for the income to be created.
     * @return \App\Models\Income
     */
    public function createIncome(array $data)
    {
        return Income::create($data);
    }

    /**
     * Update an existing income with new data.
     * 
     * @param array $data The new data for the income.
     * @param int $id The ID of the income to update.
     * @return \App\Models\Income|null
     */
    public function updateIncome(array $data, $id)
    {
        $income = Income::find($id);
        if ($income) {
            $income->update($data);
            return $income;
        }
        return null;
    }


     /**
     * Delete an income by its ID.
     * 
     * @param int $id The ID of the income to delete.
     * @return bool
     */
    public function deleteIncome($id)
    {
        $income = Income::find($id);
        if ($income) {
          $income->delete($id);
          return true;
        }
        return false;
    }


    /**
     * Find an income by its ID.
     * 
     * @param int $id The ID of the income to find.
     * @return \App\Models\Income|null
     */
    public function findIncome($id)
    {
        return Income::find($id);
    }
}
