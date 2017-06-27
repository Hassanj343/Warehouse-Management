<?php namespace App\Http\Controllers\Application_Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use App\Models;

class GlobalSettingsController extends Controller
{

    private $generalFields = array(
        'general-tax-rate', 'general-currency',
        'warning-level-1', 'warning-level-2', 'warning-level-3',
        'refund-policy', 'privacy-policy', 'store-tos'
    );

    public function index()
    {

        return view('pages.settings.index')->with('data', $this->getSettings($this->generalFields));
    }

    private function getSettings($fields)
    {
        $data = array();
        foreach ($fields as $key) {
            $setting = Models\Settings::where('name', '=', $key)->get()->first();
            $data[$key] = $setting->value;
        }
        return $data;

    }

    private function createUpdate($name, $value)
    {
        $settings = Models\Settings::where('name', '=', $name)->get()->first();
        if ( ! empty($settings) && ! is_null($settings)) {
            $settings->update(array('value' => $value));
        } else {
            $settings = new Models\Settings(array('name' => $name, 'value' => $value));
        }
        return $settings->save();

    }

    public function update(Request $request)
    {

        $inputs = array(
            'Tax Rate' => $request->get('general-tax-rate'),
            'Currency' => $request->get('general-currency'),
            'Warning Level 1' => $request->get('warning-level-1'),
            'Warning Level 2' => $request->get('warning-level-2'),
            'Warning Level 3' => $request->get('warning-level-3'),
        );
        $options = array(
            'Tax Rate' => 'required',
            'Currency' => 'required',
            'Warning Level 1' => 'required',
            'Warning Level 2' => 'required',
            'Warning Level 3' => 'required',
        );
        $validator = \Validator::make($inputs, $options);
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
            foreach ($this->generalFields as $key) {
                if ($this->createUpdate($key, $request->get($key))) {
                    continue;
                }
            }
            return response(array(
                'result' => 'success',
                'message' => 'Settings updated successfully'
            ));
        }

        return response(array(
            'result' => 'error',
            'message' => \Lang::get('messages.general-error')
        ));
    }


}
