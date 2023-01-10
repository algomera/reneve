<x-business-layout>
    <div class="py-12">
        <div class="w-[90%] mx-auto">
            <div class="w-1/2 m-auto flex justify-between items-center">
                <h1 class="text-3xl font-semibold mb-5">{{$user->name . ' ' . $user->last_name}}</h1>
                <a href="{{url()->previous()}}" class="px-7 py-3 bg-[#E5EAEA] text-[13px] font-bold uppercase text-[#7E8D9B] hover:bg-[#DCE2E2] tracking-[0.75px]">Indietro</a>
            </div>

            <div class="w-1/2 m-auto bg-white shadow-lg p-5 mt-5 flex">
                <div class="flex flex-col gap-2 w-full">
                    <div class="flex flex-col gap-2 w-full">
                        <span><strong>Data di nascita:</strong> {{ date("d-m-Y", strtotime($user->date_of_birth)) }}</span>
                        <span><strong>Sesso:</strong> {{ $user->sex == 1 ? 'F' : 'M' }}</span>
                        <span><strong>Cellulare:</strong> {{ $user->mobile_phone }}</span>
                        <span><strong>Telefono:</strong> {{ $user->telephone }}</span>
                        <span><strong>Email:</strong> {{ $user->email }}</span>
                        <span><strong>Indirizzo:</strong> {{ $user->address }}</span>
                        <span><strong>Civico:</strong> {{ $user->civic }}</span>
                        <span><strong>Citta:</strong> {{ $user->city }}</span>
                        <span><strong>Provincia:</strong> {{ $user->province }}</span>
                        <span><strong>Cap:</strong> {{ $user->cap }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-business-layout>
