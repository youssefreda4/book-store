<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use App\Models\UserAddress;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $userAddress = UserAddress::select('id', 'address')->where('user_id', auth('web')->id())->get();
        return view('website.pages.profile.index', compact('userAddress'));
    }

    public function update(UpdateProfileRequest $request)
    {
        $userId = auth('web')->id();
        $data = $request->validated();
        $dataCollection = collect($data) ?? null;

        $user = User::where('id', $userId)->first();
        $user->update($dataCollection->except(['addresses', 'new_address', 'image'])->toArray());

        $userAddresses = UserAddress::where('user_id', $userId)->whereIn('id', array_keys($data['addresses']))->get();
        if ($userAddresses->count() != count($dataCollection['addresses'])) {
            return redirect()->back()->with(['error' => 'Something wrong in your address']);
        }

        foreach ($data['addresses'] as $addressId => $addressData) {
            $userAddress = UserAddress::where('user_id', $userId)->where('id', $addressId)->first();
            if (!$userAddress) {
                continue;
            }
            if (isset($addressData['delete']) && $addressData['delete'] == '1') {
                $userAddress->delete();
                continue;
            }
            $userAddress->update(['address' => $addressData['address']]);
        }

        if ($request->hasFile('image')) {
            $user->clearMediaCollection('profile');
            $user->addMediaFromRequest('image')
                ->toMediaCollection('profile');
            $user->image = null;
            $user->save();
        }

        if ($data['new_address']) {
            UserAddress::create([
                'user_id' => $userId,
                'address' => $data['new_address'],
            ]);
        }

        return redirect()->back()->with(['success' => 'Your profile updated successfully!']);
    }
}
