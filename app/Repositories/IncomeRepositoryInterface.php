<?php

namespace App\Http\Repository;

interface IncomeRepositoryInteface
{
    public function getIncomes();

    public function createIncome(array $data);

    public function updateIncome(array $data, $id);

    public function deleteIncome($id);

    public function findIncome($id);

}