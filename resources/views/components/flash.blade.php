@if(Session::has('message-success'))
    <div class="bg-green-100 border border-green-300 text-green-800 flex gap-3 p-4 rounded-lg mb-2">
        <svg class="w-6 h-6 stroke-current text-green-800" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" height="24" width="24" xmlns:v="https://vecta.io/nano"><path d="M1 14l4-4 8 8L27 4l4 4-18 18z" fill="#155759"/></svg>
        {{ Session::get('message-success') }}
    </div>
@endif
@if(Session::has('message-error'))
    <div class="bg-red-100 border border-red-300 text-red-800 flex gap-3 p-4 rounded-lg mb-2">
        <svg class="w-6 h-6 stroke-current text-red-800" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 612 792" widht="24" height="24" xmlns:v="https://vecta.io/nano">
                <path d="M382.2 396.4l178.6-178.6L484 141 305.4 319.6 126.8 141 50 217.8l178.6 178.6L50 575l76.8 76.8 178.6-178.6L484 651.8l76.8-76.8-178.6-178.6z" fill="#e44061"/>
        </svg>
        {{ Session::get('message-error') }}
    </div>
@endif

@if($errors->any())
<div class="bg-red-100 border border-red-300 text-red-800 flex gap-3 p-4 rounded-lg mb-2">
    <svg class="w-6 h-6 stroke-current text-red-800" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 612 792" widht="24" height="24" xmlns:v="https://vecta.io/nano">
        <path d="M382.2 396.4l178.6-178.6L484 141 305.4 319.6 126.8 141 50 217.8l178.6 178.6L50 575l76.8 76.8 178.6-178.6L484 651.8l76.8-76.8-178.6-178.6z" fill="#e44061"/>
    </svg>
    {{$message}}
</div>
@endif