<?php

namespace App\Repositories\V1;

use App\Models\User;

/**
 * Class AuthRepository.
 */
class AuthRepository
{
    /**
     * @var user
     */
    protected $user;

    /**
     * AuthRepository constructor.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Get all users.
     *
     * @return User $user
     */
    public function getAll()
    {
        return $this->user->get();
    }

    /**
     * Save User
     *
     * @param $data
     * @return User
     */
    public function save($data)
    {
        $user = new $this->user;

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);

        $user->save();
        return $user->fresh();
    }

    /**
     * Save User
     *
     * @param $data
     * @return User
     */
    public function authenticate($data)
    {
        $user = new $this->user;

        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = bcrypt($data['password']);

        $user->save();
        return $user->fresh();
    }

    /**
     * Update User
     *
     * @param $data
     * @return User
     */
    public function update($data, $id)
    {
    
        $post = $this->user->find($id);
    
        $post->gain = $data['gain'];
        $post->total_amount = $total;
    
        $post->update();

        return $post;
    }

    
    /**
     * Get post by id
     *
     * @param $id
     * @return mixed
     */
    public function userById($id)
    {
        return $this->user
            ->where('id', $id)
            ->get();
    }
}
