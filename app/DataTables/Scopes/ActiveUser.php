<?php

namespace App\DataTables\Scopes;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Contracts\DataTableScope;

class ActiveUser implements DataTableScope
{
    /**
     * Apply a query scope.
     *
     * @param \Illuminate\Database\Query\Builder|\Illuminate\Database\Eloquent\Builder $query
     * @return mixed
     */
    public function apply($query)
    {
        $reporter_id = Session::get('reporter_id');
        return $query->where('reporter_id', $reporter_id);
    }
}
