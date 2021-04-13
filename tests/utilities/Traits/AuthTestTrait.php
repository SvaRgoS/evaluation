<?php

namespace Tests\utilities\Traits;

use App\Models\User;

trait AuthTestTrait
{

    protected function signInAsWriter()
    {
        return $this->signInAs('Writer');
    }

    private function signInAs($role = null)
    {
        return $this->loginAs(
            $this->getUserByRole($role)
        );
    }

    /**
     * @param string $role
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Model
     */
    protected function getUserByRole($role = 'Reader')
    {
        $user = User::with('role')
            ->whereHas('role', function ($q) use ($role) {
                $q->where('name', $role);
            })->firstOrFail();
        return $user;
    }

    protected function signInAsRedactor()
    {
        return $this->signInAs('Redactort');
    }

    protected function signInAsReader()
    {
        return $this->signInAs('Reader');
    }

}
