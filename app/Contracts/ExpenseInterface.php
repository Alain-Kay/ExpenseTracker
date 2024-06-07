<?php

namespace App\Contracts;

interface ExpenseInterface
{

    public function getExpenses();
    public function createExpense(array $data);
    public function updateExpense($id, array $data);
    public function deleteExpense($id);

}