<?php

namespace App\Policies;

use App\{User, Post};
use Illuminate\Auth\Access\HandlesAuthorization;

class OldPostPolicy
{
    use HandlesAuthorization;

    public function updatePost (User $user, Post $post) {
        return $user->owns($post);
    }

    public function deletePost (User $user, Post $post) {
        return $user->owns($post) && !$post->isPublished();
    }
}
