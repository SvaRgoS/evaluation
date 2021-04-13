<?php

namespace Tests\utilities\Traits;

use App\Models\User;
use Illuminate\Http\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\JWT;

trait AttachJwtToken
{
    /**
     * @var User
     */
    protected $loginUser;

    /**
     * @param User $user
     * @return $this
     */
    public function loginAs(User $user)
    {
        $this->loginUser = $user;
        return $this;
    }


    /**
     * @param array $server
     * @return array
     */
    protected function attachToken(array $server)
    {
        return array_merge($server, $this->transformHeadersToServerVars([
            'Authorization' => 'Bearer ' . $this->getJwtToken(),
        ]));
    }

    /**
     * @return string
     */
    protected function getJwtToken()
    {
        JWTAuth::unsetToken();
        return JWTAuth::fromUser($this->loginUser);
    }
}
