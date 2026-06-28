<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanyProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CompanyProfileController extends Controller
{
    /**
     * Halaman Company Profile
     */
    public function index()
    {
        $company = CompanyProfile::first();

        if (!$company) {
            $company = CompanyProfile::create([
                'company_name' => 'BJM AUTO',
            ]);
        }

        return view('admin.company.index', compact('company'));
    }

    /**
     * Update Company Profile
     */
    public function update(Request $request)
    {
        $request->validate([
            'company_name' => 'required|max:255',

            'logo' => 'nullable|file|mimetypes:image/jpeg,image/png,image/webp|max:5120',

            'banner' => 'nullable|file|mimetypes:image/jpeg,image/png,image/webp|max:5120',
        ]);

        $company = CompanyProfile::first();

        if (!$company) {
            $company = CompanyProfile::create([
                'company_name' => 'BJM AUTO',
            ]);
        }

        $data = $request->except([
            'logo',
            'banner',
            '_token',
            '_method',
        ]);

        $uploadPath = public_path('uploads/company');

        if (!File::exists($uploadPath)) {
            File::makeDirectory($uploadPath, 0755, true);
        }

        /*
        |--------------------------------------------------------------------------
        | Upload Logo
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('logo')) {

            if (
                $company->logo &&
                File::exists($uploadPath.'/'.$company->logo)
            ) {
                File::delete($uploadPath.'/'.$company->logo);
            }

            $logo = 'logo_'.time().'.'.$request->logo->getClientOriginalExtension();

            dd([
    'hasFile' => $request->hasFile('logo'),
    'isValid' => $request->file('logo')->isValid(),
    'mime' => $request->file('logo')->getMimeType(),
    'extension' => $request->file('logo')->extension(),
    'clientExtension' => $request->file('logo')->getClientOriginalExtension(),
    'error' => $request->file('logo')->getError(),
]);

            $request->logo->move(
                $uploadPath,
                $logo
            );

            $data['logo'] = $logo;
        }

        /*
        |--------------------------------------------------------------------------
        | Upload Banner
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('banner')) {

            if (
                $company->banner &&
                File::exists($uploadPath.'/'.$company->banner)
            ) {
                File::delete($uploadPath.'/'.$company->banner);
            }

            $banner = 'banner_'.time().'.'.$request->banner->getClientOriginalExtension();

            $request->banner->move(
                $uploadPath,
                $banner
            );

            $data['banner'] = $banner;
        }

        $company->update($data);

        return redirect()
            ->route('company.index')
            ->with('success', 'Company Profile berhasil diperbarui.');
    }
}