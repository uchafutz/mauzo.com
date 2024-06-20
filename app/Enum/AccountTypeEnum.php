<?php

namespace App\Enum;

enum AccountTypeEnum:string{

    case WITHDRAW_ACCOUNT ="credit";
    case DEPOSIT_ACCOUNT ="debit";
}
