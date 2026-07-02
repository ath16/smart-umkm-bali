<?php

namespace App\Http\Controllers;

use App\Services\CloudinaryService;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CustomerProfileController extends Controller
{
    /**
     * Show the customer profile edit form.
     */
    public function edit(): View
    {
        return view('customer.profile.edit', [
            'user' => auth()->user(),
            'profile' => auth()->user()->customerProfile()->firstOrCreate([]),
        ]);
    }

    /**
     * Update the customer profile.
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:20'],
            'birth_date' => ['nullable', 'date'],
            'gender' => ['nullable', 'in:L,P'],
            'avatar' => ['nullable', 'image', 'mimes:jpeg,png,jpg,webp', 'mimetypes:image/jpeg,image/png,image/webp', 'max:2048'], // Max 2MB
        ]);

        // Update User Model (Name, Email)
        $user->fill([
            'name' => $validated['name'],
            'email' => $validated['email'],
        ]);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        // Update Profile Model
        $profile = $user->customerProfile()->firstOrCreate([]);
        
        $profileData = [
            'phone' => $validated['phone'],
            'birth_date' => $validated['birth_date'],
            'gender' => $validated['gender'],
        ];

        // Handle Avatar Upload
        if ($request->hasFile('avatar')) {
            $cloudinary = app(CloudinaryService::class);
            $cloudinary->deleteByPublicId($profile->avatar_public_id);
            $result = $cloudinary->uploadUserAvatar($request->file('avatar'), auth()->id());
            if ($result['success']) {
                $profileData['avatar_url'] = $result['url'];
                $profileData['avatar_public_id'] = $result['public_id'];
            }
        }

        $profile->update($profileData);

        return redirect()->route('customer.profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }
}
