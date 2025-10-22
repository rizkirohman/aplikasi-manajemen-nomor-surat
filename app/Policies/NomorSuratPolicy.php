<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\NomorSurat;
use Illuminate\Auth\Access\HandlesAuthorization;

class NomorSuratPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('ViewAny:NomorSurat');
    }

    public function view(AuthUser $authUser, NomorSurat $nomorSurat): bool
    {
        return $authUser->can('View:NomorSurat');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('Create:NomorSurat');
    }

    public function update(AuthUser $authUser, NomorSurat $nomorSurat): bool
    {
        return $authUser->can('Update:NomorSurat');
    }

    public function delete(AuthUser $authUser, NomorSurat $nomorSurat): bool
    {
        return $authUser->can('Delete:NomorSurat');
    }

    public function restore(AuthUser $authUser, NomorSurat $nomorSurat): bool
    {
        return $authUser->can('Restore:NomorSurat');
    }

    public function forceDelete(AuthUser $authUser, NomorSurat $nomorSurat): bool
    {
        return $authUser->can('ForceDelete:NomorSurat');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('ForceDeleteAny:NomorSurat');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('RestoreAny:NomorSurat');
    }

    public function replicate(AuthUser $authUser, NomorSurat $nomorSurat): bool
    {
        return $authUser->can('Replicate:NomorSurat');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('Reorder:NomorSurat');
    }

}