<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class InvoicePolicy
{
    use HandlesAuthorization;

    public function viewAny(User $user) {
        //
    }

    public function view(User $user) {
        return $user->ability('view_sale');
    }

    public function create(User $user) {
        return $user->ability('create_sale');
    }

    public function edit(User $user) {
        return $user->ability('edit_sale');
    }

    public function delete(User $user) {
        return $user->ability('delete_sale');
    }

    public function viewInvoice(User $user) {
        return $user->ability('view_sale_invoice');
    }

    public function pos(User $user) {
        return $user->ability('pos_sale');
    }
}
