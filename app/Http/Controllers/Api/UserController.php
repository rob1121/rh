<?php namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\RH\Traits\UserTransformer;
use App\User;

class userController extends Controller
{
    use UserTransformer;

    public function __construct()
    {
        $this->middleware("auth");
    }

    /**
     * return users list
     *
     * @return mixed
     */
    public function index()
    {
        $this->initializeMacro();
        return User::all()->userTransformer();
    }

    /**
     * add new user
     *
     * @param UserRequest $request
     * @return User
     */
    public function store(UserRequest $request)
    {
        $instance = User::instance($request->all());
        $instance['password'] = $this->generatePassword($instance['password']);
        $user = User::create($instance);
        $user->config()->create([]);
        
        return $user;
    }

    /**
     * update user's info from database
     *
     * @param UserRequest $request
     * @param User $user
     * @return User
     */
    public function update(UserRequest $request, User $user)
    {
        $instance = User::instance($request->all());

        if($this->willChangePassword($request)) $instance['password'] = $this->generatePassword($instance['password']);
        else $instance = $this->removePasswordFrom($instance);

        $user->update($instance);
        return $user;
    }

    /**
     * delete user from database
     *
     * @param User $user
     */
    public function destroy(User $user)
    {
        $user->delete();
    }

    /**
     * encrypt password
     *
     * @param $password
     * @return string
     * @internal param $instance
     */
    private function generatePassword($password)
    {
        return bcrypt($password);
    }

    /**
     * remove password from array instance
     *
     * @param array $instance
     * @return mixed
     */
    private function removePasswordFrom(array $instance)
    {
        array_pull($instance, "password");
        return $instance;
    }

    /**
     * if old_password has value means user want to change password
     *
     * @param UserRequest $request
     * @return mixed
     */
    private function willChangePassword(UserRequest $request)
    {
        return $request->old_password;
    }
}
