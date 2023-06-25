@if(session()->has('success'))
<div x-data="{show: true}" x-init="setTimeout(() => show = false, 3000)" x-show="show" class="fixed top-0 w-full text-center left-1/2 transform -translate-x-1/2 bg-laravel text-white px-48 py-3">
     <p>{{ session()->get('success') }}</p>
</div>
@endif