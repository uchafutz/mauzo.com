<?php 
namespace App\Enum;

enum AccountStatusEnum:String{

  case ACTIVE ="active";
  case INACTIVE="disabled";
  case BLOCKED="blocked";

}