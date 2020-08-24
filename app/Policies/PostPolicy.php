<?php

namespace App\Policies;

use App\{User, Post};
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    public function update (User $user, Post $post) {
        return $user->owns($post);
    }

    public function delete (User $user, Post $post) {
        return $user->owns($post) && !$post->isPublished();
    }
}
