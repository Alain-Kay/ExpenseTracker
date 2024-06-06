<?php

namespace App\Contracts;

interface IncomeInterface
{
    public function getIncomes();

    public function createIncome(array $data);

    public function updateIncome(array $data, $id);

    public function deleteIncome($id);

    public function findIncome($id);

}