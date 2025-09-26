<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Mahasiswa;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Overtrue\LaravelSaml\Saml;
use Illuminate\Support\Str;

class SsoController extends Controller
{
    // Sesuaikan dengan aplikasi Anda
    private $afterLoginRoute = 'dashboard';
    private $afterLogoutRoute = 'home';

    public function login() {
        if (Auth::check()) {
            return redirect()->route($this->afterLoginRoute);
        }

        return Saml::redirect();
    }

    public function acs(Request $request)
    {
        // Overtrue\LaravelSaml\SamlUser
        $samlUser = Saml::getAuthenticatedUser();

        $parsedAttributes = $this->parseSamlAttributes($samlUser->getAttributes());
        $user = User::where('email', $parsedAttributes['email'])->first();

        if (!$user) {
            // Create new user if doesn't exist
            $user = new User([
                'email' => $parsedAttributes['email'],
                'name' => $parsedAttributes['nama'],
                'no_hp' => $this->formatPhoneNumber($parsedAttributes['no_hp']),
                'verified' => 1,
                'approved'  => 1,
                'verified_at' => now()->format('d-m-Y H:i:s'),
                'email_verified_at' => now()->format('d-m-Y H:i:s'),
                'password' => bcrypt(random_int(1000000, 99999999)),
                'username' => $parsedAttributes['username'],
                'level' => $parsedAttributes['level'],
                'identity_number' => $parsedAttributes['identity_numbers'],
                'alamat' => $parsedAttributes['alamat'],
                'verification_token' => null, // Prevent email notification for SSO users
            ]);
            
            // Set a flag to indicate this is SSO creation
            $user->sso_creation = true;
            $user->save();
            
            // Sync roles for new user
            $user->roles()->sync(2);

            if($parsedAttributes['level'] == 'student') {
                $mahasiswa = Mahasiswa::updateOrCreate(
                    [
                        'user_id' => $user->id,
                        'nim' => $parsedAttributes['identity_numbers'],
                    ],
                    [
                        'angkatan' => '20'. substr($parsedAttributes['identity_numbers'], 3, 2),
                        'jurusan' => substr($parsedAttributes['identity_numbers'], 1, 2),
                    ]
                );
            }

        } else {
            // For existing user, only update empty fields
            $fieldsToUpdate = [];
            
            if (empty($user->name) && !empty($parsedAttributes['nama'])) {
                $fieldsToUpdate['name'] = $parsedAttributes['nama'];
            }
            
            if (empty($user->no_hp) && !empty($parsedAttributes['no_hp'])) {
                $fieldsToUpdate['no_hp'] = $this->formatPhoneNumber($parsedAttributes['no_hp']);
            }
            
            if (empty($user->username) && !empty($parsedAttributes['username'])) {
                $fieldsToUpdate['username'] = $parsedAttributes['username'];
            }
            
            if (empty($user->alamat) && !empty($parsedAttributes['alamat'])) {
                $fieldsToUpdate['alamat'] = $parsedAttributes['alamat'];
            }
            
            // Only update if there are fields to update
            if (!empty($fieldsToUpdate)) {
                $user->update($fieldsToUpdate);
            }
            // No need to sync roles for existing users
        }
        
        // Login the user
        Auth::login($user);

        // Redirect ke halaman dashboard
        return redirect()->route('frontend.home');
    }

    public function logout(Request $request)
    {
        return Saml::redirectToLogout();
    }

    public function sls(Request $request)
    {
        $auth = Saml::handleLogoutRequest();

        Auth::logout();

        return redirect()->route($this->afterLogoutRoute);
    }

    public function metadata(Request $request)
    {
        if ($request->has('download')) {
            return Saml::getMetadataXMLAsStreamResponse();
        }

        return Saml::getMetadataXML();
    }

    /**
     * Convert SAML attributes (which is a 2 dimensional array) to a 1 dimensional array
    * @param  array  $samlAttributes
    * @return array
    */
    private function parseSamlAttributes(array $samlAttributes) : array {
        $result = [];

        foreach ($samlAttributes as $key => $value) {
            $result[$key] = $value[0];
        }

        return $result;
    }

    private function formatPhoneNumber(string $phone)
    {
        $phone = ltrim($phone, " +");
        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }
        if (in_array(substr($phone, 0, 2), ['81', '82', '83', '85', '88', '89'])) {
            $phone = '62' . $phone;
        }
        return $phone;
    }

    private function verifyFirstCharacter($input) {
        // Check if the input is a non-empty string
        if (is_string($input) && strlen($input) > 0) {
            // Get the first character and check if it's 'P' or 'G'
            $firstChar = strtoupper($input[0]); // Convert to uppercase to ensure case insensitivity
            if ($firstChar === 'P' || $firstChar === 'G') {
                return true;
            }
        }
        return false;
    }
}
