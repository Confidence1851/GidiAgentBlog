<?php

namespace App\Repositories\Interfaces;

interface UserRepositoryInterface
{
    /**
     * Get's logged in User
     *
     * @param int
     */
    public function user();


    /**
     * Get's a post by it's ID
     *
     * @param int
     */
    public function get($user_id);

    /**
     * Get's all posts.
     *
     * @return mixed
     */
    public function all();

    /**
     * Deletes a post.
     *
     * @param int
     */
    public function delete($user_id);

    /**
     * Updates a post.
     *
     * @param int
     * @param array
     */
    public function update($user_id, array $user_data);
}
