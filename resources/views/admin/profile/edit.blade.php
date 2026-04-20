@extends('layouts.admin')

@section('title', 'Account Settings | Admin')
@section('header_title', 'Account Settings')

@section('content')

<div class="relative w-full min-h-[85vh] rounded-[2.5rem] overflow-hidden bg-white/[0.02] p-4 sm:p-6 lg:p-8 shadow-[0_8px_32px_rgba(0,0,0,0.3)] border border-white/10 backdrop-blur-sm">
    
    <div class="relative z-10 max-w-4xl mx-auto space-y-8">
        
        <div>
            <h2 class="font-serif text-3xl text-brand-cream tracking-wide drop-shadow-md">Profile & Security</h2>
            <p class="text-xs text-brand-gray font-light tracking-[0.2em] uppercase mt-2">Manage your administrative account</p>
        </div>

        <div class="flex flex-col lg:flex-row gap-8">

            <div class="w-full lg:w-2/3 bg-white/5 backdrop-blur-2xl border border-white/10 rounded-[2rem] shadow-[0_8px_32px_0_rgba(0,0,0,0.4)] p-8">
                <form action="{{ route('admin.profile.update') }}" method="POST" class="space-y-8">
                    @csrf
                    @method('PUT')

                    <div>
                        <h3 class="text-sm font-semibold uppercase tracking-widest text-brand-cream mb-6 border-b border-white/10 pb-4">Basic Information</h3>
                        <div class="space-y-6">
                            <div>
                                <label class="block text-[10px] uppercase tracking-widest text-brand-gray mb-2 font-semibold">Full Name *</label>
                                <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full bg-black/20 border border-white/10 rounded-xl shadow-inner p-3.5 focus:ring-brand-sage focus:border-brand-sage text-sm text-brand-cream transition">
                                @error('name') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-[10px] uppercase tracking-widest text-brand-gray mb-2 font-semibold">Email Address *</label>
                                <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full bg-black/20 border border-white/10 rounded-xl shadow-inner p-3.5 focus:ring-brand-sage focus:border-brand-sage text-sm text-brand-cream transition">
                                @error('email') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-sm font-semibold uppercase tracking-widest text-brand-cream mb-6 border-b border-white/10 pb-4">Update Password</h3>
                        <p class="text-xs text-brand-olive mb-6 font-light tracking-wide">Leave these fields blank if you do not want to change your password.</p>
                        <div class="space-y-6">
                            <div>
                                <label class="block text-[10px] uppercase tracking-widest text-brand-gray mb-2 font-semibold">Current Password</label>
                                <input type="password" name="current_password" class="w-full bg-black/20 border border-white/10 rounded-xl shadow-inner p-3.5 focus:ring-brand-sage focus:border-brand-sage text-sm text-brand-cream transition" placeholder="Enter current password to authorize changes">
                                @error('current_password') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-[10px] uppercase tracking-widest text-brand-gray mb-2 font-semibold">New Password</label>
                                    <input type="password" name="new_password" class="w-full bg-black/20 border border-white/10 rounded-xl shadow-inner p-3.5 focus:ring-brand-sage focus:border-brand-sage text-sm text-brand-cream transition" placeholder="Min. 8 characters">
                                    @error('new_password') <span class="text-red-400 text-xs mt-1 block">{{ $message }}</span> @enderror
                                </div>
                                <div>
                                    <label class="block text-[10px] uppercase tracking-widest text-brand-gray mb-2 font-semibold">Confirm New Password</label>
                                    <input type="password" name="new_password_confirmation" class="w-full bg-black/20 border border-white/10 rounded-xl shadow-inner p-3.5 focus:ring-brand-sage focus:border-brand-sage text-sm text-brand-cream transition" placeholder="Retype new password">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-white/10 flex justify-end gap-4">
                        <button type="submit" class="px-8 py-3.5 bg-brand-sage/20 text-brand-sage border border-brand-sage/30 rounded-full text-xs font-bold uppercase tracking-widest hover:bg-brand-sage/30 transition shadow-[0_0_15px_rgba(170,171,154,0.15)] backdrop-blur-md">Save Changes</button>
                    </div>
                </form>
            </div>

            <div class="w-full lg:w-1/3">
                <div class="bg-brand-olive/10 border border-brand-olive/20 rounded-[2rem] p-8 shadow-inner">
                    <div class="flex items-center gap-3 mb-4">
                        <svg class="w-6 h-6 text-brand-sage" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <h3 class="font-semibold text-brand-sage uppercase tracking-widest text-sm">Security Notice</h3>
                    </div>
                    <p class="text-sm text-brand-warm font-light leading-relaxed mb-4">
                        Always use a strong, unique password to protect the LUMEN Admin Dashboard from unauthorized access.
                    </p>
                    <ul class="text-xs text-brand-gray space-y-2 list-disc pl-4 opacity-80">
                        <li>Minimum 8 characters length</li>
                        <li>Combine uppercase and lowercase letters</li>
                        <li>Include numbers and symbols</li>
                    </ul>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection