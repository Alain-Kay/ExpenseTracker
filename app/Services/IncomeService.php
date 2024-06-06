<?php

namespace App\Services;
use App\Repositories\IncomeRepository;

class IncomeService
{
    protected $incomeRepository;

    public function __construct(IncomeRepository $incomeRepository)
    {
        $this->incomeRepository = $incomeRepository;
    }

    /**
     * Retrieve all incomes.
     * 
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getAllIncomes()
    {
        return $this->incomeRepository->getIncomes();
    }

    /**
     * Create a new income with the provided data.
     * 
     * @param array $data The data for the income to be created.
     * @return \App\Models\Income
     */
    public function createNewIncome(array $data)
    {
        return $this->incomeRepository->createIncome($data);
    }

    /**
     * Update an existing income with new data.
     * 
     * @param array $data The new data for the income.
     * @param int $id The ID of the income to update.
     * @return \App\Models\Income|null
     */
    public function updateExistingIncome(array $data, $id)
    {
        return $this->incomeRepository->updateIncome($data, $id);
    }

    /**
     * Delete an income by its ID.
     * 
     * @param int $id The ID of the income to delete.
     * @return bool
     */
    public function deleteIncomeById($id)
    {
        return $this->incomeRepository->deleteIncome($id);
    }

    /**
     * Find an income by its ID.
     * 
     * @param int $id The ID of the income to find.
     * @return \App\Models\Income|null
     */
    public function findIncomeById($id)
    {
        return $this->incomeRepository->findIncome($id);
    }
}
