<?php

use Illuminate\Support\Facades\Request;

if (! function_exists('paginationNumber')) {
   function paginationNumber($pagination = 0) {
      return (request()->input('page', 1) - 1) * $pagination;
   }
}
