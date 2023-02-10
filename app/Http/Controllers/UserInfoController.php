<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserInfoStoreRequest;
use App\Http\Requests\UserInfoUpdateRequest;
use App\Models\UserInfo;
use Illuminate\Http\Request;

class UserInfoController extends Controller
{
    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $userInfos = UserInfo::all();

        return view('userInfo.index', compact('userInfos'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('userInfo.create');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\UserInfo $userInfo
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, UserInfo $userInfo)
    {
        return view('userInfo.show', compact('userInfo'));
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\UserInfo $userInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, UserInfo $userInfo)
    {
        return view('userInfo.edit', compact('userInfo'));
    }

    /**
     * @param \App\Http\Requests\UserInfoUpdateRequest $request
     * @param \App\Models\UserInfo $userInfo
     * @return \Illuminate\Http\Response
     */
    public function update(UserInfoUpdateRequest $request, UserInfo $userInfo)
    {
        $userInfo->update($request->validated());

        $request->session()->flash('userInfo.id', $userInfo->id);

        return redirect()->route('userInfo.index');
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\UserInfo $userInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, UserInfo $userInfo)
    {
        $userInfo->delete();

        return redirect()->route('userInfo.index');
    }

    /**
     * @param \App\Http\Requests\UserInfoStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserInfoStoreRequest $request)
    {
        $userInfo = UserInfo::create($request->validated());

        $request->session()->flash('userInfo-added-successively', $userInfo-added-successively);

        return redirect()->route('Booking.index');
    }
}
