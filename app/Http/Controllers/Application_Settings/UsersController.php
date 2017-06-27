<?php namespace App\Http\Controllers\Application_settings;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{

    public function index()
    {
        return view('pages.settings.manage-users');
    }

    public function get_create()
    {
        return view('pages.settings.create-user');
    }

    public function post_create()
    {
        $inputs = array(
            'name' => Input::get('name'),
            'email' => Input::get('email'),
            'password' => Input::get('password'),
            'repeat password' => Input::get('repeat_password')
        );
        $requirements = array(
            'name' => 'required',
            'email' => 'required|unique:users|email',
            'password' => 'required|min:6|same:repeat password',
            'repeat password' => 'same:password'
        );
        $validator = Validator::make($inputs, $requirements);
        if ($validator->fails()) {
            $messages = '';
            $err_list = $validator->errors()->all();
            foreach ($err_list as $key => $message) {
                $messages = $messages . $message . '<br />';
            }
            return response(array(
                'result' => 'error',
                'message' => $messages
            ));
        } else {
            $user = User::create(array(
                'name' => Input::get('name'),
                'email' => Input::get('email'),
                'password' => Hash::make(Input::get('password')),
                'role' => Input::get('role'),
                'status' => 'active'
            ));
            if ($user->save()) {
                return response(array(
                    'result' => 'success',
                    'message' => 'Account created successfully',
                    'url' => route('settings-create-user', $user->id),
                ));
            }

        }

        return response(array(
            'result' => 'error',
            'message' => \Lang::get('messages.general-error')
        ));
    }

    public function get_update($id)
    {
        $user = User::find($id);
        if ( ! empty($user) && ! is_null($user)) {
            return view('pages.settings.modify-user', compact('user'));
        }
        return abort(404, 'Page not found!');
    }

    public function post_update($id)
    {
        $user = User::find($id);
        if ( ! empty($user) && ! is_null($user)) {
            $inputs = array(
                'name' => Input::get('name'),
                'email' => Input::get('email'),
                'password' => Input::get('password'),
                'repeat password' => Input::get('repeat_password')
            );
            $requirements = array(
                'name' => 'required',
                'email' => 'required|email',
                'password' => 'min:6|same:repeat password',
                'repeat password' => 'same:password'
            );
            $validator = Validator::make($inputs, $requirements);
            if ($validator->fails()) {
                $messages = '';
                $err_list = $validator->errors()->all();
                foreach ($err_list as $key => $message) {
                    $messages = $messages . $message . '<br />';
                }
                return response(array(
                    'result' => 'error',
                    'message' => $messages
                ));
            } else {
                $user->name = Input::get('name');
                $user->email = Input::get('email');
                $user->role = Input::get('role');
                $password = Input::get('password');
                if ($password != $user->password and ! empty($password)) {
                    $user->password = Hash::make($password);
                }
                if ($user->save()) {
                    return response(array(
                        'result' => 'success',
                        'message' => 'Account updated successfully',
                    ));
                }
            }

            return response(array(
                'result' => 'error',
                'message' => \Lang::get('messages.general-error')
            ));
        }
        return abort(404, 'Page not found!');
    }

    public function get_delete($id)
    {
        $user = User::find($id);
        if ( ! empty($user) && ! is_null($user) && \Auth::user()->isAdmin()) {
            if (User::destroy($id))
                return response(array(
                    'result' => 'success',
                    'message' => 'User ' . $user->name . ' deleted successfully'
                ));
        }
        return abort(404, 'Page not found!');
    }


}
