<x-business-layout>
    <div class="py-12">
        <div class="w-[90%] mx-auto">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200 flex justify-between">
                    You are inside {{$subdomain->name}}
                    @role('admin')
                        <button>
                            <a href="{{ route('dashboard')}}">Return</a>
                        </button>
                    @endrole
                </div>
            </div>
        </div>
    </div>
</x-business-layout>
