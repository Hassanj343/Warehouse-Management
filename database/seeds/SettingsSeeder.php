<?php
use App\Models\ApplicationSetting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{

    public function run()
    {
        $settings = array(
            'general-tax-rate' => '20',
            'general-currency' => 'GB',
            'warning-level-1' => '35',
            'warning-level-2' => '25',
            'warning-level-3' => '15',
            'refund-policy' => 'Refund Policy',
            'privacy-policy' => 'Privacy Policy',
            'store-tos' => 'Store Terms & Conditions',
            'company-name' => 'Dummy Company Name',
            'company-address' => 'Dummay Street Address',
            'company-postcode' => 'Dummy Postcode',
            'company-country' => 'United Kingdom',
            'company-contact' => '01234 5678901',
            'company-email' => 'info@example.com',
            'company-city' => 'London',
        );
        foreach ($settings as $key => $value) {
            $setting = ApplicationSetting::firstOrNew([
                'key' => $key
            ]);
            $setting->value = $value;
            $setting->save();
        }

    }

}
