<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
</head>
<body>
<div>
    <p>
        <a href="{{url('api/accounts')}}" target="_blank">
            Accounts ({{App\Models\Account::count()}})
        </a>
    </p>
    <p>
        <a href="{{url('api/expense-categories')}}" target="_blank">
            Expense Categories ({{App\Models\ExpenseCategory::count()}})
        </a>
    </p>
    <p>
        <a href="{{url('api/income-categories')}}" target="_blank">
            Income Categories ({{App\Models\IncomeCategory::count()}})
        </a>
    </p>
    <p>
        <a href="{{url('api/transactions')}}" target="_blank">
            Transactions ({{App\Models\Transaction::count()}})
        </a>
    </p>
</div>
</body>
</html>
